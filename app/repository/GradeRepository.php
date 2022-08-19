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

    // public function findAll() : array {}

    // public function findById(int $id) : ?Grade {}

    // public function findByStudentId(int $studentId) : ?Grade {}

    // public function create(Grade $grade) : Grade {}

    // public function update(Grade $grade) : Grade {}

    // public function delete(int $id) : bool {}


}