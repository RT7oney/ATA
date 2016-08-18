<?php

/**
 * 上下文服务
 *
 * 在接口业务逻辑中，有很多重复和相同的操作，
 * 上下文服务中对常用操作进行了封装，以简化业务逻辑的开发。
 *
 * @author 古月(2016/03)
 */

namespace Core\Services;

use Core\Services\Status;
use Illuminate\Http\Request;

class Context
{
    public $request;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * 获取GET参数.
     *
     * @return array GET请求参数
     */
    public function params()
    {
        return $this->request->query();
    }

    /**
     * 获取GET参数.
     *
     * @param null $field
     * @param null $default
     *
     * @return array GET请求参数
     */
    public function param($field = null, $default = null)
    {
        return $this->request->query($field, $default);
    }

    /**
     * 获取请求头.
     * @param string $header
     * @param bool $require
     * @return string
     * @throws \Exception
     */
    public function header($header, $require = false)
    {
        $value = $this->request->header($header);

        if (!$value && $require) {
            throw new \Exception("The request header $header is required.", 1);
        }

        return $value;
    }

    /**
     * 获取请求数据
     * 只接收JSON格式.
     *
     * @param null $field
     * @param null $default
     *
     * @return array 请求数据数组
     */
    public function data($field = null, $default = null)
    {
        $data = $this->request->json()->all();

        if ($field) {
            return isset($data[$field]) ? $data[$field] : $default;
        }

        return $data;
    }

    /**
     * JSON格式响应函数。
     *
     * @param string $result 响应结果
     * @param int $httpCode HTTP状态码
     *
     * @return Response
     */
    public function response($result = '', $httpCode = 200)
    {
        return response($result, $httpCode);
    }

    /**
     * 控制器状态响应函数
     *
     * @param $status
     * @param null $data
     * @param int $httpCode
     *
     * @return Status
     */
    public function status($status, $data = null, $httpCode = 200)
    {
        return $this->response(json_encode(Status::make($status, $data)), $httpCode)->header('Content-Type', 'application/json');
    }

}
