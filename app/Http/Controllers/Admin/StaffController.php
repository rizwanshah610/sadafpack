<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class StaffController extends Controller
{
    // List all staff
    public function index()
    {
        $staff = User::role(['admin', 'staff'])->get();
        return view('admin.staff.index', compact('staff'));
    }

    // Show create form
    public function create()
    {
        $roles = Role::whereIn('name', ['admin', 'staff'])->get();
        return view('admin.staff.create', compact('roles'));
    }

    // Store new staff
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role'     => 'required|in:admin,staff',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole($request->role);

        return redirect()->route('staff.index')
            ->with('success', 'Staff member created successfully.');
    }

    // Show edit form
    public function edit(User $user)
    {
        $roles = Role::whereIn('name', ['admin', 'staff'])->get();
        return view('admin.staff.edit', compact('user', 'roles'));
    }

    // Update staff
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role'  => 'required|in:admin,staff',
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        $user->syncRoles($request->role);

        return redirect()->route('staff.index')
            ->with('success', 'Staff member updated successfully.');
    }

    // Delete staff
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('staff.index')
            ->with('success', 'Staff member deleted successfully.');
    }
}