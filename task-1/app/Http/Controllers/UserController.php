<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function welcome()
    {
        $title = 'Home';
        return view('welcome', ['title' => $title]);
    }

    public function index()
    {
        return view('add-user-form');
    }

    public function users()
    {
        return view('users');
    }

    public function edit($id)
    {
        $user = new User;
        $userID = $user->find($id);
        return view('edit-user', ['user' => $userID]);
    }

    public function update(Request $request, $id)
    {
        $userID = new User;
        $user = $userID->find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');
        $user->update();
        return redirect('users')->with('status', 'user updated successfully');
    }

    public function displayUsers()
    {
        $user = new User();
        return view('users', ['users' => $user->getAllUsers()]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect('users')->with('status', 'User removed successfully!');
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
       return redirect('users')->with('status', 'User registered successfully!');
    }
}
