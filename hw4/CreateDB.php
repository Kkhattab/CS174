<?php
// Entry point
// run from command line
require 'vendor/autoload.php';
$creator = new Models\CreateDB();
echo $creator->initDb();