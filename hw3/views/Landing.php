<?php

namespace kareemkevin\hw3\Views;


class Landing extends Base {

	function render( $data ){


		$html = "";

		$html .= $this->render_header( $data );
		
		// title from contoller $data["site_title"]
		$html .= '<h1>' .  $data["site_title"] .'</h1>';
		$html .= '<p><a href="" >Write Something</a></p>';
		$html .= '<p>Check out what people are writting</p>';
		$html .= '<form method="index.php" >';
		$html .= '<input type="text" placeholder="Phrase Filter" value="" name="filter" />';
		$html .= ' ';
		
		$html .= '<select name="genre">';

		$html .= '<option> All Genres </options>';
		$html .= '<option> Adventure </options>';
		$html .= '<option> Epic </options>';
		$html .= '<option> Novel </options>';

		$html .= '</select>';
		$html .= '<input type="submit" value="GO" />';
		$html .= '</form>';
		
		$html .= '<h3>Highest Rated</h3>';
		$html .= '<ul>';

		$html .= '<li> Catching Fire</li>'; 
		$html .= '<li> The Great Gatsby </li>'; 
		$html .= '<li> To Kill a Mockingbird </li>'; 

		$html .= '</ul>';
		$html .= '<h3>Most viewed</h3>';
		$html .= '<ul>';

		$html .= '<li> Harry Potter </li>'; 
		$html .= '<li> The Hobbit </li>'; 
		$html .= '<li> Twilight: New Moon </li>'; 
				
		$html .= '</ul>';
		$html .= '<h3>Newest</h3>';
		$html .= '<ul>';
		
		$html .= '<li> Star Wars</li>'; 
		$html .= '<li> Nelson Mandela </li>'; 
		$html .= '<li> 48 Laws of Power </li>'; 
				
		$html .= '</ul>';

		$html .= $this->render_footer( $data );

		echo $html;
	}
}