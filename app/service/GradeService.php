<?php

namespace Student\Management\Service;

use Student\Management\Entity\Grade;
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

    public function updateGrade(GradeRequest $request) : GradeResponse {

        try {

            $grade = $this->gradeRepo->findById($request->id);
            if (is_null($grade)) {
                throw new ValidationException("Data grade tidak ditemukan");
            }
    
            if (is_string($request->matematika) || is_string($request->bIndo) || is_string($request->bInggris)) {
                throw new ValidationException("Semua data grade harus berupa angka");
            }
    
            if (!($request->matematika > 0 && $request->matematika <= 100) || !($request->bIndo > 0 && $request->bIndo <= 100) || !($request->bInggris > 0 && $request->bInggris <= 100)) {
                throw new ValidationException("Semua data grade harus dalam rentang 0-100");
            }
    
            $newGrade = $this->gradeRepo->update(new Grade($request->id, $request->studentId, $request->matematika, $request->bIndo, $request->bInggris));
            return new GradeResponse($newGrade->id, $newGrade->student_id, $newGrade->matematika, $newGrade->bIndo, $newGrade->bInggris, $newGrade->rata, $newGrade->total);
        } catch(\Exception | ValidationException $e) {
            throw $e;
        }


    }

    // public function deleteGrade(int $id) : bool {}

}