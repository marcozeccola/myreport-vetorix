<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
?>
<br><br><br>


<select class="form-select" id="ispezioneSelect" style="width:50%!important; margin-left:20%!important;" required>
<option selected value="no">Scegli ispezione</option>
<?php
foreach($data["ispezioni"] as $ispezione){ 

   $link = $ispezione->idIspezioneCostruzione ; 
?>
   
   <option value="<?php echo $link;?>"> <?php echo $ispezione->area; ?>, <?php echo $ispezione->idCustom; ?> - <?php echo $ispezione->luogo; ?> </option>

   <?php

}  

?>
</select> <br>
<button type="button" class="btn btn-primary" id="submitIspezione" style=" margin-left:20%!important;" >APRI</button>
<br>
<button type="button" class="btn btn-primary" id="aggiungiAnomalia" style=" margin-left:20%!important; margin-top:5px!important;" >AGGIUNGI ANOMALIA</button>
<br>
<button type="button" class="btn btn-primary" id="quick" style=" margin-left:20%!important; margin-top:5px!important;" >QUICK REPORT</button>
<br>
<button type="button" class="btn btn-primary" id="report" style=" margin-left:20%!important; margin-top:5px!important;" >REPORT COMPLETO</button>

<br><br>

<select class="form-select" id="progettoSelect" style="width:50%!important; margin-left:20%!important;">
<option selected value="no">Scegli progetto</option>
<?php

foreach($data["progetti"] as $progetto){ 

   $idProgetto = $progetto->idProgetto ;
   ?>
   
   <option value="<?php echo $idProgetto;?>"> <?php echo $progetto->nome; ?> </option>

   <?php

}  

?>
</select> <br>
<button type="button" class="btn btn-primary" id="submitProgetto" style=" margin-left:20%!important;" >APRI</button>
<br>
 <button type="button" class="btn btn-primary" id="creaIspezioneCostruzione" style="margin-left:20%!important; margin-top:5px!important;" >CREA ISPEZIONE COSTRUZIONE</button>

<br><br><br>
<script>
   document.getElementById("submitIspezione").addEventListener("click", (e)=>{
      let idIspezione = document.getElementById('ispezioneSelect').value;
      let link = "<?php echo URLROOT; ?>/anomalie/singleInspection?idIspezione=" + idIspezione;
      if(idIspezione!="no"){ 
         window.location = link;
      }
   });
   
   document.getElementById("aggiungiAnomalia").addEventListener("click", (e)=>{
      let idIspezione = document.getElementById('ispezioneSelect').value;
      let link = "<?php echo URLROOT; ?>/anomalie/addConstructionAnomaly?idIspezione=" + idIspezione;
      if(idIspezione!="no"){ 
         window.location = link;
      }
   });
   
   document.getElementById("quick").addEventListener("click", (e)=>{
      let idIspezione = document.getElementById('ispezioneSelect').value;
      let link = "<?php echo URLROOT; ?>/pdf/quick?idIspezione=" + idIspezione;
      if(idIspezione!="no"){ 
         window.location = link;
      }
   });
   
   document.getElementById("report").addEventListener("click", (e)=>{
      let idIspezione = document.getElementById('ispezioneSelect').value;
      let link = "<?php echo URLROOT; ?>/pdf/report?idIspezione=" + idIspezione;
      if(idIspezione!="no"){ 
         window.location = link;
      }
   });

   document.getElementById("submitProgetto").addEventListener("click", (e)=>{
      let idProgetto = document.getElementById('progettoSelect').value;
      let link = "<?php echo URLROOT; ?>/progetti/singleProject?id=" + idProgetto;
      if(idProgetto!="no"){ 
         window.location = link;
      }
   });
    

   document.getElementById("creaIspezioneCostruzione").addEventListener("click", (e)=>{
      let idProgetto = document.getElementById('progettoSelect').value;
      let link = "<?php echo URLROOT; ?>/ispezioni/addCostructionInspection?idProgetto=" + idProgetto;
      if(idProgetto!="no"){ 
         window.location = link;
      }
   });
</script>
<?php
   require APPROOT . '/views/includes/footer.php';
?>