<?php

use App\Models\Tag;

return [
    'title'   => '二级标签',
    'single'  => '二级标签',
    'model'   => Tag::class,
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
        'name' => [
            'title'    => '标签名称',
            'sortable' => false,
        ],
        'boostag' => [
            'title'    => '分类',
            'sortable' => false,
            'output'   => function ($value, $model) {
                return model_admin_link($model->boostag->name, $model->boostag);
            },
        ],
        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],
    ],
    'edit_fields' => [
        'name' => [
            'title'    => '标签名称',
        ],
        'boostag' => [
            'title'              => '上级标签',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'search_fields'      => ["CONCAT(id, ' ', name)"],
            'options_sort_field' => 'id',
        ],
    ],
    'filters' => [
        'id' => [
            'title' => '标签 ID',
        ],
        'name' => [
            'title' => '标签名称',
        ],
        'boostag' => [
            'title'              => '上级标签',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'search_fields'      => array("CONCAT(id, ' ', name)"),
            'options_sort_field' => 'id',
        ]
    ],

];