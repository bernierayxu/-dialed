<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Support\Facades\Hash;

class Organization extends BaseModel
{

    public $string = ['code', 'name', 'number', 'bill_addr1', 'bill_addr2', 'bill_city', 'bill_state', 'bill_postal', 'bill_country', 'bill_email', 'bill_phone', 'ship_addr1', 'ship_addr2', 'ship_city', 'ship_state', 'ship_postal', 'ship_country', 'ship_email', 'ship_phone', 'ship_method', 'ship_acct_no'];

    public $int = ['type', 'parent'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public function organizations() {
        return $this->belongsTo('App\Models\Organization', 'parent');
    }

    public function organization_types() {
        return $this->belongsTo('App\Models\OrganizationType', 'type');
    }

}
