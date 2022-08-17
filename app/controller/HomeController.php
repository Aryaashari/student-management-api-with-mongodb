<?php 

namespace Student\Management\Controller;

use Student\Management\App\View;

class HomeController {

    public function index() {
        View::render('home.php');
    }

}