 <!-- please refer to http://www.cs.sjsu.edu/faculty/pollett/174.23.16f/Lec17102016.html#(16) regarding autoloader...--> 

<?php

define("ABSPATH",dirname( dirname(__FILE__) ) );

session_start();

spl_autoload_register(function ($class) {

	$class_parts = explode("\\",$class);

	if( strpos( $class , "kareemkevin\hw3" ) === false ) :

		include $class;

	else :

		$total = count( $class_parts );

		$class_path = ABSPATH . "/";

		for( $i = 2; $i < $total ; $i ++ ) :
			if( $i === $total - 1 ) : 
				$class_path .=  $class_parts[$i] . ".php";
			else :
				$class_path .= strtolower( $class_parts[$i] ). "/";
			endif;
		endfor;
		
    	include $class_path;

    endif;
});