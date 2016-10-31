<?php

namespace kareemkevin\hw3\Models;

class Entries extends Base {

	function get_entries( $orderby, $filter = "", $genre = "", $limit = 10 ){

		$this->db_connect();

		$entries = array();

		$sql = "SELECT * FROM entries as e";
		
		$sql .= " WHERE 1";	

		$sql .= " ORDER BY " . $orderby . " LIMIT " . $limit;

		$result = mysql_query( $sql );

		while( $row = mysql_fetch_assoc( $result ) ) :

			$entries[] = array(
				"id" => $row["entry_id"],
				"title" => $row["entry_title"]
			);

		endwhile;

		$this->db_disconnect();

		return $entries;
	}


	// FOLLOW THIS FORMAT FOR MOST VIEWED AND HIGHEST RATED
	function get_newest( $filter = "", $genre = "", $limit = 10 ){

		return $this->get_entries( "e.entry_created DESC" , $filter, $genre, $limit );
	}


}