<?php
// Start a session this will be used to store the selected language
session_start();

if(empty($_SESSION['lang'])) {
    $_SESSION['lang'] = "en_US";
}

$language = $_SESSION['lang'];

putenv("LANG=" . $language); 

setlocale(LC_ALL, $language);

// Set the text domain as "messages"
$domain = "messages";
bindtextdomain($domain, "Locale");
bind_textdomain_codeset($domain, 'UTF-8');

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
    default :
        // set proper http message
        header("HTTP/1.0 404 Not Found");
        // echo human readable message and exit the script
        die(_("E404"));
        break; // die will exit the script anyway
endswitch;
// Get to the controller
if (method_exists($controller, $method)):
    // if method exists in the controller call it else kill the app
    call_user_func(array($controller, $method));
else :
    // Output a message and terminate the current script
    header("HTTP/1.0 404 Not Found");
    die(_("E404"));
endif;