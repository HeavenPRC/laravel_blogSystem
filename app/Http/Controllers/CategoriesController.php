<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function show(Category $category, Request $request)
    {
    	//通过id查取数据，然后分页
    	$topics = Topic::where('category_id', $category->id)
    	->withOrder($request->order)
    	->with('user', 'category')
    	->paginate(20);
    	//将两类别和博文传到前端
    	return view('topics.index', compact('topics', 'category'));
    }
}
