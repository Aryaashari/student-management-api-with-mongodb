<?php

namespace Student\Management\Repository;

use Student\Management\Config\Database;
use Student\Management\Entity\Grade;
use Student\Management\Entity\Student;

class StudentRepository {
    
    private \PDO $dbConn;
    private GradeRepository $gradeRepo;

    public function __construct(\PDO $db)
    {
        $this->dbConn = $db;
        $this->gradeRepo = new GradeRepository;
    }


    public function findById(int $id) : ?Student {
        try {

            $stmt = $this->dbConn->prepare("SELECT id,name,age,gender FROM student WHERE id=?");
            $stmt->execute([$id]);
    
            if ($student = $stmt->fetch()) {
                return new Student($student["id"], $student["name"], $student["age"], $student["gender"]);
            }
    
            return null;

        } catch(\Exception | \PDOException $e) {
            throw $e;
        }
    }

    public function findAll(int $limit) : array {
        try {

            $stmt = $this->dbConn->query("SELECT id,name,age,gender FROM student LIMIT $limit");
            $students = [];
            while($student = $stmt->fetch()) {
                $students[] = new Student($student["id"], $student["name"], $student["age"], $student["gender"]);
            }
    
            return $students;

        } catch(\Exception | \PDOException $e) {
            throw $e;
        }

    }

    public function create(Student $student) : Student {

        try {
            Database::startTransaction();
            $stmt = $this->dbConn->prepare("INSERT INTO student(name,age,gender) VALUES (?,?,?)");
            $stmt->execute([$student->name, $student->age, $student->gender]);
            $id = $this->dbConn->lastInsertId();
            $student->id = $id;

            $this->gradeRepo->create(new Grade(null, $id));
            Database::commitTransaction();

            return $student;
        } catch(\Exception | \PDOException $e) {
            Database::rollbackTransaction();
            throw $e;
        }

    }

    public function update(Student $student) : Student {

        try {
            $stmt = $this->dbConn->prepare("UPDATE student SET name=?, age=?, gender=? WHERE id=?");
            $stmt->execute([$student->name, $student->age, $student->gender, $student->id]);
            // var_dump($student);
            // exit();
            return $student;
        } catch (\Exception | \PDOException $e) {
            throw $e;
        }

    }

    public function delete(int $id) : bool {
        try {

            $stmt = $this->dbConn->prepare("DELETE  FROM student WHERE id=?");
            $stmt->execute([$id]);

            return true;

        } catch(\Exception | \PDOException $e) {
            throw $e;
        }
    }

    public function deleteAllData() : void {
        $this->dbConn->query("DELETE FROM student");
    }

}