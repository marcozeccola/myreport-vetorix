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
                    <h3>Add Reviewer</h3>
                    <form action="<?php echo URLROOT ?>/inspections/addReviewer" method="POST" enctype="multipart/form-data">
 
                         <input type="hidden" name="idInspection" value="<?php echo $_GET["idInspection"]; ?>">
  
 
                         <div class="form-outline mb-4">
                              <label class="form-label" ><b>Reviewer</b></label>
                              <div class="form-check">
                                   <select class="form-select" required  name="idReviewer">
                                        <?php foreach($data["reviewers"] as $user) : ?>
                                            <option value="<?php echo $user->idUser; ?>"><?php echo $user->name . " " . $user->surname; ?></option>
                                        <?php endforeach; ?> 
                                   </select>
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
