<?php

namespace kareemkevin\hw3\Views\Helpers;

class EntryList extends Base {

	public function render( $data ){

		$html = "";
		//for each list we create we want to show in a list item
		foreach( $data["items"] as $item ) :

			$html .=  sprintf("<li><a href='index.php?c=read&id=%d' >%s</a></li>", $item["id"], htmlentities( $item["title"] ) );

		endforeach;

		return $html;
	}
}