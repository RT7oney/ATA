<?php

function validate_app($data)
{

}

function validate_app_version($data)
{

}

/**
 * 添加应用
 *
 * @param array $data
 *
 * @return mixed
 */
function add_app(array $data)
{
    return table('app')->insert($data);
}

/**
 * 添加应用版本
 *
 * @param array $data
 *
 * @return mixed
 */
function add_app_version(array $data)
{
    return table('app_version')->insert($data);
}


