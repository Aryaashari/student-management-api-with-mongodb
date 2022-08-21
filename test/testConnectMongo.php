<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__."/../vendor/autoload.php";

class testConnectMongo extends TestCase {

    public function testConnect() {
        $client = new MongoDB\Client('mongodb://localhost:27017');
        $result = $client->test->student->find();
        $students = [];
        foreach($result as $r) {
            $students[] = $r;
        }
        var_dump($students);
        var_dump("Succes to connect");
        $this->assertTrue(true);
    }

}