<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\DepartmentDataTable;
use App\Department;
use App\DepartmentLeader;
use App\Http\Requests\DepartmentRequest;
use App\Employee;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param DepartmentDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(DepartmentDataTable $dataTable)
    {
        $assets=['datatable'];
        $pageTitle= _t(__('message.lists',['name' => __('message.department')]));

        $button='<a href="'.route("departments.create").'" class="float-right btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> '.__('message.add',['name' => __('message.department')]).'</a>';
        return $dataTable->render('global.datatable', compact('assets','pageTitle','button'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
         return view('company.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {
        $department = Department::create($request->all());

        if(isset($request->leader_ids))
            DepartmentLeader::saveDepartmentLeader($request->leader_ids,$department->id);

        return redirect()->route('departments.index')->withSuccess(_t(__('message.msg_added',['name' =>__('message.department')])));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $department = Department::with('departmentLeader')->findOrFail($id);

        return view('company.departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function checkRole($department)
    {

        $leader_ids=$department->departmentLeader->pluck('leader_id')->toArray();
        $department_id=$department->id;

        $employees=Employee::doesntHave('leader',function($query) use ($department_id){
            $query->where('department_id',$department_id);
        })->where('id',$leader_ids)->get();


        if($lead!=null){
            foreach ($lead as $key => $i) {
                $dept=self::where('department_id','<>',$department['id'])->where('leader_id',$i)->first();
                if($dept==null){
                    $u=Company::findOrFail($i);
                    $u->removeRole('leader');
                }
            }
        }
    }

    public function update(DepartmentRequest $request, $id)
    {
        $department = Department::with('departmentLeader')->findOrFail($id);

        // Update Department data...
        $department->fill($request->all())->update();

        if(isset($request->leader_ids))
            DepartmentLeader::saveDepartmentLeader($request->leader_ids,$department->id);

        return redirect()->route('departments.index')->withSuccess(_t(__('message.msg_updated',['name' =>__('message.department')])));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Department::findOrFail($id);
        $category->delete();

        return redirect()->back()->withSuccess(__('message.msg_deleted',['name' =>__('message.department')]));
    }

}
