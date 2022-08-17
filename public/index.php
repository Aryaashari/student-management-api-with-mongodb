<?php
require_once __DIR__."/../vendor/autoload.php";

use Student\Management\App\Router;
use Student\Management\Controller\HomeController;
use Student\Management\Controller\BookController;

Router::add("GET", "/", HomeController::class, 'index', []);


// Book Controller
Router::add("GET", "/api/book", BookController::class, 'getBook', []);
Router::add("POST", "/api/book", BookController::class, 'createBook', []);
Router::add("PUT", "/api/book/([0-9]*)", BookController::class, 'updateBook', []);
Router::add("DELETE", "/api/book/([0-9]*)", BookController::class, 'deleteBook', []);


Router::run();