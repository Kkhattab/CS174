<?php
namespace Views;

class Landing extends Base {
	function render($data){
		$html = "";
		$html .= $this->render_header($data);
		
		// title from contoller $data["site_title"]
		$html .= '<h1>' .  $data["site_title"] .'</h1>';
		$html .= '<h2>Share your data in charts!</h2>';
		$html .= '<form id="chartForm" onsubmit="event.preventDefault(); return validateDataEntry();">';
		$html .= '<label for="chartTitle">Chart Title: </label>';
		$html .= '<input type="text" name="chart_title" id="chartTitle" required></br></br>';
		$html .= '<textarea id="dataEntry" placeholder="'. $data["placeholder_text"] .'" cols="80" rows="20" required></textarea></br>';
		$html .= '<input type="submit" name="share" value="Share">';
		$html .= '</form>';
		$html .= $this->render_footer($data);
		echo $html;
	}
}