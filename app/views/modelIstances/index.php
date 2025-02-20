<?php
   require APPROOT . '/views/includes/head.php';
?>
 <?php
   require APPROOT . '/views/includes/navigation.php';  
?>

 <section id="portfolio" class="portfolio section-bg">

     <div class="container">
       <header class="section-header text-center">
          <h3><?php echo $data["modelIstance"]->modelIstance; ?> istance of <?php echo $data["model"]->model; ?></h3>   
            <div class="row" style="max-width:60%!important;margin-left:20%!important;">
             <div class="col-lg-4 col-sm-12">
                <a class="btn btn-primary"  
                   href="<?php echo URLROOT; ?>/inspections/addBasicInfo?idModelIstance=<?php echo $_GET["id"]; ?>">
                   CREATE INSPECTION
                   <i class="bi bi-plus-circle-dotted"></i>
                </a> 
             </div>  
              <div class="col-lg-4 col-sm-12">
                <a class="btn btn-primary"  
                   href="<?php echo URLROOT; ?>/modelIstances/changeModelIstanceName?idModelIstance=<?php echo $_GET["id"]; ?>">
                   CHANGE ISTANCE NAME 
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
                         <li class="breadcrumb-item"><a
                              href="<?php echo URLROOT; ?>/models/index?id=<?php echo $data["model"]->idModel; ?>"><?php echo $data["model"]->model; ?></a>
                         </li>
                         <li class="breadcrumb-item active" aria-current="page"><?php echo $data["modelIstance"]->modelIstance; ?></li>
                </ol>
             </nav>
          </div>
 

          <div class="text-center" style="width: 100%;   ">  
               <h3 class="text-start" >Inspections</h3>
               <table class="table">
                  <thead>
                     <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Client</th>
                        <th scope="col">Vtx projet</th> 
                        <th scope="col">Open</th> 
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     if($data["inspections"]){ 
                        foreach($data["inspections"] as $inspection){
                     ?>
                     <tr>
                        <th scope="row"><?php echo $inspection->date; ?></th>
                        <td><?php echo $inspection->client; ?></td>
                        <td><?php echo $inspection->projectId; ?> </td> 
                        <td>
                           <a href="<?php echo URLROOT; ?>/inspections/index?id=<?php echo $inspection->idInspection; ?>">
                              Open
                           </a>
                        </td> 
                     </tr> 
                     <?php
                        } 
                     }
                     ?>
                  </tbody>
               </table>
          </div>
   </div>
 </section>
  
 

 <?php
   require APPROOT . '/views/includes/footer.php';
?>
 
