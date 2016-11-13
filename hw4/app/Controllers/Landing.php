<?php
namespace Controllers;
use Views as Views;

class Landing extends Base {

    function get_chart_data($data) {
        //explod is opposit of implode, basically separate lines by new spaces
        $lines = explode("\n", $data);
        $parsed = array();
        
        foreach ($lines as $line) {
            //separate the line by comma to get each point 
            $values = explode(",", $line);
           
            $parsed []= array(
                trim($values[0]), // label
                empty(trim($values[1])) ? null : floatval(trim($values[1])), // value 1 (the number we entered)
                empty(trim($values[2])) ? null : floatval(trim($values[2])) // value 2 ( the number we entered for 2nd val)
             );
         }
        return $parsed;
    }


    function validate_chart_data($data) {
    	//explode — Split a string by string
        $lines = explode("\n", $data);
        
        $num_of_lines = count($lines);
        
        if ($num_of_lines > 50) {
            return "Too many (> 50 lines) lines! You have $num_of_lines number of lines.";
        }
       
        foreach ($lines as $no => $line) {
            
            $length = strlen($line);
           
            if ($length > 80)
                return "Too many ($length > 80) characters on line #$no";
           
            $values = explode(",", $line);
           
            if (count($values) != 3)
                return "Invalid number of values on line #$no";
           
            if (empty(trim($values[0])))
                return "First value cannot be empty/blank on line #$no";
           
            for ($i = 1; $i < count($values); $i++) {
                 
                 // we must allow empty values, but non empty non numeric is forbidden
                if (!empty(trim($values[$i])) && !is_numeric(trim($values[$i]))) {
                    return "Every plot values should be numbers except labels.\n"
                    . "Line: $no Column: $i is not a number!";
                }
            }
        }
        return true; //no error
        // using === because strings evalueate to true rather than false
    }

    function index() {
        // nothing by default
        $validation_result = "";
        
        // if form submitted
        if (isset($_POST["sent"])):
            $validation_result = $this->validate_chart_data($_POST['dataEntry']);
            if ($validation_result === true) {
                // save to database 
                $chartdata = new \Models\ChartDataRow();
                $result = $chartdata->save($_POST['chart_title'], $this->get_chart_data($_POST['dataEntry']));
               // redirect to the chart page
                if($result):
                     header("Location: ?c=chart&a=show&arg1=LineGraph&arg2=".hash('md5', $_POST['chart_title']));
                     return;
                else:
                     echo "db error: ".mysql_error();
                endif;
            }
        endif;
        
        $view = new Views\Landing();
        // get the page title and pass it into the current view 
        $data = array(
            "site_title" => "PasteChart",
            "placeholder_text" => "Comma separated list of values, one per line, up to 50 lines of at most 80 characters, these will represent the points to plot our data.\n\nExample:\nJan, 600, 5.4\nFeb, , 5.0\nMarch, 551, 4.9\n...",
            // if server side validation fails, we don't want the user to lose the data they entered
            "chart_title" => isset($_POST['chart_title']) ? $_POST['chart_title'] : "",
            "dataEntry" => isset($_POST['dataEntry']) ? $_POST['dataEntry'] : "",
            // this variable contains a message if server side validation fails this could be displayed in an alert
            // it will most likely occur because user doesnt have javascript enabled, so it will be displayed as plain text
            "validation_result" => $validation_result
        );
        $view->render($data);
    }
}