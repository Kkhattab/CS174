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

		$view->render( $data );
	}
}