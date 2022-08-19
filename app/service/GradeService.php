<?php

namespace Student\Management\Service;

use Student\Management\Exception\ValidationException;
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

    public function findGradeById(int $id) : GradeResponse {
        try {
            $grade = $this->gradeRepo->findById($id);
            if (is_null($grade)) {
                throw new ValidationException("Data grade tidak ditemukan");
            }

            return new GradeResponse($grade->id, $grade->student_id, $grade->matematika, $grade->bIndo, $grade->bInggris, $grade->rata, $grade->total);
        } catch(\Exception | ValidationException $e) {
            throw $e;
        }
    }

    public function findGradeByStudentId(int $studentId) : GradeResponse {

        try {

            $grade = $this->gradeRepo->findByStudentId($studentId);
            if (is_null($grade)) {
                throw new ValidationException("Data grade tidak ditemukan");
            }
    
            return new GradeResponse($grade->id, $grade->student_id, $grade->matematika, $grade->bIndo, $grade->bInggris, $grade->rata, $grade->total);
        } catch(\Exception | ValidationException $e) {
            throw $e;
        }


    }

    // public function updateGrade(GradeRequest $request) : GradeResponse {}

    // public function deleteGrade(int $id) : bool {}

}