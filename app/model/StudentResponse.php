<?php

namespace Student\Management\Model;

class StudentResponse {

    public int $id, $age;
    public string $name, $gender;

    public function __construct(int $id, string $name, int $age, string $gender)
    {
        $this->id = $id;
        $this->age = $age;
        $this->name = $name;
        $this->gender = $gender;
    }

}