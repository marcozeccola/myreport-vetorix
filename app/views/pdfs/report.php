<?php     
     require(dirname(__FILE__).'/../pdfs/reportModel.php'); 
 
     
     //Output PDF document
     $pdf->Output($pdfName.".pdf", 'I');