<?php

namespace App\Http\Controllers\Api;
use App\Models\ContactType as Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApiController;

class ContactTypeController extends BaseApiController
{
	public function __construct(Model $model)
	{
	    $this->model = $model;
	    $this->unique = 'code';
	}
}
