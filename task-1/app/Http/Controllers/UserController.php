<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function index()
    {
        return view('add-user-form');
    }

    public function insertUser(Request $request)
    {
       $user = new User();

       $request->validate([
           "email"        => "required|unique:users,email|max:50",
           "name"         => "required|min:2|max:20",
           "password"     => "required|string",
           "phone_number" => "required|digits:10"
       ]);

       if ($request->password !== $request->password_confirmation)
           return redirect("add-user-form")->with('error', 'Password not match!');

       $user->name = $request->name;
       $user->email = $request->email;
       $user->password = bcrypt($request->password);
       $user->phone_number = $request->phone_number;

       $user->save();
       return redirect('add-user-form')->with('status', 'now you are registered!');
    }
}
