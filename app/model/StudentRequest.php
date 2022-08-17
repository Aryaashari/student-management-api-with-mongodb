<?php

namespace Student\Management\Model;

class StudentRequest {

    public int|string $age;
    public string $name, $gender;

    public function __construct(string $name, int|string $age, string $gender)
    {
        $this->age = $age;
        $this->name = $name;
        $this->gender = $gender;
    }

}