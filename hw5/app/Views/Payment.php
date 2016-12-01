<?php
namespace Views;
/**
 * This class will render responses for payments.
 * Either it will be successful or throw exception.
 *
 * @author kareem, kevin, avinash
 */
class Payment extends Base {
   
    public function renderError($data) {
        $html = $this->render_header(array());
        $html .= '<div class="error">'._("CARD_REJECTED").'</div>';
        $html .= '<br>Message: ' . $data['message'];
        $html .= '<br><a href="./index.php">'._("TRY_AGAIN").'</a>';
        $html .= $this->render_footer(array());
        return $html;
    }
    
    public function renderSuccess($data) {
        $url = '?c=postcard&m=show&id='.$data["postcard"]->id.'&secret_key='.$data["postcard"]->secret;
        $html = $this->render_header(array());
        $html .= _("PAYMENT_SUCCESS");
        $html .= ' <a href="'.htmlentities($url).'">'._("FROM_HERE").'</a>';
        $html .= '<br><a href="./index.php">'._("DO_AGAIN").'</a>';
        $html .= $this->render_footer(array());
        return $html;
    }
    
    public function renderEmail($data) {
        $url = \Configs\Config::BASE_URL . 'index.php?c=postcard&m=show&id='
                .$data["postcard"]->id.'&secret_key='.$data["postcard"]->secret;
        $text = __("MAIL_BODY", array(
            'url' => $url,
            'name' => $data['postcard']->wisher,
            'endl' => "\n"
        ));
        return $text;
    }
}