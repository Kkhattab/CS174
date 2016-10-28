<?php

namespace kareemkevin\hw3\configs;

/* 1. Create db in phpmy admin */ 
/* 2. Use default config which is root with no password, localhost, and name of db, base url for me is http://localhost/hw3 */ 
/* 3. Create script that will use this config */ 
/* 4. Visit the script via url or run php name_of_script.php */

class Config {
	const DBUSER = "root";
	const DBPASS = "";
	const DBNAME = "kareem";
	const DBHOST = "localhost";
	const BASEURL = "http://localhost/hw3";
	const TEXT_MIN_LENGTH = 10;
	const TEXT_MAX_LENGTH = 5000;
}