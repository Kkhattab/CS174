<?php
// run from command line  php CreateDB.php
// or visit http://localhost/hw5/createDB.php

require 'vendor/autoload.php';

try {
    $db = new MysqliDb(
            Configs\Config::DBHOST, Configs\Config::DBUSER, Configs\Config::DBPASS);
} catch (Exception $ex) {
    echo "Unnable to connect to the database\n";
    echo $ex->getMessage();
    exit();
}

$dbname = Configs\Config::DBNAME;
//A schema is a database, so the SCHEMATA table provides information about databases.
$dbexists = $db->rawQueryOne("SELECT SCHEMA_NAME "
        . "FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbname'");

if ($dbexists == null) {
    try {
        $db->rawQuery("CREATE DATABASE `$dbname`");
        echo "Database '$dbname' created\n";
    } catch (Exception $ex) {
        echo "Error while creating database\n";
        echo $ex->getMessage();
        exit();
    }
}

try {
    mysqli_select_db($db->mysqli(), $dbname);
    $result = $db->rawQuery(
            "CREATE TABLE IF NOT EXISTS `postcards` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `lookup` VARCHAR(10) NOT NULL DEFAULT '0',
                `image` VARCHAR(20) NOT NULL DEFAULT '0',
                `border` INT(11) NOT NULL DEFAULT '0',
                `wisher` VARCHAR(250) NOT NULL DEFAULT '0',
                PRIMARY KEY (`id`),
                UNIQUE INDEX `lookup` (`lookup`)
            )
            COMMENT='Store postcards sent via our system'
            ENGINE=InnoDB
            ;");
   
    if ($db->getLastError()) {
        echo $db->getLastErrno() . ': ' . $db->getLastError();
    } else {
        echo "Table has already been created!! \n";
    }

} catch (Exception $ex) {
    echo "\n" . $ex->getMessage() . "\n";
}