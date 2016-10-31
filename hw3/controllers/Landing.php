<?php

namespace kareemkevin\hw3\Controllers;
use kareemkevin\hw3\Views as Views;
/* http://php.net/manual/en/reserved.variables.session.php */ 

class Landing extends Base {
	 /*$_Session  global variable*/

	function index(){
		
		$view = new Views\Landing();

		// get the page title and pass it into the current view 
		$data = array(
			"site_title"=>"Five Thousand Characters"
		);

		// is genre filter set
		if( isset( $_GET["genre"] ) ) :

			if( $_GET["genre"] ){
				// save it into session if it isn't blank
				$_SESSION["genre"] = (int)$_GET["genre"];
			}
			else {
				// delete from session if it is blank
				unset( $_SESSION["genre"] );
			}

		endif;

		// is phrase filter set
		if( isset( $_GET["filter"] ) ) :

			if( $_GET["filter"] ){
				// save it into session if it isn't blank
				$_SESSION["filter"] = stripslashes( $_GET["filter"] );
			}
			else {
				// delete from session if it is blank
				unset( $_SESSION["filter"] );
			}

		endif;

		// if genre is present in session, add it to the template vars
		if( isset($_SESSION["genre"] ) ) :

			$data["genre"] = $_SESSION["genre"];

		endif;

		// if filter is present in session, add it to the template vars
		if( isset($_SESSION["filter"] ) ) :

			$data["filter"] = $_SESSION["filter"];

		endif;


		$view->render( $data );
	}
}