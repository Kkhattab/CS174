<?php
namespace Models;
use Configs\Config;
class Base {
    

    // I used static keyword because 
    // it means that the variable or function, will not be
    // attached to an instance of a class but to the whole class
    static protected $db;
    
    // is the shutdown function registered?
    static protected $shutdown_handler_registered = false;
    
    // This new function is what I want to use to execute queries
    // This way it is now Base class's sole responsibility to ensure
    // we are connected to database
    public static function query($query) {
        echo "<!-- db_query -->";
        
        // connect to database if not yet connected
        self::db_connect();
        
        // execute
        return mysql_query($query, self::$db);
    }
    // connect to database
    public static function db_connect() {
        echo "<!-- db_connect -->";
        // if there is no connection yet connect to db
        if (!self::$db):
            self::$db = mysql_connect(Config::DBHOST, Config::DBUSER, Config::DBPASS) 
                    or die(mysql_error());
            mysql_select_db(Config::DBNAME, self::$db) 
                    or die(mysql_error());
            // if this is the first time we connect add an event listener
            // this function will be invoked once the php program ends
            if(!self::$shutdown_handler_registered):
                register_shutdown_function(array("Models\\Base", "db_disconnect"));
                self::$shutdown_handler_registered = true;
            endif;
        endif;
    }
    public function db_disconnect() {
        // if we have an active connection -> disconnect
        echo "<!-- db_disconnect -->";
        if (self::$db) :
            mysql_close(self::$db);
            self::$db = null;
        endif;
    }
}