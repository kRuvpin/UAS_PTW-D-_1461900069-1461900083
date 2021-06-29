<?php

namespace App\Http\Controllers;

use Illuminate\support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Baju;
use Illuminate\support\Facades\Auth;
use App\Models\User;



class AwokController extends Controller
{
    public function index()
    {
        $baju = Baju::all();
        return view('index', ['baju' => $baju]);
    }

    public function signup_form()
    {
        return view('akun.signup');
    }
    public function signup(Request $request)
    {
        User::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'level' => 'costumer',
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        return redirect('/signin');
    }

    public function signin_form()
    {
        return view('akun.signin');
    }
    public function signin(Request $request)
    {
        $user = DB::table('users')->where('email', $request->email)->get();
        // dd($user)->get();
        if (Auth::attempt($request->only('email', 'password', 'level'))) {
            foreach ($user as $User) {
                if ($User->level == 'admin') {
                    return redirect('/admin/index');
                } else {
                    return redirect('/costumer/index');
                }
            }
        }
        return redirect('/signin');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('index');
    }
}
