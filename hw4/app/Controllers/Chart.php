<?php
namespace Controllers;

class Chart extends Base {
   
    // this function restructures the data retrieved from database
    // this is the form in the database:
    // array(
    //      array(label, value1, value2),
    //      array(label for 2nd row, value1, value2)
    // )
    // and this is what we need:
    // array(
    //      label => value1,
    //      label for 2nd row => value2,
    //      etc...
    // )
    
    public function get_data_series($original, $index) {
        $parsed = array();
        foreach ($original as $row) {
            $parsed[$row[0]] = $row[$index];
        }
        return json_encode($parsed);
    }
    
    function index() {
        $hash = $_GET['arg2'];
        $chartdata = new \Models\ChartDataRow();
        $data = $chartdata->load_data($hash);
        if (!$data) {
            // chart not found
            // redirect to landing page
            header("Location: ?c=landing");
            return;
        }
        $view = new \Views\Chart();
        // get the page title and pass it into the current view 
        $template_vars = array(
            "site_title" => "“$hash Line Graph - PasteChart”",
            "title" => $data['title'],
            "json" => $this->get_data_series($data['data'], 1)
        );
        $view->render($template_vars);
    }
}