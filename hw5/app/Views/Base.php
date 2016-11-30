<?php
namespace Views;

/**
 * Parent for all the Views
 * Frame of the HTML lives here
 */

class Base {
   
    protected $scripts = array();
    
    /**
     * Saves the script to load when page loads
     * @param string $url relative or absolute url to the script
     */

    public function addScript($url) {
        $this->scripts []= $url;
    }
    
    /**
     * Creates code for loading javascripts
     */

    protected function load_js() {
        $html = "";
        foreach($this->scripts as $url) {
            
            if (substr($url, 0, 7) != 'http://'
                    && substr($url, 0, 8) != 'https://'
                    && substr($url, 0, 3) != '://') {
                // this is a relative url
                $url = \Configs\Config::BASE_URL . 'public/scripts/' . $url;
            }
            $html .= '<script type="text/javascript" src="' . $url . '"></script>';
        }
        return $html;
    }

    /**
     * Renders the beginning part of the html code and returns it
     * 
     * @param array $data model data passed to the view
     * @return string header html code
     */

    public function render_header($data) {
       
        $html_title = isset($data["page_title"]) ? $data["page_title"] . " - " : "";
        $html_title .= "Throw-a-coin app";
       
        $html = '
        <!DOCTYPE html>
        <html>
        <head>
                    <title>' . $html_title . '</title>
                    <link rel="stylesheet" type="text/css" href="public/styles/styles.css" />
                    '.$this->load_js().'
        </head>
        <body>
                    <div id="topmenu-container">
                        <div id="topmenu">
                            '. $this->render_language_selection_box() .'
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="wrapper">';
        return $html;
    }

    /**
     * Renders the ending part of the html code and returns it
     * @param array $data model data passed to the view
     * @return string header html code
     */

    public function render_footer($data) {
        $html = '</div></body></html>';
        return $html;
    }

    public function render_language_selection_box() {
       
        $html = '<div id="languages">';
        $html .= _("SELECT_A_LANGUAGE") . ": ";
        
        $links = array();
        $urlbase = \Configs\Config::BASE_URL . "index.php";
       
        foreach (\Configs\Config::$LANGS as $code => $name) {
            $links []= $code == $_SESSION['lang']
                    ? "<b>[$name]</b>"
                    : "<a href=\"$urlbase?c=home&m=switch_lang&lang=$code\">$name</a>";
        }
       
        $html .= implode(", ", $links);
        $html .= '</div>';
        return $html;
    }
}