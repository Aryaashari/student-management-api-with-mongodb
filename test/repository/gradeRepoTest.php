<?php

namespace Student\Management\Repository;

use PHPUnit\Framework\TestCase;
use Student\Management\Config\Database;
use Student\Management\Entity\Grade;
use Student\Management\Entity\Student;
use Student\Management\Repository\GradeRepository;
use Student\Management\Repository\StudentRepository;

class gradeRepoTest extends TestCase {

    private GradeRepository $gradeRepo;
    private StudentRepository $studentRepo;

    public function setUp() : void {
        $this->gradeRepo = new GradeRepository();
        $this->studentRepo = new StudentRepository(Database::getConnection());
        $this->gradeRepo->deleteAllData();
    }

    public function testFindAllSuccess() {
        $grades = $this->gradeRepo->findAll();
        $this->assertIsArray($grades);
    }


    public function testFindByIdNotFound() {
        $grade = $this->gradeRepo->findById(1);
        $this->assertNull($grade);
    }

    public function testFindByIdFound() {
        $grade = $this->gradeRepo->findById(1);
        $this->assertNotNull($grade);
    }

    public function testFindByStudentIdNotFound() {
        $grade = $this->gradeRepo->findByStudentId(1);
        $this->assertNull($grade);
    }

    public function testFindByStudentIdFound() {
        $grade = $this->gradeRepo->findByStudentId(23);
        $this->assertNotNull($grade);
    }

    public function testCreateSuccess() {
        $student = $this->studentRepo->create(new Student(null, "Arya Ashari", 19, "L"));
        $grade = $this->gradeRepo->create(new Grade(null, $student->id, 80,87,90));
        var_dump($grade);
        $this->assertIsObject($grade);
    }

    public function testUpdateSuccess() {
        $student = $this->studentRepo->create(new Student(null, "Arya Ashari", 19, "L"));
        $grade = $this->gradeRepo->create(new Grade(null, $student->id));
        $this->assertIsObject($grade);
        var_dump($grade);
        $this->assertEquals(0, $grade->matematika);
        $this->assertEquals(0, $grade->bIndo);
        $this->assertEquals(0, $grade->bInggris);
        $this->assertEquals(0, $grade->rata);
        $this->assertEquals(0, $grade->total);
        
        $newGrade = $this->gradeRepo->update(new Grade($grade->id, $grade->student_id, 67, 86, 38));
        $this->assertIsObject($newGrade);
        var_dump($newGrade);
        // $this->assertEquals(100, $newGrade->matematika);
        // $this->assertEquals(100, $newGrade->bIndo);
        // $this->assertEquals(100, $newGrade->bInggris);
        // $this->assertEquals(100, $newGrade->rata);
        // $this->assertEquals(300, $newGrade->total);
    }

    public function testError() {
        $this->expectException(\Exception::class);
        // $this->gradeRepo->findAll();
        // $this->gradeRepo->findById(1);
    }

}