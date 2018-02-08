<?php

use App\Models\Notice;

return [
    'title'   => '站点短公告',
    'single'  => '站点短公告',

    'model'   => Notice::class,

    // 访问权限判断
    'permission'=> function()
    {
        // 只允许站长管理资源推荐链接
        return Auth::user()->hasRole('Founder');
    },

    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'title' => [
            'title'    => '标题',
            'sortable' => false,
        ],
        'contect' => [
            'title'    => '内容',
            'sortable' => false,
        ],
        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],
    ],
    'edit_fields' => [
        'title' => [
            'title'    => '标题',
        ],
        'contect' => [
            'title'    => '内容',
        ],
    ],
    'filters' => [
        'id' => [
            'title' => '标签 ID',
        ],
        'title' => [
            'title' => '标题',
        ],
    ],
];