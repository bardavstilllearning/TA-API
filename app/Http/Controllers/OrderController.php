<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Worker;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'worker_id' => 'required|exists:workers,id',
                'order_date' => 'required|date',
                'time_slot' => 'required|string',
            ]);

            $user = User::findOrFail($request->user_id);
            $worker = Worker::findOrFail($request->worker_id);

            $distance = $this->calculateDistance(
                $user->latitude ?? -7.7956,
                $user->longitude ?? 110.3695,
                $worker->latitude,
                $worker->longitude
            );

            $totalPrice = $worker->price_per_hour * 2;

            $order = Order::create([
                'user_id' => $request->user_id,
                'worker_id' => $request->worker_id,
                'order_date' => $request->order_date,
                'time_slot' => $request->time_slot,
                'distance_km' => $distance,
                'total_price' => $totalPrice,
                'status' => 'pending',
            ]);

            $worker->increment('total_orders');

            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil dibuat!',
                'order' => $order->load('worker'),
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getUserOrders(Request $request)
    {
        try {
            $userId = $request->query('user_id');
            
            $orders = Order::with('worker')
                ->where('user_id', $userId)
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'orders' => $orders,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function show($orderId)
    {
        try {
            $order = Order::with('worker')->findOrFail($orderId);

            return response()->json([
                'success' => true,
                'order' => $order,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found',
            ], 404);
        }
    }

    public function updateStatus(Request $request, $orderId)
    {
        try {
            $request->validate([
                'status' => 'required|in:pending,accepted,on_the_way,in_progress,completed,cancelled',
            ]);

            $order = Order::findOrFail($orderId);
            $order->update(['status' => $request->status]);

            if ($request->status === 'on_the_way') {
                $order->update(['worker_arrived_at' => now()]);
            } elseif ($request->status === 'in_progress') {
                $order->update(['work_started_at' => now()]);
            } elseif ($request->status === 'completed') {
                $order->update(['work_completed_at' => now()]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Status updated!',
                'order' => $order,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function uploadPhotoBefore(Request $request, $orderId)
    {
        try {
            $request->validate([
                'photo' => 'required|image|max:5120',
            ]);

            $order = Order::findOrFail($orderId);

            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('orders/before', 'public');
                $order->update([
                    'photo_before' => $path,
                    'work_started_at' => now(),
                    'status' => 'in_progress',
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Photo before uploaded!',
                'order' => $order,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function uploadPhotoAfter(Request $request, $orderId)
    {
        try {
            $request->validate([
                'photo' => 'required|image|max:5120',
            ]);

            $order = Order::findOrFail($orderId);

            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('orders/after', 'public');
                $order->update([
                    'photo_after' => $path,
                    'work_completed_at' => now(),
                    'status' => 'completed',
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Photo after uploaded!',
                'order' => $order,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function submitReview(Request $request, $orderId)
    {
        try {
            $request->validate([
                'rating' => 'required|numeric|min:1|max:5',
                'review' => 'nullable|string',
            ]);

            $order = Order::findOrFail($orderId);
            $order->update([
                'user_rating' => $request->rating,
                'user_review' => $request->review,
            ]);

            $worker = $order->worker;
            $avgRating = $worker->orders()->whereNotNull('user_rating')->avg('user_rating');
            $worker->update(['rating' => round($avgRating, 2)]);

            return response()->json([
                'success' => true,
                'message' => 'Review submitted!',
                'order' => $order,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371;
        $latDiff = deg2rad($lat2 - $lat1);
        $lonDiff = deg2rad($lon2 - $lon1);
        $a = sin($latDiff / 2) * sin($latDiff / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($lonDiff / 2) * sin($lonDiff / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return round($earthRadius * $c, 2);
    }
}