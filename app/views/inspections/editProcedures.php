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
                    <h3>Edit inspection procedures & techniques</h3>
                    <form action="<?php echo URLROOT ?>/inspections/editProcedures" method="POST" enctype="multipart/form-data">
 
                         <input type="hidden" name="idInspection" value="<?php echo $data["inspection"]->idInspection; ?>">
 
                         <div class="form-outline mb-4">
                              <label class="form-label" for="procedure"><b>Specific procedure</b></label>
                              <input type="text" id="procedure" name="procedure" class="form-control" value="<?php echo $data["inspection"]->specificProcedure; ?>"  />
                         </div>

                         <div class="form-outline mb-4">
                              <label class="form-label" for="accessibility"><b>Acceptability criteria</b></label>
                              <input type="text" id="accessibility" name="accessibility" class="form-control" value="<?php echo $data["inspection"]->accessibility; ?>" />
                         </div>

                         <div class="form-outline mb-4">
                              <label class="form-label" ><b>Techniques</b></label>
                              <div class="form-check">
                                   <label class="form-check-label" for="ut">
                                        <input class="form-check-input" value="UTPE" type="checkbox" name="techniques[]" id="ut"  
                                        <?php foreach($data["techniques"] as $tec){ if($tec->examinationTechnique  == "UTPE") echo "checked"; }?>    >
                                        UT PE (Eco/impulse)
                                   </label>
                              </div>
                              <div class="form-check">
                                   <label class="form-check-label" for="PA">
                                        <input class="form-check-input" value="PA"  type="checkbox" name="techniques[]" id="PA" 
                                        <?php foreach($data["techniques"] as $tec){ if($tec->examinationTechnique  == "PA") echo "checked"; }?>  >
                                        PA (C-S scan)
                                   </label>
                              </div>
                              <div class="form-check">
                                   <label class="form-check-label" for="TT">
                                        <input class="form-check-input"  value="TT" type="checkbox" name="techniques[]" id="TT"  
                                        <?php foreach($data["techniques"] as $tec){ if($tec->examinationTechnique   == "TT") echo "checked"; }?>  >
                                        TT (active thermography)
                                   </label>
                              </div>
                              <div class="form-check">
                                   <label class="form-check-label" for="TX">
                                        <input class="form-check-input"  value="TX" type="checkbox" name="techniques[]" id="TX"  
                                        <?php foreach($data["techniques"] as $tec){ if($tec->examinationTechnique   == "TX") echo "checked"; }?>  >
                                        TX  
                                   </label>
                              </div>
                              <div class="form-check">
                                   <label class="form-check-label" for="PX">
                                        <input class="form-check-input"  value="PX" type="checkbox" name="techniques[]" id="PX"  
                                        <?php foreach($data["techniques"] as $tec){ if($tec->examinationTechnique   == "PX") echo "checked"; }?>  >
                                        PX  
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
