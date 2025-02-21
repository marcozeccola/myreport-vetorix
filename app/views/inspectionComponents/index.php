<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
   
?>

<div style="margin-left: 20px!important;">
     <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
          <ol class="breadcrumb">
               <li class="breadcrumb-item">
                    <a href="<?php echo URLROOT; ?>/folders/">Clients</a>
               </li>
               <?php  
                        foreach($data["tree"] as $folder){ 
                    ?>
               <li class="breadcrumb-item">
                    <a
                         href="<?php echo URLROOT; ?>/folders/index?idFolder=<?php echo $folder->idFolder; ?>"><?php echo $folder->folder; ?></a>
               </li>
               <?php
                         }  
                    ?>
               <li class="breadcrumb-item">
                    <a
                         href="<?php echo URLROOT; ?>/models/index?id=<?php echo $data["model"]->idModel; ?>"><?php echo $data["model"]->model; ?></a>
               </li>
               <li class="breadcrumb-item active" aria-current="page">
                    <a
                         href="<?php echo URLROOT; ?>/modelistances/index?id=<?php echo $data["modelIstance"]->idModelIstance; ?>"><?php echo $data["modelIstance"]->modelIstance; ?></a>
               </li>
               <li class="breadcrumb-item active" aria-current="page">
                    <a
                         href="<?php echo URLROOT; ?>/inspections/index?id=<?php echo $_GET["idInspection"]; ?>">Inspection</a>
               </li>
               <li class="breadcrumb-item active" aria-current="page"><?php echo $data["component"]->componentIstance; ?> Images
               </li>
          </ol>
     </nav>
</div>


          <?php
              $dir = APPROOT . "/private/compInspec/".$_GET["idComponent"];
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
                              <img src="<?php echo URLROOT ;?>/utilities/getPrivateFile?type=compInspec&file=<?php echo $file ;?>&id=<?php echo $component->idComponentIstance ;?>"
                                       style="width: 200px;">

                              <a href="<?php echo URLROOT ;?>/postits/singleImage?idInspection=<?php echo $_GET["idInspection"];  ?>&imageName=<?php echo $file ;?>&idComponent=<?php echo $component->idComponentIstance ;?>" 
                              class="btn btn-primary" >Open</a>
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