<?php

namespace kareemkevin\hw3\Views;

class Read extends Base {
	/* access this page right now through this link: http://localhost/hw3/index.php?c=read */ 
	
	function render( $data ){

		$html = "";

		$html .= $this->render_header( $data );
		
		$html .= '<h1 class="entry-title"><a href="index.php" >' . $data["site_title"] . '</a> - '. '<font> Harry Potter </font>'. '</h1>';
		$html .= '<div class="entry-author" >' . '<font> Kareem Khattab </font> ' .'</div>';
		$html .= '<div class="entry-date" >' . '<font> 10-25-16 10:02:35</font> ' . '</div>';
		$html .= '<div class="entry-rating" >Your rating: 2.5';
		
		$html .= '</div>';
		$html .= '<div class="average-rating" >Average Rating: ' . '<font> 4.5 </font>' . '</div>';
		$html .= '<div class="entry-content" >' . 'fasjdfkjasdlkfjlaskjflsdfl' .'</div>';
	
		$html .= $this->render_footer( $data );

		echo $html;
	}
}