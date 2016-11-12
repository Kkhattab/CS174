<?php
// Entry point
// run from command line or visit http://localhost/hw4/createDB.php
require 'vendor/autoload.php';
$creator = new Models\CreateDB();
echo $creator->initDb();