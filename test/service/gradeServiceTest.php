<?php

namespace Student\Management\Service;

use PHPUnit\Framework\TestCase;
use Student\Management\Config\Database;
use Student\Management\Entity\Student;
use Student\Management\Repository\GradeRepository;
use Student\Management\Repository\StudentRepository;

class gradeServiceTest  extends TestCase {

    private GradeRepository $gradeRepo;
    private GradeService $gradeService;
    private StudentRepository $studentRepo;

    public function setUp() : void {
        $this->gradeRepo = new GradeRepository;
        $this->gradeService = new GradeService($this->gradeRepo);
        $this->studentRepo = new StudentRepository(Database::getConnection());
        $this->gradeRepo->deleteAllData();
    }

    public function testFindAllGradeEmpty() {
        $grades = $this->gradeService->findAllGrade();
        $this->assertIsArray($grades);
        $this->assertEmpty($grades);
    }

    public function testFindAllGradeNotEmpty() {
        $student = $this->studentRepo->create(new Student(null, "Arya", 18, "L"));
        $grades = $this->gradeService->findAllGrade();
        $this->assertIsArray($grades);
        $this->assertTrue(count($grades) > 0);
    }

}