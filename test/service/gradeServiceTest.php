<?php

namespace Student\Management\Service;

use PHPUnit\Framework\TestCase;
use Student\Management\Config\Database;
use Student\Management\Entity\Student;
use Student\Management\Exception\ValidationException;
use Student\Management\Model\GradeRequest;
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
        $this->studentRepo->deleteAllData();
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

    public function testFindGradeByIdFound() {
        $student = $this->studentRepo->create(new Student(null, "Arya", 18, "L"));
        $grades = $this->gradeService->findAllGrade();
        $grade = null;
        foreach($grades as $grade) {
            if ($student->id == $grade->student_id) {
                $grade = $this->gradeService->findGradeById($grade->id);
                break;
            }
        }

        var_dump($grade);
        
        $this->assertIsObject($grade);
    }

    public function testFindGradeByIdNotFound() {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage("Data grade tidak ditemukan");
        $grade = $this->gradeService->findGradeById(9999);
    }

    public function testFindGradeByStudentIdFound() {
        $student = $this->studentRepo->create(new Student(null, "Arya", 18, "L"));
        $grade = $this->gradeService->findGradeByStudentId($student->id);

        var_dump($grade);
        
        $this->assertIsObject($grade);
    }

    public function testFindGradeByStudentIdNotFound() {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage("Data grade tidak ditemukan");
        $grade = $this->gradeService->findGradeByStudentId(999);

        var_dump($grade);
    }

    public function testUpdateGradeSuccess() {
        $student = $this->studentRepo->create(new Student(null, "Arya", 18, "L"));
        $grade = $this->gradeService->findGradeByStudentId($student->id);
        var_dump($grade);
        $this->assertEquals(0, $grade->matematika);
        $this->assertEquals(0, $grade->bIndo);
        $this->assertEquals(0, $grade->bInggris);
        $this->assertEquals(0, $grade->rata);
        $this->assertEquals(0, $grade->total);

        $grade = $this->gradeService->updateGrade(new GradeRequest($grade->id, $grade->studentId, 100, 100, 100));
        var_dump($grade);
        $this->assertEquals(100, $grade->matematika);
        $this->assertEquals(100, $grade->bIndo);
        $this->assertEquals(100, $grade->bInggris);
        $this->assertEquals(100, $grade->rata);
        $this->assertEquals(300, $grade->total);
    }

}