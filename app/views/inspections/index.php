<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
   require APPROOT . '/views/includes/navigation.php'; 
   
?>

<style>
     .btn-qi {
          color: white;
          border-radius: 30px !important;
     }
</style>

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
               <li class="breadcrumb-item active" aria-current="page">Inspection
               </li>
          </ol>
     </nav>
</div>



<section id="portfolio-details" class="portfolio-details">
     <div class="container">
          <div class="row">

               <div class="col-lg-4">
                    <div class="portfolio-info">
                         <p class="text-end">
                              <a href="<?php echo URLROOT; ?>/inspections/editBasicInfo?id=<?php echo $_GET["id"]; ?>" >
                                   Edit <i class="bi bi-pen-fill"></i>
                              </a>
                         </p> 
                         <h3>
                              PROG. VTX <?php echo $data["inspection"]->projectId; ?>
                         </h3>

                         <ul>
                              <li><strong>Date</strong>:
                                   <?php echo date('d-m-Y', strtotime($data["inspection"]->date)); ?></li>
                              <li><strong>Client</strong>: <?php echo $data["inspection"]->client; ?></li>
                              <li><strong>Builder</strong>: <?php echo $data["inspection"]->builder; ?></li>
                              <li><strong>Factory</strong>: <?php echo $data["inspection"]->factory; ?></li>
                              <li><strong>Year</strong>: <?php echo $data["inspection"]->year; ?></li>
                              <li><strong>Location</strong>: <?php echo $data["inspection"]->location; ?></li>
                              <li><strong>Goal</strong>: <?php echo $data["inspection"]->goal; ?></li>
                              <li><strong>Type</strong>: <?php echo $data["inspection"]->type; ?></li>
                              <li><strong>Goal Notes</strong>: <?php echo $data["inspection"]->goalNotes; ?></li>
                         </ul>

                    </div>

                    <br>

                    <div class="portfolio-info" id="users">
                         <p class="text-end">
                              <a href="<?php echo URLROOT; ?>/inspections/addUser?idInspection=<?php echo $_GET["id"]; ?>" >
                                   Add <i class="bi bi-plus"></i>
                              </a>
                         </p> 
                         <h3>
                              Technicians
                         </h3>

                         <ul> 
                              <?php
                              foreach($data["users"] as $user){
                              ?>
                              <li>  <?php echo $user->name . " ".$user->surname; ?></li> 
                              <?php
                              }
                              ?>
                         </ul>

                         <p class="text-end">
                              <a href="<?php echo URLROOT; ?>/inspections/addReviewer?idInspection=<?php echo $_GET["id"]; ?>" >
                                   Edit <i class="bi bi-pencil"></i>
                              </a>
                         </p> 
                         <h3>
                              Reviewer
                         </h3>
                         <ul>  
                              <?php
                              if($data["reviewer"]){
                              ?>
                              <li>  <?php echo $data["reviewer"]->name . " ".$data["reviewer"]->surname; ?></li>  
                               
                              <?php
                              }
                              ?>
                         </ul>

                    </div>

                    <div class="portfolio-info" id="ultrasounds">
                         <p class="text-end">
                              <a href="<?php echo URLROOT; ?>/ultrasoundInspections/addUltrasound?idInspection=<?php echo $_GET["id"]; ?>">
                                   Add <i class="bi bi-plus"></i>
                              </a>
                         </p>
                         <h3>Ultrasounds</h3>
                         <ul>
                              <?php foreach($data["ultrasounds"] as $ultrasound): ?>
                                   <li>
                                        <strong>Ultrasound:</strong> <?php echo $ultrasound->ultrasound; ?><br>
                                        <strong>Sn:</strong> <?php echo $ultrasound->sn; ?><br>
                                        <strong>Expiration:</strong> <?php echo $ultrasound->expiration; ?><br>
                                        <strong>Probe:</strong> <?php echo $ultrasound->probe; ?><br>
                                        <a href="<?php echo URLROOT; ?>/ultrasoundInspections/editUltrasound?idUltrasound=<?php echo $ultrasound->idUltrasoundInspection; ?>">
                                             Edit Probe's informations 
                                        </a>
                                   </li>
                              <?php endforeach; ?>
                         </ul>
                    </div> 

                              <a href="<?php echo URLROOT; ?>/public/pdf/report?idInspection=<?php echo $_GET["id"]; ?>"
                                   class="btn btn-primary btn-qi">REPORT</a> 
                     
               </div>

               <div class="col-lg-8">

                    <!--project cover-->
                    <div class="portfolio-details-slider swiper">
                         <div class="swiper-wrapper align-items-center">
                              <div class="swiper-slide"> 
                                   <div id="accordion">
                                        <div class="card">
                                             <div class="card-header" id="headingOne">
                                                  <h5 class="mb-0">
                                                       <button class="btn btn-link"  data-bs-toggle="collapse"
                                                            href="#examinatedAreas" role="button" aria-expanded="true"
                                                            aria-controls="examinatedAreas">
                                                            Examinated areas
                                                       </button>
                                                  </h5>
                                             </div>

                                             <div id="examinatedAreas" class="collapse show" aria-labelledby="headingOne"
                                                  data-parent="#accordion">
                                                  <div class="card-body">
                                                       <p class="text-end">
                                                            <a href="<?php echo URLROOT; ?>/inspectioncomponents/addInspectionComponent?idInspection=<?php echo $_GET["id"]; ?>" >
                                                                 <i class="bi bi-plus"></i> add
                                                            </a>
                                                       </p> 
                                                       <div class="text-center" style="width: 100%;   ">   
                                                            <table class="table">
                                                                 <thead>
                                                                      <tr>
                                                                      <th scope="col">Component</th>
                                                                      <th scope="col">Delete</th> 
                                                                      </tr>
                                                                 </thead>
                                                                 <tbody>
                                                                 <?php
                                                                      if($data["components"]){ 
                                                                           foreach($data["components"] as $component){
                                                                 ?>
                                                                      <tr>
                                                                           <th scope="row"><?php echo $component->componentIstance; ?></th> 
                                                                           <td>
                                                                                <a href="<?php echo URLROOT; ?>/inspectioncomponents/deleteComponent?id=<?php echo $component->idInspectionComponent; ?>">
                                                                                     <i class="bi bi-trash-fill"></i>
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
                                             </div>
                                        </div>

                                        <div class="card">
                                             <div class="card-header" id="headingTwo">
                                                  <h5 class="mb-0">
                                                       <button class="btn btn-link collapsed" data-bs-toggle="collapse"
                                                            href="#areainfo" role="button" aria-expanded="true"
                                                            aria-controls="areainfo">
                                                            Area's informations
                                                       </button>
                                                  </h5>
                                             </div>
                                             <div id="areainfo" class="collapse show" aria-labelledby="headingTwo"
                                                  data-parent="#accordion">
                                                  <div class="card-body">
                                                       <table class="table">
                                                            <thead>
                                                                 <tr>
                                                                      <th scope="col">Component</th>
                                                                      <th scope="col">Notes</th> 
                                                                      <th scope="col">Building techniques</th> 
                                                                      <th scope="col">Postcare</th> 
                                                                      <th scope="col">Interferences</th> 
                                                                 </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                                 if($data["components"]){ 
                                                                      foreach($data["components"] as $component){
                                                            ?>
                                                                 <tr>
                                                                      <th scope="row"><?php echo $component->componentIstance; ?></th>
                                                                      <td>
                                                                           <a href="<?php echo URLROOT; ?>/inspectioncomponents/editNotes?idComponent=<?php echo $component->fk_idComponentIstance; ?>&idInspection=<?php echo $data["inspection"]->idInspection; ?>">     
                                                                           <?php
                                                                                if($component->notes!=NULL &&  isset($component->notes)){
                                                                                      
                                                                                     echo $component->notes ." <i class='bi bi-pen-fill'></i>";
                                                                                }else{
                                                                                     echo "add";
                                                                                }
                                                                           ?> 
                                                                           </a>
                                                                      </td> 

                                                                      <td>
                                                                           <a href="<?php echo URLROOT; ?>/buildingtechniques/edit?idComponent=<?php echo $component->fk_idComponentIstance; ?>&idInspection=<?php echo $_GET["id"]; ?>">     
                                                                           <?php
                                                                                $cont = 0;
                                                                                if($data["buildingTec"]){ 
                                                                                     foreach($data["buildingTec"] as $buildingTec){
                                                                                          if($component->fk_idComponentIstance == $buildingTec->idComponentIstance){ 
                                                                                               if($cont >0){
                                                                                                    echo ", ";
                                                                                               }
                                                                                               echo $buildingTec->technique . " ";  
                                                                                               $cont ++;  
                                                                                          }
                                                                                          
                                                                                     } 
                                                                                }

                                                                                if($cont ==0){
                                                                                     echo "add";
                                                                                }else{ 
                                                                                     echo "  <i class='bi bi-pen-fill'></i>";
                                                                                }
                                                                           ?>
                                                                           </a>
                                                                      </td> 
                                                                      <td>
                                                                           <a href="<?php echo URLROOT; ?>/postcares/edit?idComponent=<?php echo $component->fk_idComponentIstance; ?>&idInspection=<?php echo $_GET["id"]; ?>">     
                                                                           <?php
                                                                                if($data["postCare"]){ 
                                                                                     $cont = 0;
                                                                                     foreach($data["postCare"] as $postCare){
                                                                                          
                                                                                          if($component->idComponentIstance == $postCare->idComponentIstance){ 
                                                                                               if($cont >0){
                                                                                                    echo ", ";
                                                                                               }
                                                                                               echo $postCare->postCare ;  
                                                                                               $cont ++;  
                                                                                          }
                                                                                     } 
                                                                                     echo "  <i class='bi bi-pen-fill'></i>";
                                                                                }else{
                                                                                     echo "add";
                                                                                }
                                                                           ?>
                                                                           </a>
                                                                      </td> 
                                                                      <td>
                                                                           <a href="<?php echo URLROOT; ?>/inspectioncomponents/editInterferences?idComponent=<?php echo $component->fk_idComponentIstance; ?>&idInspection=<?php echo $data["inspection"]->idInspection; ?>">     
                                                                           <?php
                                                                                if($component->interferences!=NULL &&  isset($component->interferences)){
                                                                                      
                                                                                     echo $component->interferences ." <i class='bi bi-pen-fill'></i>";
                                                                                }else{
                                                                                     echo "add";
                                                                                }
                                                                           ?> 
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
                                        </div>

                                        <div class="card">
                                             <div class="card-header" id="headingThree">
                                                  <h5 class="mb-0">
                                                       <button class="btn btn-link collapsed" data-bs-toggle="collapse"
                                                            href="#info" role="button" aria-expanded="true"
                                                            aria-controls="info">
                                                            Infos
                                                       </button>
                                                  </h5>
                                             </div>
                                             <div id="info" class="collapse show" aria-labelledby="headingThree"
                                                  data-parent="#accordion">
                                                  <div class="card-body"> 
                                                       <b>Surface conditions 
                                                            <a href="<?php echo URLROOT; ?>/surfaceconditions/edit?idInspection=<?php echo $_GET["id"]; ?>" >
                                                                 Edit <i class="bi bi-pen-fill"></i>
                                                            </a> 
                                                       </b>
                                                       <br>
                                                       <?php 
                                                            $cont = 0;
                                                            foreach($data["surfaceCoditions"] as $condition){
                                                                 if($cont>0){
                                                                      echo ", ";
                                                                 }
                                                                 echo $condition->surfaceCondition;
                                                                 $cont++;
                                                            }
                                                       ?> 
                                                       <br>
                                                       <br>
                                                       <b>Structure position
                                                            <a href="<?php echo URLROOT; ?>/structurePositions/edit?idInspection=<?php echo $_GET["id"]; ?>" >
                                                                 Edit <i class="bi bi-pen-fill"></i>
                                                            </a> 
                                                       </b>
                                                       <br>
                                                       <?php 
                                                            $cont = 0;
                                                            foreach($data["structurePositions"] as $position){
                                                                 if($cont>0){
                                                                      echo ", ";
                                                                 }
                                                                 echo $position->structurePosition;
                                                                 $cont++;
                                                            }
                                                       ?>
                                                  </div>
                                             </div>
                                        </div>
                                        
                                        <div class="card">
                                             <div class="card-header" id="headingThree">
                                                  <h5 class="mb-0">
                                                       <button class="btn btn-link collapsed" data-bs-toggle="collapse"
                                                            href="#procedures" role="button" aria-expanded="true"
                                                            aria-controls="procedures">
                                                            Inspection Procedures & Techniques 
                                                       </button>
                                                  </h5>
                                             </div>
                                             <div id="procedures" class="collapse show" aria-labelledby="headingThree"
                                                  data-parent="#accordion">
                                                  <div class="card-body"> 
                                                       <a href="<?php echo URLROOT; ?>/inspections/editProcedures?idInspection=<?php echo $_GET["id"]; ?>" >
                                                            Edit <i class="bi bi-pen-fill"></i>
                                                       </a>
                                                       <br>
                                                       <b>Specific procedure: </b> <?php echo $data["inspection"]->specificProcedure;?> 
                                                       <br> 
                                                       <b>Accessibility criteria: </b> <?php echo $data["inspection"]->accessibility;?> 
                                                       <br> 
                                                       <b>Techniques: </b> 
                                                       <?php 
                                                       $cont = 0;
                                                       foreach($data["examinationTechniques"] as $technique){
                                                            if($cont>0){
                                                                 echo ", ";
                                                            }
                                                            echo $technique->examinationTechnique;
                                                            $cont++;
                                                       }
                                                       ?> 
                                                  </div>
                                             </div>
                                        </div>

                                        <div class="card">
                                             <div class="card-header" id="headingThree">
                                                  <h5 class="mb-0">
                                                       <button class="btn btn-link collapsed" data-bs-toggle="collapse"
                                                            href="#calibration" role="button" aria-expanded="true"
                                                            aria-controls="calibration">
                                                            Calibration
                                                       </button>
                                                  </h5>
                                             </div>
                                             <div id="calibration" class="collapse show" aria-labelledby="headingThree"
                                                  data-parent="#accordion">
                                                  <div class="card-body"> 
                                                       <a href="<?php echo URLROOT; ?>/inspections/editCalibrations?idInspection=<?php echo $_GET["id"]; ?>" >
                                                            Edit <i class="bi bi-pen-fill"></i>
                                                       </a> 
                                                       <br>
                                                       <b>Calibrations: </b> 
                                                       <?php 
                                                       $cont = 0;
                                                       foreach($data["calibrations"] as $calibration){
                                                            if($cont>0){
                                                                 echo ", ";
                                                            }
                                                            echo $calibration->calibration;
                                                            $cont++;
                                                       }
                                                       ?> 
                                                       <br>
                                                       <b>Notes: </b> <?php echo $data["inspection"]->calibrationNotes;?> 
                                                       <br> 
                                                  </div>
                                             </div>
                                        </div>

                                        <div class="card">
                                             <div class="card-header" id="headingThree">
                                                  <h5 class="mb-0">
                                                       <button class="btn btn-link collapsed" data-bs-toggle="collapse"
                                                            href="#conclusions" role="button" aria-expanded="true"
                                                            aria-controls="conclusions">
                                                            Conclusions
                                                       </button>
                                                  </h5>
                                             </div>
                                             <div id="conclusions" class="collapse show" aria-labelledby="headingThree"
                                                  data-parent="#accordion">
                                                  <div class="card-body"> 
                                                       <a href="<?php echo URLROOT; ?>/inspections/editConclusions?idInspection=<?php echo $_GET["id"]; ?>" >
                                                            Edit <i class="bi bi-pen-fill"></i>
                                                       </a> 
                                                       <br>
                                                       <b>Conclusions: </b> 
                                                       <?php 
                                                       if($data["inspection"]->conclusions){
                                                            echo $data["inspection"]->conclusions;
                                                       }
                                                       ?> 
                                                       <br> 
                                                  </div>
                                             </div>
                                        </div>

                                   </div>

                              </div>
                         </div>
                    </div> 

               </div>
          </div>


     </div>
</section>

<script>

</script>
<?php
   require APPROOT . '/views/includes/footer.php'; 
?>