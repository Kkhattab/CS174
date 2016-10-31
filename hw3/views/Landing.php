<?php

namespace kareemkevin\hw3\Views;
use kareemkevin\hw3\Models as Models;

class Landing extends Base {

	function render( $data ){


		// are phrase filter or gender filter set if empty
		if( !isset( $data["filter"] ) ) $data["filter"] = "";
		
		if( !isset( $data["genre"] ) ) $data["genre"] = ""; 

		$html = "";

		$html .= $this->render_header( $data );
		
		// title from contoller $data["site_title"]
		$html .= '<h1>' .  $data["site_title"] .'</h1>';

		$html .= '<p><a href="index.php?c=write" >Write Something</a></p>';
		
		$html .= '<p>Check out what people are writting</p>';
		
		$html .= '<form method="index.php" >';
		
		$html .= '<input type="text" placeholder="Phrase Filter" value="'.htmlentities( $data["filter"] ).'" name="filter" />';

		$html .= ' ';
		
		$html .= '<select name="genre">';

		$genres_options = new Helpers\Options( $this );
		$genres = new Models\Genres();

		$genres_render_data = array( 
			"all" => "All Genres", 
			"selected" => $data["genre"] , 
			"items" => $genres->get_list() 
		);

		// get all genres from db and output as <option></option>.. see helper Options.php 

		$html .= $genres_options->render( $genres_render_data );

		$html .= '</select>';
		$html .= '<input type="submit" value="GO" />';
		$html .= '</form>';
		
		$entries = new Models\Entries();
		$list = new Helpers\EntryList( $this );

		$html .= '<h3>Highest Rated</h3>';
		$html .= '<ul>';

		$html .= '<li> Harry Potter </li>'; 
		$html .= '<li> The Hobbit </li>'; 
		$html .= '<li> Twilight: New Moon </li>'; 

		$html .= '</ul>';
		$html .= '<h3>Most viewed</h3>';
		$html .= '<ul>';

		$html .= '<li> Harry Potter </li>'; 
		$html .= '<li> The Hobbit </li>'; 
		$html .= '<li> Twilight: New Moon </li>'; 
				
		$html .= '</ul>';
		
		$html .= '<h3>Newest</h3>';
		
		$html .= '<ul>';
		
		// get entries, only difference is the sorting in the db, for these 3 categories 
		$list_render_data = array(
			"items" => $entries->get_newest( $data["filter"], $data["genre"] )
		);

		$html .= $list->render( $list_render_data );
				
		$html .= '</ul>';

		$html .= $this->render_footer( $data );

		echo $html;
	}
}