<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleController extends Controller
{
    /**
     * Display a listing of the roles.
     *
     * @return \Illuminate\View\View
     */
    public function index(): \Illuminate\View\View
    {
        $roles = Role::paginate(10);
        return view('Staff.pages.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role.
     *
     * @return \Illuminate\View\View
     */
    public function create(): \Illuminate\View\View
    {
        $permissions = Permission::all();
        return view('Staff.pages.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:roles,name|max:255',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id', // Validate each permission ID
        ]);

        $role = Role::create(['name' => $validatedData['name']]);

        if (!empty($validatedData['permissions'])) {
            $role->givePermissionTo($validatedData['permissions']);
        }

        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
    }

    /**
     * Show the form for editing the specified role.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\View\View
     */
    public function edit(Role $role): \Illuminate\View\View
    {
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('Staff.pages.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Role $role): \Illuminate\Http\RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id', // Ensure valid permission IDs
        ]);

        $role->update(['name' => $validatedData['name']]);

        if (isset($validatedData['permissions'])) {
            // Sync the permissions only if provided
            $role->syncPermissions($validatedData['permissions']);
        } else {
            // Remove all permissions if none are provided
            $role->syncPermissions();
        }

        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified role from storage.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Role $role): \Illuminate\Http\RedirectResponse
    {
        // Ensure no users are assigned to this role before deletion (optional check)
        if ($role->users()->count() > 0) {
            return redirect()->route('admin.roles.index')->with('error', 'Role cannot be deleted as it is assigned to users.');
        }

        $role->delete();

        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully.');
    }

    /**
     * Assign a role to a user.
     *
     * @return \Illuminate\Http\Response
     */
    public function assignRoleShow()
    {
        // This method seems to be incomplete, add functionality as needed
        $users = User::all();
        $roles = Role::all();
        return view('Staff.pages.userRoles.index', compact('users', 'roles'));
    }

    /**
     * Attach a permission to a role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function attachPermission(Request $request, Role $role): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'permission' => 'required|exists:permissions,name',
        ]);

        $permission = $request->input('permission');
        $role->givePermissionTo($permission);

        return redirect()->route('admin.roles.index')->with('success', 'Permission attached successfully.');
    }

    /**
     * Assign a permission to a role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assignPermission(Request $request, Role $role): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'permission' => 'required|string|exists:permissions,name',
        ]);

        $role->givePermissionTo($request->input('permission'));

        return redirect()->route('admin.roles.index')->with('success', 'Permission assigned successfully.');
    }
}
