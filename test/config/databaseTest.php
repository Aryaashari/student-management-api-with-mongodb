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

}