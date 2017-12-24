<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BaseModel extends Model
{


    public $string = [];

    //更新的时候不能自动更新的
    public $updateExclude = [];



    public function selfCreate($params) {
        // 全部填充
        foreach((array)$this->string as $string) {
            $this->$string = byString($params, $string);
        }
        foreach((array)$this->int as $int) {
            $this->$int = byInt($params, $int);
        }
        foreach((array)$this->double as $double) {
            $this->$double = byDouble($params, $double);
        }
        foreach((array)$this->boolean as $boolean) {
            $this->$boolean = byBoolean($params, $boolean);
        }
        foreach((array)$this->array as $array) {
            $this->$array = byArray($params, $array);
        }
        return $this;
    }

    public function selfUpdate($params) {

        // 全部填充
        foreach(array_diff((array)$this->string, $this->updateExclude) as $string) {
            if(isset($params[$string]))
                $this->$string = byString($params, $string);
        }
        foreach(array_diff((array)$this->int, $this->updateExclude) as $int) {
            if(isset($params[$int]))
                $this->$int = byInt($params, $int);
        }
        foreach(array_diff((array)$this->double, $this->updateExclude) as $double) {
            if(isset($params[$double]))
                $this->$double = byDouble($params, $double);
        }
        foreach(array_diff((array)$this->boolean, $this->updateExclude) as $boolean) {
            if(isset($params[$boolean]))
                $this->$boolean = byDouble($params, $boolean);
        }
        foreach(array_diff((array)$this->array, $this->updateExclude) as $array) {
            if(isset($params[$array]))
                $this->$array = byArray($params, $array);
        }
        return $this;
    }



}
