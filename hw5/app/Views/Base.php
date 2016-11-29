<?php
namespace Views;

/**
 * Parent for all the Views
 * Frame of the HTML lives here
 */

class Base {
	
	public function render() { return ""; }
	
    /**
     * Renders the beginning part of the html code and returns it
     * 
     * @param and array of model data to render the view
     * @return html code string
    */
	public function render_header($data) {
		$html_title = isset( $data["page_title"] ) ?  $data["page_title"] . " - " : "";
        $html_title .= "Throw-a-coin app";
                
		$html = '
		<!DOCTYPE html>
		<html>
		<head>
			<title>' . $html_title . '</title>
			<link rel="stylesheet" type="text/css" href="public/styles/styles.css" />
			<script type="text/javascript" src="public/scripts/chart.js"></script>
			<script type="text/javascript" src="public/scripts/main.js"></script>
		</head>
		<body>
		<div class="wrapper">';
		
		return $html;
	}
	
    /**
   	 * Renders the footer of the html code and returns it
     * 
     * @param and array of model data to render the view
     * @return html code string
    */
		
	public function render_footer($data){
		$html = '</div></body></html>';
		return $html;
	}
}