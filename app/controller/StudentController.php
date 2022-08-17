<?php 

namespace Student\Management\Controller;

use Student\Management\App\View;
use Student\Management\Config\Database;
use Student\Management\Helper\ResponseApiFormatter;
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

    public function createStudent() {
    }

    public function updateStudent() {
    }

    public function deleteStudent() {
    }

}