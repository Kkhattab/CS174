<?php

//session start to store language
session_start();

// Multi language support
function __($text_id, array $substitute = array()) {
    $message = gettext($text_id); // get message translation via gettext
    foreach ($substitute as $key => $value) {
        $message = str_replace('{{'.strtolower($key).'}}', $value, $message);
    }
    return $message;
}

if(empty($_SESSION['lang'])) {
    $_SESSION['lang'] = "hu_HU";
}

$codeset = 'UTF-8';
$language = $_SESSION['lang'];
putenv('LANG='.$language.'.'.$codeset); 
putenv('LANGUAGE='.$language.'.'.$codeset); 
setlocale(LC_ALL, $language);

// Set the text domain as "messages"
$domain = "messages";
bindtextdomain($domain, "Locale");
bind_textdomain_codeset($domain, $codeset);
// set domain
textdomain($domain);

// ----------------------
include "vendor/autoload.php";
//$_GET contains the keys / values that are passed to your script in the URL.
$controller = isset($_GET["c"]) ? $_GET["c"] : "home";
// default method is index
$method = isset($_GET["m"]) ? $_GET["m"] : "index";

switch ($controller):
    case "home" :
        $controller = new Controllers\Home();
        break;
    case "payment" :
        $controller = new Controllers\Payment();
        break;
    case "postcard":
        $controller = new Controllers\Postcard();
        break;
    default :
        // set proper http message
        header("HTTP/1.0 404 Not Found");
        // echo human readable message and exit the script
        die(_("E404"));
        break; // die will exit the script anyway
endswitch;

// controller
if (method_exists($controller, $method)):
    // if methord exists in the controller call it else kill the app
    call_user_func(array($controller, $method));
else :
    // Output a message and terminate the current script
    header("HTTP/1.0 404 Not Found");
    die(_("E404"));
endif;