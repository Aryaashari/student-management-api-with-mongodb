<?php 

namespace Student\Management\Controller;

use Student\Management\App\View;
use Student\Management\Config\Database;
use Student\Management\Exception\ValidationException;
use Student\Management\Helper\ResponseApiFormatter;
use Student\Management\Model\StudentRequest;
use Student\Management\Repository\StudentRepository;
use Student\Management\Service\StudentService;

class StudentController {

    private StudentService $studentService;

    public function __construct()
    {
        $this->studentService = new StudentService(new StudentRepository(Database::getConnection()));
    }

    public function getStudent() {

        try {

            if (isset($_GET["limit"])) {
                if (!is_int($_GET["limit"])) {
                    $limit = 10;
                }
            } else {
                $limit = 10;
            }
    
            $response = $this->studentService->findAllStudent($limit);
            return ResponseApiFormatter::Success("Berhasil ambil data siswa", $response, array("limit" => $limit));
        } catch(\Exception $e) {
            return ResponseApiFormatter::Error("server bermasalah", 500, $e);
        }

    }

    public function createStudent() : void {

        if (isset($_POST["name"])) {
            $name = htmlspecialchars(trim($_POST["name"]));
        } else {
            $name = "";
        }
        
        if (isset($_POST["age"])) {
            $age = htmlspecialchars(trim($_POST["age"]));
        } else {
            $age = "";
        }

        if (isset($_POST["gender"])) {
            $gender = htmlspecialchars(trim($_POST["gender"]));
        } else {
            $gender = "";
        }

        $request = new StudentRequest($name, (int)$age, $gender);

        try {
            $student  = $this->studentService->createStudent($request);

            echo ResponseApiFormatter::Success("Berhasil tambah data siswa", [
                "id" => $student->id,
                "name" => $student->name,
                "age" => $student->age,
                "gender" => $student->gender,
            ]);
        } catch(ValidationException $e) {
            echo ResponseApiFormatter::Error($e->getMessage(), 422);
        } catch(\Exception $e) {
            echo ResponseApiFormatter::Error("Sistem bermasalah", 500, $e);
        }

    }

    public function updateStudent() {
    }

    public function deleteStudent() {
    }

}