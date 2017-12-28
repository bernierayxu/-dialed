<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Support\Facades\Hash;

class ComponentType extends BaseModel
{

    public $string = ['code', 'name', 'c_name'];
    
    public $int = ['organization_id'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public function organizations() {
        return $this->belongsTo('App\Models\Organization', 'organization_id');
    }

}
