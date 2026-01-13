<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class TenantController extends Controller
{
    public function index()
    {
        return view('admin.tenants.index', [
            'tenants' => User::orderBy('id', 'desc')->get(),
        ]);
    }
    //ADMIN VIEW FOR CREATING TENANT
    public function create()
    {
        return view('admin.tenants.create');
    }
    //STROE AFTER CREATING
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
            'role' => ['required', 'in:admin,user'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'user',
        ]);

        return redirect()->route('admin.tenants.index')->with('success', 'Tenant created.');
    }
    //ADMIN VIEW FOR EDITING TENANT
    public function edit(User $tenant)
    {
        return view('admin.tenants.edit', ['tenant' => $tenant]);
    }
    //UPDATE AFTER EDITING TENANT
    public function update(Request $request, User $tenant)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $tenant->id],
            'password' => ['nullable', 'string', 'min:6'],
        ]);

        $tenant->name = $validated['name'];
        $tenant->email = $validated['email'];
        $tenant->role = $request->input('role', 'user');

        if (!empty($validated['password'])) {
            $tenant->password = Hash::make($validated['password']);
        }

        $tenant->save();

        return redirect()
            ->route('admin.tenants.index')
            ->with('success', 'Tenant updated.');
    }

    //DELETE TENANT
    public function destroy(User $tenant)
    {
        $tenant->delete();
        return back()->with('success', 'Tenant deleted.');
    }
    //USER TO ADMIN
    public function toggleRole(User $tenant)
    {
        if ($tenant->id === Auth::id()) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $tenant->update([
            'role' => $tenant->role === 'admin' ? 'user' : 'admin',
        ]);

        return response()->json([
            'role' => $tenant->role,
        ]);
    }


}
