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
                    <h3>Add areas</h3>
                    <form action="<?php echo URLROOT ?>/inspectionComponents/addInspectionComponent" method="POST"
                         enctype="multipart/form-data">

                         <input type="hidden" name="idInspection" value="<?php echo $_GET["idInspection"] ?>">

                         <div class="form-outline mb-4"> 
                                   <?php
                                   foreach($data["components"] as $component) {
                                      
                                   ?>
                                   <div class="form-check"> 
                                        <input class="form-check-input" type="checkbox" value="<?php echo $component->idComponentIstance; ?>" name="idComponentIstance[]" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                             <?php echo $component->componentIstance; ?>
                                        </label>
                                   </div> 
                                   <?php } ?>

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