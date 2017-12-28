<?php

namespace App\Http\Controllers\Api;
use App\Models\UnitOfMeasure as Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApiController;

class UnitOfMeasureController extends BaseApiController
{
	public function __construct(Model $model)
	{
	    $this->model = $model;
	}
}