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
                    <h3>Edit Calibrations</h3>
                    <form action="<?php echo URLROOT ?>/inspections/editCalibrations" method="POST" enctype="multipart/form-data">
 
                         <input type="hidden" name="idInspection" value="<?php echo $data["inspection"]->idInspection; ?>">
 
                         <div class="form-outline mb-4">
                              <label class="form-label" for="calibrationNotes"><b>Calibration notes</b></label>
                              <input type="text" id="calibrationNotes" name="calibrationNotes" class="form-control" value="<?php echo $data["inspection"]->calibrationNotes; ?>"  />
                         </div>
 
                         <div class="form-outline mb-4">
                              <label class="form-label" ><b>Calibrations</b></label>
                              <div class="form-check">
                                   <label class="form-check-label" for="reference">
                                        <input class="form-check-input" value="reference block" type="checkbox" name="calibrations[]" id="reference"  
                                        <?php foreach($data["calibrations"] as $calibration){ if($calibration->calibration  == "reference block") echo "checked"; }?>    >
                                        Reference block
                                   </label>
                                   <div class="form-check">
                                        <label class="form-check-label" for="representative">
                                             <input class="form-check-input" value="representative reference block" type="checkbox" name="calibrations[]" id="representative"  
                                             <?php foreach($data["calibrations"] as $calibration){ if($calibration->calibration  == "representative reference block") echo "checked"; }?>    >
                                             Representative reference block
                                        </label>
                                   </div> 
                                   <div class="form-check">
                                        <label class="form-check-label" for="directly">
                                             <input class="form-check-input" value="directly on the structure" type="checkbox" name="calibrations[]" id="directly"  
                                             <?php foreach($data["calibrations"] as $calibration){ if($calibration->calibration  == "directly on the structure") echo "checked"; }?>    >
                                             Directly on the structure 
                                        </label>
                                   </div> 
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
