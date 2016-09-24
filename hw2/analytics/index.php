<!DOCTYPE html>
<html>

<head>

  <meta name="author" content="Kareem Khattab, Kevin Hou">

  <title>CS 174 - HW2</title>

  <!-- load the spreadsheet -->
  <link rel="stylesheet" type="text/css" href="analytics.css">

  
 </head>

<body>


<?php 
  
  // ================
  // The PHP magic :)

  // set the URL_TO_TRACKER_SITE 
  define("URL_TO_TRACKER_SITE" , "http://localhost/hw2/analytics");


  // check if $_REQUEST['activity'] is set
  if (isset($_REQUEST['activity'])) {

    // check if $_REQUEST['activity'] is one of the values: codes, counts, or analytics (I guess you are using SWITCH statemant and not IF/ELSE)
    switch ($_REQUEST['activity']) {

        case "codes":
        codes();
            break;

        case "count":
        countFunction();
            break;

        case "analytics":
          analytics();
            break;

        //If your script doesn't see $_REQUEST['activity'] set or it is not set to one of these values, then index.php should call a function default() (I had to call it defaultFunction as the word 'default' is reserved in PHP)
        default:
        defaultFunction();
    }


  } else {

    // If script doesn't see $_REQUEST['activity'] call a function default()
    defaultFunction();
  }



  // =========================
  // HERE WE SET THE FUNCTIONS

  
  /**
   * the DEFAULT function to draw the form
   */
  function defaultFunction() { 

    // stop PHP to echo the form
    ?>
    
    <h1> Web Page Analytics </h1>

      <!-- start form and set the method to GET -->
    <form method="GET">

      <!-- input field arg -->    
      <input type="text" name="arg" placeholder="Enter Site Magic String">

      <!-- select field with name "activity" for PHP to check -->
      <select name="activity">
        <option value="codes" >Get Site Tracker Codes</option>
        <!-- set the default option with "selected" tag -->
        <option value="analytics" selected>View Analytics</option>
      </select>

      <!-- submit button with text GO -->
      <button type="submit">GO</button>

    <!-- close the form -->
    </form>

    <?php 
  }

  /**
   * Codes function to enter the url-s
   */
  function codes(){

    // check if arg is not set or is empty amd call defaultFunction
      if (!isset($_REQUEST['arg']) || empty($_REQUEST['arg'])) {

        defaultFunction();
        return;
      }

    // check if there is no arg2 or it is not set, and display new form
      if (!isset($_REQUEST['arg2']) || empty($_REQUEST['arg2'])) {
      
      ?>

        <h1>Tracker Codes - Web Page Tagging Analytics</h1>
        
        <form method="GET">
          
          <!-- save the old values -->
          <input type="hidden" name="activity" value="<?php echo $_REQUEST['activity']; ?>">
          <input type="hidden" name="arg" value="<?php echo $_REQUEST['arg']; ?>">

          <!-- input field arg2-->
          <input type="text" name="arg2" placeholder="Enter a URL to track">

          <!-- submit button with text GO -->
          <button type="submit">GO</button>

        </form>

      <?php

      
      } else {

        // else if there is 'arg2' one can assume this form has been submitted

        // make the XXXX form sha of 'arg' and 'arg2'
        $XXXX = sha1($_REQUEST['arg'] . $_REQUEST['arg2']);

        // make the YYYY form sha of 'arg'
        $YYYY = sha1($_REQUEST['arg']); 



        // echo the form with url value of 'arg2' 
      ?>

        <h1>Tracker Codes - Web Page Tagging Analytics</h1>
        
        <form method="GET">

          <!-- save the old values -->
          <input type="hidden" name="activity" value="<?php echo $_REQUEST['activity']; ?>">
          <input type="hidden" name="arg" value="<?php echo $_REQUEST['arg']; ?>">

          <!-- input field arg2-->
          <input type="text" name="arg2" value="<?php echo $_REQUEST['arg2']; ?>">

          <!-- submit button with text GO -->
          <button type="submit">GO</button>

        </form>

        <h2>Add the following code to the web page of the site with the url just entered</h2>

      <?php 

      // echo the link to tracker site
      echo htmlentities('<script src="' . URL_TO_TRACKER_SITE . '/?activity=count&arg=' . $YYYY . '&arg2=' . $XXXX . '" />');


      // check if url_lookups.txt exists
      if (file_exists('url_lookups.txt')) {

        // unserialize the contents to a variable $lookups
        $lookups = unserialize(file_get_contents('url_lookups.txt'));

        // set $lookups[XXXX] = $_REQUEST['arg2'];
        $lookups[$XXXX] = $_REQUEST['arg2'];

        // serialize $lookups and write it back out to url_lookups.txt
        file_put_contents('url_lookups.txt', serialize($lookups));

      } else {

        // If url_lookups.txt does not exist, then initialize $lookups = []; 
        $lookups = [];

        // set $lookups[XXXX] = $_REQUEST['arg2'];
        $lookups[$XXXX] = $_REQUEST['arg2'];

        // serialize $lookups and write it out to url_lookups.txt
        file_put_contents('url_lookups.txt', serialize($lookups));      
      }


      }

  }
  

  /**
   * Count the visitors
   * I had to call it countFunction as the function count is reserved in PHP / it counts items in an array
   */
  function countFunction(){

    // test for 'arg' and 'arg2' vars
    if (isset($_REQUEST['arg']) && isset($_REQUEST['arg2']) && !empty($_REQUEST['arg']) && !empty($_REQUEST['arg2'])) {

      
      // file counts.txt, if it exists, should be read in and unserialized to the variable $counts
      if (file_exists('counts.txt')) {

        $counts = unserialize(file_get_contents('counts.txt'));

      } else {

        // Otherwise, $counts should be set to []
        $counts = [];
      }


      $IP = $_SERVER['REMOTE_ADDR'];


      // If $counts[$_REQUEST['arg']][$_REQUEST['arg2']][IP] is not set it should be initialized to 1
      if (!isset($counts[$_REQUEST['arg']][$_REQUEST['arg2']][$IP])) {

        $counts[$_REQUEST['arg']][$_REQUEST['arg2']][$IP] = 1;

      } else {

        // otherwise, it should be incremented
        $counts[$_REQUEST['arg']][$_REQUEST['arg2']][$IP] += 1;

      }

      // serialize the results and put in counts.txt
      file_put_contents('counts.txt', serialize($counts));

      // echo requestd text
      echo 'tracking = "done";';


    } else {

      return;
    }

  }


  /**
   * The function to display the analytics
   */
  function analytics() {

    // echo the page
    ?>

      <h1>View Analytics - Web Page Tagging Analytics</h1>  

      <h2>Analytics for <?php echo $_REQUEST['arg']; ?></h2>

    <?php 
    
    // check if both files exist
    if (file_exists('counts.txt') && file_exists('url_lookups.txt')) {

      // get the contents of the files
      $counts = unserialize(file_get_contents('counts.txt'));
      $url_lookups = unserialize(file_get_contents('url_lookups.txt'));

      // make the YYYY form sha of 'arg'
      $YYYY = sha1($_REQUEST['arg']); 


      // loop trough the counts
      foreach ($counts[$YYYY] as $counts_key => $counts_arg) {

        // set the echo to empty
        $list_of_ip = "";
        $total_count = 0;

        // loop trough all the IP that visited this website
        foreach ($counts_arg as $count_key => $count_arg) {

          // add each ip to the list
          $list_of_ip .=  $count_key . ": " . $count_arg . "<br>";

          // add the count to total
          $total_count += $count_arg;

        }

        // echo the result
        echo '<h3>' . $url_lookups[$counts_key] . ' - ' . $total_count . '</h3>' . $list_of_ip;
      }

    } else {

      return;
    }
  }



?>


</body>
</html>