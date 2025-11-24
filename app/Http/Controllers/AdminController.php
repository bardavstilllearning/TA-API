<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Worker;
use App\Models\Order;
use App\Models\WorkerSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // ==================== AUTH ====================
    public function showLogin()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($request->username === 'admin' && $request->password === 'admin') {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
        }

        return back()->with('error', 'Username atau password salah!');
    }

    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login')->with('success', 'Logout berhasil!');
    }

    // ==================== DASHBOARD ====================
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_workers' => Worker::count(),
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'completed_orders' => Order::where('status', 'completed')->count(),
            'total_revenue' => Order::where('status', 'completed')->sum('total_price'),
        ];

        $recent_orders = Order::with(['user', 'worker'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $top_workers = Worker::orderBy('rating', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_orders', 'top_workers'));
    }

    // ==================== USERS ====================
    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function userShow($id)
    {
        $user = User::with('orders')->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function userEdit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function userUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        $user->update($request->only(['name', 'email', 'phone', 'address']));

        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $user->photo = $request->file('photo')->store('users', 'public');
            $user->save();
        }

        return redirect()->route('admin.users')->with('success', 'User berhasil diupdate!');
    }

    public function userDelete($id)
    {
        $user = User::findOrFail($id);
        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User berhasil dihapus!');
    }

    // ==================== WORKERS ====================
    public function workers()
    {
        $workers = Worker::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.workers.index', compact('workers'));
    }

    public function workerCreate()
    {
        return view('admin.workers.create');
    }

    public function workerStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'price_per_hour' => 'required|numeric|min:0',
            'phone' => 'required|string',
            'whatsapp' => 'nullable|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'photo' => 'nullable|image|max:5120',
        ]);

        $data = $request->except('photo');
        $data['rating'] = 4.5;
        $data['total_orders'] = 0;
        $data['is_available'] = true;

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('workers', 'public');
        }

        $worker = Worker::create($data);

        // Create default schedule
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $timeSlots = ['08:00-10:00', '10:00-12:00', '13:00-15:00', '15:00-17:00'];

        foreach ($days as $day) {
            foreach ($timeSlots as $slot) {
                WorkerSchedule::create([
                    'worker_id' => $worker->id,
                    'day' => $day,
                    'time_slot' => $slot,
                    'is_available' => true,
                ]);
            }
        }

        return redirect()->route('admin.workers')->with('success', 'Worker berhasil ditambahkan!');
    }

    public function workerShow($id)
    {
        $worker = Worker::with(['schedules', 'orders'])->findOrFail($id);
        return view('admin.workers.show', compact('worker'));
    }

    public function workerEdit($id)
    {
        $worker = Worker::findOrFail($id);
        return view('admin.workers.edit', compact('worker'));
    }

    public function workerUpdate(Request $request, $id)
    {
        $worker = Worker::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'price_per_hour' => 'required|numeric|min:0',
            'phone' => 'required|string',
            'whatsapp' => 'nullable|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'photo' => 'nullable|image|max:5120',
        ]);

        $worker->update($request->except('photo'));

        if ($request->hasFile('photo')) {
            if ($worker->photo) {
                Storage::disk('public')->delete($worker->photo);
            }
            $worker->photo = $request->file('photo')->store('workers', 'public');
            $worker->save();
        }

        return redirect()->route('admin.workers')->with('success', 'Worker berhasil diupdate!');
    }

    public function workerDelete($id)
    {
        $worker = Worker::findOrFail($id);
        if ($worker->photo) {
            Storage::disk('public')->delete($worker->photo);
        }
        $worker->schedules()->delete();
        $worker->delete();
        return redirect()->route('admin.workers')->with('success', 'Worker berhasil dihapus!');
    }

    // ==================== ORDERS ====================
    public function orders()
    {
        $orders = Order::with(['user', 'worker'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }

    public function orderShow($id)
    {
        $order = Order::with(['user', 'worker'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function orderDelete($id)
    {
        $order = Order::findOrFail($id);
        if ($order->photo_before) {
            Storage::disk('public')->delete($order->photo_before);
        }
        if ($order->photo_after) {
            Storage::disk('public')->delete($order->photo_after);
        }
        $order->delete();
        return redirect()->route('admin.orders')->with('success', 'Order berhasil dihapus!');
    }

    // ==================== SCHEDULES ====================
    public function schedules($workerId)
    {
        $worker = Worker::findOrFail($workerId);
        $schedules = WorkerSchedule::where('worker_id', $workerId)
            ->orderByRaw("FIELD(day, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
            ->get()
            ->groupBy('day');
        
        return view('admin.schedules.index', compact('worker', 'schedules'));
    }

    public function scheduleToggle(Request $request, $id)
    {
        $schedule = WorkerSchedule::findOrFail($id);
        $schedule->is_available = !$schedule->is_available;
        $schedule->save();

        return back()->with('success', 'Schedule updated!');
    }
}