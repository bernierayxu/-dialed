<?php

namespace App\Http\Controllers\Api;
use App\Models\BaseModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseApiController extends Controller
{
	public function __construct(Model $model)
	{
	    $this->model = $model;
	}

	public function index(Request $request) {
		$params = $request->all();

		$model = ($this->model)::whereRaw('1=1');

		foreach( byArray($params, 'relations') as $relation) {
            if($relation) {
                $model->with($relation);
            }
        }
		return $model->orderBy('created_at', 'desc')->paginate(20);
	}

	public function store(Request $request) {
		$user = $this->model;
		if($request->id) {
			$user = ($this->model)::find($request->id);
			if(!$user) {
				error(last(explode('\\', get_class($this->model))) . ' Not Found');
			}
		}
		$user->selfCreate($request->all())->save();
		return 'Success';
	}

	public function destroy($id) {
		($this->model)::where('id', $id)->delete();
		return 'Success';
	}
}
