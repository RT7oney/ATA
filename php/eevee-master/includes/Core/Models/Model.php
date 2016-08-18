<?php

namespace Core\Models;

use Illuminate\Support\Facades\DB;

class Model
{

    /**
     * 生成 ID
     *
     * @return string
     */
    public function id()
    {
        return md5(sha1(uniqid(mt_rand(1, 1000000))));
    }

    /**
     * 获取数据表操作对象
     *
     * @param $name
     *
     * @return string
     *
     */
    public function table($name)
    {
        return DB::table($name);
    }


    /**
     * 资源查询构造器.
     *
     * 支持`order`,`offset`,`limit`,`fields`,`group`,`count`,`first`等条件筛选.
     *
     *
     * @param string $resource 资源标识符
     * @param array $params 查询参数
     *
     * @return mixed 数据库查询结果
     *
     */
    public function selector($resource, $params = [])
    {
        $query = $this->resource($resource);

        foreach ($params as $action => $param) {

            switch ($action) {
                case 'order':
                    $options = explode(':', $param);
                    $query = $query->orderBy($options[0], $options[1]);
                    break;
                case 'offset':
                    $query = $query->skip($param);
                    break;
                case 'limit':
                    $query = $query->take($param);
                    break;
                case 'fields':
                    $query = $query->lists($param);
                    break;
                case 'group':
                    $query = $query->groupBy($param);
                    break;
                case 'count':
                case 'first':
                    break;
                default:
                    $query = $query->where($action, $param);

            }
        }

        return isset($params['count']) ? $data = $query->count() : $data = $query->get();
    }


    /**
     * 过滤掉数据的多余字段
     *
     * @param  array $data   原始数据
     * @param  array $fields 保留字段
     * @param  array $ignore 强制过滤字段
     *
     * @return array
     */
    public function filter(array &$data, array $fields, array $ignore = [])
    {
        $fields = array_diff($fields, $ignore);

        foreach ($data as $k => $v) {
            if (!in_array($k, $fields)) {
                unset($data[$k]);
            }
        }

        return $data;
    }

    /**
     * 忽略数组字段
     *
     * @param array &$rule
     * @param array $fields
     */
    public function ignore(&$rule, $fields)
    {
        foreach ($fields as $field) {

            if (isset($rule[$field])) unset($rule[$field]);
        }
    }

    /**
     * 数据库事务处理
     *
     * 在闭包函数中使用`DB`或`Eloquent`作数据库,监听闭包函数异常,操作数据库事务.
     *
     * @param $callback
     * @return mixed 闭包函数的返回结果,或者是操作事务操作失败信息(1003)
     *
     * @throws \Exception
     */
    public function transaction($callback)
    {
        DB::beginTransaction();

        try {

            $status = $callback($this);

            DB::commit();

        } catch (\Exception $e) {

            DB::rollBack();

            throw $e;
        }

        return $status;
    }

    /**
     * 引用传递数组,生成数据库的时间戳字段.
     *
     * @param array $data   记录数组(引用传递)
     * @param bool  $create 新增数据(默认为true)
     *
     * @return void
     */
    public function timestamps(&$data, $create = true)
    {
        if ($create) {

            $data['created_at'] = date('Y-m-d H:i:s');
        }

        $data['updated_at'] = date('Y-m-d H:i:s');
    }

}
