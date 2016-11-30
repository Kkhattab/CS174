<?php
namespace Configs;

/**
 * Holds configuration variables
 */

class Config {
        
        // Database configuration
        const BASE_URL="http://localhost/hw5/";
        const DBUSER = "root";
        const DBHOST = "127.0.0.1"; 
        const DBPASS = "";
        const DBNAME = "localdb";
        
        // General app configuration
        const WISH_PRICE = 50; // 50 cents (0.5 usd)
                               // minimum amount possible
                               // see: https://support.stripe.com/questions/what-is-the-minimum-amount-i-can-charge-with-stripe
        const WISH_PRICE_CURRENCY = "USD";
        const WISH_PRICE_CURRENCY_SIGN = "$";
        const MAX_FRIENDS_TO_MAIL = 10;
        
        // Stripe api credentials
        const STRIPE_PUBLIC_KEY = "pk_test_iGdK2tJhQasi3K83IQ3fUz63";
        const STRIPE_PRIVATE_KEY = "sk_test_7YRCAd1vHNzpQ7XCGv6cTeUT";

         // Available languages
        public static $LANGS = array(
            "en_US" => "en",
            "es" => "es"
        );

}
  