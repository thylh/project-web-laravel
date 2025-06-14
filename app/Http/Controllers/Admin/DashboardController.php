<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Document;
use App\Models\User;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function home()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }

        $approvedCount = Document::where('is_approved', true)->count();
        $pendingCount = Document::where('is_approved', false)->count();
        $todayCount = Document::whereDate('created_at', now()->toDateString())->count();
        $userCount = User::count();
        $newUsersToday = User::whereDate('created_at', Carbon::today())->count();
        return view('admin.dashboard', compact(
            'approvedCount',
            'pendingCount',
            'todayCount',
            'userCount',
            'newUsersToday'
            ));
    }
    public function index()
    {
        $users = User::withCount('documents')->orderBy('created_at', 'desc')->get();
        return view('admin.dashboard-user', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'admin') {
            return back()->with('success', 'Không thể xóa tài khoản admin.');
        }

        $user->delete();
        return back()->with('success', 'Xóa người dùng thành công.');
    }
}
