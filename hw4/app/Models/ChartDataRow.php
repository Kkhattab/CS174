<?php
namespace Models;

class ChartDataRow extends Base {
    
    public function createTable() {
        // Create a table
        // Hash is the primary key
        $query = "CREATE TABLE `chart_data` ( "
                . "`chart_hash` VARCHAR(32) NOT NULL , "
                . "`label` VARCHAR(80) NOT NULL , "
                . "`value1` DOUBLE , "
                . "`value2` DOUBLE , "
                . "PRIMARY KEY (`chart_hash`(32),`label`(80))) ENGINE = InnoDB;";
        return self::query($query);
    }
    
    public function insertSampleData() {
        // I want a sine and cosine for data points
        $rows = array();
        $md5 = hash("md5", "sincos");
        for ($x = 0; $x < 12; $x+=1.2) {
            $sin = sin($x);
            $cos = cos($x);
            $rows []= "('$md5','$x',$sin,$cos)";
        }
        $query = "INSERT INTO `chart_data` VALUES ".implode(",", $rows).";";
        return self::query($query);
    }
}