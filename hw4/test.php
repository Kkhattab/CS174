<?php


// if user selected a valid test

if (isset($_GET["test"]) && file_exists("tests/".$_GET["test"].".php")) {
    // Autoloader for our classes
    include "vendor/autoload.php";
    // Launch simpletest
    include "vendor/simpletest/simpletest/autorun.php";
    // load a test, and run
    include "tests/".$_GET["test"].".php";
}

else die("Access denied!");