<?php
require_once __DIR__."/../vendor/autoload.php";

use Student\Management\App\Router;
use Student\Management\Controller\HomeController;
use Student\Management\Controller\StudentController;

Router::add("GET", "/", HomeController::class, 'index', []);


// Book Controller
Router::add("GET", "/api/student", BookController::class, 'getBook', []);
Router::add("POST", "/api/student", BookController::class, 'createBook', []);
Router::add("PUT", "/api/student/([0-9]*)", BookController::class, 'updateBook', []);
Router::add("DELETE", "/api/student/([0-9]*)", BookController::class, 'deleteBook', []);


Router::run();