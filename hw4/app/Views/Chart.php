<?php

namespace Views;

class Chart extends Base {
    
    function render_xml($data) {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $xml .= '<chart title="'. htmlentities($data['title']) .'" hash="'.$data['hash'].'">'."\n";
        
        foreach ($data["data"] as $label_and_values) {
            $xml .= '<point label="'.$label_and_values[0].'">'."\n";
            $xml .= '<value>'.$label_and_values[1].'</value>'."\n";
            $xml .= '<value>'.$label_and_values[2].'</value>'."\n";
            $xml .= '</point>'."\n";
        }
        $xml .= '</chart>'."\n";
        header('Content-Type: text/xml');
        echo $xml;
    }
    //view sample data: http://localhost/hw4/?c=chart&a=show&arg2=13665484cd59ac94b6caecd80e26bce5&arg1=LineGraph (replace hash with your own chart hash into url)
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