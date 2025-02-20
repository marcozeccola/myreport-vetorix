<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
?> 
<div style="margin-left: 20px!important;">
  <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" >
    <ol class="breadcrumb"> 
      <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/folders/">Folders</a></li>   
      <?php  
         foreach($data["tree"] as $folder){ 
      ?>

            <li class="breadcrumb-item"><a
                  href="<?php echo URLROOT; ?>/folders/index?idFolder=<?php echo $folder->idFolder; ?>"><?php echo $folder->folder; ?></a>
            </li>

      <?php
            } 
      ?>   

    </ol>
  </nav>
</div>
<div class="d-flex justify-content-center" style="margin-top: 10%">
   <div class="row text-center  ">
      <h3>Enter <b>new</b> model</h3>
      <form action="<?php echo URLROOT ?>/models/addModel" method="POST" enctype="multipart/form-data"> 

          <input type="hidden" name="idFolder" value="<?php echo $data["idFolder"] ?>">
          <!-- idFolder input -->
          <div class="form-outline mb-4">
               <label class="form-label" for="model"><b>Model name</b></label>
               <input type="text" id="model" name="model" class="form-control" required/>
          </div>

          <!-- Submit button -->
          <button type="submit" class="btn btn-primary btn-block mb-4">
                    SAVE
                    <i class="bi bi-plus-circle-dotted"></i>
          </button> 
      </form>
   </div>
</div>

<?php
   require APPROOT . '/views/includes/footer.php';
?>