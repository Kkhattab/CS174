<?php

namespace Controllers;
/**
 * This class will generate the PDF files to download
 *
 *  @author Kareem, Kevin, Avinash.
 */
class Postcard {
   
    public function show() {
        $postcard = \Models\Postcard::lookUp($_GET['id'], $_GET['secret_key']);
        
        if (is_null($postcard)) {
            header("HTTP/1.0 404 Not Found");
            header("Location: ./");
            die(_("E404"));
        }
      
       $pdf = new PDF();
        $pdf->image = __DIR__.'/../../public/images/' . $postcard->image . '.jpg';
        $border = \Models\Postcard::getBorder($postcard->border);
        $pdf->border = $border['style'];
        $pdf->color = $border['color'];
        $pdf->title = __("HIS_POSTCARD", array('name' => $postcard->wisher));
        $pdf->message = __("PDF_LONG_MESSAGE", array('name' => $postcard->wisher));
        $pdf->DrawPdf();
        //Finally, the document is closed and sent to the browser with Output().
        $pdf->Output();
    }
    
}

/**
 * Extends FPDF to draw our postcard
 */
class PDF extends \FPDF
{
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Draws a dashed line where x1 < x2 and y1 < y2.
     * 
     * @param float $x1,
     * @param float $y1,
     * @param float $x2,
     * @param float $y2,
     * @param float $dash_length.
     * 
     * @return void.
     */
   
    private function LineDashed($x1, $y1, $x2, $y2, $dash_length) {
        if ($x1 == $x2) {
            // vertical line
            for($y = $y1; $y < $y2; $y += $dash_length * 2) {
                $this->Line($x1, $y, $x2, min(array($y + $dash_length, $y2)));
            }
        } else {
            // horizontal line
            for($x = $x1; $x < $x2; $x += $dash_length * 2) {
                $this->Line($x, $y1, min(array($x + $dash_length, $x2)), $y2);
            }
        }
    }
    
    /**
     * Draws a line, with the settings stored in this instance.
     * @param float $x1,
     * @param float $y1,
     * @param float $x2,
     * @param float $y2.
     *
     * @return void.
     */

    private function DrawLine($x1, $y1, $x2, $y2) {
        $colors = array(
            'black' => array(0,0,0),
            'red' => array(255,0,0),
            'green' => array(0,128,0),
            'purple' => array(128,0,128),
            'orange' => array(255,165,0),
        );
      
        $color = $colors[$this->color];
      
        $this->SetDrawColor($color[0], $color[1], $color[2]);
      
        if ($this->border == 'dashed') {
            $this->LineDashed($x1, $y1, $x2, $y2, 5);
        } else {
            $this->Line($x1, $y1, $x2, $y2);
        }
    }
    
    /**
     * Renders pdf document.
     *
     * @return void.
     */
    function DrawPdf()
    {
        // Blank page
        $this->AddPage();
        
        // Page width
        $width = $this->GetPageWidth() - $this->lMargin - $this->rMargin;
        
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Title
        $this->Cell($width,10,$this->title,0,0,'C');
        
        // set font
        $this->SetFont('Times','',12);
        $this->SetXY(15, 40);
        $this->Cell(100,0,$this->message,0,0,'L');
        
        // Logo
        $image_width = 100;
        $image_x = ($this->GetPageWidth()-$image_width)/2;
        $image_y = 60;
        $this->Image($this->image,$image_x,$image_y,$image_width);
        
        $padding = 10;
       
        // draw frame if necessary
        if ($this->border != "none") {
            $this->SetLineWidth(1);
            // calculate image height on page
            $image_original_width = $this->images[$this->image]['w'];
            $image_original_height = $this->images[$this->image]['h'];
            $image_height = $image_original_height * ($image_width / $image_original_width);
            
            // calculate desired frame position
            $frame_x = $image_x - $padding;
            $frame_y = $image_y - $padding;
            $frame_w = $image_width + $padding * 2;
            $frame_h = $image_height + $padding * 2;
            
            // draw the frame
            $this->DrawLine($frame_x, $frame_y, $frame_x + $frame_w, $frame_y); // upper horizontal
            $this->DrawLine($frame_x, $frame_y + $frame_h, $frame_x + $frame_w, $frame_y + $frame_h); // lower horizontal
            $this->DrawLine($frame_x, $frame_y, $frame_x, $frame_y + $frame_h); // left vertical
            $this->DrawLine($frame_x + $frame_w, $frame_y, $frame_x + $frame_w, $frame_y + $frame_h); // right vertical
        }
        
    }
    
}