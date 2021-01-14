<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubDomain extends Model
{

    protected $table = 'subdomains';

    protected $primaryKey = 'id';

    protected $fillable = [
    	'name',
        'email',
    	'company',
        'subdomain',
    	'country'
    ];
}
