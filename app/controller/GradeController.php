<?php

namespace Student\Management\Controller;

use Student\Management\Config\Database;
use Student\Management\Exception\ValidationException;
use Student\Management\Helper\ResponseApiFormatter;
use Student\Management\Repository\GradeRepository;
use Student\Management\Repository\StudentRepository;
use Student\Management\Service\GradeService;
use Student\Management\Service\StudentService;

class GradeController {

    private GradeService $gradeService;
    private StudentService $studentService;

    public function __construct()
    {
        $this->gradeService = new GradeService(new GradeRepository);
        $this->studentService = new StudentService(new StudentRepository(Database::getConnection()));
    }

    public function findAllGrade() : void {

        try {
            $grades = $this->gradeService->findAllGrade();

            $response = [];
            foreach($grades as $grade) {
                $student = $this->studentService->findStudentById($grade->student_id);
                $response[] = [
                    "id" => $grade->id,
                    "student_id" => $grade->student_id,
                    "matematiika" => $grade->matematika,
                    "bIndo" => $grade->bIndo,
                    "bInggris" => $grade->bInggris,
                    "rata" => $grade->rata,
                    "total" => $grade->total,
                    "student" => [
                        "id" => $student->id,
                        "name" => $student->name,
                        "age" => $student->age,
                        "gender" => $student->gender,
                    ]
                ];
            }

            echo ResponseApiFormatter::Success("Berhasil ambil semua data grade", $response);
        } catch(\Exception $e) {
            echo ResponseApiFormatter::Error("Sistem bermasalah",500,$e);
        }

    }

    public function findDetailGrade(int $id) : void {

        try {

            $grade = $this->gradeService->findGradeById($id);
            $student = $this->studentService->findStudentById($grade->studentId);
            $response = [
                "id" => $grade->id,
                "student_id" => $grade->studentId,
                "matematiika" => $grade->matematika,
                "bIndo" => $grade->bIndo,
                "bInggris" => $grade->bInggris,
                "rata" => $grade->rata,
                "total" => $grade->total,
                "student" => [
                    "id" => $student->id,
                    "name" => $student->name,
                    "age" => $student->age,
                    "gender" => $student->gender,
                ]
            ];
    
            echo ResponseApiFormatter::Success("Berhasil ambil detail data grade", $response);
        } catch(ValidationException $e) {
            echo ResponseApiFormatter::Error($e->getMessage(), 404);
        } catch(\Exception $e) {
            echo ResponseApiFormatter::Error("Sistem bermasalah",500,$e);
        }
        

    }

    public function createGrade() : void {}

    public function updateGrade() : void {}

    public function deleteGrade() : void {}

}