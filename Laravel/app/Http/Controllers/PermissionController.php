<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Validator;
use DB;
   
class PermissionController extends BaseController
{

    
    public function index()
    {
        $roles = Role::pluck('name','id')->all();
        if (!empty($roles)) {
            return $this->sendResponse($roles, 'All roles retrived successfully.');
        }
        return $this->sendError('Oops! Something Went Wrong'); 
    }
    
     
    public function getPermission($role_id=0)
    {
        if($role_id)
        {
            $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$role_id)->pluck('role_has_permissions.permission_id')->all();
            $gerRoles = array();
            
            $userRole =  Role::select('id', 'name')->orderBy('name','ASC')->get();
            foreach($userRole as $role){
                $gerRoles[] = array(
                    'id' => $role->id,
                    'name' => ucfirst($role->name)
                );
            }
            $response['roles'] = $gerRoles;
            
            $permission = Permission::orderBy('id','ASC')->get();

            $response['permissions'] = $permission;
            $response['rolePermissions'] = (array)$rolePermissions;

            return $this->sendResponse($response, 'Permission retrived successfully.');
        }
        return $this->sendError('Oops! Something Went Wrong'); 
    }
     
    public function update(Request $request, $role_id)
    {
        $input = $request->all();

        $validator  =  Validator::make($input, [
            'permission' => 'required',
        ]);

        if($validator->fails()){
            $errors = $validator->errors();
            return $this->sendError('validation_error', $errors);     
        }

        // if($role_id == 1){
        //     return $this->sendError("Super administrator permissions can't be changed."); 
        // }

        $role = Role::find($role_id);

        $role->syncPermissions($request->input('permission'));

        if($role){
            $allowed = $this->users->permission($role_id);
            $responce['status'] = 200;
            $responce['allowed'] = $allowed;
            return $this->sendResponse($responce, 'Role based permissions updated successfully.');
        }
        return $this->sendError('Oops! Something Went Wrong.'); 
    }
}