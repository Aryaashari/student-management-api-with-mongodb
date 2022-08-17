<?php 

namespace Marketplace\Controller;

use MarketPlace\App\View;

class HomeController {

    public function index() {
        View::render('home.php');
    }

}