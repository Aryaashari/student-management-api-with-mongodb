<?php

namespace Student\Management\Entity;

class Grade {

    public ?int $id, $student_id; 
    public int $matematika, $bIndo, $bInggris, $rata, $total;

    public function __construct(?int $id = null, ?int $student_id = null, int $matematika = 0, int $bIndo = 0, int $bInggris = 0, int $rata = 0, int $total = 0)
    {
        $this->id = $id;
        $this->student_id = $student_id;
        $this->matematika = $matematika;
        $this->bIndo = $bIndo;
        $this->bInggris = $bInggris;
        $this->rata = $rata;
        $this->total = $total;
    }

    public function getRata() : float {
        $sum = (float)$this->matematika + (float)$this->bInggris + (float)$this->bIndo;
        return $sum/3;
    }

    public function getTotal() : int {
        return $this->matematika + $this->bInggris + $this->bIndo;
    }

}