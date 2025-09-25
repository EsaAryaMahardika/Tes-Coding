<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Content;

class General extends Controller
{
    public function signin(){
        return view('signin');
    }
    public function signup(){
        return view('signup');
    }
    public function register(Request $request){
        $validate = $request->validate([
            'username' => 'required|string|max:255|unique:account',
            'name' => 'required|string|max:255',
            'password' => 'required|string|confirmed'
        ]);
        $validate['password'] = bcrypt($validate['password']);
        User::create($validate);
        return redirect('signin')->with('success', 'Registration successful, please login');
    }
    public function auth(Request $request){
        $validate = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt($validate)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return redirect()->back()->with('error', 'Username / Password is wrong');
    }
    public function dashboard(){
        $user = Auth::user()->role;
        $content = Content::all()->count();
        $author = User::where('role', 'author')->count();
        switch ($user) {
            case 'admin':
                return view('admin', compact('content', 'author'));
            case 'author':
                return view('author', compact('content'));
        }
    }
    public function logout(){
        Auth::logout();
        return redirect('/signin')->with('success', 'You have logged out');
    }
}