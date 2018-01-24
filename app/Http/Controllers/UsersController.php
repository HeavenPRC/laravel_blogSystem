<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\models\User;
use App\Handlers\ImageUploadHandler;
use Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        //auth 中间件限制游客行为
        $this->middleware('auth', ['except' => ['show']]);
    }

    public function show(User $user)
    {
    	return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
    	if(!Auth::user()->can('update', $user))
        {
            return redirect()->route('users.edit', [Auth::user()]);
        }

        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user,  ImageUploadHandler $uploader)
    {
        $this->authorize('update', $user);
        $data = $request->all();

        if ($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $user->id, 1024000, 362);
            if ($result) {
                $data['avatar'] = $result['path'];
                $oldPath = str_replace(config('app.url').'/', '', $user->avatar);
                /*上传成功后将旧头像删除*/
                if (!empty($user->avatar)&&is_file($oldPath)) {
                    unlink($oldPath);
                }
            } else {
                //session()->flash('success' ,'asas' );
                return back();
            }
        }

        $user->update($data);

        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功！');
    }
}
