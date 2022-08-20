<?php

namespace Student\Management\Controller;

use Student\Management\Repository\GradeRepository;
use Student\Management\Service\GradeService;

class GradeController {

    private GradeService $gradeService;

    public function __construct()
    {
        $this->gradeService = new GradeService(new GradeRepository);
    }

}