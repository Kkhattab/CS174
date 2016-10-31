<?php

namespace kareemkevin\hw3\Views\Helpers;

class Options extends Base {

	public function render( $data ){

		if( !isset( $data["selected"] ) || !$data["selected"] ) :
			 $data["selected"] = array();
		elseif( !is_array( $data["selected"] ) ) :
			$data["selected"] = array( $data["selected"] );
		endif;

		$html = "";

		if( isset( $data["all"] ) ) :

			$html .= "<option value='' >" . htmlspecialchars( $data["all"] ) . "</option>";

		endif;

		//%s is string %d is decimal 

		foreach( $data["items"] as $item ) :
			// ucfirst: Returns a string with the first character of str capitalized, if that character is alphabetic.
			$html .= sprintf( 
				"<option value='%d' %s >%s</option>",
				$item["value"], 
				(  in_array( $item["value"], $data["selected"] ) ? "selected='selected'":"" ) ,
				 htmlentities( ucfirst( $item["title"] ) ) //will just return All, if item value and data selected are not in object
			);

		endforeach;

		return $html;
	}
}