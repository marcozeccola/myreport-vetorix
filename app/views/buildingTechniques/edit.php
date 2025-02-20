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
                    <h3>Edit building techniques of <?php echo $data["component"]->componentIstance; ?></h3>
                    <form action="<?php echo URLROOT ?>/buildingtechniques/edit" method="POST" enctype="multipart/form-data">

                         <input type="hidden" name="idComponent" value="<?php echo $data["idComponent"]; ?>">
                         <input type="hidden" name="idInspection" value="<?php echo $data["idInspection"]; ?>">
 

                         <div class="form-outline mb-4">
                              <label class="form-label" ><b>Type</b></label>
                              <div class="form-check">
                                   <label class="form-check-label" for="infusione">
                                        <input class="form-check-input" value="infusione" type="checkbox" name="tecs[]" id="infusione"  <?php foreach($data["tecs"] as $tec){ if($tec->technique  == "infusione") echo "checked"; }?>    >
                                        Infusione
                                   </label>
                              </div>
                              <div class="form-check">
                                   <label class="form-check-label" for="wet">
                                        <input class="form-check-input" value="wet lay up"  type="checkbox" name="tecs[]" id="wet" <?php foreach($data["tecs"] as $tec){ if($tec->technique  == "wet lay up") echo "checked"; }?>  >
                                        Wet lay up
                                   </label>
                              </div>
                              <div class="form-check">
                                   <label class="form-check-label" for="no">
                                        <input class="form-check-input"  value="no" type="checkbox" name="tecs[]" id="no"  <?php foreach($data["tecs"] as $tec){ if($tec->technique  == "no") echo "checked"; }?>  >
                                        nd
                                   </label>
                              </div>
                         </div> 

                         <!-- Submit button -->
                         <button type="submit" class="btn btn-primary btn-block mb-4">
                              SAVE
                              <i class="bi bi-plus-circle-dotted"></i>
                         </button>
                    </form>
               </div>
          </div>
     </div>
</section>
<?php
   require APPROOT . '/views/includes/footer.php';
?>