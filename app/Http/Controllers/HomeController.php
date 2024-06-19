<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    //
    function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'register_email' => 'required|email|unique:users,email',
        ]);
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()]);
        }
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('register_email'),
            'password' => $request->get('register_password'),
            'usertype' => $request->get('usertype'),
        ]);
        return response()->json(['success' => true, 'message' => 'Register Successfully..']);
    }
    function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
           return response()->json(['success'=>true,'message'=>'Login Successful..','usertype'=>Auth::user()->usertype]);
        } else {
            return response()->json(['success' => false, 'message' => 'Login Fail']);
        }
    }
    function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    function adminpage()
    {
        return view('admindashboard');
    }
    function userpage()
    {
        return view('userdashboard');
    }
}
