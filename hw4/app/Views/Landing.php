<?php
namespace Views;

class Landing extends Base {
	function render($data){
		$html = "";
		$html .= $this->render_header($data);
		
		// title from contoller $data["site_title"]
		$html .= '<h1>' .  $data["site_title"] .'</h1>';
		$html .= '<h2>Share your data in charts!</h2>';
		$html .= '<form>';
		$html .= '<label for="chartTitle">Chart Title</label>';
		$html .= '<input type="text" name="chartTitle" id="chartTitle">';
		$html .= '<textarea></textarea>';
		$html .= '<button type="submit">Share</button>';
		$html .= '</form>';

		$html .= $this->render_footer($data);

		echo $html;
	}
}