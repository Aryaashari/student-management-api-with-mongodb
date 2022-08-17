<?php

namespace Student\Management\Config;

class Database {

    private static ?\PDO $db = null;

    private static function getEnv(string $env = "test", string $dbType = "mysql") : array {

        $setting = [
            "mysql" => [
                "test" => [
                    "url" => "mysql:host=localhost:3306;dbname=rekap_nilai_test",
                    "username" => "root",
                    "password" => ""
                ],
                "production" => [
                    "url" => "mysql:host=localhost:3306;dbname=rekap_nilai",
                    "username" => "root",
                    "password" => ""
                ]
            ]
        ];

        return $setting[$dbType][$env];
    }

    public static function getConnection($env = "test", $dbType = "mysql") : \PDO {

        if (is_null(self::$db)) {
            $env = self::getEnv($env, $dbType);
            self::$db = new \PDO($env["url"], $env["username"], $env["password"]);
        }

        return self::$db;

    }

    public static function startTransaction() : void {
        self::$db->beginTransaction();
    }

    public static function commitTransaction() : void {
        self::$db->commit();
    }

    public static function rollbackTransaction() : void {
        self::$db->rollback();
    }
}