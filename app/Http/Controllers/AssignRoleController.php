<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class AssignRoleController extends Controller
{
    /**
     * Display a listing of the users with their roles.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::with('roles')->get();

        return view('Staff.pages.userRoles.index', compact('users'));
    }

    /**
     * Show the form for creating a new role.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $users = User::all();
        $roles = Role::all();

        return view('Staff.pages.userRoles.create', compact('users', 'roles'));
    }

    /**
     * Store a newly created role in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name', // Ensure each role exists in the roles table
        ]);

        // Fetch the user by user_id
        $user = User::findOrFail($request->user_id);
        $user->syncRoles($request->roles); // Sync the roles

        return redirect()->route('admin.assignRole.index')
            ->with('success', 'Roles assigned successfully.');
    }

    /**
     * Show the form for editing roles for a specific user.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit(int $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all(); // Get all roles

        return view('Staff.pages.userRoles.edit', compact('user', 'roles'));
    }

    /**
     * Update the roles of a specific user.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,name', // Validate role names
        ]);

        $user = User::findOrFail($id);
        $user->syncRoles($request->roles); // Sync the updated roles

        return redirect()->route('admin.assignRole.index')
            ->with('success', 'Roles updated successfully!');
    }

    /**
     * Remove a user and detach their roles.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $user = User::findOrFail($id);

        // Remove all roles from the user and then delete the user
        $user->syncRoles([]);
        $user->delete();

        return redirect()->route('admin.assignRole.index')
            ->with('success', 'User deleted successfully!');
    }
}
