<?php

namespace Student\Management\Repository;

use Student\Management\Entity\Student;

class StudentRepository {
    
    private \PDO $dbConn;

    public function __construct(\PDO $db)
    {
        $this->dbConn = $db;
    }


    public function findById(int $id) : ?Student {
        try {

            $stmt = $this->dbConn->prepare("SELECT id,name,age,gender FROM student WHERE id=?");
            $stmt->execute([$id]);
    
            if ($student = $stmt->fetch()) {
                return new Student($student["id"], $student["name"], $student["age"], $student["gender"]);
            }
    
            return null;

        } catch(\Exception $e) {
            throw $e;
        }
    }

    public function findAll(int $limit) : array {
        try {

            $stmt = $this->dbConn->prepare("SELECT id,name,age,gender FROM student LIMIT ?");
            $stmt->execute([$limit]);
    
            $students = [];
            while($student = $stmt->fetch()) {
                $students[] = new Student($student["id"], $student["name"], $student["age"], $student["gender"]);
            }
    
            return $students;

        } catch(\Exception $e) {
            throw $e;
        }

    }

    public function create(Student $student) : Student {

        try {
            $stmt = $this->dbConn->prepare("INSERT INTO student(name,age,gender) VALUES (?,?,?)");
            $stmt->execute([$student->name, $student->age, $student->gender]);
            $id = $this->dbConn->lastInsertId();
            $student->id = $id;
            return $student;
        } catch(\Exception $e) {
            throw $e;
        }

    }

    public function update(Student $student) : Student {

        try {
            $stmt = $this->dbConn->prepare("UPDATE student SET(name=?, age=?, gender=?) WHERE id=?");
            $stmt->execute([$student->name, $student->age, $student->gender, $student->id]);

            return $student;
        } catch (\Exception $e) {
            throw $e;
        }

    }

    public function delete(int $id) : bool {
        try {

            $stmt = $this->dbConn->prepare("DELETE  FROM student WHERE id=?");
            $stmt->execute([$id]);

            return true;

        } catch(\Exception $e) {
            throw $e;
        }
    }

}