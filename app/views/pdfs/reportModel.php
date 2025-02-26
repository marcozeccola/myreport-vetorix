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
          $this->Cell(0, 0, 'Pagina '. $this->PageNo(), 0, 0, 'R', false); 
          $this->Ln(); 
            
     }

     public function Footer() { 
 
          $this->SetY(-30); 
          $this->SetFont($this->font,'',8); 
          $this->Cell(185, 5, '', 'T', 0 , 'C');
          $this->Ln(1);
          $this->SetY(-25); 
          $this->SetFont($this->font, 'I', 10); 

          $this->SetX(48); 
          $this->Image(PUBLICROOT.'/assets/img/pdf/footerImage.png', 10, 272, 27);
          $this->SetFont($this->font,'',7); 
          $this->Cell(185, 5, '© Vetorix Engineering S.r.l. Unipersonale. The information in this document is Condential and property of Vetorix Engineering ' );
          $this->Ln();
          $this->SetX(48); 
          $this->Cell(185, 3, 'S.r.l. Unipersonale and STILPLAST srl. Can not be copied or communicated to a third party, or used, for any purpose other than ' );
          $this->Ln();
          $this->SetX(48); 
          $this->Cell(185, 3, 'that for which it is supplied without the express written consent of Vetorix Engineering S.r.l. Unipersonale.', );
     }

     public function html($html){
          $_pdf = clone $this;
          $startpage = $_pdf->PageNo();

          $_pdf->writeHTMLCell( 0, 0, '', '', $html, 0, 1, false, true, 'C'  );

          $endpage = $_pdf->PageNo();

          if($startpage != $endpage || $this->GetX()>250) {
              $this->addPage();
              $this->SetY(35); 
          }

          $this->writeHTML($html, true, false, true, false, '');
     }

     
}
// create new PDF document
$pdf = new quickModel($data["inspection"]);
  

$pdfName = "Vetorix ";

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
$outlineTable="#a6a6a6";
$insideTable="#cccccc";
$lightBlue ="#94f7ee";
$secondLightBlue ="#b3ffe6";
$orange = "#fcba03";
$blue = "#17cdff";
$bluWater = "#75d7cd";
$thirdLightBlue="#e5f9ff";
$grey = "#bfbfbf";
$inspection = $data["inspection"];

//create inspection table
$inspectionTable = '
<style>
td{
border: 1px solid '.$insideTable .';
}
table{
border: 2px solid '.$outlineTable .';
}
</style>
  <table  cellpadding="4" style="font-size:13px;"> 
  <tbody>
    <tr  >
      <td    width="20%" bgcolor="'.$lightGrey.'" >DATA:</td>
      <td   width="15%">'.$data["inspection"]->date.'</td>
      <td    width="20%" bgcolor="'.$lightGrey.'">CLIENTE:</td>
      <td   width="45%">'.$data["inspection"]->client.'</td>
    </tr>
    <tr >
      <td   width="20%" bgcolor="'.$lightGrey.'" >PROG. VTX:</td>
      <td    width="15%">'.$data["inspection"]->projectId.'</td>
      <td    width="20%" bgcolor="'.$lightGrey.'">COSTRUTTORE:</td>
      <td    width="45%">'.$data["inspection"]->builder.'</td>
    </tr> 
    <tr >
      <td width="20%" bgcolor="'.$lightGrey.'" >MODELLO:</td>
      <td width="40%">'.$data["modelIstance"]->modelIstance.'</td> 
      <td width="40%">ID: /'.$data["modelIstance"]->idModelIstance.'</td>
    </tr>
    <tr >
      <td width="20%" bgcolor="'.$lightGrey.'" >STABILIMENTO:</td>
      <td width="50%">'.$data["inspection"]->factory.'</td>
      <td width="20%" bgcolor="'.$lightGrey.'">ANNO imbarcazione:</td>
      <td width="10%">'.$data["inspection"]->year.'</td>
    </tr>  
  </tbody>
</table> ';

// output the inspection Table
$pdf->html($inspectionTable);
 
$pdf->Ln( 2);
   
$goalTable = '
<style>
td{
border: 1px solid '.$insideTable .';
}
table{
border: 2px solid '.$outlineTable .';
}
</style>
  <table   cellpadding="4" style="font-size:13px;   "> 
  <tbody>
    <tr >
      <td width="20%" bgcolor="'.$lightBlue.'" ><b>SCOPO:</b></td>
      <td width="80%">'.$data["inspection"]->goal.'</td> 
    </tr>
    <tr >
      <td width="34%"  ><input type="checkbox" name="new_construction" value="1" '.($data["inspection"]->type == "new" ? 'checked="checked"' : '').' readonly="true" /> <label for="new_construction">NUOVA COSTRUZIONE </label> </td>
      <td width="34%"  ><input type="checkbox" name="aftersale" value="1" '.($data["inspection"]->type == "aftersale" ? 'checked="checked"' : '').' readonly="true" /> <label for="aftersale">POST VENDITA </label> </td>
      <td width="32%"  ><input type="checkbox" name="other" value="1" '.($data["inspection"]->type == "other" ? 'checked="checked"' : '').' readonly="true" /> <label for="other">ALTRO </label> </td> 
    </tr> 
    <tr >
      <td width="10%"   >NOTE:</td>
      <td width="90%">'.$data["inspection"]->goalNotes.'</td> 
    </tr>
  </tbody>
</table> ';

 
$pdf->html($goalTable );
  
$pdf->Ln( 2);
    
 
$componentsTable = '
<style>
td{
border: 1px solid '.$insideTable .';
}
table{
border: 2px solid '.$outlineTable .';
}
</style>
  <table   cellpadding="4" style="font-size:13px;  "> 
  <tbody>
    <tr >
      <td width="100%" bgcolor="'.$lightBlue.'" ><b>AREE ESAMINATE:</b></td> 
    </tr>';
 
foreach ($data["components"] as $component) {
    $componentsTable .= '
    <tr >
      <td width="20%" bgcolor="'.$secondLightBlue .'">'.$component->componentIstance.'</td>
      <td width="80%">Note: '.$component->notes.'</td> 
    </tr>  
    ';
}
$componentsTable .= '  
  </tbody>
</table> ';
 
$pdf->html($componentsTable );
  
$pdf->Ln( 2);
   
$tecTable = '
<style>
td{
border: 1px solid '.$insideTable .';
}
table{
border: 2px solid '.$outlineTable .';
}
</style>
  <table   cellpadding="4" style="font-size:13px;  "> 
  <tbody>
    <tr >
      <td width="50%" bgcolor="'.$lightBlue.'" ><b>TECNICA COSTRUTTIVA</b></td> 
      <td width="50%" bgcolor="'.$lightBlue.'" ><b>POST CURA</b></td> 
    </tr>';

foreach ($data["components"] as $component) {
    $tecTable .= '<tr>
      <td width="13%">' . $component->componentIstance . '</td>';

    // Check which techniques are applied to the component
    $infusioneChecked = '';
    $wetLayUpChecked = '';
    $ndChecked = '';
    $fornoChecked = '';
    $lampadaChecked = '';
    $noNdChecked = '';

    foreach ($data["buildingTec"] as $buildingTec) {
        if ($buildingTec->fk_idComponentIstance == $component->idComponentIstance) {
            if ($buildingTec->technique == 'infusion') {
                $infusioneChecked = 'checked="checked"';
            }
            if ($buildingTec->technique == 'wet lay up') {
                $wetLayUpChecked = 'checked="checked"';
            }
            if ($buildingTec->technique== 'no') {
                $ndChecked = 'checked="checked"';
            }
        }
    }

    foreach ($data["postCare"] as $postCare) {
        if ($postCare->fk_idComponentIstance == $component->idComponentIstance) {
            if ($postCare->postCare == 'hoven') {
                $fornoChecked = 'checked="checked"';
            }
            if ($postCare->postCare == 'lamp') {
                $lampadaChecked = 'checked="checked"';
            }
            if ($postCare->postCare == 'no') {
                $noNdChecked = 'checked="checked"';
            }

        }
    }
    
            
    $tecTable .= '<td width="12%" style="font-size:11px;"><input type="checkbox" name="infusione" value="1" ' . $infusioneChecked . ' readonly="true" /> <label for="infusione"> infusione </label> </td> 
      <td width="12%" style="font-size:11px;"><input type="checkbox" name="wet lay up" value="1" ' . $wetLayUpChecked . ' readonly="true" /> <label for="wet lay up"> wet lay up </label>  </td>
      <td width="13%"style="font-size:11px;"><input type="checkbox" name="nd" value="1" ' . $ndChecked . ' readonly="true" /> <label for="nd"> nd</label>   </td>

      <td width="13%">' . $component->componentIstance . '</td>
      <td width="12%" style="font-size:11px;"><input type="checkbox" name="forno" value="1" ' . $fornoChecked . ' readonly="true" /> <label for="forno"> forno </label> </td> 
      <td width="12%" style="font-size:11px;"><input type="checkbox" name="lampada" value="1" ' . $lampadaChecked . ' readonly="true" /> <label for="lampada"> lampada </label>  </td>
      <td width="13%"style="font-size:11px;"><input type="checkbox" name="no/nd" value="1" ' . $noNdChecked . ' readonly="true" /> <label for="no/nd"> no/nd</label>   </td> 
    </tr>';
}

$tecTable .= '</tbody></table>';

$pdf->html($tecTable );

   
$pdf->Ln( 2);
   
 
$surfaceConditions = array_column($data["surfaceConditions"], 'surfaceCondition');
$otherSurfaceCondition = '';
foreach ($data["surfaceConditions"] as $surfaceCondition) {
    if (!in_array($surfaceCondition->surfaceCondition, array('gel coat opaco', 'gel coat lucido', '2nd step carrozzeria', 'verniciatura', '1st step carrozzeria'))) {
        $otherSurfaceCondition = $surfaceCondition->surfaceCondition;
    }
}
$surfaceConditionsTable = '
<style>
td{
border: 1px solid '.$insideTable .';
}
table{
border: 2px solid '.$outlineTable .';
}
</style>
  <table  cellpadding="4" style="font-size:13px;  "> 
  <tbody>
     <tr>
          <td width="100%" bgcolor="'.$lightBlue.'"><b>CONDIZIONI DELLA SUPERFICIE</b></td> 
     </tr>
     <tr>  
          <td width="32%" style="font-size:11px;"><input type="checkbox" name="infusione" value="1" ' . (in_array('gel coat opaco', $surfaceConditions) ? 'checked="checked"' : '') . ' readonly="true" /> <label> GEL COAT OPACO </label> </td>    
          <td width="36%" style="font-size:11px;"><input type="checkbox" name="infusione" value="1" ' . (in_array('1st step carrozzeria', $surfaceConditions) ? 'checked="checked"' : '') . ' readonly="true" /> <label> 1st step carrozzeria (post estrazione)</label> </td> 
          <td width="32%" style="font-size:11px;"><input type="checkbox" name="infusione" value="1" ' . (in_array('verniciato', $surfaceConditions) ? 'checked="checked"' : '') . ' readonly="true" /> <label> VERNICIATO </label> </td> 
     </tr>  
     <tr>  
          <td width="32%" style="font-size:11px;"><input type="checkbox" name="infusione" value="1" ' . (in_array('gel coat lucido', $surfaceConditions) ? 'checked="checked"' : '') . ' readonly="true" /> <label> GEL COAT LUCIDO </label> </td>    
          <td width="36%" style="font-size:11px;"><input type="checkbox" name="infusione" value="1" ' . (in_array('2nd step carrozzeria', $surfaceConditions) ? 'checked="checked"' : '') . ' readonly="true" /> <label> 2nd step carrozzeria (carrozzeria avanzata)</label> </td> 
          <td width="32%" style="font-size:11px;"><input type="checkbox" name="infusione" value="1" ' . ($otherSurfaceCondition != ''? 'checked="checked"' : '') . ' readonly="true" /> <label> ALTRO: ' .  $otherSurfaceCondition. ' </label> </td> 
     </tr>  
  </tbody>
</table> '; 

$pdf->html($surfaceConditionsTable ); 
  
$structurePositions = array_column($data["structurePositions"], 'structurePosition');
$positions = '
<style>
td{
border: 1px solid '.$insideTable .';
}
table{
border: 2px solid '.$outlineTable .';
}
</style>
  <table   cellpadding="4" style="font-size:13px;  "> 
  <tbody>
     <tr>
          <td width="100%" bgcolor="'.$lightBlue.'"><b>POSIZIONE DELLA STRUTTURA   </b></td> 
     </tr>
     <tr>  
          <td width="32%" style="font-size:11px;"><input type="checkbox" name="infusione" value="1" ' . (in_array('worksite', $structurePositions) ? 'checked="checked"' : '') . ' readonly="true" /> <label> CANTIERE</label> </td>    
          <td width="36%" style="font-size:11px;"><input type="checkbox" name="infusione" value="1" ' . (in_array('ground', $structurePositions) ? 'checked="checked"' : '') . ' readonly="true" /> <label> A TERRA (senza copertura)</label> </td> 
          <td width="32%" style="font-size:11px;"><input type="checkbox" name="infusione" value="1" ' . (in_array('water', $structurePositions) ? 'checked="checked"' : '') . '  readonly="true" /> <label> IN  ACQUA  </label> </td> 
     </tr>       
  </tbody>
</table> ';
 
$pdf->html($positions );
  
 
$inspectionsTable = '
<style>
td{
border: 1px solid '.$insideTable .';
}
table{
border: 2px solid '.$outlineTable .';
}
</style>
  <table  cellpadding="4" style="font-size:13px;   "> 
  <tbody>
    <tr >
      <td width="100%" bgcolor="'.$lightBlue.'" ><b>INTERFERENZE</b></td> 
    </tr>';
 
foreach ($data["components"] as $component) {
    $inspectionsTable .= '
    <tr >
      <td width="20%" bgcolor="'.$secondLightBlue .'">'.$component->componentIstance.'</td>
      <td width="80%">Note: '.$component->interferences.'</td> 
    </tr>  
    ';
}
$inspectionsTable .= '  
  </tbody>
</table> ';
 
$pdf->html($inspectionsTable );

$pdf->Ln( 8);
$proc = $inspection->specificProcedure!=null ? $inspection->specificProcedure : "";
$acc = $inspection->accessibility!=null ? $inspection->accessibility : ""; 
$examinationTechniques = array_column($data["examinationTechniques"], 'examinationTechnique');
$calibrations = array_column($data["calibrations"], 'calibration');
$proceduresTable = '
<style>
td{
border: 1px solid '.$insideTable .';
}
table{
border: 2px solid '.$outlineTable .';
}
</style>
  <table  cellpadding="4" style="font-size:13px;   "> 
  <tbody>
    <tr >
      <td    width="100%" bgcolor="'.$lightGrey.'" align="center"><b>TECNICHE D\' ESAME & PROCEDURA D\'ISPEZIONE</b></td> 
    </tr>
    <tr >
      <td width="30%" >Procedura specifica</td>
      <td width="70%">'.$proc.'</td> 
    </tr>   
    <tr >
      <td width="30%"  style=" border-bottom: 1px solid '.$blue .';">Criteri di accettabilità</td>
      <td width="70%" style=" border-bottom: 1px solid '.$blue .';">'.$acc.'</td> 
    </tr>    
     <tr align="center">  
          <td width="32%" style="font-size:11px; border: 1px solid '.$blue .'; border-top: 1px solid '.$blue .';"><input type="checkbox" name="infusione" value="1" ' . (in_array('UTPE', $examinationTechniques) ? 'checked="checked"' : '') . ' readonly="true" /> <label>UT PE(Eco/impulso)</label> </td>    
          <td width="36%" style="font-size:11px;  border: 1px solid '.$blue .'; border-top: 1px solid '.$blue .';"><input type="checkbox" name="infusione" value="1" ' . (in_array('PA', $examinationTechniques) ? 'checked="checked"' : '') . ' readonly="true" /> <label>PA (C-S scan)</label> </td> 
          <td width="32%" style="font-size:11px;  border: 1px solid '.$blue .'; border-top: 1px solid '.$blue .';"><input type="checkbox" name="infusione" value="1" ' . (in_array('TT', $examinationTechniques) ? 'checked="checked"' : '') . '  readonly="true" /> <label> TT (Termografia attiva) </label> </td> 
     </tr>       
     <tr align="center">  
          <td width="40%" style="font-size:11px; border-bottom: 1px solid '.$orange .';"><input type="checkbox" name="infusione" value="1" ' . (in_array('TX', $examinationTechniques) ? 'checked="checked"' : '') . ' readonly="true" /> <label>TX</label> </td>    
          <td width="20%" style="font-size:11px; border-bottom: 1px solid '.$orange .'; " bgcolor="'.$orange.'" align="center"> TECNICHE COMBINATE </td> 
          <td width="40%" style="font-size:11px; border-bottom: 1px solid '.$orange .';"><input type="checkbox" name="infusione" value="1" ' . (in_array('PX', $examinationTechniques) ? 'checked="checked"' : '') . '  readonly="true" /> <label> PX  </label> </td> 
     </tr>      
    <tr >
      <td  width="100%"   style="font-size: 9px;"  align="center"><b>UT PE :</b> tecnica per riflessione  a contatto; <b>PA :</b> tecnica Phased Array;  <b>TT :</b> termograa a transitorio termico;  <b>TX :</b> Thermosonics; <b>PX :</b> Phaseography</td> 
    </tr> 
    <tr >
      <td    width="100%" bgcolor="'.$lightGrey.'" align="center"><b>CALIBRAZIONE</b></td> 
    </tr>
     <tr>  
          <td width="32%" style="font-size:11px;"><input type="checkbox" align="center" name="infusione" value="1" ' . (in_array('reference block', $calibrations) ? 'checked="checked"' : '') . ' readonly="true" /> <label> Blocco di riferimento</label> </td>    
          <td width="36%" style="font-size:11px;"><input type="checkbox" align="center" name="infusione" value="1" ' . (in_array('representative reference block', $calibrations) ? 'checked="checked"' : '') . ' readonly="true" /> <label> Blocco di rif.to rappresentativo</label> </td> 
          <td width="32%" style="font-size:11px;"><input type="checkbox" align="center" name="infusione" value="1" ' . (in_array('directly on the structure', $calibrations) ? 'checked="checked"' : '') . '  readonly="true" /> <label> Direttamente sulla struttura</label> </td> 
     </tr>  
    <tr >
      <td  width="100%" style="font-size:12px;" >NOTE: '.$inspection->calibrationNotes .' </td> 
    </tr>   
  </tbody>
</table> '; 
 
$pdf->html($proceduresTable );
 
$ultrasounds =  $data["ultrasounds"] ;
$apparecchiature = '
<style>
td{
border: 1px solid '.$insideTable .';
}
table{
border: 2px solid '.$outlineTable .';
}
</style>
  <table   cellpadding="4" style="font-size:13px;  "> 
  <tbody>
     <tr>
          <td width="100%" bgcolor="'.$lightGrey.'" align="center"><b>APPARECCHIATURE</b></td> 
     </tr>';

foreach($ultrasounds as $ultrasound){
      $waterChecked = '';
      $gelChecked = ''; 

      //dimensions check
      $check10 = ''; 
      $check12 = ''; 
      $check25 = ''; 
      $check20 = ''; 
      $check16 = ''; 
      $check64 = ''; 
      $checkOther = ''; 

      //frequency check
      $check05 = '';
      $check1='';
      $check2='';
      $check3='';
      $check5='';


      //check details
      $checkSingleCristal = '';
      $checkPhasedArray = '';
      $checkDelayLine = '';
      $checkExternalPlinth = '';
      $checkRollerProbe = ''; 

      foreach ($data["couplers"] as $coupler) {
          if ($coupler->fk_idUltrasound == $ultrasound->idUltrasoundInspection) {
              if ($coupler->coupler == 'water') {
                  $waterChecked = 'checked="checked"';
              }
              if ($coupler->coupler == 'gel') {
                  $gelChecked = 'checked="checked"';
              } 
          }
      }
      foreach ($data["dimensions"] as $dimension) {
          if ($dimension->fk_idUltrasound == $ultrasound->idUltrasoundInspection) {
              if ($dimension->probeDimension == 10) {
                  $check10 = 'checked="checked"';
              }
              if ($dimension->probeDimension == 12.5) {
                  $check12 = 'checked="checked"';
              }
              if ($dimension->probeDimension == 25) {
                  $check25 = 'checked="checked"';
              }
              if ($dimension->probeDimension == 20) {
                  $check20 = 'checked="checked"';
              }
              if ($dimension->probeDimension == 'PA 16 elements') {
                  $check16 = 'checked="checked"';
              }
              if ($dimension->probeDimension == 'PA 64 elements') {
                  $check64 = 'checked="checked"';
              }
              if ($dimension->probeDimension == 'other') {
                  $checkOther = 'checked="checked"';
              }
          }
      }

      foreach ($data["frequencies"] as $frequency) {
          if ($frequency->fk_idUltrasound == $ultrasound->idUltrasoundInspection) {
              if ($frequency->probeFrequency == 0.5) {
                  $check05 = 'checked="checked"';
              } 

              if($frequency->probeFrequency == 1){
                  $check1 = 'checked="checked"';
              }
              if($frequency->probeFrequency == 2.25){
                  $check2 = 'checked="checked"';
              }
              if($frequency->probeFrequency == 3.5){
                  $check3 = 'checked="checked"';
              }
              if($frequency->probeFrequency == 5){
                  $check5 = 'checked="checked"';
              }
          }
      }

       
      foreach($data["details"] as $detail){
          if($detail->fk_idUltrasound == $ultrasound->idUltrasoundInspection){
              if($detail->probeDetail == 'single cristal'){
                  $checkSingleCristal = 'checked="checked"';
              } 
              if($detail->probeDetail == 'phased array'){
                  $checkPhasedArray = 'checked="checked"';
              }
              if($detail->probeDetail == 'delay line'){
                  $checkDelayLine = 'checked="checked"';
              }
              if($detail->probeDetail == 'external plinth'){
                  $checkExternalPlinth = 'checked="checked"';
              }
              if($detail->probeDetail == 'roller probe'){
                  $checkRollerProbe = 'checked="checked"';
              }
          }
      }
 
    
     $apparecchiature .= '
     <tr>  
          <td width="15%"  bgcolor="'.$bluWater.'" style="font-size:11px;"><b>ULTRASUONI</b> </td>    
          <td width="26%" bgcolor="'.$thirdLightBlue.'"    style="font-size:11px;">  '.$ultrasound->ultrasound .' </td> 
          <td width="24%" bgcolor="'.$thirdLightBlue.'"    style="font-size:11px;"> SN:  '.$ultrasound->sn .' </td> 
          <td width="25%" style="font-size:11px;"> Scadenza calibrazione </td> 
          <td width="10%"  style="font-size:11px;"> '.$ultrasound->expiration .' </td> 
      </tr>
      <tr>  
          <td width="15%"  bgcolor="'.$secondLightBlue.'" style="font-size:11px;">SONDA </td>    
          <td width="26%"    style="font-size:11px;">  '.$ultrasound->probe .' </td> 
          <td width="24%" bgcolor="'.$secondLightBlue.'"    style="font-size:11px;"> ACCOPPIANTE </td> 
          <td width="17%" style="font-size:11px;"> <input type="checkbox" name="infusione" value="1" ' . $waterChecked . ' readonly="true" /> <label for="infusione"> acqua </label> </td> 
          <td width="18%"  style="font-size:11px;"> <input type="checkbox" name="infusione" value="1" ' . $gelChecked . ' readonly="true" /> <label for="infusione"> gel </label>  </td> 
      </tr>
      <tr>   
          <td width="15%" bgcolor="'.$secondLightBlue.'"    style="font-size:11px;"> DIMENSIONE </td> 
          <td width="9%" style="font-size:11px;"> <input type="checkbox" name="infusione" value="1" ' . $check10 . ' readonly="true" /> <label for="infusione"> 10 </label> </td> 
          <td width="9%"  style="font-size:11px;"> <input type="checkbox" name="infusione" value="1" ' . $check12 . ' readonly="true" /> <label for="infusione"> 12.5 </label>  </td> 
          <td width="8%"  style="font-size:11px;"> <input type="checkbox" name="infusione" value="1" ' . $check20 . ' readonly="true" /> <label for="infusione"> 20 </label>  </td> 
          <td width="7%"  style="font-size:11px;"> <input type="checkbox" name="infusione" value="1" ' . $check25 . ' readonly="true" /> <label for="infusione"> 25 </label>  </td> 
          <td width="17%"  style="font-size:11px;"> <input type="checkbox" name="infusione" value="1" ' . $check16 . ' readonly="true" /> <label for="infusione"> PA 16 elementi </label>  </td> 
          <td width="17%"  style="font-size:11px;"> <input type="checkbox" name="infusione" value="1" ' . $check64 . ' readonly="true" /> <label for="infusione"> PA 64 elementi </label>  </td> 
          <td width="18%"  style="font-size:11px;"> <input type="checkbox" name="infusione" value="1" ' . $checkOther . ' readonly="true" /> <label for="infusione"> altro </label>  </td> 
      </tr> 
      <tr>   
          <td width="15%" bgcolor="'.$secondLightBlue.'"    style="font-size:11px;"> FREQUENZA  </td> 
          <td width="18%" style="font-size:11px;"> <input type="checkbox" name="infusione" value="1" ' . $check05 . ' readonly="true" /> <label for="infusione"> 0.5 (Mhz)</label> </td> 
          <td width="15%"  style="font-size:11px;"> <input type="checkbox" name="infusione" value="1" ' . $check1 . ' readonly="true" /> <label for="infusione"> 1(Mhz)</label>  </td> 
          <td width="17%"  style="font-size:11px;"> <input type="checkbox" name="infusione" value="1" ' . $check2 . ' readonly="true" /> <label for="infusione"> 2.25 (Mhz)</label>  </td> 
          <td width="17%"  style="font-size:11px;"> <input type="checkbox" name="infusione" value="1" ' . $check3 . ' readonly="true" /> <label for="infusione"> 3.5 (Mhz)</label>  </td> 
          <td width="18%"  style="font-size:11px;"> <input type="checkbox" name="infusione" value="1" ' . $check5 . ' readonly="true" /> <label for="infusione"> 5 (Mhz)</label>  </td> 
      </tr>
      <tr>   
          <td width="15%" bgcolor="'.$secondLightBlue.'"    style="font-size:11px;"> DETTAGLI  </td> 
          <td width="18%" style="font-size:11px;"> <input type="checkbox" name="infusione" value="1" ' . $checkSingleCristal . ' readonly="true" /> <label for="infusione"> Cristallo singolo</label> </td> 
          <td width="15%"  style="font-size:11px;"> <input type="checkbox" name="infusione" value="1" ' . $checkPhasedArray . ' readonly="true" /> <label for="infusione">phased array</label>  </td> 
          <td width="17%"  style="font-size:11px;"> <input type="checkbox" name="infusione" value="1" ' . $checkDelayLine . ' readonly="true" /> <label for="infusione"> linea di ritardo</label>  </td> 
          <td width="17%"  style="font-size:11px;"> <input type="checkbox" name="infusione" value="1" ' . $checkExternalPlinth . ' readonly="true" /> <label for="infusione"> zoccolo est.</label>  </td> 
          <td width="18%"  style="font-size:11px;"> <input type="checkbox" name="infusione" value="1" ' . $checkRollerProbe . ' readonly="true" /> <label for="infusione"> sonda a rullo</label>  </td> 
      </tr>';
}
   $apparecchiature .= '      
  </tbody>
</table> ';
 
$pdf->html($apparecchiature );

$conclusions = '
<style> 
table{
border: 2px solid '.$outlineTable .';
}
</style>
  <table   cellpadding="4" style="font-size:13px;  "> 
  <tbody>
     <tr>
          <td width="100%" bgcolor="'.$grey.'"><b>CONCLUSIONI</b></td> 
     </tr>
     <tr>  
          <td width="100%" bgcolor="'.$lightGrey.'" style="font-size:13px;">  '. $inspection->conclusions.'  </td>    
      </tr>   
     <tr>  
          <td width="100%" bgcolor="'.$lightGrey.'" style="font-size:9px;"> Nota generale:
Nonostante l’indagine sia stata condotta con la massima cura ed attenzione, non è possibile garantire la rilevazione e la segnalazione di tutte le
discontinuità presenti nel laminato al momento del controllo. Per quanto sia stato utilizzato un processo di controllo ottimizzato esistono categorie
difettologiche che per dimensioni o specicità potrebbero non essere rilevate con certezza con questa o altre tecniche d’esame non distruttivo. </td>    
      </tr>    
  </tbody>
</table> ';
 
$pdf->html($conclusions );

$signaturesTable = '
<style> 
td{
border: 1px solid '.$insideTable .';
}
table{
border: 2px solid '.$outlineTable .';
}
</style>
  <table   cellpadding="4" style="font-size:13px;  "> 
  <tbody>
     <tr>
          <td width="34%" bgcolor="'.$lightGrey.'"><b>TECNICO CND</b></td> 
          <td width="34%" bgcolor="'.$lightGrey.'"><b>PREPARATO DA</b></td> 
          <td width="32%" bgcolor="'.$lightGrey.'"><b>CONTROLLATO DA</b></td> 
     </tr>
     <tr> <td width="34%"> ';
     foreach($data["users"] as $user){  
          $signaturesTable .= $user->name. ' '. $user->surname.'<br>'. $user->qualifications.'<br>';
          $idUser = $user->idUser;

          //print specialist signature
          $dirFirma = PUBLICROOT.'/signatures/'.$idUser;
          $files = array();
          
          if(is_dir($dirFirma)){
                $files = array_diff(scandir($dirFirma), array('.', '..')); 
          } 

          if($files){ 
                foreach ($files as $file) {   
                    $signaturesTable .='<img height="50" src="'.$dirFirma.'/'.$file.'">';
                }  
          } 
 
     }
     $signaturesTable .='</td>
     
          <td width="34%"  ></td> 
          <td width="32%"  > ';
          if($data["reviewer"]){
              $reviewer = $data["reviewer"];
              $signaturesTable .= $reviewer->name. ' '. $reviewer->surname.'<br>'. $reviewer->qualifications.'<br>';
              $idUser = $reviewer->idUser;

              //print specialist signature
              $dirFirma = PUBLICROOT.'/signatures/'.$idUser;
              $files = array();
              
              if(is_dir($dirFirma)){
                    $files = array_diff(scandir($dirFirma), array('.', '..')); 
              } 

              if($files){ 
                    foreach ($files as $file) {   
                        $signaturesTable .='<img height="50" src="'.$dirFirma.'/'.$file.'">';
                    }  
              } 
          }

$signaturesTable .= ' </td> </tr>   
     <tr>   
          <td width="34%"  >Luogo: '.$data["inspection"]->location.' </td> 
          <td width="66%" >Data emissione report: '.$data["inspection"]->date.'  </td>   
      </tr>    
  </tbody>
</table> ';
 
$pdf->html($signaturesTable ); 
 
// reset pointer to the last page
$pdf->lastPage();  
 