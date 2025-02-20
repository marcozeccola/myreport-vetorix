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
                    <h3>Enter <b>new</b> Inspection</h3>
                    <form action="<?php echo URLROOT ?>/inspections/addBasicInfo" method="POST" enctype="multipart/form-data">

                         <input type="hidden" name="idModelIstance" value="<?php echo $data["idModelIstance"] ?>">

                         <div class="form-outline mb-4">
                              <label class="form-label" for="date"><b>Date</b></label>
                              <input type="date" id="date" name="date" class="form-control" required />
                         </div>
                          
                         <div class="form-outline mb-4">
                              <label class="form-label" for="client"><b>Client</b></label>
                              <input type="text" id="client" name="client" class="form-control" required />
                         </div>
 
                         <div class="form-outline mb-4">
                              <label class="form-label" for="projectId"><b>Prog. VTX</b></label>
                              <input type="text" id="projectId" name="projectId" class="form-control" required />
                         </div>
 
                         <div class="form-outline mb-4">
                              <label class="form-label" for="builder"><b>Builder</b></label>
                              <input type="text" id="builder" name="builder" class="form-control" required />
                         </div>

                         <div class="form-outline mb-4">
                              <label class="form-label" for="factory"><b>Factory</b></label>
                              <input type="text" id="factory" name="factory" class="form-control" required />
                         </div>

                         <div class="form-outline mb-4">
                              <label class="form-label" for="year"><b>Year</b></label>
                              <input type="number" min="1900" max="3000" step="1" id="year" name="year" class="form-control" required />
                         </div>

                         <div class="form-outline mb-4">
                              <label class="form-label" for="location"><b>Location</b></label>
                              <input type="text" id="location" name="location" class="form-control" required />
                         </div>

                         <div class="form-outline mb-4">
                              <label class="form-label" for="goal"><b>Goal</b></label>
                              <input type="text" id="goal" name="goal" class="form-control" required />
                         </div>

                         <div class="form-outline mb-4">
                              <label class="form-label" for="goalNotes"><b>Goal notes</b></label>
                              <input type="text" id="goalNotes" name="goalNotes" class="form-control" required />
                         </div>

                         <div class="form-outline mb-4">
                              <label class="form-label"  ><b>Type</b></label>
                              <div class="form-check">
                                   <label class="form-check-label" for="new">
                                        <input class="form-check-input" value="new" type="radio" name="type" id="new">
                                        New
                                   </label>
                              </div>
                              <div class="form-check">
                                   <label class="form-check-label" for="aftersale">
                                        <input class="form-check-input" value="aftersale"  type="radio" name="type" id="aftersale">
                                        Aftersale
                                   </label>
                              </div>
                              <div class="form-check">
                                   <label class="form-check-label" for="other">
                                        <input class="form-check-input"  value="other" type="radio" name="type" id="other">
                                        Other
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