<?php

namespace Student\Management\Service;

use Student\Management\Entity\Student;
use Student\Management\Exception\ValidationException;
use Student\Management\Model\StudentRequest;
use Student\Management\Model\StudentResponse;
use Student\Management\Repository\StudentRepository;

class StudentService {

    private StudentRepository $studentRepo;

    public function __construct(StudentRepository $studentRepo)
    {
        $this->studentRepo = $studentRepo;
    }

    public function findStudentById(int $id) : StudentResponse {

        try {

            // Validasi id
            $student = $this->studentRepo->findById($id);
    
            if ($student == null) {
                throw new ValidationException("Data student tidak ditemukan", 404);
            }
    
            $response = new StudentResponse($student->id, $student->name, $student->age, $student->gender);
    
            return $response;

        } catch(ValidationException | \Exception $e) {
            throw $e;
        }

    }

    public function findAllStudent(int $limit) : array {
       try {
            // Validasi limit
            if ($limit < 5 && $limit > 100) {
                $limit = 10;
            }

            $students = $this->studentRepo->findAll($limit);

            return $students;
       } catch(\Exception $e) {
            throw $e;
        }
    }

    public function createStudent(StudentRequest $request) : StudentResponse {

        try {
            // Validasi request
            if (strlen($request->name) < 3 && strlen($request->name) > 50) {
                throw new ValidationException("Nama siswa minimal 3 dan maksimal 50 karakter", 422);
            }

            if ($request->age == null || $request->age = "") {
                throw new ValidationException("Umur belum di isi", 422);
            } 

            if (!is_int($request->age)) {
                throw new ValidationException("Umur siswa harus integer", 422);
            }

            if (strtoupper($request->gender) != "L" && strtoupper($request->gender) != "P") {
                throw new ValidationException("Gender harus berupa L atau P", 422);
            }

            $response = $this->studentRepo->create(new Student(null, $request->name, $request->age, $request->gender));
            return new StudentResponse($response->id, $response->name, $response->age, $response->gender);
        } catch(ValidationException | \Exception $e) {
            throw $e;
        }

    }

    public function updateStudent(StudentRequest $request) : StudentResponse {

        try {
            // Validasi request
            if (strlen($request->name) < 3 && strlen($request->name) > 50) {
                throw new ValidationException("Nama siswa minimal 3 dan maksimal 50 karakter", 422);
            }

            if ($request->age == null || $request->age = "") {
                throw new ValidationException("Umur belum di isi", 422);
            } 

            if (!is_int($request->age)) {
                throw new ValidationException("Umur siswa harus integer", 422);
            }

            if (strtoupper($request->gender) != "L" && strtoupper($request->gender) != "P") {
                throw new ValidationException("Gender harus berupa L atau P", 422);
            }

            $response = $this->studentRepo->update(new Student($request->id, $request->name, $request->age, $request->gender));
            return new StudentResponse($response->id, $response->name, $response->age, $response->gender);
        } catch(ValidationException | \Exception $e) {
            throw $e;
        }

    }

    public function deleteStudent(int $id) : bool {
        try {

            // Validasi id
            $student = $this->studentRepo->findById($id);
        
            if ($student == null) {
                throw new ValidationException("Data student tidak ditemukan", 404);
            }
    
            $response = $this->studentRepo->delete($id);
            return $response;
        } catch(ValidationException | \Exception $e) {
            throw $e;
        }
    }
    
}