<?php 

require(dirname(__FILE__).'/../../../TCPDF/tcpdf.php');
class quickModel extends TCPDF{
     public $inspection; 
     public $idOperatoreCapo;
     public $font;
     public function __construct($inspection) {
          parent::__construct();
          $this->inspection = $inspection;
          $this->idOperatoreCapo = 1;
          $this->font = "helvetica";
     }

     public function Header(){  

          $this->SetFont($this->font, '', 10);   

          $this->Image(PUBLICROOT.'/assets/img/pdf/logo.png',15, 15,25); 
          $this->Ln( 10);
          
          $this->SetFont($this->font,'',17); 
          $this->Cell(190,   5, 'NDI REPORT', 0, 0, 'C');
          $this->Ln();
          $this->Cell(190, 5, 'XYZ #075 - cpt', 0, 0, 'C');
          $this->Ln(); 

          $this->SetFont($this->font,'',9); 
          $this->Cell(0, 0, 'Page '. $this->PageNo(), 0, 0, 'R', false); 
           
     }

     public function Footer() {
          if ($this->page == 1) { 
               $this->SetY(-30); 
               $this->SetFont($this->font,'',8); 
               $this->Cell(185, 5, '', 'T', 0 , 'C');
               $this->Ln(1);
               $this->Cell(185, 5, 'This report contains confidential information intended only for the recipient(s) mentioned above and is protected by law. Any disclosure,' );
               $this->Ln();
               $this->Cell(185, 3, 'distribution and/or copying of this document by any subject different from the named recipient(s) is strictly prohibited by law. Any unauthorised' );
               $this->Ln();
               $this->Cell(185, 3, 'use of the contents of this document constitutes a violation of the Law.', );
          }
 
          $this->SetY(-15); 
          $this->SetFont($this->font, 'I', 10); 

          $this->Cell(0, 10, "Report id:  ".$this->inspection->projectId, 0, 0, 'L');
          $this->Cell(0, 10, $this->PageNo(), 0, 0, 'R');
          $this->Image(PUBLICROOT.'/assets/img/pdf/favicon.png', 184, 279, 12);
     }

     public function html($html){
          $_pdf = clone $this;
          $startpage = $_pdf->PageNo();

          $_pdf->writeHTMLCell( 0, 0, '', '', $html, 0, 1, false, true, 'C'  );

          $endpage = $_pdf->PageNo();

          if($startpage != $endpage) {
               $this->addPage();
          }

          $this->writeHTML($html, true, false, true, false, '');
     }

     
}
// create new PDF document
$pdf = new quickModel($data["inspection"]);
  

$pdfName = "QI Report ";

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('QI Compostes');
$pdf->SetTitle($pdfName); 
  
// set margins 
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
} 
 
$pdf->SetFont('helvetica', '', 9);
 
$pdf->AddPage();
$pdf->Ln( 35);

$dataFormat =  date('d-m-Y', strtotime( $data["inspection"]->date));
$lightGrey="#e3e3e3";
$lightBlue ="#94f7ee";

//create inspection table
$inspectionTable = '
  <table border="0.5" cellpadding="4" style="font-size:13px;"> 
  <tbody>
    <tr >
      <td width="20%" bgcolor="'.$lightGrey.'" >DATA:</td>
      <td width="15%">'.$data["inspection"]->date.'</td>
      <td width="20%" bgcolor="'.$lightGrey.'">CLIENTE:</td>
      <td width="45%">'.$data["inspection"]->client.'</td>
    </tr>
    <tr >
      <td width="20%" bgcolor="'.$lightGrey.'" >PROG. VTX:</td>
      <td width="15%">'.$data["inspection"]->projectId.'</td>
      <td width="20%" bgcolor="'.$lightGrey.'">COSTRUTTORE:</td>
      <td width="45%">'.$data["inspection"]->builder.'</td>
    </tr> 
    <tr >
      <td width="20%" bgcolor="'.$lightGrey.'" >MODELLO:</td>
      <td width="40%">'.$data["inspection"]->projectId.'</td> 
      <td width="40%">ID: /'.$data["inspection"]->builder.'</td>
    </tr>
    <tr >
      <td width="20%" bgcolor="'.$lightGrey.'" >STABILIMENTO:</td>
      <td width="50%">'.$data["inspection"]->projectId.'</td>
      <td width="20%" bgcolor="'.$lightGrey.'">ANNO imbarcazione:</td>
      <td width="10%">'.$data["inspection"]->year.'</td>
    </tr>  
  </tbody>
</table> ';

// output the inspection Table
$pdf->writeHTML($inspectionTable, true, false, true, false, '');
 
$pdf->Ln( 3);
  
$goalTable = '
  <table border="0.5" cellpadding="4" style="font-size:13px;"> 
  <tbody>
    <tr >
      <td width="20%" bgcolor="'.$lightBlue.'" ><b>SCOPO:</b></td>
      <td width="80%">'.$data["inspection"]->goal.'</td> 
    </tr>
    <tr >
      <td width="34%"  ><input type="checkbox" name="agree" value="1" checked="checked" readonly="true" /> <label for="agree">NUOVA COSTRUZIONE </label> </td>
      <td width="34%"  ><input type="checkbox" name="agree" value="1"   readonly="true" /> <label for="agree">POST VENDITA </label> </td>
      <td width="32%"  ><input type="checkbox" name="agree" value="1"   readonly="true" /> <label for="agree">ALTRO </label> </td> 
    </tr> 
    <tr >
      <td width="10%"   >NOTE:</td>
      <td width="90%">'.$data["inspection"]->goalNotes.'</td> 
    </tr>
  </tbody>
</table> ';
 
$pdf->writeHTML($goalTable, true, false, true, false, '');
 
 
$operatore = $data["inspection"]->fk_idReviewer; 
$footer = "";
if($operatore){
     $pdf->Ln(20); 
     $idOp = $operatore;

     //print specialist signature
     $dirFirma = PUBLICROOT.'/signatures/'.$idOp;
     $files = array();
     
     if(is_dir($dirFirma)){
          $files = array_diff(scandir($dirFirma), array('.', '..')); 
     } 

     if($files){ 
          foreach ($files as $file) {   
               $footer = $footer.'<img height="100" src="'.$dirFirma.'/'.$file.'">';
          }  
     }
 
 
} 
 

$footer = $footer." <h4>NDT Operator - Q.I. Composites S.r.l.</h4> 
          <p>
               <a href='www.qicomposites.com'>www.qicomposites.com</a><br>
               Q.I. Composites S.r.l.<br>
               C.F. e P.IVA 03157580014<br>
               Registered office and Operational headquarters:<br>
               Via Lago 4 - 13886 Viverone (BI)<br>
               <br>
               Tel. +39 0161 1510744  <br>
               WhatsApp +39 3331866438 <br> 
          </p>
          <br>        
  ";
$footer = $footer.  '
          <table border="1" cellpadding="4" style="font-size:15px;"> 
          <tbody>
          <tr > 
               <td width="100%" >           
                    Although the present check was carried out with the maximum care, it’s not possible to declare to have discovered every anomaly or defect present in the structure at the moment of the inspection. Backing film residues are difficult to detect with ultrasonic testing or other NDT methods. Therefore, this report cannot give an explicit or implicit guarantee concerning the structure.
               </td> 
          </tr>
          </tbody></table>';
$pdf->SetFont($pdf->font, '', 11); 
$pdf->html($footer); 

// reset pointer to the last page
$pdf->lastPage();  
 