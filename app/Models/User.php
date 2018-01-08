<?php

namespace App\Models;

// use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\BaseModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class User extends BaseModel implements AuthenticatableContract
{

    use Authenticatable;
    public $string = ['name', 'email'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //更新的时候不能自动更新的
    public $updateExclude = ['password'];
    

    public function selfCreate($params) {
        parent::selfCreate($params);
        $this->password = Hash::make(byString($params, 'password'));
        return $this;
    }

    public function selfUpdate($params) {
        parent::selfUpdate($params);
        $this->password = Hash::make(byString($params, 'password'));
        return $this;
    }

}
