<?php

namespace Controllers;

/**
 * This is the default controller
 * it will handle requests aiming the site root
 *
 * @author Kareem, Kevin, Avinash
 */

class Home {
    
    /**
     * Displays landing page
     */

    public function index() {
        $model = new \Models\Base();
        //
        var_dump(\MysqliDb::getInstance());
    }
    
}