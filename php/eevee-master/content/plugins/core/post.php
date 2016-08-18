<?php

/**
 * 添加POST
 *
 * @param array $data
 *
 * @return mixed
 */
function add_post(array $data)
{
    return table('post')->insert($data);
}

/**
 * 更新POST
 *
 * @param $post_id
 *
 * @param array $data
 */
function update_post($post_id, array $data)
{

}