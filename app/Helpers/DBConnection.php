<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class DBConnection
{
    protected $connection;
    
    public static function connect($driver, $host, $database, $username, $password)
    {
        $config = [
            'driver' => $driver,
            'host' => $host,
            'database' => $database,
            'username' => $username,
            'password' => $password,
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ];

        DB::purge('mysql');
        DB::reconnect('mysql');
        config(['database.connections.mysql' => $config]);

        return DB::connection('mysql')->getPdo();
    }

    public function executeQuery($query)
    {
        $results = $this->connection->select($query);
        return $results;
    }
}