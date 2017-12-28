<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Support\Facades\Hash;

class ContactType extends BaseModel
{

    public $string = ['code', 'name', 'c_name'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

}
