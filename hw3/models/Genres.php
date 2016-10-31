<?php

namespace kareemkevin\hw3\Models;

class Genres extends Base {

	function get_list(){

		 $list = array();

		$this->db_connect();

		$sql = "SELECT * FROM genres ORDER BY genre_title";
		$result = mysql_query( $sql, $this->db );

		while( $row = mysql_fetch_assoc( $result ) ) :

			$list[] = array( 
				"value" => $row["genre_id"],
				"title" => $row["genre_title"]
			);
		endwhile;

		$this->db_disconnect();

		return $list;
	}
}