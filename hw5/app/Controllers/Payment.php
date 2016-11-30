<?php
namespace Controllers;
/**
 * This is controller which will handle payment
 * and send emails
 *
 * @author kareem
 */
class Payment extends Base {
    
    public function submit() {
        // set up stripe
        \Stripe\Stripe::setApiKey(\Configs\Config::STRIPE_PRIVATE_KEY);
        
        $view = new \Views\Payment();
        
        try {
            
            // populate credit card info from user
            $myCard = array(
                'number' => $_POST['card_num'], 
                'exp_month' => $_POST['exp_month'], 
                'exp_year' => $_POST['exp_year']);
            
            if (
                empty($myCard['number']) || !is_numeric($myCard['number'])
                    || empty($myCard['exp_month']) || !is_numeric($myCard['exp_month'])
                    || empty($myCard['exp_year']) || !is_numeric($myCard['exp_year'])) {
                
                throw new \Exception("Please provide valid credit card data");
            }
          
            // make a charge
            $charge = \Stripe\Charge::create(array(
                'card' => $myCard, 
                'amount' => \Configs\Config::WISH_PRICE, 
                'currency' => \Configs\Config::WISH_PRICE_CURRENCY));
            
            echo $view->renderSuccess();
        } catch (\Exception $ex) {
            echo $view->renderError(array("message" => $ex->getMessage()));
        }
    }
}