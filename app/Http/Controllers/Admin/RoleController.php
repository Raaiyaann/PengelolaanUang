<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRoleRequest;
use App\Http\Requests\Admin\UpdateRoleRequest;
use App\Models\Permission;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $roles = Role::paginate(5);
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $role = Role::create($request->validate([
            'name' => 'required|string|max:255',
        ]));
        $role->permissions()->sync($request->input('permissions', []));
        return redirect()->route('admin.roles.index')->with([
            'message' => 'success created !',
            'alert-info' => 'success'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role): View
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role): RedirectResponse
    {
        $role->update($request->validate([
            'name' => 'required|string|max:255',
        ]));
        $role->permissions()->sync($request->input('permissions', []));
        return redirect()->route('admin.roles.index')->with([
            'message' => 'success updated !',
            'alert-info' => 'info'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();
        return redirect()->back()->with([
            'message' => 'success deleted !',
            'alert-info' => 'danger'
        ]);
    }
}
