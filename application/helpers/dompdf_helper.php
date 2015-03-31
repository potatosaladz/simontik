<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function pdf_create($html, $filename='', $stream=TRUE) 
{
    require_once("dompdf/dompdf_config.inc.php");

    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->render();
    if ($stream) {
        $dompdf->stream($filename.".pdf");
    } else {
        return $dompdf->output();
    }
}


function pdf_create_params($html, $filename, $paper = 'a4', $orientation = "landscape",$stream=TRUE) 
	{
	    require_once("dompdf/dompdf_config.inc.php");

	    $dompdf = new DOMPDF();
	    $dompdf->load_html($html);
	    $dompdf->set_paper($paper, $orientation);
	    $dompdf->render();
	    //$dompdf->stream($filename . ".pdf");
	    if ($stream) {
	        $dompdf->stream($filename.".pdf");
	    } else {
	        return $dompdf->output();
	    }
	}
?>