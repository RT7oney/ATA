<?php

return [

    ['name' => trans_name('resources.DASHBOARD'),           'icon' => 'dashboard icon',     'icon_url' => false, 'link' => '#app/dashboard',    'permission' => false],
    ['name' => trans_name('resources.POST'),                'icon' => 'edit icon',          'icon_url' => false, 'link' => '#app/post',         'permission' => 'POST_GET'],
    ['name' => trans_name('resources.TERM'),                'icon' => 'block layout icon',  'icon_url' => false, 'link' => '#app/term',         'permission' => 'TERM_GET'],
    ['name' => trans_name('resources.MEDIA'),               'icon' => 'video play icon',    'icon_url' => false, 'link' => '#app/media',        'permission' => false],
    ['name' => trans_name('resources.USER'),                'icon' => 'user icon',          'icon_url' => false, 'link' => '#app/user',         'permission' => 'USER_GET'],
    ['name' => trans_name('resources.ROLE'),                'icon' => 'spy icon',           'icon_url' => false, 'link' => '#app/role',         'permission' => 'ROLE_GET'],
    ['name' => trans_name('resources.THEME'),               'icon' => 'paint brush icon',   'icon_url' => false, 'link' => '#app/theme',        'permission' => false],
    ['name' => trans_name('resources.PLUGIN'),              'icon' => 'puzzle icon',        'icon_url' => false, 'link' => '#app/plugin',       'permission' => false],
    ['name' => trans_name('resources.SYSTEM_CONFIG'),       'icon' => 'setting icon',       'icon_url' => false, 'link' => false,               'permission' => 'SYSTEM_CONFIG'],
    ['name' => trans_name('resources.SYSTEM_CONFIG_SITE'),  'icon' => false,                'icon_url' => false, 'link' => '#app/config/site',  'permission' => 'SYSTEM_CONFIG_SITE'],
    ['name' => trans_name('resources.SYSTEM_CONFIG_EMAIL'), 'icon' => false,                'icon_url' => false, 'link' => '#app/config/email', 'permission' => 'SYSTEM_CONFIG_EMAIL'],
    ['name' => trans_name('resources.HELP'),                'icon' => 'area info icon',     'icon_url' => false, 'link' => '#app/help',         'permission' => false],
//    ['name' => '假条',                                       'icon' => 'send icon',     'icon_url' => false, 'link' => '#app/qingjia',                 'permission' => 'QINGJIA'],
//    ['name' => '请假管理',                                    'icon' => 'send icon',     'icon_url' => false, 'link' => '#app/qiangjia-admin',         'permission' => 'QINGJIA_ADMIN'],

];

