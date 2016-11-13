<?php
namespace Models;

class ChartDataRow extends Base {
    
     public function load_data($hash) {
    
        $hash = self::escape($hash);
        $query = "SELECT * FROM chart_data WHERE chart_hash = '$hash' ORDER BY `order`";
        $result = self::query($query);
        
        if (mysql_num_rows($result) == 0) {
            return false;
        }
        
        $title = null;
        $data = array();
        while ($row = mysql_fetch_assoc($result)) {
            if ($title === null) {
                $title = $row['title'];
            }
            $data[] = array($row['label'], $row['value1'], $row['value2']);
        }
        
        return array("title" => $title, "data" => $data);
    }

    public function save($title, $data) {
        $md5 = hash("md5", $title);
        $title = self::escape($title);
        $sql_rows = array();
        $i = 0;
        
        foreach ($data as $row) {
            list($label, $first, $second) = $row;
            $label = self::escape($label);
            //allow null values to be saved!
            $first = empty(trim($first)) ? 'NULL' : floatval($first);
            $second = empty(trim($second)) ? 'NULL' : floatval($second);
            $sql_rows []= "('$md5',$i,'$title','$label',$first,$second)";
            $i++;
        }

        $query = "INSERT INTO `chart_data` VALUES ".implode(",", $sql_rows).";";
        return self::query($query);
    }

     
    public function createTable() {
        // Create a table
        //hash is the primary key 
       $query = "CREATE TABLE `chart_data` ( "
                . "`chart_hash` VARCHAR(32) NOT NULL , "
                . "`order` INT NOT NULL, "
                . "`title` VARCHAR(80) NOT NULL , "
                . "`label` VARCHAR(80) NOT NULL , "
                . "`value1` DOUBLE , "
                . "`value2` DOUBLE , "
                . "PRIMARY KEY (`chart_hash`(32),`label`(80))) ENGINE = InnoDB;";
        return self::query($query);
    }
    
    public function insertSampleData() {
         $rows = array();
        // I want a sine and cosine for data points
        $rows = array();
        //md5 is the type of hasing, and the second string is the string that is getting hashed
        $md5 = hash("md5", "Sine & Cosine");
        for ($x = 0; $x < 20; $x++) {
            //better looking sine graph
            $v = $x * 7 / 20;
            $sin = sin($v) / 2.0 + 0.5;
            $cos = cos($v) / 2.0 + 0.5;
            $rows []= "('$md5','$x','Sine & Cosine','$v',$sin,$cos)";
        }
        // implode joins strings 
        //implode(",", array("1","2","3")) will return "1,2,3"
        $query = "INSERT INTO `chart_data` VALUES ".implode(",", $rows).";";
        return self::query($query);
    }
}