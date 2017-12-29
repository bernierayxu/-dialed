<?php

namespace App\Http\Controllers\Api;
use App\Models\PriceStep as Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApiController;

class PriceStepController extends BaseApiController
{
	public function __construct(Model $model)
	{
	    $this->model = $model;
	    $this->unique = 'min_quantity';
	}
}
