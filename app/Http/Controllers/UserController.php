<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function getProfile(Request $request)
    {
        try {
            $userId = $request->query('user_id');
            $user = User::find($userId);

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'user' => $user,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $userId = $request->input('user_id');
            $user = User::find($userId);

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found',
                ], 404);
            }

            if ($request->has('name')) $user->name = $request->name;
            if ($request->has('phone')) $user->phone = $request->phone;
            if ($request->has('address')) $user->address = $request->address;

            if ($request->hasFile('photo')) {
                if ($user->photo) {
                    Storage::disk('public')->delete($user->photo);
                }
                $path = $request->file('photo')->store('users', 'public');
                $user->photo = $path;
            }

            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Profile updated!',
                'user' => $user,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }}
public function updatePreferences(Request $request)
{
    try {
        $userId = $request->input('user_id');
        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }

        if ($request->has('preferred_currency')) {
            $user->preferred_currency = $request->preferred_currency;
        }
        if ($request->has('preferred_timezone')) {
            $user->preferred_timezone = $request->preferred_timezone;
        }

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Preferences updated!',
            'user' => $user,
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error: ' . $e->getMessage(),
        ], 500);
    }
}
}