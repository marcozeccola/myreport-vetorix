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
                    <h3>Enter <b>new</b> Ultrasound</h3>
                    <form action="<?php echo URLROOT ?>/ultrasoundinspections/addUltrasound" method="POST" enctype="multipart/form-data">

                         <input type="hidden" name="idInspection" value="<?php echo $_GET["idInspection"]; ?>">

                         <div class="form-outline mb-4">
                              <label class="form-label" for="ultrasound"><b>Ultrasound</b></label>
                              <input type="text" id="ultrasound" name="ultrasound" class="form-control" required />
                         </div>
 
                         <div class="form-outline mb-4">
                              <label class="form-label" for="sn"><b>Serial number</b></label>
                              <input type="text" id="sn" name="sn" class="form-control" required />
                         </div>
 
                         <div class="form-outline mb-4">
                              <label class="form-label" for="expiration"><b>Expiration</b></label>
                              <input type="date" id="expiration" name="expiration" class="form-control" required />
                         </div>
 
                         <div class="form-outline mb-4">
                              <label class="form-label" for="probe"><b>Probe</b></label>
                              <input type="text" id="probe" name="probe" class="form-control" required />
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