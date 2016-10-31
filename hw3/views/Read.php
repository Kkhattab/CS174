<?php

namespace kareemkevin\hw3\Views;

class Read extends Base {
	/* access this page right now through this link: http://localhost/hw3/index.php?c=read */ 
	
	function render( $data ){
	
	$html = "";

		$html .= $this->render_header( $data );
		
		$html .= '<h1 class="entry-title"><a href="index.php" >' . $data["site_title"] . '</a> - '. $data["entry_title"] . '</h1>';
		$html .= '<div class="entry-author" >' . $data["entry_author"] .'</div>';
		$html .= '<div class="entry-date" >' .  $data["entry_created"] . '</div>';
		$html .= '<div class="entry-rating" >Your rating: ';

		// get helper that will output rating links
		$rating = new Helpers\Rating( $this );
		
		$rating_render_data = array(
			"id" => $data["id"],
			"rating" => isset( $data["your_rating"] ) ? $data["your_rating"] : ""
		);

		$html .= $rating->render( $rating_render_data );
		
		$html .= '</div>';
		$html .= '<div class="average-rating" >Average Rating: ' . $data["entry_average_rating"] . '</div>';
		$html .= '<div class="entry-content" >' . $data["entry_content"] .'</div>';
	
		$html .= $this->render_footer( $data );

		echo $html;
	}
}