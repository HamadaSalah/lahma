<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AskPay;
use App\Models\Client;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function getlogin()
    {
        return view('Admin.login');
    }
    public function dologin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $rememberme = $request->rememberme;
        if (auth()->guard('admin')->attempt(['email' => $email, 'password' => $password], $rememberme)) {
            return redirect('admin/index');
        } 
        else {
            session()->flash('error', 'Wrong Email Or Password');
            return redirect('admin/login');
        }
    }
    public function index()
    {
        return view('Admin.index', [
            'title' => 'الرئيسية',
            'employees' => 5,
            'users' => 5,
            'con' => 5
        ]);
    }
    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();
        return redirect()->route('Admin.login');
    }
}
