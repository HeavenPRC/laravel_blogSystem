<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class Policy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function before($user, $ability)
	{
        // 如果用户拥有管理内容的权限的话，即授权通过,不用执行其他文件的权限判断
        if ($user->can('manage_contents')) {
            return true;
        }
	}
}
