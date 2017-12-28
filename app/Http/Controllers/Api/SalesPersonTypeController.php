<?php

namespace App\Http\Controllers\Api;
use App\Models\SalesPersonType as Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApiController;

class SalesPersonTypeController extends BaseApiController
{
	public function __construct(Model $model)
	{
	    $this->model = $model;
	}
}
