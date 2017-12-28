<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Support\Facades\Hash;

class OrganizationType extends BaseModel
{

    public $string = ['code', 'name'];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

}
