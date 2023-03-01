<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{

    public function index()
    {
        if (Auth::check()) {
            if (auth()->user()->hasRole('user')) {
                return redirect('/user/dashboard');
            } else {
                return redirect('/admin/dashboard');
            }
        }

        return view('auth.pages.signin');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ]);
        $user = Auth::user();
        $userCredentials = $request->only('email', 'password');

        if (Auth::attempt($userCredentials)) {

            if (Auth::check()) {
                if (auth()->user()->hasRole('user')) {
                    return redirect('/user/dashboard');
                } else {
                    return redirect('/admin/dashboard');
                }
            }
        } else {
            return back()->with('error', 'Username & Password is Invalid');
        }
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
