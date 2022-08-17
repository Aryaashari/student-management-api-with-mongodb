<?php
require_once __DIR__."/../vendor/autoload.php";

use Student\Management\App\Router;
use Student\Management\Controller\HomeController;
use Student\Management\Controller\StudentController;

Router::add("GET", "/", HomeController::class, 'index', []);


// Book Controller
Router::add("GET", "/api/student", StudentController::class, 'getBook', []);
Router::add("POST", "/api/student", StudentController::class, 'createBook', []);
Router::add("PUT", "/api/student/([0-9]*)", StudentController::class, 'updateBook', []);
Router::add("DELETE", "/api/student/([0-9]*)", StudentController::class, 'deleteBook', []);


Router::run();