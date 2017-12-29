<?php

namespace App\Http\Controllers\Api;
use App\Models\BaseModel;
use Illuminate\Http\Request;
use Config;
use App\Http\Controllers\Controller;

class BaseApiController extends Controller
{
	public function __construct(Model $model)
	{
	    $this->model = $model;
	    $this->unique = '';
	}

	public function index(Request $request) {
		$params = $request->all();

		$model = ($this->model)::whereRaw('1=1');

		foreach( byArray($params, 'relations') as $relation) {
            if($relation) {
                $model->with($relation);
            }
        }

        if( byBoolean($params, 'withoutPagination') ) {
            return $model->get();
        } else {
            return $model->orderBy('created_at', 'desc')->paginate( byInt($params, 'count') ? byInt($params, 'count') : Config::get('const.count') ); 
        }
	}

	public function store(Request $request) {
		$model = $this->model;
		if($request->id) {
			$model = ($this->model)::find($request->id);
			if(!$model) {
				error(last(explode('\\', get_class($this->model))) . ' Not Found');
			}
			$model->selfUpdate($request->all())->save();
		} else {
			if($this->unique 
				&& ($this->model)::where($this->unique, byString($request->all(), $this->unique))->first()) {
				error('Duplicate ' . $this->unique);
			}
			$model->selfCreate($request->all())->save();
		}
		
		return 'Success';
	}

	public function destroy($id) {
		($this->model)::where('id', $id)->delete();
		return 'Success';
	}
}
