<?php
namespace Views;

/**
 * Parent for all the Views
 * Frame of the HTML lives here
 */

class Base {
   
    public function render() {
        return "";
    }
   
    /**
     * Renders the beginning part of the html code and returns it
     * 
     * @param and array of model data to render the view
     * @return html code string
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
                    <!-- load any scripts here: -->
                    <!-- <script type="text/javascript" src="public/scripts/*"></script> -->
		</head>
		<body>
                    <div class="wrapper">
                        <div id="topmenu-container"><div id="topmenu">
                            '. $this->render_language_selection_box() .'
                        </div>
                        <div class="clear"></div>
                    </div>';
      
        return $html;
    }
    
   /**
   	 * Renders the footer of the html code and returns it
     * 
     * @param and array of model data to render the view
     * @return html code string
    */
    
    public function render_footer($data) {
        $html = '</div></body></html>';
        return $html;
    }

     /**
   	 * Renders the language box where user selects language
     * 
     * @param null
     * @return html code string
    */
    
    public function render_language_selection_box() {
        
        $html = '<div id="languages">';
        $html .= _("SELECT_A_LANGUAGE") . ": ";
        
        $links = array();
        $urlbase = \Configs\Config::BASE_URL . "index.php";
        
        //foreach($array as $key => $value)
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