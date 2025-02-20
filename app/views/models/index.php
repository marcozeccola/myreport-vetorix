<?php
   require APPROOT . '/views/includes/head.php';
?>
 <?php
   require APPROOT . '/views/includes/navigation.php';  
?>

 <section id="portfolio" class="portfolio section-bg">

     <div class="container">
       <header class="section-header text-center">
          <h3><?php echo $data["model"]->model; ?> Model</h3>   
            <div class="row" style="max-width:60%!important;margin-left:20%!important;">
             <div class="col-lg-4 col-sm-12">
                <a class="btn btn-primary"  
                   href="<?php echo URLROOT; ?>/modelIstances/addModelIstance?idModel=<?php echo $_GET["id"]; ?>">
                   CREATE ISTANCE
                   <i class="bi bi-plus-circle-dotted"></i>
                </a> 
             </div> 
             <div class="col-lg-4 col-sm-12">
                <a class="btn btn-primary"  
                   href="<?php echo URLROOT; ?>/components/addComponent?idModel=<?php echo $_GET["id"]; ?>">
                   ADD COMPONENT
                   <i class="bi bi-plus-circle-dotted"></i>
                </a> 
             </div> 
              <div class="col-lg-4 col-sm-12">
                <a class="btn btn-primary"  
                   href="<?php echo URLROOT; ?>/models/changeModelName?idModel=<?php echo $_GET["id"]; ?>">
                   CHANGE MODEL NAME 
                </a> 
             </div>

            </div>
        </header>
       <br> 

        <div >
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
                         <li class="breadcrumb-item active" aria-current="page"><?php echo $data["model"]->model; ?></li>
                </ol>
             </nav>
          </div>
 

         <div class="text-center" style="width: 100%;   ">  
         <h3 class="text-start" >Components</h3>
         <div class="row">
            <?php  
               if( !isset($data["components"]->scalar)){ 
                  foreach($data["components"] as $component){  
            ?>
               <h4 class="text-start">
                  <a href="<?php echo URLROOT; ?>/components/index?id=<?php echo $component->idComponent; ?>" 
                    class="text-secondary"
                    style="margin-left:50px!important;"> 
                    <?php echo $component->component; ?>
                  </a> 
               </h4>

             
            <?php 
                  }
               }
            ?>
         </div>

         <h3 class="text-start" >Istances</h3>
         <div class="row">
            <?php  
               if( !isset($data["istances"]->scalar)){ 
                  foreach($data["istances"] as $istance){  
            ?>
               <h4 class="text-start">
                  <a href="<?php echo URLROOT; ?>/modelIstances/index?id=<?php echo $istance->idModelIstance; ?>" 
                    class="text-secondary"
                    style="margin-left:50px!important;"> 
                    <?php echo $istance->modelIstance; ?>
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
  
 

 <?php
   require APPROOT . '/views/includes/footer.php';
?>
 
