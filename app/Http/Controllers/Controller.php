<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Category;
use App\Models\Boostag;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $navs,$boostags;

    public function __construct()
    {
    	$this->navs = Category::all();
    	$this->boostags = Boostag::all();
    	//dde($this->navs);
    }
}
