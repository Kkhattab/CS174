<?php

namespace kareemkevin\hw3\Views;

class Write extends Base {
	/* access this page right now through this link: http://localhost/hw3/index.php?c=write */ 
	
	function render( $data ){

		$html = "";

		$html .= $this->render_header( $data );
		
		$html .= '<h1 class="entry-title"><a href="index.php" >' . $data["site_title"] . '</a> - '. '<font> Write Something </font>'. '</h1>';

		$html .= '<form action="" method="post">' .
		'Title<br><input type="text" name="title"><br>' . 
		'Author<br><input type="text" name="author"><br>' . 
		'Identifier<br><input type="text" name="identifier"><br>' . // identifier auto-fill needed
		'Genre<br><select name="select">' . // populate select
		'</select><br> ' . 
		'Your Writing<br><textarea name="writing"></textarea>' .
		'<div class="buttons"><button type="submit" value="Save">Save</button>' .
		'<button type="reset" value="Reset">Reset</button></div>' .
		'</form>';	
	
		$html .= $this->render_footer( $data );

		echo $html;
	}
}