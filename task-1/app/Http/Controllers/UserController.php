<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\User;
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
        return view("admin.user-views.add-user-form");
    }

    public function total()
    {
        $categories     = Category::getAllCategories();
        $sub_categories = SubCategory::getAllSubCategories();
        $users          = User::getAllUsers();

        return view("admin.total",
            [
                "users"          => $users,
                "categories"     => $categories,
                "sub_categories" => $sub_categories
            ]
        );
    }

    public function users()
    {
        return view("admin.user-views.users");
    }

    public function edit($id)
    {
        $userID = User::findOrFail($id);
        return view("admin.user-views.edit-user", ["user" => $userID]);
    }

    public function insertUser(Request $request)
    {
       $user = new User();

       $request->validate([
           "email"        => "required|unique:users,email|max:50",
           "name"         => "required|min:2|max:20",
           "role"         => "required",
           "password"     => "required|string|min:8",
           "phone_number" => "required|digits:10"
       ]);

       if ($request->password !== $request->password_confirmation)  {
           Alert::error("Something Wrong!", "Password not match!");
           return redirect()->route("admin.user.add_user_form");
       }

       $user->name         = $request->name;
       $user->email        = $request->email;
       $user->password     = bcrypt($request->password);
       $user->role         = $request->get("role");
       $user->phone_number = $request->phone_number;
       $user->save();

       Alert::success("Registered!", "User registered successfully!");
       return redirect()->route("admin.user.users");
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "email"        => "required|email|max:50",
            "name"         => "required|min:2|max:20",
            "role"         => "required",
            "phone_number" => "required|digits:10"
        ]);

        $user               = User::findOrFail($id);
        $user->name         = $request->input("name");
        $user->email        = $request->input("email");
        $user->role         = $request->input("role");
        $user->phone_number = $request->input("phone_number");
        $user->update();

        Alert::success("Updated!", "user updated successfully!");
        return redirect()->route("admin.user.users");
    }

    public function displayUsers(Request $request)
    {
        return view("admin.user-views.users",
            [
                "users" => User::where(function($q) use($request){
                    if($request->has('user_role')){
                        return $q->where('role', $request->user_role);
                    }elseif ($request->user_role === 'all'){
                        // return all users
                    }
                })->get()
            ]
        );
    }

    public function destroy(User $user)
    {
        $user->delete();
        Alert::success("Deleted!", "User deleted successfully!");
        return redirect()->route("admin.user.users");
    }
}
