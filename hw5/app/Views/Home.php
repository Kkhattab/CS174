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
            <h2>Customize your wish</h2>
            <div class="column">
                <label for="wisher">Your name:</label><br>
                <input type="text" placeholder="John Doe" name="wisher" id="input_wisher"><br>
                
                <label for="fountain">Choose a well:</label><br>
                <select name="fountain" id="input_fountain" onchange="javascript:changeWellImage()">
                    <option value="well1">Drawing</option>
                    <option value="well2">3D</option>
                    <option value="well3">3D Realistic</option>
                </select><br>
                
                <label for="border-style">Select picture frame style:</label><br>
                <select name="border-style" id="input_border-style" onchange="javascript:changeWellBorder()">
                    <option value="none">None</option>
                    <option value="solid">Solid</option>
                    <option value="dashed">Dashed</option>
                </select><br>
                
                <label for="border-color">Select picture frame color:</label><br>
                <select name="border-color" id="input_border-color" onchange="javascript:changeWellBorder()">
                    <option value="black">Black</option>
                    <option value="red">Red</option>
                    <option value="green">Green</option>
                    <option value="purple">Purple</option>
                    <option value="orange">Orange</option>
                </select><br>
                
                <label for="targets">Email addresses:</label><br>
                <span class="note">[comma separated list of email addresses]</span><br>
                <span class="note">[up to '.$data['max-mail'].' addresses]</span><br>
                <textarea type="text" placeholder="name@isp.com" name="targets" 
                    id="input_emails"></textarea>
                <br>
            </div>
            
            <div class="column">
                <div id="well-container">
                    <img src="./public/images/well1.jpg" id="well-image">
                </div>
            </div>
            <div class="clear"></div>
            <hr>
            <h2>Throw that coin</h2>
        </div>';
        $html .= $this->render_footer($data);
        return $html;
    }
}