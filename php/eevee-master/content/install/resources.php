<?php

return [
    'APP' => [
        'table' => 'apps',
        'fields' => ['id', 'name', 'description', 'created_at', 'updated_at'],
    ],
    'USER' => [
        'table' => 'users',
        'fields' => ['id', 'username', 'email', 'role', 'status', 'avatar', 'source', 'password', 'created_at', 'updated_at'],
    ],
    'ROLE' => [
        'table' => 'roles',
        'fields' => ['id', 'name', 'description', 'parent', 'source', 'status', 'created_at', 'updated_at'],
    ],
    'TERM' => [
        'table' => 'term',
        'fields' => ['id', 'fid', 'name', 'path', 'tag', 'keyword', 'describe', 'updatetime', 'createtime', 'unique_tag'],
    ],
    'CONFIG' => [
        'table' => 'configs',
        'fields' => ['user_id', 'config_key', 'config_value', 'source', 'created_at', 'updated_at'],
    ],
    'MESSAGE' => [
        'table' => 'messages',
        'fields' => ['id', 'user_id', 'title', 'content', 'type', 'sender', 'status', 'source', 'created_at'],
    ],
    'POST' => [
        'table' => 'posts',
        'fields' => ['id', 'user_id', 'title', 'content', 'type', 'status', 'source', 'created_at', 'updated_at'],
        'type' => true,
        'name'=>'',
        'description'=>''
    ],
    'RESOURCE' => [
        'table' => 'resources',
        'fields' => [],
    ],
    'PERMISSION' => [
        'table' => 'permissions',
        'fields' => [],
    ],
    'USERTOKEN' => [
        'table' => 'user_tokens',
        'fields' => [],
    ],
    'SYSTEMCONFIG' => [
        'table' => 'system_configs',
        'fields' => ['config_key', 'config_value', 'source', 'created_at', 'updated_at'],
    ],
    'L:TERMRELATIONSHIP' => [
        'table' => 'terms_relationships',
        'fields' => [],
    ],
    'L:PERMISSIONRELATIONSHIP' => [
        'table' => 'permissions_relationships',
        'fields' => ['role_id', 'permission_id'],
    ],
];
