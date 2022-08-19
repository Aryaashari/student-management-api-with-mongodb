<?php

namespace Student\Management\Service;

use Student\Management\Repository\GradeRepository;

class GradeService {

    private GradeRepository $gradeRepo;

    public function __construct(GradeRepository $gradeRepo)
    {
        $this->gradeRepo = $gradeRepo;
    }

}