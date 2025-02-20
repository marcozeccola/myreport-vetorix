<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php';  
?>

<section id="portfolio" class="portfolio section-bg">

     <div class="container">  
          <div class="d-flex justify-content-center" style="margin-top: 3%">
               <div class="row text-center  ">
                    <h3>Edit surface conditions</h3>
                    <form action="<?php echo URLROOT ?>/structurePositions/edit" method="POST" enctype="multipart/form-data">
 
                         <input type="hidden" name="idInspection" value="<?php echo $data["idInspection"]; ?>">
 

                         <div class="form-outline mb-4">
                              <label class="form-label" ><b>Type</b></label>
                              <div class="form-check">
                                   <label class="form-check-label" for="cantiere">
                                        <input class="form-check-input" value="cantiere" type="checkbox" name="positions[]" id="cantiere"  <?php foreach($data["positions"] as $position){ if($position->structurePosition  == "cantiere") echo "checked"; }?>    >
                                        Cantiere
                                   </label>
                              </div>
                              <div class="form-check">
                                   <label class="form-check-label" for="terra">
                                        <input class="form-check-input" value="terra"  type="checkbox" name="positions[]" id="terra" <?php foreach($data["positions"] as $position){ if($position->structurePosition  == "terra") echo "checked"; }?>  >
                                        A terra
                                   </label>
                              </div>
                              <div class="form-check">
                                   <label class="form-check-label" for="acqua">
                                        <input class="form-check-input"  value="acqua" type="checkbox" name="positions[]" id="acqua"  <?php foreach($data["positions"] as $position){ if($position->structurePosition  == "acqua") echo "checked"; }?>  >
                                        In acqua
                                   </label>
                              </div>
                         </div> 

                         <!-- Submit button -->
                         <button type="submit" class="btn btn-primary btn-block mb-4">
                              SAVE 
                         </button>
                    </form>
               </div>
          </div>
     </div>
</section>
<?php
   require APPROOT . '/views/includes/footer.php';
?>
