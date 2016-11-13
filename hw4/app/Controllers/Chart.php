<?php
namespace Controllers;

class Chart extends Base {
  
    function index() {
        $hash = $_GET['arg2'];
        $chart_type = $_GET['arg1'];
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
            "site_title" => "$hash $chart_type - PasteChart"
        );
        
        $view->render($template_vars);
    }
}