<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class NotificationsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    	$this->middleware('auth');
    }

    public function index()
    {
    	//获取用户所有通知
    	$notifications =Auth::user()->notifications()->paginate(20);

    	// 标记为已读，未读数量清零
        Auth::user()->markAsRead();

        $navs = $this->navs;

    	return view('notifications.index', compact('notifications', 'navs'));
    }
}
