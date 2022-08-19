<?php

namespace Student\Management\Service;

use Student\Management\Model\GradeRequest;
use Student\Management\Model\GradeResponse;
use Student\Management\Repository\GradeRepository;

class GradeService {

    private GradeRepository $gradeRepo;

    public function __construct(GradeRepository $gradeRepo)
    {
        $this->gradeRepo = $gradeRepo;
    }

    public function findAllGrade() : array {
        try {
            $grades = $this->gradeRepo->findAll();
            return $grades;
        } catch(\Exception $e) {
            throw $e;
        }
    }

    // public function findGradeById(int $id) : GradeResponse {}

    // public function findGradeByStudentId(int $studentId) : GradeResponse {}

    // public function updateGrade(GradeRequest $request) : GradeResponse {}

    // public function deleteGrade(int $id) : bool {}

}