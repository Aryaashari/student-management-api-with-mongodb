<?php

namespace Student\Management\Config;

class Database {

    private static ?\PDO $db = null;
    private static ?\MongoDB\Database $mongoDB = null;

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
            ],
            "mongodb" => [
                "test" => [
                    "url" => "mongodb://localhost:27017",
                    "dbName" => "test"
                ],
                "production" => [
                    "url" => "mongodb://localhost:27017",
                    "dbName" => "student_management"
                ]
            ]

        ];

        return $setting[$dbType][$env];
    }

    public static function getConnection($env = "test", $dbType = "mysql") : \PDO|\MongoDB\Database {

        if ($dbType === "mysql") {
            if (is_null(self::$db)) {
                $env = self::getEnv($env, $dbType);
                self::$db = new \PDO($env["url"], $env["username"], $env["password"]);
            }
            return self::$db;
        } else if ($dbType === "mongodb") {
            if (is_null(self::$mongoDB)) {
                $env = self::getEnv($env, $dbType);
                $client = new \MongoDB\Client($env["url"]);
                $dbName = $env["dbName"];

                self::$mongoDB = $client->$dbName;
            }
            return self::$mongoDB;
        }

        

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