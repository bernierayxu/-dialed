<?php

namespace App\Http\Controllers\Api;
use App\Models\PriceType as Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApiController;

class PriceTypeController extends BaseApiController
{
	public function __construct(Model $model)
	{
	    $this->model = $model;
	    $this->unique = 'code';
	}
}
