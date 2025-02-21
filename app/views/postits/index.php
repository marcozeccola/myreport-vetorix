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
               <li class="breadcrumb-item active" aria-current="page">
                    <a
                         href="<?php echo URLROOT; ?>/inspectioncomponents/index?idInspection=<?php echo $_GET["idInspection"]; ?>&idComponent=<?php echo $_GET["idComponent"]; ?>"><?php echo $data["component"]->componentIstance; ?> Images</a>
               </li>
               <li class="breadcrumb-item active" aria-current="page">
                    Single image
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

<div style="position: relative; display: inline-block; width: 100%;">
  <img src="<?php echo URLROOT ;?>/utilities/getPrivateFile?type=compInspec&file=<?php echo $_GET["imageName"] ;?>&id=<?php echo $component->idComponentIstance ;?>"
       style="width: 100%; height: auto; display: block;"
       id="img">

  <svg style="width: 100%; height: 100%; position: absolute; left: 0; top: 0;" id="svgOverlay">
    <?php
    if (!empty($data["postits"])) {
        foreach($data["postits"] as $postit){
    ?>
    <rect x="<?php echo $postit->x-1 ;?>%" y="<?php echo $postit->y-2 ;?>%" width="40" height="18" fill="lightsteelblue" opacity="0.9"></rect>
    <text x="<?php echo $postit->x-1 ;?>%" y="<?php echo $postit->y  ;?>%" font-size="12px" fill="red">
      <?php echo $postit->note ;?>
    </text>
    <?php
        }
    }
    ?>
  </svg>
</div>


  <?php
                }else{?>
             <td>
                <h3>No images</h3>
              </td>
        
                    <?php
                }
          ?>  

<!-- Modal -->
<div class="modal fade" id="coordinateModal" tabindex="-1" aria-labelledby="coordinateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="coordinateModalLabel">Add Post-it</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="coordinateForm" action="<?php echo URLROOT; ?>/postits/addPostItNote" method="POST">
          <input type="hidden" name="x" id="inputX">
          <input type="hidden" name="y" id="inputY">
          <input type="hidden" name="imageName" value="<?php echo $_GET["imageName"]; ?>">
          <input type="hidden" name="idComponentIstance" value="<?php echo $_GET["idComponent"]; ?>">
          <input type="hidden" name="idInspection" value="<?php echo $_GET["idInspection"]; ?>">
          <div class="mb-3">
            <label for="note" class="form-label">Note</label>
            <textarea class="form-control" id="note" name="note" rows="3" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const image = document.getElementById('svgOverlay');
        image.addEventListener('click', function(event) {
            const rect = image.getBoundingClientRect();
            const x = ((event.clientX - rect.left) / rect.width) * 100;
            const y = ((event.clientY - rect.top) / rect.height) * 100;  

            // Set the hidden input values
            document.getElementById('inputX').value = x.toFixed(2);
            document.getElementById('inputY').value = y.toFixed(2);

            // Show the modal
            const coordinateModal = new bootstrap.Modal(document.getElementById('coordinateModal'));
            coordinateModal.show();
        });
    });
</script>
            
