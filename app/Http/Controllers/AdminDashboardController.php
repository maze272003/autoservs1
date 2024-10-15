<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AdminDashboardController extends Controller
{
    public function showUserStatistics()
    {
        $usersPerMonth = DB::table('users')
            ->select(DB::raw('COUNT(*) as count'), DB::raw('MONTH(created_at) as month'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        return view('admin.userStatistics', ['usersPerMonth' => $usersPerMonth]);
    }
    public function showUsers()
    {
        try {
            // Count and retrieve users
            $userCount = User::count(); // This should set $userCount
            $users = User::all();       // This should set $users

            // Log the outputs
            \Log::info('User Count: ' . $userCount);
            \Log::info('Users:', $users->toArray());

            // Return the view with users and user count
            return view('admin.users', [
                'users' => $users,
                'userCount' => $userCount, // Ensure this is correctly set
            ]);
        } catch (\Exception $e) {
            \Log::error('Error fetching users: ' . $e->getMessage());
            return view('admin.users', [
                'users' => [],
                'userCount' => 0, // Fallback to zero if there's an error
            ]);
        }
    }

}
