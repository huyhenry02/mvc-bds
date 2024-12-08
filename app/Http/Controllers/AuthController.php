<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class AuthController extends Controller
{
    public function showLogin(): View|Factory|Application
    {
        return view('auth.login');
    }

    public function showRegister(): View|Factory|Application
    {
        return view('auth.register');
    }

    public function postRegister(Request $request): ?RedirectResponse
    {

        DB::beginTransaction();
        try {
            $input = $request->all();
            $input['role'] = 'customer';
            $input['password'] = bcrypt($input['password']);
            $user = new User();
            $user->fill($input);
            $user->save();
            DB::commit();
            return redirect()->route('auth.showLogin')->with('success', 'Register successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('auth.showRegister')->with('error', $e->getMessage());
        }
    }

    public function showChangePassword(): View|Factory|Application
    {
        return view('auth.change-password');
    }

    public function postLogin(Request $request): ?RedirectResponse
    {
        try {
            $credentials = $request->only('email', 'password');
            if (auth()->attempt($credentials)) {
                if (auth()->user()->role === 'admin') {
                    return redirect()->route('user.showIndex');
                }
                return redirect()->route('customer.showIndex');
            }
            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->route('auth.showLogin')->with('error', $e->getMessage());
        }
    }

    public function postChangePassword(Request $request): RedirectResponse
    {
        try {
            if ($request->new_password !== $request->confirm_password) {
                return back()->withErrors(['confirm_password' => 'Mật khẩu xác nhận không khớp.']);
            }
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required',
                'confirm_password' => 'required|same:new_password',
            ]);
            $input = $request->all();
            if (!Hash::check($input['old_password'], auth()->user()->password)) {
                return back()->withErrors(['old_password' => 'Mật khẩu hiện tại không chính xác.']);
            }
            auth()->user()->update([
                'password' => Hash::make($input['new_password']),
            ]);
            return redirect()->route('auth.showChangePassword')->with('status', 'Đổi mật khẩu thành công!');
        }catch (Exception $e) {
            return redirect()->route('auth.showChangePassword')->with('error', $e->getMessage());
        }
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();
        return redirect()->route('auth.showLogin');
    }
}
