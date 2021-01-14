<?php

namespace App\Http\Controllers\Company;

use App\DataTables\EmployeeDataTable;
use App\DepartmentLeader;
use App\Http\Requests\EmployeeRequest;
use App\Employee;
use App\EmployeeProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use \Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param EmployeeDataTable $dataTable
     * @return Response
     */
    public function index(EmployeeDataTable $dataTable)
    {
        $assets=['datatable'];
        $pageTitle= __('message.lists',['name' => __('message.employee')]);
        $button='<a href="'.route("employees.create").'" class="float-right btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> '.__('message.add',['name' => __('message.employee')]).'</a>';

        return $dataTable->render('global.datatable', compact('assets','pageTitle','button'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('company.employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(EmployeeRequest $request)
    {

        // Save Employee data...
        $request['password'] = bcrypt($request->password);
        $request['email_verified_at'] = date('Y-m-d h:i:s');
        $employee = Employee::create($request->all());

        foreach ($request->role_id as $key => $rol) {
           $employee->assignRole(Role::findOrFail($rol)->name);
        }

        // Save Employee image...
        if (isset($request->profile_image) && $request->profile_image != null) {
            $employee->addMediaFromRequest('profile_image')->toMediaCollection('profile_image');
        }

        // Save Employee Profile data...
        $employee->profile()->create($request->profile);

        return redirect()->route('employees.index')->withSuccess(__('message.msg_added',['name' => 'employee']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if(!auth()->guard('admin')->check()){
            $id = auth()->id();
        }

        $employee = Employee::with(['profile','roles','department'])->findOrFail($id);

        $profileImage = getSingleMedia($employee, 'profile_image');

        return view('company.employees.edit', compact('employee','profileImage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param int $id
     * @return Response
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    public function update(EmployeeRequest $request, $id)
    {
        if(!auth()->guard('admin')->check()){
            $id = auth()->id();
        }

        $employee = Employee::with('profile')->findOrFail($id);

        // Employee data...
        $employee->fill($request->all())->update();


        if(auth()->guard('admin')->check()){
            foreach ($request->role_id as $key => $rol) {
               $employee->assignRole(Role::findOrFail($rol)->name);
            }

            $roleName = Role::whereIn('id',$request->role_id)->pluck('name')->toArray();

            $employee->syncRoles($roleName);

            $deptLeader = DepartmentLeader::where('leader_id',$employee->id)->first();
            if(isset($deptLeader)){
                $deptLeader->update(['department_id' => $request->department_id]);
            }
        }

        // Save Employee image...
        if (isset($request->profile_image) && $request->profile_image != null) {
            $employee->clearMediaCollection('profile_image');
            $employee->addMediaFromRequest('profile_image')->toMediaCollection('profile_image');
        }

        // Employee profile data....
        $employee->profile->fill($request->profile)->update();

        if(!auth()->user()->hasRole('employee')){
            return redirect()->route('employees.index')->withSuccess(__('message.msg_updated',['name' => 'employee']));;
        }
        return redirect()->back()->withSuccess(__('message.msg_updated',['name' => 'My Profile']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }


}
