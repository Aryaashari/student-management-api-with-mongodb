<?php

namespace Student\Management\Repository;

use PHPUnit\Framework\TestCase;
use Student\Management\Config\Database;
use Student\Management\Repository\StudentRepository;

class studentRepositoryTest extends TestCase {
    private \PDO $db;
    private StudentRepository $studentRepo;

    public function setUp() : void{
        $this->db = Database::getConnection();
        $this->studentRepo = new StudentRepository($this->db);
        $this->studentRepo->deleteAllData();
    }

    public function testFindByIdFound() : void {
        $this->db->query("INSERT INTO student(name,age,gender) VALUES ('Arya', 18, 'L')");
        $id = $this->db->lastInsertId();
        $student = $this->studentRepo->findById($id);
        $this->assertNotNull($student);
        $this->assertIsObject($student);
        $this->assertEquals('Arya', $student->name);
    }

    public function testFindByIdNotFound() : void {
        $student = $this->studentRepo->findById(1);
        $this->assertNull($student);
    }

    // public function testErrorException() : void {

    //     $this->expectException(\Exception::class);
    //     $this->studentRepo->findById(3);

    // }

}