<?php

namespace Student\Management\Model;

class GradeResponse {

    public ?int $id;
    public int $studentId, $matematika, $bIndo, $bInggris, $rata, $total;

    public function __construct(?int $id = null, int $studentId, int $matematika = 0, int $bIndo = 0, int $bInggris = 0, int $rata = 0, int $total = 0)
    {
        $this->id = $id;
        $this->studentId = $studentId;
        $this->matematika = $matematika;
        $this->bIndo = $bIndo;
        $this->bInggris = $bInggris; 
        $this->rata = $rata;
        $this->total = $total;
    }

}