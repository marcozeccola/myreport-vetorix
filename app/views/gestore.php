<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php';
?>

<section id="portfolio" class="portfolio section-bg">
<div style="margin-left: 20px!important;">
  <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" >
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/progetti/">Projects</a></li>
      <li class="breadcrumb-item active" aria-current="page">Charateristics</li>
    </ol>
  </nav>
</div>
      <div class="container" >
         <header class="section-header text-center">
         <h3 class="section-title">Characteristics</h3>
         <p>General characteristics</p>
         </header>
         <div class="text-center">

               <h4 id="tipi">Types of anomalies</h4>
               <p><a class="btn btn-primary" href="<?php echo URLROOT ?>/anomalie/addTypeAnomaly?idProgetto=23">ADD TYPE</a></p>
               <table class="table"> 
                  <tbody>
                     <?php
                        foreach($data["tipiAnomalie"] as $tipo){
                     ?>
                        <tr>
                           <td> 
                              <?php echo $tipo->anomalia;?>        
                           </td>
                           <td> 
                              <a href="<?php echo URLROOT ?>/anomalie/deleteTypeAnomaly?id=<?php echo $tipo->idTipoAnomalia;?>">delete</a>      
                           </td>
                        </tr>
                     <?php
                        }
                     ?>
                     </tbody>
               </table>

               <br>

               <h4 id="sonde">Probes</h4>
               <p><a class="btn btn-primary" href="<?php echo URLROOT ?>/sonde/aggiungiSonda?idProgetto=23">ADD PROBE</a></p>
               <table class="table"> 
                  <tbody>
                     <?php
                        foreach($data["sonde"] as $sonda){
                     ?>
                        <tr>
                           <td> 
                              <?php echo $sonda->sonda;?>        
                           </td>
                           <td> 
                              <a href="<?php echo URLROOT ?>/sonde/eliminaSonda?id=<?php echo $sonda->idSonda;?>">delete</a>      
                           </td>
                        </tr>
                     <?php
                        }
                     ?>
                     </tbody>
               </table>

               <br>

               <h4 id="reticoli">Grids</h4>
               <p><a class="btn btn-primary" href="<?php echo URLROOT ?>/reticoli/aggiungiReticolo?idProgetto=23">ADD GRID</a></p>
               <table class="table"> 
                  <tbody>
                     <?php
                        foreach($data["reticoli"] as $reticolo){
                     ?>
                        <tr>
                           <td> 
                              <?php echo $reticolo->nome;?>        
                           </td>
                           <td> 
                              <a href="<?php echo URLROOT ?>/reticoli/eliminaReticolo?id=<?php echo $reticolo->idReticolo;?>">delete</a>      
                           </td>
                        </tr>
                     <?php
                        }
                     ?>
                     </tbody>
               </table>

               <br> 
               
               <h4 id="strumenti">Instruments</h4>
               <p><a class="btn btn-primary" href="<?php echo URLROOT ?>/strumenti/addTool">ADD INSTRUMENT</a></p>
               <table class="table"> 
                  <tbody>
                     <?php
                        foreach($data["strumenti"] as $strumento){
                     ?>
                        <tr>
                           <td> 
                              <?php echo $strumento->strumento;?>        
                           </td>
                           <td> 
                              <a href="<?php echo URLROOT ?>/strumenti/deleteTool?id=<?php echo $strumento->idStrumento;?>">delete</a>      
                           </td>
                        </tr>
                     <?php
                        }
                     ?>
                     </tbody>
               </table>

               <br>

               </div>
            </div>
         </div>
      </div>
   </section>

<!-- POPUP di errore-->
<div class="modal" id="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">ERROR</h5>
      </div>
      <div class="modal-body">
        <p>
         <?php 
            if(isset($_GET["errore"])){
               if($_GET["errore"]="tipi"){
                  echo "This anomaly is used in some anomalies!";
               }else if($_GET["errore"]=="sonde"){ 
                  echo "This probe is used in some inspections!";
               }else if($_GET["errore"]=="reticoli"){
                  echo "This grid is used in some inspections!";
               }
            }
         ?>
        </p>
      </div>
      <div class="modal-footer">
         <a href="<?php echo URLROOT; ?>/pages/informations<?php 
            if(isset($_GET["errore"])){
               if($_GET["errore"]="tipi"){
                  echo "#tipi";
               }else if($_GET["errore"]=="sonde"){ 
                  echo "#sonde";
               }else if($_GET["errore"]=="reticoli"){
                  echo "#reticoli";
               }
            }
         ?>">
         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button> </a>
      </div>
    </div>
  </div>
</div>

<!-- Mostra popUp solo se presente errore -->
 <?php 
   if(isset($_GET["errore"])){
?>
 <script>
   var myModal = new bootstrap.Modal(document.getElementById("modal"), {});
   document.onreadystatechange = function () {
      myModal.show();
   };
   </script>
<?php }?>
<?php
   require APPROOT . '/views/includes/footer.php';
?>