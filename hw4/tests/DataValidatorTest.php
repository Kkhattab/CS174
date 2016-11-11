<?php
// This class holds a series of tests for unit testing server side data validation
// http://localhost/hw4/test.php?test=datavalidatortest to run unit tests
//http://php.net/manual/en/language.operators.comparison.php why we use equal vs identical
class DataValidatorTest extends UnitTestCase {
   
    function __construct() {
        parent::__construct('Data validation test');
    }
    
    // Validator handles long lines well?
    function testLongLines() {
        // Create an instance of the class we want to test
        $landing = new Controllers\Landing();
        
        // these two lines should pass
        $this->assertEqual($landing->validate_chart_data("shortline,1,2"), true);
        $this->assertEqual($landing->validate_chart_data("still valid,42,2.92"), true);
        // assertTrue is not ideal here, because it would accept any value which evaulates to true, which means non-empty strings would pass
        
        // this is a long line with (97 char length)
        // so validator should return a message according to that
        $this->assertEqual(
                $landing->validate_chart_data("label,1234567890,12345678901234567890123456789012345678901234567890123456789012345678901234567890"),
                "Too many (97 > 80) characters on line #0");
    }
    
    // The validator should not let more than 50 lines to be posted
    function testTooManyLines() {
        $landing = new Controllers\Landing();
        $this->assertEqual($landing->validate_chart_data("shortline,1,2"), true);
        $this->assertEqual($landing->validate_chart_data(str_repeat("still valid,42,2.92\n", 10)."valid,1,2"), true);
        $this->assertEqual(
                $landing->validate_chart_data(str_repeat("label,31,23\n",55)."lastline,1,2"),
                "Too many (> 50 lines) lines! You have 56 number of lines.");
    }
    
    function testTuple() {
        $landing = new Controllers\Landing();
        $this->assertEqual($landing->validate_chart_data("shortline,1,2"), true);
        $this->assertEqual($landing->validate_chart_data("  some thing, 1,2 "), true);
        $this->assertEqual($landing->validate_chart_data("fdsa,,91"), true);
        $this->assertEqual($landing->validate_chart_data("bad,2"), "Invalid number of values on line #0");
        $this->assertEqual($landing->validate_chart_data("bad,2,3,3"), "Invalid number of values on line #0");
    }
    
    function testNonNumericValidation() {
        $landing = new Controllers\Landing();
        $message_base = "Every plot values should be numbers except labels.\n";
        $this->assertEqual($landing->validate_chart_data("shortline,1,18.8281"), true);
        $this->assertEqual($landing->validate_chart_data("  some thing, 5,2 "), true);
        $this->assertEqual($landing->validate_chart_data("fdsa,,91"), true);
        $this->assertEqual($landing->validate_chart_data("fdsa,-47,9.1"), true);
        $this->assertEqual($landing->validate_chart_data("bad,2,nonnum"), $message_base
                ."Line: 0 Column: 2 is not a number!");
        $this->assertEqual($landing->validate_chart_data("bad,2-3,3"), $message_base
                ."Line: 0 Column: 1 is not a number!");
    }
}