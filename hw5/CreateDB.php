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
        $db->rawQuery("CREATE DATABASE `$dbname` COLLATE 'utf8_general_ci'");
        echo "Database '$dbname' created\n";
    } catch (Exception $ex) {
        echo "Error when creating database\n";
        echo $ex->getMessage();
        exit();
    }
}
//http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
try {
    mysqli_select_db($db->mysqli(), $dbname);

    $stmt = $db->rawQuery("DROP TABLE IF EXISTS postcards;" );
    

    $result = $db->rawQuery(
            "CREATE TABLE `postcards` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `secret` VARCHAR(10) NOT NULL DEFAULT '0' COLLATE 'utf8_general_ci',
                `image` VARCHAR(20) NOT NULL DEFAULT '0' COLLATE 'utf8_general_ci',
                `border` INT(11) NOT NULL DEFAULT '0',
                `wisher` VARCHAR(250) NOT NULL DEFAULT '0' COLLATE 'utf8_general_ci',
                PRIMARY KEY (`id`)
            )
            COMMENT='Store postcards sent via our system'
            COLLATE='utf8_general_ci'
            ENGINE=InnoDB;");
    if ($db->getLastError()) {
        echo $db->getLastErrno() . ': ' . $db->getLastError();
    } else {
        echo "Table created, or already exists. Bye!\n";
    }
} catch (Exception $ex) {
    echo "\n" . $ex->getMessage() . "\n";
}