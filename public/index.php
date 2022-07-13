<?php
require_once __DIR__."/../vendor/autoload.php";

use App\Router;
use Controller\HomeController;

Router::add("GET", "/", HomeController::class, 'index');

Router::run();