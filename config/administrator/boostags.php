<?php

use App\Models\Boostag;

return [
    'title'   => '一级标签',
    'single'  => '一级标签',

    'model'   => Boostag::class,

    // 访问权限判断
    'permission'=> function()
    {
        // 只允许站长管理资源推荐链接
        return Auth::user()->hasRole('Founder');
    },

    'columns' => [
        'id' => [
            'title'    => 'ID',
            'sortable' => false,
        ],
        'name' => [
            'title'    => '标签名称',
            'sortable' => false,
        ],
        'boos_id' => [
            'title'    => '上级标签ID',
            'sortable' => false,
        ],
        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],
    ],
    'edit_fields' => [
        'name' => [
            'title'    => '标签名称',
        ]
    ],
    'filters' => [
        'id' => [
            'title' => '标签 ID',
        ],
        'name' => [
            'title' => '标签名称',
        ],
    ],
];