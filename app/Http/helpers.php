<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use App\Exceptions\CustomizedException;


// 用于接收web参数的，一般拿来查询，所以默认直接转化为Y-m-d
function byDate($params, $attribute, $interval = 0, $returnCarbon = false, $format = 'Y-m-d'){
	if(isset($params[$attribute]) && $params[$attribute]) {
		$date = Carbon::parse($params[$attribute]);
		if($interval > 0) {
			$date = $date->addDays($interval);
		} else if ($interval < 0) {
			$date = $date->subDays($interval);
		}
		if(!$returnCarbon)
			$date = $date->format($format);

		return $date;
	}
	return NULL;
}

// 用于接收web参数的，用来解决查询的符号，>= or <=，默认会在const里面设置参数的操作符
function byOperator($params, $attribute){
	$defaultOperator = '=';
	// 命名规则 就是在后面加上Operator
	$attribute = $attribute . 'Operator';
	if(isset($params[$attribute]) && $params[$attribute]) {
		return $params[$attribute];
	}
	return Config::has('const.dbOperator.' . $attribute) ? Config::get('const.dbOperator.' . $attribute) : $defaultOperator;
}

// 用于接收web参数的，获取array，如果不是array则返回一个array，还可以选择是否将原来的array的内容包含进来
function byArray($params, $attribute, $includeOriginal = false){
	if(isset($params[$attribute]) && $params[$attribute]) {
		if(is_array($params[$attribute]) || $includeOriginal) {
			return (array) $params[$attribute];
		}
	}
	return [];
}

// 用于转换json
function toJson($data = array(), $state = 'success') {
	if(!is_array($data)) {
		$data = method_exists($data, 'toArray') ? $data->toArray() : (array)$data;
	}
	return $state == 'success' ? JSendResponse::success($data) : JSendResponse::fail($data);
}

// 用于接收web参数的，接收string的参数
function byString($params, $attribute){
	return isset($params[$attribute]) ? (string)$params[$attribute] : '';
}

// 用于接收web参数的，接收integer的参数
function byInt($params, $attribute){
	return isset($params[$attribute]) ? (int)$params[$attribute] : 0;
}

// 用于接收web参数的，接收double的参数
function byDouble($params, $attribute){
	return isset($params[$attribute]) ? (double)$params[$attribute] : 0.00;
}

// 用于接收web参数的，接收boolean的参数
function byBoolean($params, $attribute){
	if( isset($params[$attribute]) ) {
		if( is_string($params[$attribute]) ) {
			if( in_array($params[$attribute], ['true', 'yes', 'y', '1']) )
				return true;
		}
		if( is_bool($params[$attribute]) ) {
			return $params[$attribute];
		}
	}
	return false;
}


function error($message) {
	throw new CustomizedException($message);
}

// iterate over date
function getNextDay(Carbon $startedAt, Carbon $endedAt) {
	$startedAt = $startedAt->addDay();
	return $startedAt->lt($endedAt) ? $startedAt : NULL;
}

function stripSpacesIgnoreCases($string) {
	return  strtolower( preg_replace('/\s+/', '', $string)  );
}

