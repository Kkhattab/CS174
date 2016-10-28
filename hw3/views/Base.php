<?php

namespace kareemkevin\hw3\Views;

class Base {

	public function render(){}

	public function render_header( $data ){

		$html_title = $data["site_title"] . ( isset( $data["page_title"] ) ?  " - " . $data["page_title"] : "" );

		$html = '
			<!DOCTYPE html>
			<html>
				<head>
					<title>' . $html_title . '</title>
					<link rel="stylesheet" type="text/css" href="styles/main.css" />
				</head>
				<body>
					<div class="wrap" >';

		return $html;
	
	}

	public function render_footer( $data ){
		
		$html = '</div></body></html>';
		
		return $html;
	}
}