<?php

namespace Student\Management\Repository;

use PHPUnit\Framework\TestCase;
use Student\Management\Repository\GradeRepository;

class gradeRepoTest extends TestCase {

    private GradeRepository $gradeRepo;

    public function setUp() : void {
        $this->gradeRepo = new GradeRepository();
    }

    public function testFindAllSuccess() {
        $grades = $this->gradeRepo->findAll();
        $this->assertIsArray($grades);
    }

    public function testFindAllError() {
        $this->expectException(\Exception::class);
        $this->gradeRepo->findAll();
    }

}