<?php

namespace App\Http\Controllers\Api;
use App\Models\Currency as Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApiController;

class CurrencyController extends BaseApiController
{
	public function __construct(Model $model)
	{
	    $this->model = $model;
	    $this->unique = 'code';
	}
}
