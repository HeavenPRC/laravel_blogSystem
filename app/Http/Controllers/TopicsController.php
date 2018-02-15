<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Models\Category;
use App\Models\User;
use App\Models\Link;
use Auth;
use App\Handlers\ImageUploadHandler;
use App\Models\Boostag;

class TopicsController extends Controller
{
    public function __construct()
    {
    	parent::__construct();
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index(Request $request, Topic $topic, User $user, Link $link)
	{
		//通过预加载解决N+1问题
		//每次遍历一次查一次类别表，查一次用户表最终执行2N+1条语句

		$topics = $topic->withOrder($request->order);

		if (isset($request->boostag_id)&&!empty($request->boostag_id)) {
			$topics = $topics->where('boostag_id', $request->boostag_id);
		}

		if (isset($request->tag_id)&&!empty($request->tag_id)) {
			$topics = $topics->where('tag_id', $request->tag_id);
		}
		$topics = $topics->paginate();
/*		dde($topics);
		exit;*/
		$active_users = $user->getActiveUsers();
		$links = $link->getAllCached();
        $navs = $this->navs;
        $boostags = $this->boostags;
        //dde($topics);
		return view('topics.index', compact('topics', 'active_users', 'links', 'navs', 'boostags'));
	}

    public function show(Topic $topic)
    {
    	$navs = $this->navs;
        return view('topics.show', compact('topic', 'navs'));
    }

	public function create(Topic $topic)
	{
		$categories =Category::all();

		$navs = $this->navs;
		$boostags = $this->boostags;
		return view('topics.create_and_edit', compact('topic', 'categories', 'navs', 'boostags'));
	}
	//TopicRequest自定义表单验证规则
	public function store(TopicRequest $request, Topic $topic)
	{
		//$topic = Topic::create($request->all());
		$topic->fill($request->all());
		$topic->user_id = Auth::id();
		$topic->save();

		return redirect()->route('topics.show', $topic->id)->with('success', '创建成功.');
	}

	public function edit(Topic $topic)
	{
        $this->authorize('update', $topic);
        $categories =Category::all();
        $navs = $this->navs;
        $boostags = $this->boostags;
		return view('topics.create_and_edit', compact('topic', 'categories', 'navs', 'boostags'));
	}

	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);
		$topic->update($request->all());

		return redirect()->route('topics.show', $topic->id)->with('success', '更新成功.');
	}

	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topics.index')->with('success', '删除成功');
	}

	//处理富文本编辑器上传图片
    public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {
        // 初始化返回数据，默认是失败的
        $data = [
            'success'   => false,
            'msg'       => '上传失败!',
            'file_path' => ''
        ];
        // 判断是否有上传文件，并赋值给 $file
        if ($file = $request->upload_file) {
            // 保存图片到本地
            $result = $uploader->save($request->upload_file, 'topics', \Auth::id(), 1024000, 900, 1);
            // 图片保存成功的话
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['msg']       = "上传成功!";
                $data['success']   = true;
            }
        }
        return $data;
    }
}