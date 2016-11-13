<?php
namespace Views;

class Chart extends Base {
	
	function render($data){
		
		$html = "";
		$html .= $this->render_header($data);
		
		// title from contoller $data["site_title"]
		$html .= '<h1>' .  $data["site_title"] .'</h1>';
		$html .= '<div class="chart" id="graph_node"></div>';
		$html .= '<script>
                    var graph = new Chart("graph_node", 
                    '.$data['json'].', 
                    {"title":"'.$data['title'].'"}); graph.draw();</script>';

		$html .= $this->render_footer($data);
		echo $html;
	}
}