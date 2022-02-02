<?php

Class Fungsi{


    function PdfGenerator($html,$filename,$paper,$orientation){

    	$dompdf = new Dompdf\Dompdf();
    	$dompdf->loadHtml($html);
    	$dompdf->setPaper($paper,$orientation);
    	$dompdf->render();
		$dompdf->output(['isRemoteEnabled' => true]);
    	$dompdf->stream($filename,array('Attachment' => 0));
    }
}

?>