<?php
   require APPROOT . '/views/includes/head.php';
?>
 <?php
   require APPROOT . '/views/includes/navigation.php';  
?>

 <section id="portfolio" class="portfolio section-bg">

     <div class="container">
       <header class="section-header text-center">
          <h3><?php echo $data["component"]->component; ?> Component</h3>   
            <div class="row" style="max-width:60%!important;margin-left:20%!important;">
             <div class="col-lg-6 col-sm-12">
                <a class="btn btn-primary"  
                   href="<?php echo URLROOT; ?>/components/addImages?idComponent=<?php echo $_GET["id"]; ?>">
                   ADD IMAGE
                   <i class="bi bi-plus-circle-dotted"></i>
                </a> 
             </div>   
             
             <div class="col-lg-6 col-sm-12">
                <a class="btn btn-primary"  
                   href="<?php echo URLROOT; ?>/components/changeComponentName?idComponent=<?php echo $_GET["id"]; ?>">
                   CHANGE COMPONENT NAME 
                </a> 
             </div>
            </div>
            
        </header>
       <br> 

        
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
                          
                         <li class="breadcrumb-item active" aria-current="page"><?php echo $data["component"]->component; ?></li>
                    </ol>
               </nav>
          </div>

          <div class="text-center" style="width: 100%;">   
         <div class="row">
          
          
          <?php
              $dir = APPROOT . "/private/compModels/".$data["component"]->idComponent;
              $component = $data["component"];
              $files= NULL;

              if(is_dir($dir)){
                  $files = array_slice(scandir($dir),2);
              }

          if (!empty($files) && !is_null($files)) {
            ?>
        <br><br>
        <div class="text-center">
          <table class=" text-center"> 
             <?php 
                $cont =0;
                foreach($files as $file){ 
            ?>        <tr>
                         <td> 
                              <img src="<?php echo URLROOT ;?>/utilities/getPrivateFile?type=compModels&file=<?php echo $file ;?>&id=<?php echo $component->idComponent ;?>"
                                       style="width: 200px;">
                         </td>
                         <td style="padding-left: 100px!important;">
                              <a class="btn btn-danger"
                                  href="<?php echo URLROOT ;?>/components/deleteImgComponent?idComponent=<?php echo $component->idComponent;?>&file=<?php echo  $file;?>" >
                                  DELETE
                                  <i class="bi bi-archive-fill"></i>
                              </a>
                         </td>
                    </tr>  
          <?php 
                $cont++;
                }
          ?>
               </table>
        </div>
        <?php
          }else{
          ?>
             <td>
                <h3>No images</h3>
              </td>
          <?php
                }
          ?>
          
         </div>
      </div>
   </div>
 </section>
  
 

 <?php
   require APPROOT . '/views/includes/footer.php';
?>
 
