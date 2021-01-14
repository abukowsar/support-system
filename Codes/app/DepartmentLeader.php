<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Employee;
use Spatie\Permission\Traits\HasRoles;

class DepartmentLeader extends Model
{
    use HasRoles;

    protected $primaryKey = 'id';
    protected $table = 'department_leaders';

    protected $fillable = ['department_id','leader_id'];

    public function employee() {
        return $this->belongsTo(Employee::class, 'leader_id', 'id');
    }

    protected function saveDepartmentLeader($leader_ids,$department_id) {
        //Delete previous role
        self::where('department_id',$department_id)->delete();

        foreach ($leader_ids as $key => $leader_id) {
            //Assign Leader role for Employee
            $this->assignEmployeeRole($leader_id);

            //Added Department leader
            self::create([
               'department_id' =>$department_id,
               'leader_id'     =>$leader_id,
            ]);
        }
    }

    public function assignEmployeeRole($employee_id,$role='leader'){
        $employee=Employee::findOrFail($employee_id);

        $employee->assignRole($role);
    }

    public function leaderDepartments(){
        return $this->hasMany(DepartmentLeader::class,'department_id','id')
            ->where('leader_id', \Auth::id());
    }
}
