<?php
namespace Models;

class CreateDB extends Base {
   
    public function report() {
        // self references static variables, not for a specific instance 
        // self references the actual class in this case 
        $errno = mysql_errno(self::$db);
        $error = mysql_error(self::$db);
        echo "$errno: $error\n";
    }
    
    public function initDb() {
        // List all models:
        // [as array(table name, object)]
        $models = array(
            array("chart_data", new ChartDataRow())
        );
        
        // Every table has an associated class
        // so move the creation and dummy data code there
        foreach ($models as $m) {
            
            list($table, $creator) = $m;
            
            if ($this->tableExists($table)) {
                echo "$table table exists\n";
            } else {
                //create table from ChartDataRow.php
                if (!$creator->createTable()) {
                    echo "Failed to create $table table\n";
                    $this->report();
                } else {
                     //insert sample data from ChartDataRow.php
                    if (!$creator->insertSampleData()) {
                        echo "Failed to load sample data\n";
                        $this->report();
                    }
                }
    
            }
        }
        
        // etc.
    }
    
    public function tableExists($table_name) {
        // check if a table exists
        //If a class doesn't override functions and variables are inhereted
        $table_name = self::escape($table_name);
        $sql = "SHOW TABLES LIKE '$table_name'";
        $result = mysql_query($sql);
        //return true/false if rows greater than or less than 0
        return mysql_num_rows($result) > 0;
    }
}