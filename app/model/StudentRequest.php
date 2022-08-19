<?php

namespace Student\Management\Model;

class StudentRequest {

    public ?int $id;
    public int|string $age;
    public string $name, $gender;

    public function __construct(string $name, int|string $age, string $gender, ?int $id = null)
    {
        $this->id = $id;
        $this->age = $age;
        $this->name = $name;
        $this->gender = $gender;
    }

}