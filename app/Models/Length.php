<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Support\Facades\Hash;

class Length extends BaseModel
{

    public $string = ['code', 'name', 'c_name'];

    public $int = ['length_type', 'organization_id', 'display_order'];    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function organizations() {
        return $this->belongsTo('App\Models\Organization', 'organization_id');
    }
}
