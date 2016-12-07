<?php

namespace Controllers;
/**
 * This is the default controller
 * it will handle requests aiming the site root
 *
 * @author Kareem
 */
class Home {
    
    /**
     * Displays landing page.
     *
     * @return void.
     */
    public function index() {
        
        $data = array(
            "max-mail" => \Configs\Config::MAX_FRIENDS_TO_MAIL
        );
        
        
        $view = new \Views\Home();
        
        echo $view->render($data);
        
    }
    
    /**
     * This method is responsible, for setting the desired language for the user.
     *
     * @return void
     */
    
    public function switch_lang() {
        if (!empty($_GET['lang']) && array_key_exists($_GET['lang'], \Configs\Config::$LANGS)) {
            $_SESSION['lang'] = $_GET['lang'];
        }
        
        $target_url = \Configs\Config::BASE_URL;
        
        // redirect user:
        header("Location: " . $target_url);
    }
    
}