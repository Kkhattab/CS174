<?php
namespace Models;
use Configs\Config;

class CreateDB extends Base {
   
    public function report() {
        // self references static variables, not for a specific instance 
        // self references the actual class in this case 
        $errno = mysqli_errno(self::$db);
        $error = mysqli_error(self::$db);
        echo "$errno: $error\n";
    }
    
    public function initDb() {

        $connection = mysqli_connect(Config::DBHOST, Config::DBUSER, Config::DBPASS);
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // CREATE DATABASE
        $sql = "CREATE DATABASE " . Config::DBNAME;
        if(mysqli_query($connection, $sql)){
            echo "Database created successfully.";
        } else {
            echo "Error initializing database: " . mysqli_error($connection);
        }     

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
    }
    
    public function tableExists($table_name) {
        // check if a table exists
        //If a class doesn't override functions and variables are inhereted
        $table_name = self::escape($table_name);
        $sql = "SHOW TABLES LIKE '$table_name'";
        $result = mysqli_query(self::$db,$sql);
        //return true/false if rows greater than or less than 0
        return mysqli_num_rows($result) > 0;
    }
}