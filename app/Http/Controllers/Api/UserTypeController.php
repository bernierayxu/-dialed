<?php

namespace App\Http\Controllers\Api;
use App\Models\UserType as Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApiController;

class UserTypeController extends BaseApiController
{
	public function __construct(Model $model)
	{
	    $this->model = $model;
	}
}
