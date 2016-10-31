<?php
namespace kareemkevin\hw3\Controllers;
use kareemkevin\hw3\Views as Views;
use kareemkevin\hw3\Models as Models;

class Read extends Base {

	function index(){
		
		
		$view = new Views\Read();

		$data = array(
			"site_title" => "Five Thousand Characters"
		);

		// if entry ID was found in the URL
		if( isset( $_GET["id"] ) ) :

			// convert entry id to number
			$entry_id = intval( $_GET["id"] );

			// try loading entry from ID
			$entry = new Models\Entry( $entry_id );

			// entry was found
			if( $entry->is_loaded() ):

				$data["page_title"] = htmlentities( $entry->title );

				$data["id"] = $entry_id;
				$data["entry_title"] = htmlentities( $entry->title );
				$data["entry_author"] = htmlentities( $entry->author );
				$data["entry_created"] = htmlentities( $entry->created );
				//

				$formatted_content = "<p>" . htmlentities( $entry->text ) . "</p>";

				// content needs to be placed in paragraphs.. every two consecutive linebreaks needs to close and start new paragraph.. I did it will str_replace..

				$formatted_content = str_replace( 
					array(
						"\r\n\r\n", // \r\n is windows line ending
						"\n\n", // \n is linux line ending
						"\r\r" // \r is mac line ending
					), 
					array(
						"</p><p>",
						"</p><p>",
						"</p><p>"
					), 
					$formatted_content 
				);

				//convert remaining linebreaks to <br> tags.. nl2br — Inserts HTML line breaks before all newlines in a strin
				$formatted_content = nl2br( $formatted_content );

				$data["entry_content"] = $formatted_content;

				// check if this entry was rated
				
				// increment number of views in db.
				$entry->update_view_count();

			else :
				$data["title"] = "Five Thousand Characters - Error 404";
				$data["error"] = "Entry not found.";
			endif;

		else :

			$data["title"] = "Five Thousand Characters - Error 404";
			$data["error"] = "Entry not found.";

		endif;

		$view->render( $data );
	}

	// handle rating the story we passed in
	function rate(){


	}
}