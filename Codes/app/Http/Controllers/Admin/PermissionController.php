<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle  = _t(__('message.permissions.list'));
        $permission = Permission::orderBy('name','ASC')->get()->unique('name');
        $roles      = Role::orderBy('name','ASC')->get();

        return view('admin.permission.index',compact('pageTitle','roles','permission'));
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
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $data=$request->permission;

        if($data !=null && count($data)>0){
            $roles=Role::get()->map(function($role) use($data){
                $role->revokePermissionTo(array_keys($data));
            });
            foreach ($data as $permission_name => $permission){

                foreach ($permission as $key=>$role_name){
                    $role = Role::where('name', $role_name)->first();
                    $permission = Permission::findOrCreate($permission_name, $role->guard_name);
                    $role->givePermissionTo($permission);
                }
            }
        }
        return redirect()->route('permission.index')->withSuccess('Permission Save Successfully');
    }



    public function addPermission($type){

        $title = _t(__('message.permissions.action', ['Action' => 'Add']));

        switch ($type){
            case 'role' :
                $title = _t(__('message.roles.action', ['Action' => 'Add']));
                break;
        }

        $guards = collect(config('auth.guards'))->mapWithKeys(function ($item, $key) {
            return [$key => $key];
        });

        $permissionView = view('admin.permission.add_permission',compact('title','type', 'guards'));

        if(request()->ajax()) {
            return response()->json([
                'status'     => true,
                'page_title' => $title,
                'data'       => $permissionView->render()
            ]);
        }

        return $permissionView;
    }

    public function savePermission(Request $request){
        $data = $request->all();

        switch ($data['type']){
            case 'permission' :
                Permission::create(['name' =>$request->name,'guard_name'=>$request->guard_name]);
                break;
            case 'role' :
                Role::create(['name' =>$request->name,'guard_name'=>$request->guard_name]);
                break;
            default :
                return response()->json(['status'=>false,'event' => 'validation' , 'message' => 'Try Again']);
            break;
        }
        $message = ucfirst($data['type']).' added successfully';

        return response()->json(['status'=>true,'event' => 'refresh' , 'message' => $message]);
    }
}
