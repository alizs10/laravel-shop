<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\PermissionRequest;
use App\Models\User\Permission;
use App\Models\User\PermissionRole;
use App\Models\User\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $permissionsRoleIDsArray = PermissionRole::select('permission_id')->where('role_id', $role->id)->get()->pluck('permission_id')->toArray();
        return view('admin.user.role.permissions', compact('role', 'permissions', 'permissionsRoleIDsArray'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, Role $role)
    {
        $inputs = $request->all();
        global $oldPermissionsRoleIDsArray;
        $oldPermissionsRoleIDsArray = PermissionRole::select('permission_id')->where('role_id', $role->id)->get()->pluck('permission_id')->toArray();

        global $newPermissionsRoleIds;
        $newPermissionsRoleIds = $inputs['permission_id'];

        foreach ($newPermissionsRoleIds as $newValue) {
            global $oldPermissionsRoleIDsArray;
            if (in_array($newValue, $oldPermissionsRoleIDsArray)) {
                unset($newValue, $newPermissionsRoleIds);
                unset($newValue, $oldPermissionsRoleIDsArray);
            }
        }
        global $oldPermissionsRoleIDsArray;
        if ($oldPermissionsRoleIDsArray) {
            foreach ($oldPermissionsRoleIDsArray as $oldPermissionsRoleID) {
                PermissionRole::where('permission_id', $oldPermissionsRoleID)->where('role_id', $role->id)->delete();
            }
        }
        global $newPermissionsRoleIds;
        if ($newPermissionsRoleIds) {
            $role->permissions()->sync($newPermissionsRoleIds);
        }

        return redirect()->route('admin.user.role.index')->with('alertify-success', 'دسترسی های نقش تغییر کرد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
