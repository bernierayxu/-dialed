<?php

namespace App\Http\Controllers\Api;
use App\Models\Size as Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApiController;

class SizeController extends BaseApiController
{
	public function __construct(Model $model)
	{
	    $this->model = $model;
	}
}
