<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Boostag;

class BoostagsController extends Controller
{
    public function getTags(Request $request)
    {
    	$data = Boostag::find($request->boostag_id)->tags;
    	//var_dump($data->toArray());
    	return response()->json([
    		'status' => 1,
    		'message'=> 'getTags success',
    		'datas'=> $data
    	]);
    }

    public function show(Request $request)
    {

    }
}
