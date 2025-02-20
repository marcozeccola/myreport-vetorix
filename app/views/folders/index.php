 <?php
   require APPROOT . '/views/includes/head.php';
?>
 <?php
   require APPROOT . '/views/includes/navigation.php'; 
   $idFolder = isset($_GET["idFolder"]) ? $_GET["idFolder"] : 0;  
?>

 <section id="portfolio" class="portfolio section-bg">

    <div class="container">
       <header class="section-header text-center">
          <h3>Clients</h3> 

           <div class="row" style="max-width:60%!important;margin-left:20%!important;">
             <div class="col-lg-2 col-sm-12">
                <a class="btn btn-primary"  
                   href="<?php echo URLROOT; ?>/models/addModel?idFolder=<?php echo $idFolder; ?>">
                   ADD NEW MODEL
                   <i class="bi bi-plus-circle-dotted"></i>
                </a>

             </div> 
             <div class="col-lg-2 col-sm-12">
                <a class="btn btn-primary"  
                   href="<?php echo URLROOT; ?>/folders/addFolder?idFolder=<?php echo $idFolder; ?>">
                   CREATE SUB FOLDER
                   <i class="bi bi-folder-plus"></i>
                </a> 
             </div>
             <?php
               if(isset($_GET["idFolder"]) && $_GET["idFolder"]!=0) {
             ?>
             <div class="col-lg-3 col-sm-12">
                <a class="btn btn-primary"  
                   href="<?php echo URLROOT; ?>/folders/deleteFolder?idFolder=<?php echo $idFolder; ?>">
                   DELETE THIS FOLDER 
                </a> 
             </div>
             <div class="col-lg-3 col-sm-12">
                <a class="btn btn-primary"  
                   href="<?php echo URLROOT; ?>/folders/changeFolderName?idFolder=<?php echo $idFolder; ?>">
                   CHANGE FOLDER NAME 
                </a> 
             </div>
             <?php
             }
             ?>

          </div>
          <br><br> 
 
       </header>
       <br> 

        <div style="margin-left: 20px!important;">
             <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    
                   <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/folders/">Folders</a></li>

                   <?php 
                        $cont =1;
                        foreach($data["tree"] as $folder){
                           if($cont<count($data["tree"])){ 
                     ?>

                           <li class="breadcrumb-item"><a
                                 href="<?php echo URLROOT; ?>/folders/index?idFolder=<?php echo $folder->idFolder; ?>"><?php echo $folder->folder; ?></a>
                           </li>
  
                   <?php
                           }else{
                     ?>
                              <li class="breadcrumb-item active" aria-current="page"><?php echo $folder->folder; ?></li>
                   <?php
                           }
                           $cont++;
                        }

                     ?>

                </ol>
             </nav>
          </div>
 

          <div class="text-center" style="width: 100%; margin: auto">
         <!--Folders-->
         <div class="row">
            <?php  
                  if($data["folders"]){
                     foreach($data["folders"] as $folder){   
               ?>
               <h4 class="text-start">
                  <a href="<?php echo URLROOT; ?>/folders/index?idFolder=<?php echo $folder->idFolder; ?>" class="text-secondary"> 
                     <i class="bi bi-folder text-warning"></i>
                     <?php echo $folder->folder; ?> 
                  </a> 
               </h4>
            <?php  
                     }
                  }
            ?>
         </div>
         <!--Project in current folder-->
         <div class="row">
            <?php  
               if( !isset($data["models"]->scalar)){ 
                  foreach($data["models"] as $model){  
            ?>
            <h4 class="text-start">
                  <a href="<?php echo URLROOT; ?>/models/index?id=<?php echo $model->idModel; ?>" class="text-secondary"> 
                    <?php echo $model->model; ?>
                  </a> 
               </h4>

             
            <?php 
                  }
               }
            ?>
         </div>
      </div>
   </div>
 </section>
 

<!--Popup errore eliminazione-->
<div class="modal" tabindex="-1" id="modalError">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">ERROR</h5>
          <a href="<?php echo URLROOT; ?>/folders/index?idFolder=<?php if(isset($_GET["idFolder"])){echo $_GET["idFolder"]; }?>"  data-bs-dismiss="modal" aria-label="Close"> 
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> 
               </button>
          </a> 
      </div>
      <div class="modal-body">
        <p>Error while deleting this folder. There is a project or subfolder inside.</p>
      </div>
      <div class="modal-footer">
        <a href="<?php echo URLROOT; ?>/folders/index?idFolder=<?php if(isset($_GET["idFolder"])){echo $_GET["idFolder"]; }?>" class="btn btn-secondary" data-bs-dismiss="modal">Close</a> 
      </div>
    </div>
  </div>
</div>

<?php 
   if(isset($_GET["error"]) && $_GET["error"]==1){
?>
<script>
   const errorModal = new bootstrap.Modal(document.getElementById('modalError'))
   errorModal.show();
</script>
<?php
   }
?>

 <?php
   require APPROOT . '/views/includes/footer.php';
?>
 