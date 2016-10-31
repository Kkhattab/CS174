<?php

namespace kareemkevin\hw3\Controllers;
use kareemkevin\hw3\Views as Views;
use kareemkevin\hw3\Models as Models;
use kareemkevin\hw3\configs\Config;

class Write extends Base {

	function index(){
		
		$view = new Views\Write();

		// get the page title and pass it into the current view 
		$data = array(
			"site_title"=>"Five Thousand Characters"
			);

		$view->render( $data );

		if(isset($_POST) && isset($_POST['title']) && isset($_POST['author']) && isset($_POST['identifier']) && isset($_POST['genre']) && isset($_POST['text']) && isset($_POST['genre'])){

			// validation
			if ($this->validate($_POST['title'], $_POST['author'], $_POST['identifier'], $_POST['text']) == true){
				$entry = new Models\Entry();
				$entry->save_entry();
			}
		}
	}

	private function validate($title, $author, $identifier, $text) {

		$url = 'index.php?c=write';
		$valid = true;
		if(strlen(trim($title)) < Config::TEXT_MIN_LENGTH || strlen(trim($title)) > Config::TEXT_MAX_LENGTH){
			$url .= '&title=bad';
			$valid = false;
		}
		if(strlen(trim($author)) < Config::TEXT_MIN_LENGTH || strlen(trim($author)) > Config::TEXT_MAX_LENGTH){
			$url .= '&author=bad';
			$valid = false;
		}
		if(strlen(trim($identifier)) < Config::TEXT_MIN_LENGTH || strlen(trim($identifier)) > Config::TEXT_MAX_LENGTH){
			$url .= '&identifier=bad';
			$valid = false;
		}
		if(strlen(trim($text)) < Config::TEXT_MIN_LENGTH || strlen(trim($text)) > Config::TEXT_MAX_LENGTH){
			$url .= '&text=bad';
			$valid = false;
		}
		if ($valid == false) {
			header("Status: 301 Moved Permanently");
			header('Location: ' . $url);
			exit;
		} 
		return $valid;
	}
}