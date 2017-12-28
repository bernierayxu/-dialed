<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Support\Facades\Hash;

class StyleLocation extends BaseModel
{

    public $string = ['code', 'name', 'c_name'];

    public $boolean = ['size_specific'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */



}
