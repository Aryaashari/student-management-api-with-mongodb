<?php

namespace Student\Management\Entity;

class Grade {

    public ?int $id; 
    public int $student_id, $matematika, $bIndo, $bInggris, $rata, $total;

    public function __construct(?int $id = null, int $student_id = 0, int $matematika = 0, int $bIndo = 0, int $bInggris = 0, int $rata = 0, int $total = 0)
    {
        $this->id = $id;
        $this->student_id = $student_id;
        $this->matematika = $matematika;
        $this->bIndo = $bIndo;
        $this->bInggris = $bInggris;
        $this->rata = $rata;
        $this->total = $total;
    }

}