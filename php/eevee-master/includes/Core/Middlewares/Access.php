<?php

namespace Core\Middleware;

use Closure;
use Core\Logs\AccessLog;

class Access
{

    /**
     * 访问日志
     *
     * @var array
     */
    protected $access_log = [];

    /**
     * 关键隐藏字段
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * 获取请求数据
     *
     * @param $request
     *
     * @return mixed
     */
    protected function getRequestData($request)
    {
        $data = $request->json()->all();

        foreach ($this->hidden as $item) {

            if (isset($data[$item])) {

                $data[$item] = '***';
            }
        }

        return json_encode($data);
    }

    /**
     * 保存访问日志
     */
    protected function saveAccessLogRecord()
    {
        AccessLog::create($this->access_log);
    }

    /**
     * 访问控制中间件
     */
    public function handle($request, Closure $next)
    {


        $response = $next($request);

        $this->access_log['method'] = $request->method();
        $this->access_log['uri'] = $request->path();
        $this->access_log['request_params'] = json_encode($request->query());
        $this->access_log['request_data'] = $this->getRequestData($request);
        $this->access_log['ip'] = $request->ip();
        $this->access_log['access_begin_at'] = date('Y-m-d H:i:s');

        $content = $response->getContent();

        try {

            $status = json_decode($content);

            $this->access_log['status_code'] = $status->code;
            $this->access_log['status_message'] = $status->message;
            $this->access_log['status_data'] = json_encode($status->data);

        } catch (\Exception $e) {

            $this->access_log['status_code'] = 1000;
            $this->access_log['status_message'] = 'Unknown';
            $this->access_log['status_data'] = $content;

        }

        $this->access_log['access_end_at'] = date('Y-m-d H:i:s');

        $this->saveAccessLogRecord();

        return $response;
    }

}
