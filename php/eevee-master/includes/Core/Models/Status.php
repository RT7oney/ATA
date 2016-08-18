<?php


namespace Core\Models;

/**
 * 状态响应模型
 *
 */
class Status
{

    /**
     * 处理结果状态码
     *
     * @var int
     */
    public $code;

    /**
     * 处理结果提示消息
     *
     * @var string
     */
    public $message;

    /**
     * 处理结果数据
     *
     * @var mixed
     */
    public $data;

}
