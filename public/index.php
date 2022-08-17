<?php
require_once __DIR__."/../vendor/autoload.php";

use Student\Management\App\Router;
use Student\Management\Controller\HomeController;

Router::add("GET", "/", HomeController::class, 'index');

Router::run();