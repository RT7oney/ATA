<?php

namespace Core\Console\Commands\Permission;

use Storage;
use Illuminate\Console\Command;

class Generate  extends Command
{
    protected $signature = 'permission:generate';

    protected $description = 'generate permissions from route config.';

    protected $routes;

    protected $permissions;

    protected $errors;

    public function __construct()
    {
        parent::__construct();

        $this->routes = config('routes');

        $this->errors = 0;
    }

    /**
     * 从路由中提取权限信息.
     *
     * TODO 校验权限命名规则，只能是英文，数字和点符号
     * 
     */
    public function handle()
    {
        $this->permissions = array();

        foreach ($this->routes as $route => $info) {
            if (!isset($info['permission'])) {
                $this->comment("warning : the route $route doesn't set permission.");
                continue;
            }

            $permission = $info['permission'];

            if (is_string($permission)) {
                $permission = [$permission];
            }

            if (!is_array($permission)) {
                $this->error("error : the route $route permission is neither string nor array.");
                ++$this->errors;
                continue;
            }

            $this->permissions = array_merge($this->permissions, $permission);
        }

        $this->writePermissionConfig();
    }

    /**
     * 将权限列表写入配置文件，如果原文件存在则删除原文件。
     */
    protected function writePermissionConfig()
    {
        if ($this->errors === 0) {
            $file = 'core/System/config/permissions.php';
            if (Storage::put($file, "<?php\r\nreturn ".var_export($this->permissions, true).';')) {
                $this->info("generate $file");
                $this->generatePrmissionsLang();
            } else {
                $this->error("write $file error.");
            }
        }
    }

    /**
     * 生成权限语言文件，如果当前语言环境下存在权限的语言文件，则合并二者。
     */
    protected function generatePrmissionsLang()
    {
        $locale = config('app.locale');

        $file = "core/System/locale/$locale/permissions.php";

        if (Storage::exists($file)) {
            $lang = require base_path($file);

            foreach ($this->permissions as $permission) {
                if (!array_key_exists($permission, $lang)) {
                    $lang[$permission] = $permission;
                }
            }
        } else {
            $lang = array();
            foreach ($this->permissions as $permission) {
                $lang[$permission] = '';
            }
        }

        if (!Storage::put($file, "<?php\r\nreturn ".var_export($lang, true).';')) {
            $this->error("write $file error.");
        } else {
            $this->info("generate $file");
        }
    }
}
