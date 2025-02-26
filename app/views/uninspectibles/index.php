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
                    Edit uninspectible areas 
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
                  style="width: auto; height: 75%; display: block;"
                  id="img">

              <?php $urlImg = URLROOT. "/utilities/getPrivateFile?type=compInspec&file=" . $_GET["imageName"] . "&id=" . $component->idComponentIstance;  ?>
              <svg style=" position: absolute; left: 0; top: 0;" id="svgOverlay"  >
                <?php
                if (!empty($data["postits"])) {
                    foreach($data["postits"] as $postit){
                ?>
                <rect x="<?php echo $postit->x-1 ;?>%" y="<?php echo $postit->y-2 ;?>%" width="40" height="18" fill="lightsteelblue" opacity="0.9"></rect>
                <text x="<?php echo $postit->x-1 ;?>%" y="<?php echo $postit->y  ;?>%" font-size="12px" fill="red" postit-id="<?php echo $postit->idPostit; ?>">
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
<script>
  
let rect;
document.addEventListener('DOMContentLoaded', function() {
  const img = document.getElementById('img');
  const svg = document.getElementById('svgOverlay');
  svg.style.width = img.offsetWidth + 'px';
  svg.style.height = img.offsetHeight + 'px';
  rect = svg.getBoundingClientRect();
}); 

  const svg = document.getElementById('svgOverlay');
  const addRectangleButton = document.getElementById('addRectangleButton');
  let isMouseDown = false;
  let canAddRectangle = false;
  let x, y, width, height;

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
      console.log(x);
      console.log(y);
      console.log(width);
      console.log(height);
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

      isMouseDown = false;
      canAddRectangle = false; // Reset after adding the rectangle
    }
  });

  svg.addEventListener('mouseleave', function() {
    isMouseDown = false;
  });


  
</script>
