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

            <div style="position: relative; display: inline-block; width: 100%;" id="toDownload">
              <img src="<?php echo URLROOT ;?>/utilities/getPrivateFile?type=compInspec&file=<?php echo $_GET["imageName"] ;?>&id=<?php echo $component->idComponentIstance ;?>"
                  style="width: 100%; height: auto; display: block;"
                  id="img">

              <svg style=" position: absolute; left: 0; top: 0;" id="svgOverlay">
                <image href="<?php echo URLROOT ;?>/utilities/getPrivateFile?type=compInspec&file=<?php echo $_GET["imageName"] ;?>&id=<?php echo $component->idComponentIstance ;?>"
                style="width: 100%; height: auto; display: block;"></image>
                <?php
                if (!empty($data["postits"])) {
                    foreach($data["postits"] as $postit){
                ?>
                <rect x="<?php echo $postit->x-1 ;?>%" y="<?php echo $postit->y-2 ;?>%" width="40" height="18" fill="white" opacity="0.9"></rect>
                <text font-weight="bold" x="<?php echo $postit->x-1 ;?>%" y="<?php echo $postit->y  ;?>%" font-size="12px" fill="blue" postit-id="<?php echo $postit->idPostit; ?>">
                  <?php echo $postit->note ;?>
                </text>
                <?php
                    }
                }
                ?>

                <?php
                if (!empty($data["uninspectibles"])) {
                    foreach($data["uninspectibles"] as $uninspectible){
                ?>
                <rect x="<?php echo $uninspectible->x;?>%" y="<?php echo $uninspectible->y;?>%" 
                  width="<?php echo $uninspectible->width;?>%" height="<?php echo $uninspectible->height;?>%" fill="lightsteelblue" opacity="0.9"></rect>
                <?php
                    }
                }
                ?>

 
              </svg>
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

<button id="addRectangleButton" class="btn btn-primary">Add Rectangle</button>
 
<!-- Add postit Modal -->
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

<!-- Delete modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Delete Post-it</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this Post-it?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form id="deleteForm" method="POST">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script> 
    const svg = document.getElementById('svgOverlay');
    const addRectangleButton = document.getElementById('addRectangleButton');
    let isMouseDown = false;
    let canAddRectangle = false;
    let x, y, width, height, rect, uploadedUninspect = false, img, image;
    document.addEventListener('DOMContentLoaded', function() {

        img = document.getElementById('img');
        image = document.getElementById('svgOverlay');
        image.style.width = img.offsetWidth + 'px';
        image.style.height = img.offsetHeight + 'px';  
        rect = svg.getBoundingClientRect(); 
        
    });

    addRectangleButton.addEventListener('click', function() {
      canAddRectangle = true;
    });

    svg.addEventListener('mousedown', function(event) {
      if (!canAddRectangle) return;
      isMouseDown = true; 
      x = ((event.clientX + window.scrollX - rect.left) / rect.width) * 100;
      y = ((event.clientY + window.scrollY - rect.top) / rect.height) * 100;    
    });

    svg.addEventListener('mousemove', function(event) {
      if (isMouseDown && canAddRectangle) {
        width = (((event.clientX + window.scrollX - rect.left) / rect.width) * 100) - x;
        height = (((event.clientY + window.scrollY - rect.top) / rect.height) * 100) - y;
        this.innerHTML += `<rect   x="${x}%" y="${y}%" width="${width}%" height="${height}%" fill="lightsteelblue" opacity="0.9"></rect>`;
      }
    });

    svg.addEventListener('mouseup', function() {
      if (isMouseDown && canAddRectangle) { 
        if(width> 0 && height > 0){
          const xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              console.log(this.responseText);
            }
          };
          xhttp.open("POST", "<?php echo URLROOT; ?>/uninspectibles/addUninspectible", true);
          xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhttp.send("idComponentIstance=<?php echo $_GET["idComponent"]; ?>&imageName=<?php echo $_GET["imageName"]; ?>&x="+x+"&y="+y+"&width="+width+"&height="+height);
        }

        uploadedUninspect = true;
        isMouseDown = false;
        canAddRectangle = false; // Reset after adding the rectangle
      }
    });

    svg.addEventListener('mouseleave', function() {
      isMouseDown = false;
    });

    document.addEventListener('DOMContentLoaded', function() {
    image.addEventListener('click', function(event) { 
          if(!uploadedUninspect){
            if(event.target.tagName === "text"){
                const postItId = event.target.getAttribute('postit-id');
                const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
                document.getElementById('deleteForm').setAttribute('action', `<?php echo URLROOT; ?>/postits/deletePostIt?idPostit=${postItId}&idInspection=<?php echo $_GET["idInspection"]; ?>`);
                deleteModal.show();
            }else{

                const rect = image.getBoundingClientRect();
                const x = ((event.clientX - rect.left) / rect.width) * 100;
                const y = ((event.clientY - rect.top) / rect.height) * 100;  

                // Set the hidden input values
                document.getElementById('inputX').value = x.toFixed(2);
                document.getElementById('inputY').value = y.toFixed(2);

                // Show the modal
                const coordinateModal = new bootstrap.Modal(document.getElementById('coordinateModal'));
                coordinateModal.show();
            }
          }else{
            uploadedUninspect = false;
          }
        }); 
    });

    document.addEventListener('DOMContentLoaded', function() {
    const svg = document.getElementById('toDownload').querySelector('svg');

// Get the SVG data as a string
const svgData = new XMLSerializer().serializeToString(svg);

// Create a blob from the SVG data
const blob = new Blob([svgData], { type: 'image/svg+xml' });

// Create a URL for the blob
const url = URL.createObjectURL(blob);

// Create a link to download the image
const link = document.createElement('a');
link.href = url;
link.download = 'image.svg';
link.click();

// Clean up
URL.revokeObjectURL(url);
    });
 
</script>
