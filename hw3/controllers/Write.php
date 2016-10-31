<?php

namespace kareemkevin\hw3\Controllers;
use kareemkevin\hw3\Views as Views;

class Write extends Base {

	function index(){
		
		$view = new Views\Write();

		// get the page title and pass it into the current view 
		$data = array(
			"site_title"=>"Five Thousand Characters"
		);

		$view->render( $data );
	}
}