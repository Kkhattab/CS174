<?php
namespace Models;
use Configs\Config;

/**
 * Parent for all the model classes
 * Grants access to the database
 */

class Base {
  
    /**
     * This will be a reference to the only instance to MysqliDb class
     * This variable is static, so it will be unique to Base class
     * But the same for all of its instances
     * @var \MysqliDb database connection wrapper 
    */
  
    protected static $db = null;
    
    /**
     * Constructor
     * - Ensures we have a working connection to the database
     */
  
    spublic function __construct() {
       
        self::connect();
    
    }
    
    /**
     * If there is no connection yet, connect to DB
    */
    
    public static function connect() {
        // if there is no connection yet
        if (is_null(self::$db)) {
            self::$db = new \MysqliDb(
                    Config::DBHOST, 
                    Config::DBUSER, Config::DBPASS, 
                    Config::DBNAME);
        }
    }
}