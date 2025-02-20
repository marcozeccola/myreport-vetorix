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
                    <h3>Edit Conclusions</h3>
                    <form action="<?php echo URLROOT ?>/inspections/editConclusions" method="POST" enctype="multipart/form-data">
 
                         <input type="hidden" name="idInspection" value="<?php echo $data["inspection"]->idInspection; ?>">
 
                         <div class="form-outline mb-4">
                              <label class="form-label" for="conclusions"><b>Conclusions</b></label>
                              <input type="text" id="conclusions" name="conclusions" class="form-control" value="<?php echo $data["inspection"]->conclusions; ?>"  />
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
