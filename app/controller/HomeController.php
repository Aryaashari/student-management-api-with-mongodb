<?php 

namespace Marketplace\Controller;

use Marketplace\App\View;

class HomeController {

    public function index() {
        View::render('home.php');
    }

}