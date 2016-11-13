<?php
namespace Views;

class Chart extends Base {
	
	function render($data){
		
		$html = "";
		$html .= $this->render_header($data);
		
		// title from contoller $data["site_title"]
		$html .= '<h1>' .  $data["site_title"] . '</h1>';
		$html .= '<div>' . $data["chart_title"] . '</div>';
		$html .= '<div>' . $data["chart_data"] . '</div>';
	
		$html .= $this->render_footer($data);
		echo $html;
	}
}