<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php';  
?>

<section id="portfolio" class="portfolio section-bg">

     <div class="container">
          <div>
               <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                         <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/folders/">Clients</a></li>
                         <?php  
               foreach($data["tree"] as $folder){ 
          ?>
                         <li class="breadcrumb-item"><a
                                   href="<?php echo URLROOT; ?>/folders/index?idFolder=<?php echo $folder->idFolder; ?>"><?php echo $folder->folder; ?></a>
                         </li>
                         <?php
               }  
          ?>
                         <li class="breadcrumb-item" aria-current="page">
                              <a href="<?php echo URLROOT; ?>/models/index?id=<?php echo $data["model"]->idModel; ?>">
                                   <?php echo $data["model"]->model; ?>
                              </a>
                         </li>
                         
                         <li class="breadcrumb-item" aria-current="page">
                              <a href="<?php echo URLROOT; ?>/components/index?id=<?php echo $data["component"]->idComponent; ?>">
                                   <?php echo $data["component"]->component; ?>
                              </a>
                         </li>
                         <li class="breadcrumb-item active" aria-current="page">Add Component's images</li>
                    </ol>
               </nav>
          </div>

          <div class="d-flex justify-content-center" style="margin-top: 3%">
               <div class="row text-center  ">
                    <h3>Add <b>new</b> images</h3>
                    <form action="<?php echo URLROOT ?>/components/addImages" method="POST" enctype="multipart/form-data">

                         <input type="hidden" name="idComponent" value="<?php echo $data["component"]->idComponent ?>">
 
 
                         <div class="form-outline mb-4">
                              <label class="form-label" for="imgs"><b>Images</b></label>
                              <input type="file" id="imgs" name="imgs[]" class="form-control" multiple required />
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