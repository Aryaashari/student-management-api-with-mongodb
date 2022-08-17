<?php

namespace Student\Management\Repository;

use PHPUnit\Framework\TestCase;
use Student\Management\Config\Database;
use Student\Management\Entity\Student;
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

    public function testFindAllNotEmpty() : void {
        $this->db->query("INSERT INTO student(name,age,gender) VALUES ('Arya', 18, 'L')");
        $students = $this->studentRepo->findAll(100);
        $this->assertNotEquals(0, count($students));
        $this->assertIsObject($students[0]);
    }

    public function testFindAllEmpty() : void {
        $students = $this->studentRepo->findAll(100);
        $this->assertEquals(0, count($students));
    }

    public function testCreate() : void {
        $student = $this->studentRepo->create(new Student(null, "Arya Ashari", 18, "L"));
        $this->assertIsObject($student);
        $this->assertEquals("Arya Ashari", $student->name);
        $this->assertEquals(18, $student->age);
        $this->assertEquals("L", $student->gender);
    }

    public function testUpdate() : void {
        $student = $this->studentRepo->create(new Student(null, "Arya Ashari", 18, "L"));
        $this->assertEquals("Arya Ashari", $student->name);
        $this->assertEquals(18, $student->age);
        $this->assertEquals("L", $student->gender);

        $student->name = "Fira";
        $student->age = 16;
        $student->gender = "P";
        $newStudent = $this->studentRepo->update($student);
        $this->assertEquals("Fira", $newStudent->name);
        $this->assertEquals(16, $newStudent->age);
        $this->assertEquals("P", $newStudent->gender);

    }

    public function testDelete() : void {
        $student = $this->studentRepo->create(new Student(null, "Arya Ashari", 18, "L"));
        $this->assertEquals("Arya Ashari", $student->name);
        $this->assertEquals(18, $student->age);
        $this->assertEquals("L", $student->gender);

        $student = $this->studentRepo->delete($student->id);
        $this->assertTrue($student);
    }

    // public function testErrorException() : void {

    //     $this->expectException(\Exception::class);
    //     $this->studentRepo->findById(3);

    // }

}