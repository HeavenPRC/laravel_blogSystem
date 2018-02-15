<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Category;
use App\Models\User;
use App\Models\Link;
use App\Models\Boostag;

class CategoriesController extends Controller
{
    public function show(Category $category, Request $request, Topic $topic, User $user, Link $link)
    {
        // 读取分类 ID 关联的话题，并按每 20 条分页
        $topics = $topic->withOrder($request->order)
                        ->where('category_id', $category->id);

        if (isset($request->boostag_id)&&!empty($request->boostag_id)) {
            $topics = $topics->where('boostag_id', $request->boostag_id);
        }

        if (isset($request->tag_id)&&!empty($request->tag_id)) {
            $topics = $topics->where('tag_id', $request->tag_id);
        }
        $topics = $topics->paginate();
        // 活跃用户列表
        $active_users = $user->getActiveUsers();
        // 资源链接
        $links = $link->getAllCached();

        $navs = $this->navs;

        $boostags = Boostag::all();
        // 传参变量到模板中
        return view('topics.index', compact('topics', 'category', 'active_users', 'links', 'navs', 'boostags'));
    }
}