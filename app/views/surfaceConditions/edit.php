

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
                    <h3>Edit structure position</h3>
                    <form action="<?php echo URLROOT ?>/surfaceConditions/edit" method="POST" enctype="multipart/form-data">
 
                         <input type="hidden" name="idInspection" value="<?php echo $data["idInspection"]; ?>">
 

                         <div class="form-outline mb-4">
                              <label class="form-label" ><b>Position</b></label>
                              <div class="form-check">
                                   <label class="form-check-label" for="opaco">
                                        <input class="form-check-input" value="gel coat opaco" type="checkbox" name="conditions[]" id="opaco" 
                                         <?php foreach($data["conditions"] as $condition){ if($condition->surfaceCondition  == "gel coat opaco") echo "checked"; }?>    >
                                        gel coat opaco
                                   </label>
                              </div>
                              <div class="form-check">
                                   <label class="form-check-label" for="first">
                                        <input class="form-check-input" value="1st step carrozzeria" type="checkbox" name="conditions[]" id="first" 
                                         <?php foreach($data["conditions"] as $condition){ if($condition->surfaceCondition  == "1st step carrozzeria") echo "checked"; }?>    >
                                        1st step carrozzeria
                                   </label>
                              </div>
                              <div class="form-check">
                                   <label class="form-check-label" for="verniciato">
                                        <input class="form-check-input" value="verniciato" type="checkbox" name="conditions[]" id="verniciato" 
                                         <?php foreach($data["conditions"] as $condition){ if($condition->surfaceCondition  == "verniciato") echo "checked"; }?>    >
                                        verniciato
                                   </label>
                              </div>
                              <div class="form-check">
                                   <label class="form-check-label" for="lucido">
                                        <input class="form-check-input" value="gel coat lucido" type="checkbox" name="conditions[]" id="lucido" 
                                         <?php foreach($data["conditions"] as $condition){ if($condition->surfaceCondition  == "gel coat lucido") echo "checked"; }?>    >
                                        gel coat lucido
                                   </label>
                              </div>
                              <div class="form-check">
                                   <label class="form-check-label" for="second">
                                        <input class="form-check-input" value="2nd step carrozzeria" type="checkbox" name="conditions[]" id="second" 
                                         <?php foreach($data["conditions"] as $condition){ if($condition->surfaceCondition  == "2nd step carrozzeria") echo "checked"; }?>    >
                                        2nd step carrozzeria
                                   </label>
                              </div>

                              <?php
                              $other = "";
                              foreach($data["conditions"] as $condition){
                                   if($condition->surfaceCondition  != "2nd step carrozzeria"
                                   && $condition->surfaceCondition  != "gel coat lucido"
                                   && $condition->surfaceCondition  != "verniciato"
                                   && $condition->surfaceCondition  != "1st step carrozzeria"
                                   && $condition->surfaceCondition  != "gel coat opaco"){
                                        $other = $condition->surfaceCondition;
                                   }
                              }
                              ?>

                              
                              <div class="form-outline mb-4">
                                   <label class="form-label" for="other"><b>Other</b></label>
                                   <input type="text" id="other" name="other" class="form-control" value="<?php echo $other; ?>"   />
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