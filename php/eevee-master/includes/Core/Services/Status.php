<?php
/**
 * 编码器.
 *
 * 用于处理系统的响应结果，
 * 封装了相应的函数提供给模型或控制器使用，以简化业务逻辑的代码。
 * 集中处理程序的操作日志，同时能向用户提供所有状态信息的文档，方便用户调用API时查询。
 *
 * @author 古月(2016/03)
 */

namespace Core\Services;

use \Core\Models\Status as StatusModel;
use League\Flysystem\Exception;

class Status
{
    /**
     * 状态数组.
     *
     * @var array
     */
    protected static $statuses;

    /**
     * 响应结果函数
     * 识别状态码，返回状态信息.
     * 响应状态时，根据状态名称，从本地化文件中读取状态消息。
     *
     * @param int /string     $status 状态编码或别名
     * @param [array/string] $data   返回的数据
     *
     * @return \Core\Models\Status 返回结果对象
     */
    public static function make($status, $data = null)
    {

        self::$statuses = require_once base_path("content/install/statuses.php");

        $result = new StatusModel();

        $result->code = self::getCode($status);

        $result->message = self::getMessage($status);

        $result->data = $data;

        return $result;
    }

    /**
     * 获取状态码
     *
     * @param int /string $status 状态码或状态名称
     *
     * @return int 状态码
     */
    protected static function getCode($status)
    {
        if (!self::statusExists($status)) {
            return false;
        }

        if (is_string($status)) {
            return self::$statuses[$status];
        }

        return $status;
    }

    /**
     * 状态存在检查
     * 状态不存在时记录状态信息到日志.
     *
     * @param int /string $status 状态码或名称
     *
     * @return bool
     */
    protected static function statusExists($status)
    {

        if (is_string($status)) {

            if (array_key_exists($status, self::$statuses)) {

                return true;
            }

            self::report($status);
        }

        if (is_int($status)) {

            if (in_array($status, self::$statuses)) {

                return true;
            }

            self::report($status);
        }

        return false;
    }

    /**
     * 获取状态消息
     * 状态消息存放在本地化文件中，
     * 状态消息不存在，返回状态名称.
     *
     * @param $status
     *
     * @return string 状态消息
     *
     */
    protected static function getMessage($status)
    {
        return message(self::getStatusName($status));
    }

    /**
     * 获取状态名.
     *
     * @param  int /string $status 状态码或状态名
     * @return string /false        状态名
     *
     * @throws \Exception
     */
    protected static function getStatusName($status)
    {
        if (is_int($status)) {

            return array_search($status, self::$statuses);

        } elseif (is_string($status)) {

            return $status;

        }

        throw new \Exception('status name is not a string or int');
    }

    /**
     * 状态报告
     * 状态列表改动，造成状态代码丢失，
     * 在程序执行时，报告相关状态信息。
     *
     * @param int /string $status 状态码或状态别名
     *
     * TODO 完成不存在状态的记录
     */
    protected static function report($status)
    {
    }
}
