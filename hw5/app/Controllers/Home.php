<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Controllers;
/**
 * This is the default controller
 * it will handle requests aiming the site root
 *
 * @author Kareem
 */
class Home {
    
    /**
     * Displays landing page
     */
    public function index() {
        
        $data = array(
            "greeting" => _("TEST_MESSAGE")
        );
        
        $view = new \Views\Home();
        
        echo $view->render($data);
        
    }
    
    /**
     * This method is responsible, for setting the desired language
     * for the user
     */
    public function switch_lang() {
        if (!empty($_GET['lang']) && array_key_exists($_GET['lang'], \Configs\Config::$LANGS)) {
            $_SESSION['lang'] = $_GET['lang'];
        }
        
        $target_url = \Configs\Config::BASE_URL;
        
        // some browsers provide the url where the user is coming from
        $from = $_SERVER["HTTP_REFERER"];
        $base = \Configs\Config::BASE_URL;
        if (substr($from, 0, strlen($base)) == $base) {
            $target_url = $from;
        }
        
        // redirect user:
        header("Location: " . $target_url);
    }
    
}