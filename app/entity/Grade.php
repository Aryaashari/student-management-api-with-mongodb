<?php

namespace Student\Management\Entity;

class Grade {

    public ?int $id; 
    public int $student_id, $matematika, $bIndo, $bInggris, $rata, $total;

    public function __construct(?int $id = null, int $student_id, int $matematika, int $bIndo, int $bInggris, int $rata, int $total)
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