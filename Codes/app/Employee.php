<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Employee extends Authenticatable implements HasMedia
{
    use Notifiable, HasMediaTrait, HasRoles;

        protected $guard = 'employees';

        protected $fillable = [
            'name', 'email', 'password','department_id',
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];

        public function department() {
            return $this->belongsTo(Department::class, 'department_id', 'id');
        }

        public function profile() {
	        return $this->hasOne(EmployeeProfile::class, 'employee_id', 'id');
	    }

        public function leader() {
            return $this->hasMany(DepartmentLeader::class, 'leader_id', 'id');
        }


}


