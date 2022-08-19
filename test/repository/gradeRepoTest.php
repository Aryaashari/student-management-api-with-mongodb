<?php

namespace Student\Management\Repository;

use PHPUnit\Framework\TestCase;
use Student\Management\Config\Database;
use Student\Management\Repository\GradeRepository;

class gradeRepoTest extends TestCase {

    private GradeRepository $gradeRepo;

    public function setUp() : void {
        $this->gradeRepo = new GradeRepository();
        // $this->gradeRepo->deleteAllData();
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

    public function testError() {
        $this->expectException(\Exception::class);
        // $this->gradeRepo->findAll();
        $this->gradeRepo->findById(1);
    }

}