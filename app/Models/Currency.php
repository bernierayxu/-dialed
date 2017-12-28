<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Support\Facades\Hash;

class Currency extends BaseModel
{

    public $string = ['code', 'name'];

    protected $table = 'currency';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


}
