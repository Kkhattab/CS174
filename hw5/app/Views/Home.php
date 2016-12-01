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
        
        // render page
        $html = $this->render_header($data);
        $html .= 
        '<form action=".?c=payment&m=submit" method="POST">
            <div style="text-align: center">
                <h1>'._("MAIN_PAGE_TITLE").'</h1> 
                <p class="quote">'._("MAIN_PAGE_SUBTITLE").'</p> most</p>
            </div>
            <h2>'._("CUSTOMIZE_YOUR_WISH").' </h2>
            <div class="column">
                <label for="wisher">'._("LBL_NAME").'</label><br>
                <input type="text" placeholder="John Doe" name="wisher" id="input_wisher"><br>
                
                <label for="fountain">'._("LBL_FOUNTAIN").':</label><br>
                <select name="fountain" id="input_fountain" onchange="javascript:changeWellImage()">
                    <option value="well1">'._("VAL_FOUNTAIN_TYPE_DRAWING").'</option>
                    <option value="well2">'._("VAL_FOUNTAIN_TYPE_3D").'</option>
                    <option value="well3">'._("VAL_FOUNTAIN_TYPE_3D_REAL").'</option>
                </select><br>
                
                <label for="border-style">'._("LBL_FRAME_STYLE").'</label><br>
                <select name="border-style" id="input_border-style" onchange="javascript:changeWellBorder()">
                    <option value="none">None</option>
                    <option value="solid">Solid</option>
                    <option value="dashed">Dashed</option>
                </select><br>
                
                <label for="border-color">Select picture frame color:</label><br>
               <select name="border-color" id="input_border-color" onchange="javascript:changeWellBorder()">
                     <option value="black">'._('COLOR_BLACK').'</option>
                     <option value="red">'._('COLOR_RED').'</option>
                     <option value="green">'._('COLOR_GREEN').'</option>
                     <option value="purple">'._('COLOR_PURPLE').'</option>
                     <option value="orange">'._('COLOR_ORANGE').'</option>
                </select><br>
                 
                 <label for="targets">'._('LBL_EMAIL').':</label><br>
                 <span class="note">'._('DESCR_EMAIL').'</span><br>
                 <span class="note">'.__('DESCR_EMAIL_LIMIT', array('limit' => $data['max-mail'])).'</span><br>
                 <textarea type="text" placeholder="name@email.com" name="targets" id="input_emails"></textarea>
                 <br>
            </div>
            
            <div class="column">
                <div id="well-container">
                    <img src="./public/images/well1.jpg" id="well-image">
                </div>
            </div>
            <div class="clear"></div>
            <hr>
            <h2>'._("FORM_SECTION_PAYMENT").'</h2>
            <div>
                <label for="card_num">'._("LBL_CARD_NUM").'</label><br>
                <input type="text" placeholder="ex. 4012888888881881" name="card_num" id="card_num"><br>
                
                <label for="exp_year">'._("LBL_EXPIRY_YEAR").'</label>
                <input type="text" placeholder="2015" name="exp_year" id="exp_year" class="small">
                <label for="exp_month">'._("LBL_MONTH").'</label>
                <input type="text" placeholder="02" name="exp_month" id="exp_month" class="small">
                <br>
                <input type="submit" name="throw-a-coin" value="'._("BTN_THROW_IT").'">
            </div>
        </form>';
       
        $html .= $this->render_footer($data);
        return $html;
    }
}