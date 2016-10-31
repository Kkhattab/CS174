<?php

namespace kareemkevin\hw3\Models;

class Entries extends Base {

	function get_entries( $orderby, $filter = "", $genre = "", $limit = 10 ){

		$this->db_connect();

		$entries = array();

		$sql = "SELECT * FROM entries as e";
		
		// if genre filter is set
		if( $genre ) :

			$sql .= ",entry_genres as g ";

		endif;

		$sql .= " WHERE 1";	

		if( $filter ) :
		
			//mysqli::real_escape_string -- mysqli_real_escape_string — Escapes special characters in a string for use in an SQL statement, taking into account the current charset of the connection

			$sql .= " AND e.entry_title LIKE '%".mysql_real_escape_string( $filter )."%'";

		endif;

		// if genre filter is set
		if( $genre ) :	

			//mysqli::real_escape_string -- mysqli_real_escape_string — Escapes special characters in a string for use in an SQL statement, taking into account the current charset of the connection

			$sql .= " AND g.entry_id = e.entry_id AND g.genre_id = '".mysql_real_escape_string( $genre )."' ";

		endif;

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

	function get_highest_rated( $filter = "", $genre = "", $limit = 10 ){

		return $this->get_entries( "(e.entry_rating_sum/e.entry_rating_num) DESC" , $filter, $genre, $limit );
	}

	function get_most_viewed( $filter = "", $genre = "", $limit = 10 ){

		return $this->get_entries( "e.entry_views DESC" , $filter, $genre, $limit );
	}
}