<?php

namespace Student\Management\Config;

require_once __DIR__."./../../vendor/autoload.php";

use PHPUnit\Framework\TestCase;
use Student\Management\Config\Database;

class databaseTest extends TestCase {

    public function testConnection() {

        $db = Database::getConnection();
        $this->assertNotNull($db);

    }

    public function testConnectionMongo() {
        $db = Database::getConnection("test", "mongodb");
        $collections = $db->student->find();
        $students = [];
        foreach($collections as $student) {
            $students[] = $student;
        }
        
        var_dump($students);
        $this->assertNotNull($db);
    }

}