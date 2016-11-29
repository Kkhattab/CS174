<?php

namespace Views;
/**
 * This is the view for Home controller
 *
 * @author Kareem, Kevin, Avinash
 */
class Home extends Base {
    
    /**
     * Renders landing page
     * 
     * @param array $data from model
     * @return html code string for view
    */

    public function render($data) {
        
        $html = $this->render_header($data);
        $html .= $data["greeting"];
        $html .= $this->render_footer($data);
        
        return $html;
    }    
}