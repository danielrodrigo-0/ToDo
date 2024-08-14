<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function index(Request $r){
        // dd(Auth::user());
        if(Auth::check()){//verifica se tem usuario logado
            return redirect()->route('home');
        }
        return view('login');
    }

    public function register(Request $r){
        if(Auth::check()){
            return redirect()->route('home');
        }
        return view('register');
    }

    public function register_action(Request $r){
        $r->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);
        $data = $r->only(['name', 'email', 'password']);
        User::create($data);

        return redirect(route('login'));
    }

    public function login_action(Request $r){
        $validator = $r->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        if(Auth::attempt($validator)){
        return redirect()->route('home');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
