<?php
namespace Controllers;
use Views as Views;

class Landing extends Base {

	function index(){
		
		$view = new Views\Landing();
		// get the page title and pass it into the current view 
		$data = array(
			"site_title"=>"PasteChart",
			"max_characters"=>"80",
			"max_lines"=>"50",
			"placeholder_text"=>""
		);
		
		$view->render($data);
	}
}