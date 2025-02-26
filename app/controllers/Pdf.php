<?php
class Pdf extends Controller { 

     var $foldersModel;
     var $modelsModel;
     var $componentsModel;
     var $modelIstancesModel;
     var $inspectionUsersModel;
     var $componentIstancesModel;
     var $inspectionsModel;
     var $inspectionComponentsModel;
     var $tecsComponentIstanceModel;
     var $postCaresModel;
     var $structurePositionsModel;
     var $surfaceConditionsModel;
     var $examinationTechniquesModel;
     var $calibrationsModel;
     var $ultrasoundInspectionModel;
     var $ultrasoundUserModel;
     var $usersModel;
     var $couplersModel ;
     var $probeDimensionsModel;
     var $probeFrequencyModel;
     var $probeDetailsModel;
     var $postItModel;
     var $uninspectiblesModel;
     
    public function __construct() { 

          $this->componentsModel = $this->model('Component');  
          $this->modelsModel = $this->model('Model');  
          $this->modelIstancesModel = $this->model('ModelIstance');  
          $this->componentIstancesModel = $this->model('ComponentIstance');  
          $this->foldersModel = $this->model('Folder');  
          $this->inspectionsModel = $this->model('Inspection');  
          $this->inspectionUsersModel = $this->model('InspectionUser');  
          $this->inspectionComponentsModel = $this->model('InspectionComponent');
          $this->tecsComponentIstanceModel = $this->model('TecComponentIstance');
          $this->postCaresModel = $this->model('PostCare');
          $this->structurePositionsModel = $this->model('StructurePosition');
          $this->surfaceConditionsModel = $this->model('SurfaceCondition');
          $this->examinationTechniquesModel = $this->model('ExaminationTechnique');
          $this->calibrationsModel = $this->model('Calibration');
          $this->ultrasoundInspectionModel = $this->model('UltrasoundInspection');  
          $this->ultrasoundUserModel = $this->model('UltrasoundUser');  
          $this->usersModel = $this->model('User');
          $this->couplersModel = $this->model('Coupler');  
          $this->probeDimensionsModel = $this->model('ProbeDimension');  
          $this->probeFrequencyModel = $this->model('ProbeFrequency');  
          $this->probeDetailsModel = $this->model('ProbeDetail');  
          $this->postItModel = $this->model('Postit');  
          $this->uninspectiblesModel = $this->model('Uninspectible');  

         if(!isLoggedIn()){  
            header("location:".URLROOT."/users/login");
        } 
    }

    public function index() {
  
               $data = [
               ];
               $this->view('pdfs/index', $data);
    }

     public function test(){ 
          
          if(isset($_GET["imageName"])
               && isset($_GET["idComponentIstance"])){ 
              
               $data = [
                    'imageName' => $_GET["imageName"],
                    'idComponentIstance'=>$_GET["idComponentIstance"]
               ];
               
               $postIts = $this->postItModel->getPostitsByImageNameAndIdComponent($data);
               $uninspectibles = $this->uninspectiblesModel->getUninspectibleByImageNameAndIdComponent($data);

               $data = [
                    'imageName' => $_GET["imageName"],
                    'idComponentIstance'=>$_GET["idComponentIstance"],
                    'postIts'=>$postIts,
                    'uninspectibles'=>$uninspectibles
               ]; 
               
               $imgUrl =   APPROOT. "/private/compInspec/". $_GET["idComponentIstance"]."/".$data["imageName"];
 
               // Load the base image
               $base_image = imagecreatefrompng($imgUrl);

               // Create a new image that is the same size as the base image
               $new_image = imagecreatetruecolor(imagesx($base_image), imagesy($base_image));
               
               // Loop through the post-it data and render each note on the new image
               foreach ($postIts as $postit) {
                    $x = $postit->x;
                    $y = $postit->y;
                    $note = $postit->note;
                    var_dump($note);
                    // Render the note text on the new image
                    $font = dirname(__FILE__) . '/arial.ttf';
                    $fontsize = 18;
                    $color = imagecolorallocate($new_image, 0, 0, 0);
                    imagettftext($new_image, $fontsize, 0, $x, $y, $color, $font, $note);
               }

                    // Composite the new image with the base image
                    imagecopy($new_image, $base_image, 0, 0, 0, 0, imagesx($base_image), imagesy($base_image));

                    // Save the resulting image to a file
                    imagepng($new_image, APPROOT.'/../public/assets/test.png');
 
          }else{ 
               header("location:".URLROOT."/folders");
          } 
     }

     public function report()  { 
          $inspection =$this->inspectionsModel->getInspectionById($_GET["idInspection"]);     
          $modelIstance = $this->modelIstancesModel->getModelIstanceById($inspection->fk_idModelIstance);
          $model = $this->modelsModel->getModelById($modelIstance->fk_idModel);
          $components = $this->inspectionComponentsModel->getComponentsByIdInspection($_GET["idInspection"]);
          $buildingTec = $this->tecsComponentIstanceModel->getBuildingTecByIdInspection($_GET["idInspection"]);
          $postCare= $this->postCaresModel->getPostCareByIdInspection($_GET["idInspection"]);
          $structurePositions = $this->structurePositionsModel->getStructurePositionByIdInspection($_GET["idInspection"]);
          $surfaceConditions = $this->surfaceConditionsModel->getSurfaceConditionByIdInspection($_GET["idInspection"]);
          $examinationTechniques = $this->examinationTechniquesModel->getExaminationTechniquesByIdInspection($_GET["idInspection"]);
          $calibrations = $this->calibrationsModel->getCalibrationsByIdInspection($_GET["idInspection"]);
          $users = $this->inspectionUsersModel->getInspectionUsersByIdInspection($_GET["idInspection"]);
          $ultrasounds = $this->ultrasoundInspectionModel->getUltrasoundInspectionByIdInspection($_GET["idInspection"]);
          $reviewer = $this->usersModel->getUserById($inspection->fk_idReviewer);
          $couplers = $this->couplersModel->getCouplersByIdInspection($_GET["idInspection"]);
          $frequencies = $this->probeFrequencyModel->getProbeFrequencyByIdInspection($_GET["idInspection"]);
          $dimensions = $this->probeDimensionsModel->getProbeDimensionsByIdInspection($_GET["idInspection"]);
          $details = $this->probeDetailsModel->getProbeDetailsByIdInspection($_GET["idInspection"]);


          if(isset($_GET["idInspection"])){ 

               $data = [
                    'inspection' =>$inspection,
                    'modelIstance'=>$modelIstance,
                    'model'=>$model,
                    'components'=>$components,
                    'buildingTec'=>$buildingTec,
                    'postCare'=>$postCare,
                    'structurePositions'=>$structurePositions,
                    'surfaceConditions'=>$surfaceConditions,
                    'examinationTechniques'=>$examinationTechniques,
                    'calibrations'=>$calibrations,
                    'users'=>$users,
                    'ultrasounds'=>$ultrasounds,
                    'reviewer'=>$reviewer,
                    'couplers'=>$couplers,
                    'frequencies'=>$frequencies,
                    'dimensions'=>$dimensions,
                    'details'=>$details
               ];
                 $this->view('pdfs/report', $data);
          }else{ 
               header("location:".URLROOT."/folders");
          } 
     } 
 
}
