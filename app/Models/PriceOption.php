<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Support\Facades\Hash;

class PriceOption extends BaseModel
{

    public $string = ['code', 'name'];

    public $int = ['price_id', 'display_order', 'price_type'];

    public $double = ['unit_cost'];

    public $boolean = ['in_base'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public function prices() {
        return $this->belongsTo('App\Models\Price', 'price_id');
    }

    public function price_types() {
        return $this->belongsTo('App\Models\PriceType', 'price_type');
    }
}
