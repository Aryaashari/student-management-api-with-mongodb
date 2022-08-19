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
        $grade = $this->gradeRepo->create(new Grade(null, $student->id));
        $this->assertIsObject($grade);
    }

    public function testError() {
        $this->expectException(\Exception::class);
        // $this->gradeRepo->findAll();
        // $this->gradeRepo->findById(1);
    }

}