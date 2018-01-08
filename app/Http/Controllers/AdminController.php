<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function component(Request $request) {
    	$component = $request->component ? $request->component : 'users';
    	$routes = [
    		'users' => 'Users',
    		'user-types' => 'User Types',
    		'unit-of-measures' => 'Unit Of Measure',
    		'style-types' => 'Style Type',
    		'style-locations' => 'Style Location',
    		'sizes' => 'Size',
    		'sales-person-types' => 'Sales Person Type',
    		'sales-persons' => 'Sales Person',
    		'prices' => 'Price',
    		'price-types' => 'Price Type',
    		'price-steps' => 'Price Step',
    		'price-options' => 'Price Option',
    		'organizations' => 'Organization',
    		'organization-types' => 'Organization Type',
    		'lengths' => 'Length',
    		'currencys' => 'Currency',
    		'contact-types' => 'Contact Type',
    		'component-types' => 'Component Type',
    	];
    	return view('master')->with(['component' => $component, 'routes' => $routes]);
    }

    public function signin(Request $request) {
        return view('signin');
    }
}
