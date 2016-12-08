<?php
namespace Views;
/**
 * Parent for all the Views.
 * Frame of the HTML lives here.
 *
 * @author Kareem, Kevin, Avinash.
 */

class Base {
   
  
    /**
     * Renders the beginning part of the html code and returns it.
     * 
     * @param array $data model data passed to the view.
     *
     * @return string header html code.
     */

     public function render_header($data) {
        $html_title = isset($data["page_title"]) ? $data["page_title"] . " - " : "";
        $html_title .= "Throw-a-coin app";
        $homejs = \Configs\Config::BASE_URL . 'public/scripts/home.js';
        $html = '
        <!DOCTYPE html>
        <html>
        <head>
                    <title>' . $html_title . '</title>
                    <link rel="stylesheet" type="text/css" href="public/styles/styles.css" />
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
                    <script src="'.$homejs.'"></script>
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
     * Renders the ending part of the html code and returns it.
     *
     * @param array $data model data passed to the view.
     *
     * @return string footer html code
     */

    public function render_footer($data) {
        $html = '</div></body></html>';
        return $html;
    }

    /**
     * Renders the language selection box.
     *
     * @param array $data model data passed to the view.
     *
     * @return string language selection html code.
     */
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