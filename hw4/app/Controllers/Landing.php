<?php
namespace Controllers;
use Views as Views;

class Landing extends Base {

	function index(){
		
		$view = new Views\Landing();
		// get the page title and pass it into the current view 
		$data = array(
			"site_title"=>"PasteChart",
			"placeholder_text"=>"Jan, 600, 5.4\nFeb, , 5.0\nMarch, 551, 4.9\n...\nMax: 50 lines, 80 characters per line."
		);
		
		$view->render($data);
	}
}