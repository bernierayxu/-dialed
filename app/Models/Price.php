<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Support\Facades\Hash;

class Price extends BaseModel
{

    public $string = ['code', 'name'];

    public $int = ['organization_id', 'currency'];

    public $boolean = ['is_active'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public function organizations() {
        return $this->belongsTo('App\Models\Organization', 'organization_id');
    }

    public function currencys() {
        return $this->belongsTo('App\Models\Currency', 'currency');
    }

}
