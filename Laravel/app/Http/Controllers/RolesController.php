<?php

namespace App\Http\Controllers\Admin;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\StoreRolesRequest;
use App\Http\Requests\Admin\UpdateRolesRequest;
use Validator;

class RolesController extends Controller
{
    public function __construct()
    {
        if (!Auth::user()){
            return view('auth.login');
        }
    }

    public function index()
    {
        if (! Gate::allows('roles_manage')) {
            return abort(401);
        }

        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        if (! Gate::allows('roles_manage')) {
            return abort(401);
        }
        $permissions = Permission::get()->pluck('name', 'name');

        return view('admin.roles.create', compact('permissions'));
    }

    public function store(StoreRolesRequest $request)
    {
        if (! Gate::allows('roles_manage')) {
            return abort(401);
        }
        if ($role = Role::create($request->except('permission'))) {
        $permissions = $request->input('permission') ? $request->input('permission') : [];
        $role->givePermissionTo($permissions);

        return redirect()->route('admin.roles.index')->with('added', trans('global.added'));
        }
        return redirect()->back()->with('error', trans('global.something_rong'));
    }

    public function edit(Role $role)
    {
        if (! Gate::allows('roles_manage')) {
            return abort(401);
        }
        $permissions = Permission::get()->pluck('name', 'name');

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

   
    public function update(UpdateRolesRequest $request, Role $role)
    {
        if (! Gate::allows('roles_manage')) {
            return abort(401);
        }

        $request->validate([
            'name' => 'required|string|min:2|max:100|unique:roles,name,'.$role->id,
        ]);
        if ($role->update($request->except('permission'))) {
        $permissions = $request->input('permission') ? $request->input('permission') : [];
        $role->syncPermissions($permissions);
        return redirect()->route('admin.roles.index')->with('updated', trans('global.updated'));
    }
        return redirect()->back()->with('error', trans('global.something_rong'));
    }

    public function show(Role $role)
    {
        if (! Gate::allows('roles_manage')) {
            return abort(401);
        }

        $role->load('permissions');

        return view('admin.roles.show', compact('role'));
    }



    public function destroy(Role $role)
    {
        if (! Gate::allows('roles_manage')) {
            return abort(401);
        }

        if(in_array($role->id, array(1,2,3))){
            return redirect()->route('admin.roles.index')->with('updated', trans('global.something_rong'));
        }

        if ($role->delete()) {
        return redirect()->route('admin.roles.index')->with('deleted', trans('global.deleted'));
    }
        return redirect()->back()->with('error', trans('global.something_rong'));
    }

   
    public function multiDestroy(Request $request)
    {
        if (! Gate::allows('roles_manage')) {
            return abort(401);
    }
        if( in_array(1, request('ids')) || in_array(2, request('ids')) || in_array(3, request('ids')) ){
            return redirect()->route('admin.roles.index')->with('updated', trans('global.something_rong'));
        }
        if( Role::whereIn('id', request('ids'))->delete() ){
            return response()->json(array('status' => 'success', 'message' => trans('global.deleted_all')));
        }
        return response()->json(array('status' => 'failed', 'message' => trans('global.something_rong')));
    }
}
