<?php

namespace kareemkevin\hw3\Views;
use kareemkevin\hw3\Models as Models;
use kareemkevin\hw3\configs\Config;

class Write extends Base {
	/* access this page right now through this link: http://localhost/hw3/index.php?c=write */ 
	
	function render( $data ){

		if( !isset( $data["genre"] ) ) $data["genre"] = "";

		$html = "";

		$html .= $this->render_header( $data );
		
		$html .= '<h1 class="entry-title"><a href="index.php" >' . $data["site_title"] . '</a> - '. '<font> Write Something </font>'. '</h1>';

		$html .= '<form action="" method="post">' .
		'Title<br><input type="text" name="title"><br>' . 
		'Author<br><input type="text" name="author"><br>' . 
		'Identifier<br><input type="text" name="identifier"><br>' .
		'Genre<br><select name="genre">';

		$genres_options = new Helpers\Options( $this );
		$genres = new Models\Genres();

		$genres_render_data = array( 
			"selected" => $data["genre"] , 
			"items" => $genres->get_list() 
			);

		// get all genres from db and output as <option></option>.. see helper Options.php 

		$html .= $genres_options->render( $genres_render_data );

		$html .= '</select><br>' . 
		'Your Writing<br><textarea name="text"></textarea>' .
		'<div class="buttons"><button type="submit" value="Save">Save</button>' .
		'<button type="reset" value="Reset">Reset</button></div>' .
		'</form>';

		if(isset($_POST) && isset($_POST['title']) && isset($_POST['author']) && isset($_POST['identifier']) && isset($_POST['genre']) && isset($_POST['text']) && isset($_POST['genre'])){
			$entry = new Models\Entry();
			$entry->save_entry();
		}

		$html .= $this->render_footer( $data );

		echo $html;
	}
}