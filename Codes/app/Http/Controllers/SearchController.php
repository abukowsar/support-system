<?php

namespace App\Http\Controllers;

use App\DepartmentLeader;

use App\User;
use App\Categories;
use App\StaticData;
use App\Department;
use App\UserThemeMapping;
use Illuminate\Http\Request;
use \Spatie\Permission\Models\Role;
use App\Employee;

class SearchController extends Controller
{

    public function getAjaxList(Request $request)
    {
        $items = array();
        $value = $request->q;

        switch ($request->type) {

            case 'users':
                $items = User::select('id','name as text')->list();

                if($value != ''){
                    $items->where('name', 'LIKE', $value.'%');
                }

                $items=$items->take(10)->get();

                break;

            case 'category':
                $items = Categories::select(\DB::raw('id,category_name text'))->list()->whereNull('deleted_at');
                if(isset($request->data_type)){
                    $items->where('category_type',$request->data_type);
                }

                if($value != ''){
                    $items->where('category_name', 'LIKE', $value.'%');
                }

                $items=$items->take(10)->get();
                break;

            case 'leader':
                $items = Employee::select('id','name as text')->whereHas('roles',function($role){
                    $role->where('name','leader');
                });

                if($value != ''){
                    $items->where('name', 'LIKE', $value.'%');
                }

                if($request->department_id != ''){
                    $items->where('department_id', $request->department_id);
                }

                $items=$items->take(10)->get();
                break;

            case 'employee':
                $items = Employee::select('id','name as text')->whereHas('roles',function($role){
                    $role->where('name','employee');
                });

                if($value != ''){
                    $items->where('name', 'LIKE', $value.'%');
                }

                if($request->department_id != ''){
                    $items->where('department_id', $request->department_id);
                }

                $items = $items->take(10)->get();

                break;
            case 'department':
                $items = Department::select('id','department_name as text')->list();
                if(isset($request->data_type)){
                    $items->where('department_name',$request->data_type);
                }
                $items=$items->where(['is_hidden' => 0,'default' => 0])->get();

                break;

            case 'static_data':
            $items = StaticData::select(\DB::raw('id,label text'))
                    ->where(function($query) use($value) {
                        $query->where(\DB::raw('value', 'LIKE', '%'.$value.'%'));
                        $query->orWhere('value', 'LIKE', '%'.$value.'%');
                    })
                    ->where('status',1)
                    ->whereNull('deleted_at')
                    ->orderBy('sequence','ASC')
                    ->where('type',$request->data_type);
                $items=$items->get();
                break;
            case 'static_data_key':
                $items = \DB::table('static_data')->select(\DB::raw('value id,label text'))
                        ->where(function($query) use($value) {
                            $query->where(\DB::raw('value', 'LIKE', '%'.$value.'%'));
                            $query->orWhere('value', 'LIKE', '%'.$value.'%');
                        })
                        ->where('status',1)
                        ->whereNull('deleted_at')
                        ->orderBy('sequence','ASC')
                        ->where('type',$request->data_type);
                    $items=$items->get();
                    break;

            case 'role_member':
            $items = Role::select('id','name as text')->where('name','member')->get();
                break;

            case 'company_role':
            $items = Role::select('id','name as text')->where('guard_name','company')->get();
                break;

            case 'employee_role':
            $items = Role::select('id','name as text')->where('guard_name','company')->where('name','<>','leader')->get();
                break;
            case 'mail_template':
                $items = \App\MailTemplate::select('id as id','label as text')->get();
                break;

            case 'evanto_themes':
                $purchaseCode = UserThemeMapping::where('user_id',auth()->id())->where('user_type','web')->with('theme')->get();

                $data = [];

                foreach ($purchaseCode as $key => $value){
                    $data[$key] = [
                        'id' => $value->theme->theme_id,
                        'text' => $value->theme->theme_name,
                        'purchase_code' => $value->purchase_code
                    ];
                }

                $items = $data;

                break;

            case 'department_leader':
                $data = DepartmentLeader::where('department_id',$request->data_type)->get();
                $items = $data->map(function ($q){
                    return [
                        'id' => $q->employee->id,
                        'text' => $q->employee->name
                    ];
                });
                break;

            default:
                break;
        }

        return response()->json(['status' => 'true', 'results' => $items]);
    }
}
