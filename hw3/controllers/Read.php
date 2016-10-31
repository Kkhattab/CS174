<?php

namespace kareemkevin\hw3\Controllers;
use kareemkevin\hw3\Views as Views;


class Read extends Base {

	function index(){
		
		$view = new Views\Read();

		// pass in the title lol.. 
		$data = array(
			"site_title" => "Five Thousand Characters"
		);
		//were gonna need to pass in the id of the story we clicked into the _GET
		
		$view->render( $data );
	}

	// handle rating the story we passed in
	function rate(){


	}
}