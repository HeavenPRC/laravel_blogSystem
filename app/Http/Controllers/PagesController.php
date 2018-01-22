<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * 处理显示主页
     * @return [type] [description]
     */
    public function root()
    {
    	return view('pages.root');
    }
}
