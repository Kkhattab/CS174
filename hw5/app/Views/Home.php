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
     * @return html code for the view
     */
    
    public function render($data) {
       
        // load javascript from /public/script/home.js
        $this->addScript('https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js');
        $this->addScript('home.js');
        
        // render page
        $html = $this->render_header($data);
        
        $html .= 
        '<div class="wrapper">
            <div style="text-align: center">
                <h1>Throw a Coin in the Fountain</h1>
                <p class="quote">...and send your kind wishes to the ones you love most</p>
            </div>
            <div class="column">
                <label for="wisher">Your name:</label><br>
                <input type="text" placeholder="John Doe" name="wisher" id="input_wisher"><br>
                
                <label for="fountain">Choose a well:</label><br>
                <select name="fountain" id="input_fountain" onchange="javascript:changeWellImage()">
                    <option value="well1">Drawing</option>
                    <option value="well2">3D</option>
                    <option value="well3">3D Realistic</option>
                </select>
            </div>
            <div class="column">
                <img src="./public/images/well1.jpg" id="well-image">
            </div>
            <div class="clear"></div>
        </div>';
        
        $html .= $this->render_footer($data);
        
        return $html;
    }
    
}