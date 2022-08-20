<?php
require_once __DIR__."/../vendor/autoload.php";

use Student\Management\App\Router;
use Student\Management\Config\Database;
use Student\Management\Controller\GradeController;
use Student\Management\Controller\HomeController;
use Student\Management\Controller\StudentController;

Router::add("GET", "/", HomeController::class, 'index', []);

Database::getConnection("production");

// Student Controller
Router::add("GET", "/api/student", StudentController::class, 'getStudent', []);
Router::add("POST", "/api/student", StudentController::class, 'createStudent', []);
Router::add("PUT", "/api/student/([0-9]*)", StudentController::class, 'updateStudent', []);
Router::add("DELETE", "/api/student/([0-9]*)", StudentController::class, 'deleteStudent', []);


// Grade
Router::add("GET", "/api/grade", GradeController::class, "findAllGrade", []);
Router::add("GET", "/api/grade/([0-9]*)", GradeController::class, "findDetailGrade", []);
Router::add("POST", "/api/grade", GradeController::class, "createGrade", []);
Router::add("PUT", "/api/grade/([0-9]*)", GradeController::class, "updateGrade", []);
Router::add("DELETE", "/api/grade/([0-9]*)", GradeController::class, "deleteGrade", []);

Router::run();