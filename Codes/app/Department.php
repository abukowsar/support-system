<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Department extends Model
{
    use  HasRoles;

    protected $primaryKey = 'id';
    protected $table = 'departments';

    protected $fillable = ['department_name','parent_id','status','default','is_hidden'];

    public function scopeList($query, $order='department_name')
    {
        return $query->whereStatus(1)->orderBy('department_name', 'ASC');
    }

    public function user() {
        return $this->belongsTo(User::class, 'leader_id', 'id');
    }

    public function departmentLeader() {
        return $this->hasmany(DepartmentLeader::class, 'department_id', 'id');
    }
}
