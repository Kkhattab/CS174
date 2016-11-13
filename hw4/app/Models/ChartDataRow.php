<?php
namespace Models;

class ChartDataRow extends Base {
    
     public function load_data($hash) {
    
        $hash = self::escape($hash);
        $query = "SELECT * FROM chart_data WHERE chart_hash = '$hash';";
        $result = self::query($query);
        
        if (mysql_num_rows($result) == 0) {
            return false;
        }
        
        $title = null;
        $data = "";
        while ($row = mysql_fetch_assoc($result)) {
            if ($title === null) {
                $title = $row['title'];
            }
            $data = $row['data'];
        }
        
        return array("title" => $title, "data" => $data);
    }

    public function save($md5, $title, $data) {
        $title = self::escape($title);
        $query = "INSERT INTO `chart_data` VALUES (\"$md5\", \"$title\", \"$data\") ;";
        return self::query($query);
    }

     
    public function createTable() {
        // Create a table
        //hash is the primary key 
       $query = "CREATE TABLE `chart_data` ( "
                . "`chart_hash` VARCHAR(32) NOT NULL , "
                . "`title` VARCHAR(80) NOT NULL , "
                . "`data` TEXT , "
                . "PRIMARY KEY (`chart_hash`(32),`title`(80))) ENGINE = InnoDB;";
        return self::query($query);
    }
    
    public function insertSampleData() {
        $title = "Test Data 1";
        $md5 = hash("md5", $title);
        $data = "Jan,1,1\nFeb,2,2\n";
        $query = "INSERT INTO `chart_data` VALUES (\"$md5\", \"$title\", \"$data\");";
        return self::query($query);
    }
}