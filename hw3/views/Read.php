<?php

namespace kareemkevin\hw3\Views;

class Read extends Base {
	/* access this page right now through this link: http://localhost/hw3/index.php?c=read */ 
	
	function render( $data ){

		$html = "";

		$html .= $this->render_header( $data );
		
		//index.php with no c or m will take us back to landing
		$html .= '<h1 class="entry-title"><a href="index.php" >' . $data["site_title"] . '</a> - '. $data["entry_title"] . '</h1>';
		$html .= '<div class="entry-author" >' . $data["entry_author"] .'</div>';
		$html .= '<div class="entry-date" >' .  $data["entry_created"] . '</div>';
		$html .= '<div class="entry-rating" >Your rating: ';

		
		$html .= '</div>';
	
		$html .= '<div class="entry-content" >' . $data["entry_content"] .'</div>';
	
		$html .= $this->render_footer( $data );

		echo $html;
	}
}