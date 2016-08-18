<?php

/**
 * Class Rbac
 *
 * RABC 角色权限认证服务
 *
 * @package Core\Services
 */

namespace Core\Services;


use PhpRbac\Rbac as Base;



class Rbac extends Base
{
    public function __construct()
    {
        $host = "localhost";

        $user = "root";

        $pass = "";

        // $dbname = __DIR__ . "/phprbac.sqlite3";

        // $dbname="phprbac";

        // $adapter = "pdo_sqlite";

        // $adapter="pdo_mysql";

        // $adapter="mysqli";

        $tablePrefix = "phprbac_";

        require_once base_path('vendor/owasp/phprbac/PhpRbac/src/PhpRbac/core/lib/Jf.php');

        $this->Permissions = Jf::$Rbac->Permissions;

        $this->Roles = Jf::$Rbac->Roles;

        $this->Users = Jf::$Rbac->Users;

    }

}