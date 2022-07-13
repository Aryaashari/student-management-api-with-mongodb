<?php 

namespace Controller;

use App\View;

class HomeController {

    public function index() {
        View::render('home.php');
    }

}