<?php

namespace kareemkevin\hw3\Models;

class Entry extends Base {
	//save
	//loaded_by_indentifier 
	//is loaded
	private $id = null;
	public $title;
	public $author;
	public $text;
	public $created;
	public $modified;
	public $rating_sum;
	public $rating_num;
	public $genres;

	public function __construct( $id = "" ){

		if( $id ):
			$this->load_from_id( $id );
		endif;

	}

	public function load_from_id( $id = "" ){

		$id = intval( $id );

		$this->db_connect();

		$sql = sprintf( "SELECT * FROM entries WHERE entry_id = '%s' " , $id );
		$result = mysql_query( $sql );

		if( mysql_num_rows( $result ) > 0 ){

			$row  = mysql_fetch_assoc( $result );

			$this->id = $row["entry_id"];
			$this->title = $row["entry_title"];
			$this->author = $row["entry_author"];
			$this->text = $row["entry_text"];
			$this->created = $row["entry_created"];
			$this->modified = $row["entry_modified"];
			$this->rating_sum = (int)$row["entry_rating_sum"];
			$this->rating_num = (int)$row["entry_rating_num"];
			$this->views = (int)$row["entry_views"];
			$this->identifier = $row["entry_identifier"];

		}

		$this->db_disconnect();
	}

	public function update_view_count(){

		if( !$this->id ) return;

		$this->views++;

		// $this->save();

		$this->db_connect();

		$sql = sprintf( 
				"UPDATE entries SET 
				entry_title = '%s' ,
				entry_author = '%s' ,
				entry_identifier = '%s' ,
				entry_text = '%s' ,
				entry_rating_sum = '%s' ,
				entry_rating_num = '%s' ,
				entry_views = '%s' ,
				entry_created = '%s' ,
				entry_modified = '%s' 
				WHERE entry_id = '%s' " , 
				mysql_real_escape_string( $this->title ) ,
				mysql_real_escape_string( $this->author ) ,
				mysql_real_escape_string( $this->identifier ) ,
				mysql_real_escape_string( $this->text ) ,
				mysql_real_escape_string( $this->rating_sum ) ,
				mysql_real_escape_string( $this->rating_num ) ,
				mysql_real_escape_string( $this->views ) ,
				mysql_real_escape_string( $this->created ) ,
				mysql_real_escape_string( $this->modified ) ,
				$this->id 
			);
			mysql_query( $sql ) or die( $sql );

		$this->db_disconnect();
	}

	public function is_loaded(){

		return !empty( $this->id );
	}

}