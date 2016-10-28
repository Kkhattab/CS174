<?php

namespace kareemkevin\hw3;

include "configs/autoloader.php";
//$_GET contains the keys / values that are passed to your script in the URL.
// We will use c in the url for controller index.php?c=read or index.php?c=write
$controller = isset($_GET["c"]) ? $_GET["c"] : "landing";
$method = isset($_GET["m"]) ? $_GET["m"] : "index";

switch( $controller ):
	
	case "landing" :

		$controller = new Controllers\Landing();

	break;

	default :
	    //Output a message and terminate the current script
		die("Page not found.");

	break;

endswitch;

if( method_exists( $controller, $method ) ):
	//if methord exists in the controller call it else kill the app
	call_user_func( array( $controller , $method ) );

else : 
	//Output a message and terminate the current script
	die("Method not found.");

endif;