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
                    <h3>Edit Ultrasound</h3>
                    <form action="<?php echo URLROOT ?>/ultrasoundInspections/editUltrasound" method="POST"
                         enctype="multipart/form-data">

                         <input type="hidden" name="idUltrasound"
                              value="<?php echo $data["ultrasoundInspection"]->idUltrasoundInspection; ?>">
                         <input type="hidden" name="idInspection"
                              value="<?php echo $data["ultrasoundInspection"]->fk_idInspection; ?>">

                         <div class="form-outline mb-4">
                              <label class="form-label" for="ultrasound"><b>Ultrasound</b></label>
                              <input type="text" id="ultrasound" name="ultrasound" class="form-control"
                                   value="<?php echo $data["ultrasoundInspection"]->ultrasound; ?>" />
                         </div>

                         <div class="form-outline mb-4">
                              <label class="form-label" for="sn"><b>Sn</b></label>
                              <input type="text" id="sn" name="sn" class="form-control"
                                   value="<?php echo $data["ultrasoundInspection"]->sn; ?>" />
                         </div>

                         <div class="form-outline mb-4">
                              <label class="form-label" for="expiration"><b>Expiration</b></label>
                              <input type="date" id="expiration" name="expiration" class="form-control"
                                   value="<?php echo $data["ultrasoundInspection"]->expiration; ?>" />
                         </div>

                         <div class="form-outline mb-4">
                              <label class="form-label" for="probe"><b>Probe</b></label>
                              <input type="text" id="probe" name="probe" class="form-control"
                                   value="<?php echo $data["ultrasoundInspection"]->probe; ?>" />
                         </div>

                         <?php
                              $couplerOptions = ['water', 'gel'];
                              $dimensionOptions = ['10', '12.5', '20', '25', 'PA 16 elements', 'PA 64 elements', 'other'];
                              $frequencyOptions = ['0.5', '1', '2.25', '3.5', '5'];
                              $detailOptions = ['single cristal', 'phased array', 'cdelay line', 'zoccolo est.', 'probe'];

                              function generateCheckboxes($name, $options, $checkedOptions) {
                              foreach ($options as $option) {
                                   $isChecked = in_array($option, $checkedOptions) ? 'checked' : '';
                                   echo "<div class='form-check'>
                                             <input class='form-check-input' type='checkbox' name='{$name}[]' value='{$option}' {$isChecked}>
                                             <label class='form-check-label'>{$option}</label>
                                        </div>";
                              }
                              }
                         ?>

                         <div class="form-outline mb-4">
                              <label class="form-label"><b>Coupler</b></label>
                              <?php generateCheckboxes('coupler', $couplerOptions, $data["checkedCoupler"]); ?>
                         </div>

                         <div class="form-outline mb-4">
                              <label class="form-label"><b>Dimensions</b></label>
                              <?php generateCheckboxes('dimensions', $dimensionOptions, $data["checkedDimensions"]); ?>
                         </div>

                         <div class="form-outline mb-4">
                              <label class="form-label"><b>Frequencies</b></label>
                              <?php generateCheckboxes('frequencies', $frequencyOptions, $data["checkedFrequencies"]); ?>
                         </div>

                         <div class="form-outline mb-4">
                              <label class="form-label"><b>Details</b></label>
                              <?php generateCheckboxes('details', $detailOptions, $data["checkedDetails"]); ?>
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