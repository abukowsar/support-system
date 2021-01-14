<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketAssignedMapping extends Model
{
    protected $table = 'ticket_assigned_mapping';

    protected $primaryKey = 'id';

    protected $fillable = [
        'ticket_id',
        'assign_to',
        'assign_by',
        'status'
    ];

    public function employee(){
        return $this->hasOne(Employee::class,'id','assigned_to');
    }
}
