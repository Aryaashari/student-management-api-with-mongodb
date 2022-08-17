<?php
require_once __DIR__."/../vendor/autoload.php";

use Marketplace\App\Router;
use Marketplace\Controller\HomeController;

Router::add("GET", "/", HomeController::class, 'index');

Router::run();