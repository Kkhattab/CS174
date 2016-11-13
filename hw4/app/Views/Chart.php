<?php

namespace Views;

class Chart extends Base {
    
    function render($data) {
        
        $html = "";
        
        $html .= $this->render_header($data);
        // title from contoller $data["site_title"]
        $html .= '<h1>' . $data["site_title"] . '</h1>';
        $html .= '<div class="chart" id="graph_node"></div>';
        $html .= '<br><p>Share your chart and data at the URLs below:</p>';
        $html .= '<p class="plotlink"><a href="' . $data['links']['LineGraph'] . '">a Line Graph</a></p>';
        $html .= '<p class="plotlink"><a href="' . $data['links']['PointGraph'] . '">a Point Graph</a></p>';
        $html .= '<p class="plotlink"><a href="' . $data['links']['Histogram'] . '">a Histogram</a></p>';
        $html .= '<p class="plotlink"><a href="' . $data['links']['xml'] . '">XML data</a></p>';
        $html .= '<p class="plotlink"><a href="' . $data['links']['json'] . '">JSON data</a></p>';
        $html .= '<p class="plotlink"><a href="' . $data['links']['jsonp'] . '">JSONP data</a></p>';
        $html .= '<script>
                    var graph = new Chart("graph_node", 
                    ' . $data['json'] . ', 
                    {"title":"' . $data['title'] . '", "type":"'.$data['type'].'"}); graph.draw();</script>';
       
        $html .= $this->render_footer($data);
       
        echo $html;
    }
}