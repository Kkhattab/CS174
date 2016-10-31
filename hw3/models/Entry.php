<?php
namespace kareemkevin\hw3\Models;

class Entry extends Base {

	function save_entry ( $entry_title, $entry_author, $entry_identifier, $entry_text ){

			$entry_created = date("Y-m-d H:i:s");

			$this->db_connect();

			$sql = 'INSERT INTO entries (entry_title, entry_author, entry_identifier, entry_text, entry_created) ' . 
			'VALUES ("' . $entry_title . '","' . $entry_author . '","' . $entry_identifier . '","' . $entry_text . '",' . $entry_created . ')';

			mysqli_execute($sql);

			$this->db_disconnect();
		}
}