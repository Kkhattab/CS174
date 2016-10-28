<?php

namespace kareemkevin\hw3\Models;
use kareemkevin\hw3\configs\Config;

class Base {

	protected $db;

	public function db_connect(){
		
		$this->db = mysql_connect( Config::DBHOST, Config::DBUSER, Config::DBPASS ) or die( mysql_error() );
		mysql_select_db( Config::DBNAME , $this->db ) or die( mysql_error() );
	}

	public function db_disconnect(){

		if( $this->db  ) :

			mysql_close( $this->db );
			$this->db=  null;

		endif;
	}
}