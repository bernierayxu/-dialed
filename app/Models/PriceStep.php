<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Support\Facades\Hash;

class PriceStep extends BaseModel
{

    public $int = ['price_id', 'min_quantity', 'max_quantity'];

    public $double =  ['price_group_std', 'price_group_alt1', 'price_group_alt2'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function prices() {
        return $this->belongsTo('App\Models\Price', 'price_id');
    }

}
