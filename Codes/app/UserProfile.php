<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserProfile extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'gender', 'dob', 'address', 'city', 'state', 'country', 'pincode'
    ];


    protected $dates = ['deleted_at'];

    public function users() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function setDobAttribute( $value ) {
        $this->attributes['dob'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function getDobAttribute($value) {
        return $this->attributes['dob'] = Carbon::parse($value)->format('d-m-Y');
    }

}
