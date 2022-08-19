<?php

namespace Student\Management\Repository;

use Student\Management\Config\Database;
use Student\Management\Entity\Grade;

class GradeRepository {

    private \PDO $dbConn;

    public function __construct()
    {
        $this->dbConn = Database::getConnection();
    }

    public function findAll() : array {

        try {
            
            $stmt = $this->dbConn->query("SELECT id,student_id, matematika, bIndo, bInggris, rata, total FROM grade");
            $grades = [];
    
            while($grade = $stmt->fetch()) {
                $grades[] = new Grade($grade["id"], $grade["student_id"], $grade["matematika"], $grade["bIndo"], $grade["bInggris"], $grade["rata"], $grade["total"]);
            }
    
            return $grades;

        } catch(\Exception | \PDOException $e) {
            throw $e;
        }

    }

    public function findById(int $id) : ?Grade {

        try {

            $stmt = $this->dbConn->prepare("SELECT id,student_id, matematika, bIndo, bInggris, rata, total FROM grade WHERE id=?");
            $stmt->execute([$id]);
    
            if ($grade = $stmt->fetch()) {
                return new Grade($grade["id"], $grade["student_id"], $grade["matematika"], $grade["bIndo"], $grade["bInggris"], $grade["rata"], $grade["total"]);
            }
    
            return null;
        } catch(\Exception | \PDOException $e) {
            throw $e;
        }


    }

    public function findByStudentId(int $studentId) : ?Grade {

        try {

            $stmt = $this->dbConn->prepare("SELECT id,student_id, matematika, bIndo, bInggris, rata, total FROM grade WHERE student_id=?");
            $stmt->execute([$studentId]);
    
            if ($grade = $stmt->fetch()) {
                return new Grade($grade["id"], $grade["student_id"], $grade["matematika"], $grade["bIndo"], $grade["bInggris"], $grade["rata"], $grade["total"]);
            }
    
            return null;
        } catch(\Exception | \PDOException $e) {
            throw $e;
        }

    }

    public function create(Grade $grade) : Grade {

        try {

            $stmt = $this->dbConn->prepare("INSERT INTO grade(student_id, matematika, bIndo, bInggris, rata, total) VALUES(?,?,?,?,?,?)");
            $grade->rata = $grade->getRata();
            $grade->total = $grade->getTotal();
            $stmt->execute([$grade->student_id, $grade->matematika, $grade->bIndo, $grade->bInggris, $grade->rata, $grade->total]);

            $grade->id = $this->dbConn->lastInsertId();

            return $grade;

        } catch(\Exception | \PDOException $e) {
            throw $e;
        }

    }

    public function update(Grade $grade) : Grade {

        try {

            $stmt = $this->dbConn->prepare("UPDATE grade SET matematika=?, bIndo=?, bInggris=?, rata=?, total=? WHERE id=?");
            $grade->rata = $grade->getRata();
            $grade->total = $grade->getTotal();
            $stmt->execute([$grade->matematika, $grade->bIndo, $grade->bInggris, $grade->rata, $grade->total, $grade->id]);

            return $grade;

        } catch(\Exception | \PDOException $e) {
            throw $e;
        }

    }

    public function delete(int $id) : bool {

        try {

            $stmt = $this->dbConn->prepare("DELETE FROM grade WHERE id=?");
            $stmt->execute([$id]);

            return true;

        } catch(\Exception | \PDOException $e) {
            throw $e;
        }

    }


    public function deleteAllData() : void {
        $this->dbConn->query("DELETE FROM grade");
    }


}