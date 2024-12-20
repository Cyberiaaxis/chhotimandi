<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {

        return view('Customer.layouts.index'); // Pass users to the view
    }

    public function users()
    {
        $users = User::all(); // Retrieve all users from the database
        return view('Staff.pages.home', compact('users')); // Pass users to the view
    }

    public function createUser(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Return validation errors if any
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create a new User instance
        $user = new User();
        $user->addUser($request->all()); // Call the instance method to add user

        // Optionally, return the newly created user or a success message
        return redirect('/users');
    }

    public function edit($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Return the edit view with the user data
        return view('edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id, // Exclude current user email
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Handle validation errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Find the user by ID
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        // Update password only if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect('/users')->with('success', 'User updated successfully!'); // Redirect with a success message
    }

    public function destroy($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Delete the user
        $user->delete();

        return redirect('/users')->with('success', 'User deleted successfully!'); // Redirect with a success message
    }
}
