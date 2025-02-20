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
                    <h3>Edit postcares</h3>
                    <form action="<?php echo URLROOT ?>/postcares/edit" method="POST" enctype="multipart/form-data">

                         <input type="hidden" name="idComponent" value="<?php echo $data["idComponent"]; ?>">
                         <input type="hidden" name="idInspection" value="<?php echo $data["idInspection"]; ?>">
 

                         <div class="form-outline mb-4">
                              <label class="form-label" ><b>Type</b></label>
                              <div class="form-check">
                                   <label class="form-check-label" for="hoven">
                                        <input class="form-check-input" value="hoven" type="checkbox" name="postCare[]" id="hoven"  <?php foreach($data["postCare"] as $postcare){ if($postcare->postCare  == "hoven") echo "checked"; }?>    >
                                        Hoven
                                   </label>
                              </div>
                              <div class="form-check">
                                   <label class="form-check-label" for="lamp">
                                        <input class="form-check-input" value="lamp"  type="checkbox" name="postCare[]" id="lamp" <?php foreach($data["postCare"] as $postcare){ if($postcare->postCare  == "lamp") echo "checked"; }?>  >
                                        Lamp
                                   </label>
                              </div>
                              <div class="form-check">
                                   <label class="form-check-label" for="no">
                                        <input class="form-check-input"  value="no" type="checkbox" name="postCare[]" id="no"  <?php foreach($data["postCare"] as $postcare){ if($postcare->postCare  == "no") echo "checked"; }?>  >
                                        no/nd
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