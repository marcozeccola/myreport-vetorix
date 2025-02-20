<?php
class Inspections extends Controller { 
     

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


     public function __construct() { 

          if(!isLoggedIn()){  
               header("location:".URLROOT."/users/login");
          } 

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

     }


     public function index(){

          if(!isset($_GET["id"])){ 
               header("location:".URLROOT."/folders");
          } 

          $inspection =$this->inspectionsModel->getInspectionById($_GET["id"]);     
          $modelIstance = $this->modelIstancesModel->getModelIstanceById($inspection->fk_idModelIstance);
          $model = $this->modelsModel->getModelById($modelIstance->fk_idModel);
          $components = $this->inspectionComponentsModel->getComponentsByIdInspection($_GET["id"]);
          $buildingTec = $this->tecsComponentIstanceModel->getBuildingTecByIdInspection($_GET["id"]);
          $postCare= $this->postCaresModel->getPostCareByIdInspection($_GET["id"]);
          $structurePositions = $this->structurePositionsModel->getStructurePositionByIdInspection($_GET["id"]);
          $surfaceConditions = $this->surfaceConditionsModel->getSurfaceConditionByIdInspection($_GET["id"]);
          $examinationTechniques = $this->examinationTechniquesModel->getExaminationTechniquesByIdInspection($_GET["id"]);
          $calibrations = $this->calibrationsModel->getCalibrationsByIdInspection($_GET["id"]);
          $users = $this->inspectionUsersModel->getInspectionUsersByIdInspection($_GET["id"]);
          $ultrasounds = $this->ultrasoundInspectionModel->getUltrasoundInspectionByIdInspection($_GET["id"]);
          $reviewer = $this->usersModel->getUserById($inspection->fk_idReviewer);
          $data = [  
               'inspection'=>$inspection, 
               'modelIstance'=>$modelIstance,
               'model'=>$model,
               'tree'=>$this->foldersModel->getAllFolderTree($model->fk_idFolder),
               'components'=>$components,
               'buildingTec'=>$buildingTec,
               'postCare'=>$postCare,
               'structurePositions'=>$structurePositions,
               'surfaceCoditions'=>$surfaceConditions,
               'examinationTechniques'=>$examinationTechniques,
               'calibrations'=>$calibrations,
               'users'=>$users,
               'ultrasounds'=>$ultrasounds,
               'reviewer'=>$reviewer
          ];
  
          $this->view('inspections/index', $data);
     }
 
     public function addBasicInfo(){
           $data=[];
           if($_SERVER['REQUEST_METHOD'] == 'POST' 
               && isset($_POST["date"])
               && isset($_POST["client"])
               && isset($_POST["projectId"])
               && isset($_POST["builder"])
               && isset($_POST["factory"])
               && isset($_POST["year"])
               && isset($_POST["location"])
               && isset($_POST["goal"])
               && isset($_POST["type"])
               && isset($_POST["goalNotes"])
               && isset($_POST["idModelIstance"])){
                
              
              $data =[
                   'date'=>$_POST["date"],  
                   'client'=>$_POST["client"],
                   'projectId'=>$_POST["projectId"],
                   'builder'=>$_POST["builder"],
                   'factory'=>$_POST["factory"],
                   'year'=>$_POST["year"],
                   'location'=>$_POST["location"],
                   'goal'=>$_POST["goal"],
                   'type'=>$_POST["type"],
                   'goalNotes'=>$_POST["goalNotes"],
                   'fk_idModelIstance'=>$_POST["idModelIstance"],
                   'specificProcedure'=>"",
                   'accessibility'=>"",
                   'calibrationNotes'=>"",
                   'conclusions'=>"",
                   'fk_idReviewer'=>NULL
               ];

               if($idInspection = $this->inspectionsModel->insert($data) ){   

                    $data=[
                         'idUser'=>$_SESSION['user_id'],
                         'idInspection'=>$idInspection
                    ];
                    $this->inspectionUsersModel->insert($data);

                    $ultrasound = $this->ultrasoundUserModel->getUltrasoundUserByIdUser($_SESSION['user_id']);

                    $data = [
                         'ultrasound'=>$ultrasound->ultrasound,
                         'sn'=>$ultrasound->sn,
                         'expiration'=>$ultrasound->expiration,
                         'probe'=>$ultrasound->probe,
                         'idInspection'=>$idInspection
                    ];
                    $this->ultrasoundInspectionModel->insert($data);

                    header('location: ' . URLROOT . "/inspections?id=$idInspection");
               }else{
                    die("something went wrong");
               }

          }else{  
               if(!isset($_GET["idModelIstance"])){
                    header('location: ' . URLROOT . "/folders");
               }

               $idModelIstance = $_GET["idModelIstance"]; 
               $modelIstance = $this->modelIstancesModel->getModelIstanceById($idModelIstance);
               $model =$this->modelsModel->getModelById($modelIstance->fk_idModel);  
               $data=[
                    'idModelIstance'=>$idModelIstance,
                    'model'=>$model,
                    'tree'=>$this->foldersModel->getAllFolderTree($model->fk_idFolder)
               ];
               $this->view('inspections/addBasicInfo', $data);
          }
     }
  
     public function editBasicInfo(){
           $data=[];
           if($_SERVER['REQUEST_METHOD'] == 'POST' 
               && isset($_POST["date"])
               && isset($_POST["client"])
               && isset($_POST["projectId"])
               && isset($_POST["builder"])
               && isset($_POST["factory"])
               && isset($_POST["year"])
               && isset($_POST["location"])
               && isset($_POST["goal"])
               && isset($_POST["type"])
               && isset($_POST["goalNotes"])
               && isset($_POST["idInspection"])){
                
              
              $data =[
                   'date'=>$_POST["date"],  
                   'client'=>$_POST["client"],
                   'projectId'=>$_POST["projectId"],
                   'builder'=>$_POST["builder"],
                   'factory'=>$_POST["factory"],
                   'year'=>$_POST["year"],
                   'location'=>$_POST["location"],
                   'goal'=>$_POST["goal"],
                   'type'=>$_POST["type"],
                   'goalNotes'=>$_POST["goalNotes"],
                   'idInspection'=>$_POST["idInspection"] 
               ];

               if($idInspection = $this->inspectionsModel->editBasicInfo($data) ){   
                   
                    header('location: ' . URLROOT . "/inspections?id=$idInspection");
               }else{
                    die("something went wrong");
               }

          }else{  
               if(!isset($_GET["id"])){
                    header('location: ' . URLROOT . "/folders");
               }
 
               $inspection = $this->inspectionsModel->getInspectionById($_GET["id"]);
               $data=[ 
                    'inspection'=>$inspection
               ];
               $this->view('inspections/editBasicInfo', $data);
          }
     }

     public function editConclusions(){
           $data=[];
           if($_SERVER['REQUEST_METHOD'] == 'POST'  
               && isset($_POST["idInspection"])){
                
               $conclusions = isset($_POST["conclusions"]) ? $_POST["conclusions"] : ""; 
               $idInspection = $_POST["idInspection"];

               $data =[
                   'conclusions'=>$conclusions,   
                   'id'=>$idInspection
               ];

               if($this->inspectionsModel->editConclusions($data) ){     
                    header('location: ' . URLROOT . "/inspections?id=$idInspection#conclusions");
               }else{
                    die("something went wrong");
               }

          }else{  
               if(!isset($_GET["idInspection"])){
                    header('location: ' . URLROOT . "/folders");
               }
 
               $inspection = $this->inspectionsModel->getInspectionById($_GET["idInspection"]);
               $data=[ 
                    'inspection'=>$inspection 
               ];

               $this->view('inspections/editConclusions', $data);
          }
     }
     
     public function addReviewer(){
           $data=[];
           if($_SERVER['REQUEST_METHOD'] == 'POST'  
               && isset($_POST["idReviewer"])
               && isset($_POST["idInspection"]) ){
                 
               $idInspection = $_POST["idInspection"];

               $data =[
                   'idReviewer'=>$_POST["idReviewer"],   
                   'id'=>$idInspection
               ];

               if($this->inspectionsModel->editReviewer($data) ){     
                    header('location: ' . URLROOT . "/inspections?id=$idInspection#users");
               }else{
                    die("something went wrong");
               }

          }else{  
               if(!isset($_GET["idInspection"])){
                    header('location: ' . URLROOT . "/folders");
               }
 
               $inspection = $this->inspectionsModel->getInspectionById($_GET["idInspection"]);
               $reviewers = $this->usersModel->getAllReviewers();
               
               $data=[ 
                    'inspection'=>$inspection,
                    'reviewers'=>$reviewers
               ];

               $this->view('inspections/addReviewer', $data);
          }
     }
     
     public function editProcedures(){
           $data=[];
           if($_SERVER['REQUEST_METHOD'] == 'POST'  
               && isset($_POST["idInspection"])){
                
               $procedure = isset($_POST["procedure"]) ? $_POST["procedure"] : "";
               $accessibility = isset($_POST["accessibility"]) ? $_POST["accessibility"] : "";
               $idInspection = $_POST["idInspection"];

               $data =[
                   'procedure'=>$procedure,  
                   'accessibility'=>$accessibility,
                   'id'=>$idInspection
               ];

               if($this->inspectionsModel->editProcedures($data) ){   

                    $this->examinationTechniquesModel->deleteExaminationTechniqueByIdInspection($_POST["idInspection"]);
               
                    if($_POST["techniques"] ){
                         foreach($_POST["techniques"] as $technique){
                              
                              $data =[
                                   'examinationtechnique'=>$technique,  
                                   'idInspection'=>$_POST["idInspection"] 
                              ];

                              if(!$this->examinationTechniquesModel->insert($data)){
                                   die("something went wrong");
                              }
                         } 
                    }

                    header('location: ' . URLROOT . "/inspections?id=$idInspection#procedures");
               }else{
                    die("something went wrong");
               }

          }else{  
               if(!isset($_GET["idInspection"])){
                    header('location: ' . URLROOT . "/folders");
               }
 
               $inspection = $this->inspectionsModel->getInspectionById($_GET["idInspection"]);
               $data=[ 
                    'inspection'=>$inspection,
                    'techniques'=>$this->examinationTechniquesModel->getExaminationTechniquesByIdInspection($_GET["idInspection"])
               ];

               $this->view('inspections/editProcedures', $data);
          }
     }
     
     public function editCalibrations(){
           $data=[];
           if($_SERVER['REQUEST_METHOD'] == 'POST'  
               && isset($_POST["idInspection"])){
                
               $calibrationNotes = isset($_POST["calibrationNotes"]) ? $_POST["calibrationNotes"] : ""; 
               $idInspection = $_POST["idInspection"];

               $data =[
                   'calibrationNotes'=>$calibrationNotes,   
                   'id'=>$idInspection
               ];

               if($this->inspectionsModel->editCalibrationNotes($data) ){   

                    $this->calibrationsModel->deleteCalibrationByIdInspection($_POST["idInspection"]);
               
                    if($_POST["calibrations"] ){
                         foreach($_POST["calibrations"] as $calibration){
                              
                              $data =[
                                   'calibration'=>$calibration,  
                                   'idInspection'=>$_POST["idInspection"] 
                              ];

                              if(!$this->calibrationsModel->insert($data)){
                                   die("something went wrong");
                              }
                         } 
                    }

                    header('location: ' . URLROOT . "/inspections?id=$idInspection#calibrations");
               }else{
                    die("something went wrong");
               }

          }else{  
               if(!isset($_GET["idInspection"])){
                    header('location: ' . URLROOT . "/folders");
               }
 
               $inspection = $this->inspectionsModel->getInspectionById($_GET["idInspection"]);
               $calibrations = $this->calibrationsModel->getCalibrationsByIdInspection($_GET["idInspection"]);
               $data=[ 
                    'inspection'=>$inspection,
                    'calibrations'=> $calibrations
               ];

               $this->view('inspections/editCalibrations', $data);
          }
     }

     
     public function addUser(){
           $data=[];
           if($_SERVER['REQUEST_METHOD'] == 'POST'  
               && isset($_POST["idInspection"]) 
               && isset($_POST["idUser"])){
                 
               $idInspection = $_POST["idInspection"];
               $idUser = $_POST["idUser"];

               $data =[
                   'idUser'=>$idUser,   
                   'idInspection'=>$idInspection
               ];

               if($this->inspectionUsersModel->insert($data) ){   

                    $ultrasound = $this->ultrasoundUserModel->getUltrasoundUserByIdUser($idUser);

                    if($ultrasound){

                         $data = [
                              'ultrasound'=>$ultrasound->ultrasound,
                              'sn'=>$ultrasound->sn,
                              'expiration'=>$ultrasound->expiration,
                              'probe'=>$ultrasound->probe,
                              'idInspection'=>$idInspection
                         ];

                         $this->ultrasoundInspectionModel->insert($data);

                    }

                    header('location: ' . URLROOT . "/inspections?id=$idInspection#users");
               }else{
                    die("something went wrong");
               }

          }else{  
               if(!isset($_GET["idInspection"])){
                    header('location: ' . URLROOT . "/folders");
               }
 
               $users = $this->usersModel->getAll(); 
               $data=[ 
                    'users'=>$users 
               ];

               $this->view('inspections/addUser', $data);
          }
     }
   
}
