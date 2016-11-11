<?php
namespace Controllers;
use Views as Views;

class Landing extends Base {
	function index(){
		
		$view = new Views\Landing();
		// get the page title and pass it into the current view 
		$data = array(
			"site_title" => "PasteChart",
			"placeholder_text"=> "Comma separated list of values, one per line, up to 50 lines of at most 80 characters, these will represent the points to plot our data.\n\nExample:\nJan, 600, 5.4\nFeb, , 5.0\nMarch, 551, 4.9\n..."
		);
		
		$view->render($data);
	}
}