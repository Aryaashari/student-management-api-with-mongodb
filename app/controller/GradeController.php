<?php

namespace Student\Management\Controller;

use Student\Management\Config\Database;
use Student\Management\Exception\ValidationException;
use Student\Management\Helper\ResponseApiFormatter;
use Student\Management\Model\GradeRequest;
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

    public function updateGrade(int $id) : void {

        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        if (isset($input["matematika"])) {
            $matematika = htmlspecialchars(trim($input["matematika"]));
        } else {
            $matematika = "";
        }

        if (isset($input["bIndo"])) {
            $bIndo = htmlspecialchars(trim($input["bIndo"]));
        } else {
            $bIndo = "";
        }

        if (isset($input["bInggris"])) {
            $bInggris = htmlspecialchars(trim($input["bInggris"]));
        } else {
            $bInggris = "";
        }

        $request = new GradeRequest($id, null, (int)$matematika, (int)$bIndo, (int)$bInggris);

        try {

            $newGrade = $this->gradeService->updateGrade($request);
            $student = $this->studentService->findStudentById($newGrade->studentId);
            $response = [
                "id" => $newGrade->id,
                "student_id" => $newGrade->studentId,
                "matematiika" => $newGrade->matematika,
                "bIndo" => $newGrade->bIndo,
                "bInggris" => $newGrade->bInggris,
                "rata" => $newGrade->rata,
                "total" => $newGrade->total,
                "student" => [
                    "id" => $student->id,
                    "name" => $student->name,
                    "age" => $student->age,
                    "gender" => $student->gender,
                ]
            ];
    
            echo ResponseApiFormatter::Success("Berhasil update data grade", $response);
        } catch(ValidationException $e) {
            echo ResponseApiFormatter::Error($e->getMessage(), 400);
        } catch(\Exception $e) {
            echo ResponseApiFormatter::Error("Sistem bermasalah",500,$e);
        }



    }

}