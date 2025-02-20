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
                    <h3>Edit notes</h3>
                    <form action="<?php echo URLROOT ?>/inspectionComponents/editNotes" method="POST" enctype="multipart/form-data">

                         <input type="hidden" name="idInspectionComponent" value="<?php echo $data["idInspectionComponent"]; ?>">

                         <div class="form-outline mb-4">
                              <label class="form-label" for="notes"><b>Notes</b></label>
                              <input type="text" id="interferences" name="notes" class="form-control" value="<?php echo $data["notes"] ; ?>" required />
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