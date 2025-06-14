<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Middleware\ForcePasswordChange;

class AuthController extends Controller
{
    public function showLogin(Request $request)
    {
        if (!session()->has('url.intended')) {
            session(['url.intended' => url()->previous()]);
        }
        return view('in_out.login');
    }

    public function showRegister(Request $request)
    {
        session(['url.intended' => url()->previous()]);
        return view('in_out.register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string',
        ]);

        $login_type = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $login_type => $request->login,
            'password' => $request->password
        ];
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            
            if ($user->role === 'admin') {
                return view('admin.redirect-admin');
            }
            
            if (session()->has('url.intended') &&
                !str_contains(session('url.intended'), '/dangnhap') &&
                !str_contains(session('url.intended'), '/dangky') &&
                !str_contains(session('url.intended'), '/doimatkhau')) {

                return redirect()->intended();
            }
            
            return redirect('/trangchu');
        }

        return back()->withErrors([
            'login' => 'Sai tài khoản hoặc mật khẩu.',
        ])->withInput();
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'username'=> 'required|string|unique:users,username',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'username'=> $request->username,
            'password' => Hash::make($request->password),
            'role'     => 'user',
        ]);

        return redirect()->route('login')->with('success', 'Bạn đăng ký thành công. Vui lòng đăng nhập.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/trangchu');
    }

    public function profile()
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'user') {
            abort(403);
        }

        $documentCount = $user->documents()->count();

        return view('in_out.info', compact('user', 'documentCount'));
    }

    public function showChangePasswordForm()
    {
        return view('in_out.change-pw');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Mật khẩu cũ không đúng.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')->with('done', 'Mật khẩu đã được đổi thành công. Vui lòng đăng nhập lại.');
    }
}
