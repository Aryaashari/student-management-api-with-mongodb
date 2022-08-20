<?php

namespace Student\Management\Controller;

use Student\Management\Helper\ResponseApiFormatter;
use Student\Management\Repository\GradeRepository;
use Student\Management\Service\GradeService;

class GradeController {

    private GradeService $gradeService;

    public function __construct()
    {
        $this->gradeService = new GradeService(new GradeRepository);
    }

    public function findAllGrade() : void {

        try {
            
            $grades = $this->gradeService->findAllGrade();
            echo ResponseApiFormatter::Success("Berhasil ambil semua data grade", $grades);
        } catch(\Exception $e) {
            echo ResponseApiFormatter::Error("Sistem bermasalah",500,$e);
        }

    }

    public function findDetailGrade(int $id) : void {}

    public function createGrade() : void {}

    public function updateGrade() : void {}

    public function deleteGrade() : void {}

}