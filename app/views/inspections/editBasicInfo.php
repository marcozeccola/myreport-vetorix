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
                    <form action="<?php echo URLROOT ?>/inspections/editBasicInfo" method="POST" enctype="multipart/form-data">

                         <input type="hidden" name="idInspection" value="<?php echo $data["inspection"]->idInspection; ?>">

                         <div class="form-outline mb-4">
                              <label class="form-label" for="date"><b>Date</b></label>
                              <input type="date" id="date" name="date" class="form-control" value="<?php echo $data["inspection"]->date ; ?>" required />
                         </div>
                          
                         <div class="form-outline mb-4">
                              <label class="form-label" for="client"><b>Client</b></label>
                              <input type="text" id="client" name="client" class="form-control" value="<?php echo $data["inspection"]->client ; ?>" required />
                         </div>
 
                         <div class="form-outline mb-4">
                              <label class="form-label" for="projectId"><b>Prog. VTX</b></label>
                              <input type="text" id="projectId" name="projectId" class="form-control" value="<?php echo $data["inspection"]->projectId ; ?>"  required />
                         </div>
 
                         <div class="form-outline mb-4">
                              <label class="form-label" for="builder"><b>Builder</b></label>
                              <input type="text" id="builder" name="builder" class="form-control" value="<?php echo $data["inspection"]->builder ; ?>"   required />
                         </div>

                         <div class="form-outline mb-4">
                              <label class="form-label" for="factory"><b>Factory</b></label>
                              <input type="text" id="factory" name="factory" class="form-control" value="<?php echo $data["inspection"]->factory ; ?>"  required />
                         </div>

                         <div class="form-outline mb-4">
                              <label class="form-label" for="year"><b>Year</b></label>
                              <input type="number" min="1900" max="3000" step="1" id="year" name="year" value="<?php echo $data["inspection"]->year ; ?>"  class="form-control" required />
                         </div>

                         <div class="form-outline mb-4">
                              <label class="form-label" for="location"><b>Location</b></label>
                              <input type="text" id="location" name="location" class="form-control" value="<?php echo $data["inspection"]->location ; ?>"  required />
                         </div>

                         <div class="form-outline mb-4">
                              <label class="form-label" for="goal"><b>Goal</b></label>
                              <input type="text" id="goal" name="goal" class="form-control" value="<?php echo $data["inspection"]->goal ; ?>"  required />
                         </div>

                         <div class="form-outline mb-4">
                              <label class="form-label" for="goalNotes"><b>Goal notes</b></label>
                              <input type="text" id="goalNotes" name="goalNotes" class="form-control" value="<?php echo $data["inspection"]->goalNotes ; ?>"  required />
                         </div>

                         <div class="form-outline mb-4">
                              <label class="form-label"  ><b>Type</b></label>
                              <div class="form-check">
                                   <label class="form-check-label" for="new">
                                        <input class="form-check-input" value="new" type="radio" name="type" id="new"  <?php if($data["inspection"]->type  == "new") echo "checked"; ?>    >
                                        New
                                   </label>
                              </div>
                              <div class="form-check">
                                   <label class="form-check-label" for="aftersale">
                                        <input class="form-check-input" value="aftersale"  type="radio" name="type" id="aftersale" <?php if($data["inspection"]->type == "aftersale") echo "checked"; ?>>
                                        Aftersale
                                   </label>
                              </div>
                              <div class="form-check">
                                   <label class="form-check-label" for="other">
                                        <input class="form-check-input"  value="other" type="radio" name="type" id="other" <?php if($data["inspection"]->type  == "other") echo "checked"; ?>>
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