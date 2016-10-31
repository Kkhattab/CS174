<?php

namespace kareemkevin\hw3\Views\Helpers;

class Rating extends Base {

	public function render( $data ){
		//http://php.net/manual/en/function.sprintf.php
		// sprintf - Return a formatted string
		$html = "";

		if( $data["rating"] ) : //my rating exists show my selection and bold 
			for( $i=1;$i<6;$i++):
				//% - a literal percent character. No argument is required.
				//s - the argument is treated as and presented as a string.
				// bold rating for the YOUR RATING value
				$html .= sprintf("<span>%s</span>", $i == $data["rating"] ? "<strong>" . $i . "</strong>" : $i );
			endfor;
		else : 
			for( $i=1;$i<6;$i++): //otherwise show the ratings of the data
				$html .= sprintf("<a href='index.php?c=read&id=%s&m=rate&rating=%s' >%s</a>", $data["id"] , $i , $i );
			endfor;
		endif;

		return $html;
	}
}