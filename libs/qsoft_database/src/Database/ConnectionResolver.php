<?php
/**
 * Created by PhpStorm.
 * User: vyfvfv
 * Date: 05.08.15
 * Time: 18:19
 */

namespace QSoft\Database;


use Bitrix\Main\Application;
use Illuminate\Database\ConnectionResolverInterface;

class ConnectionResolver implements ConnectionResolverInterface
{

    private $defaultConnection = "";

    /**
     * Get a database connection instance.
     *
     * @param  string $name
     * @return \Illuminate\Database\ConnectionInterface
     */
    public function connection($name = null)
    {
        return new MysqlConnection(Application::getConnection((string)$name));
    }

    /**
     * Get the default connection name.
     *
     * @return string
     */
    public function getDefaultConnection()
    {
        return $this->defaultConnection;
    }

    /**
     * Set the default connection name.
     *
     * @param  string $name
     * @return void
     */
    public function setDefaultConnection($name)
    {
        $this->defaultConnection = $name;
    }
}