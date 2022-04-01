<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
Use RealRashid\SweetAlert\Facades\Alert;
use Eloquent;

/**
 * User
 *
 * @mixin Eloquent
 */

class UserController extends Controller
{
    public function welcome()
    {
        return view("welcome");
    }

    public function index()
    {
        return view("user-views.add-user-form");
    }

    public function users()
    {
        return view("user-views.users");
    }

    public function edit($id)
    {
        $user = new User;
        $userID = $user->findOrFail($id);
        return view("user-views.edit-user", ["user" => $userID]);
    }

    public function update(Request $request, $id)
    {
        $userID = new User;

        $request->validate([
            "email"        => "required|email|max:50",
            "name"         => "required|min:2|max:20",
            "phone_number" => "required|digits:10"
        ]);

        $user = $userID->findOrFail($id);
        $user->name = $request->input("name");
        $user->email = $request->input("email");
        $user->phone_number = $request->input("phone_number");
        $user->update();

        Alert::success("Updated!", "user updated successfully!");
        return redirect()->route("user.users");
    }

    public function displayUsers()
    {
        $user = new User();
        return view("user-views.users", ["users" => $user->getAllUsers()]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        Alert::success("Deleted!", "User Deleted successfully!");
        return redirect()->route("user.users");
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

       if ($request->password !== $request->password_confirmation)  {
           Alert::error("Something Wrong!", "Password not match!");
           return redirect()->route("user.add_user_form");
       }

       $user->name = $request->name;
       $user->email = $request->email;
       $user->password = bcrypt($request->password);
       $user->phone_number = $request->phone_number;
       $user->save();

       Alert::success("Registered!", "User registered successfully!");
       return redirect()->route("user.users");
    }
}
