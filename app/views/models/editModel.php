<?php
   require APPROOT . '/views/includes/head.php'; 
?>
<?php
  require APPROOT . '/views/includes/navigation.php';  
?>
 <!-- Section: Design Block -->
<section class="">
  <!-- Jumbotron -->
  <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
    <div class="container">
      <div class="row gx-lg-5 align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0 "> 
          <h1 class="my-5 display-3 fw-bold ls-tight">
            Change model name <br /> 
          </h1> 
        </div>

        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="card">
            <div class="card-body py-5 px-md-5">
              <form action="<?php echo URLROOT ?>/models/changeModelName" method="POST">  
 
 
                    <input type="hidden" name="idModel" value="<?php echo $_GET["idModel"]; ?>"> 
         
                    <div class="form-outline mb-4">
                         <textarea name="model" class="form-control"><?php echo $data["model"]->model; ?></textarea>
                         <label class="form-label" for="model">Model name</label>
                         <br> 
                    </div>  

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4">
                    CHANGE
                    </button> 
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Jumbotron -->
</section>
<?php
  require APPROOT . '/views/includes/footer.php';  
?>