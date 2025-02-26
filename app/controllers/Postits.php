<?php
class Postits extends Controller { 
     

     var $foldersModel;
     var $modelsModel;
     var $componentsModel;
     var $modelIstancesModel;
     var $componentIstancesModel;
     var $inspectionsModel;
     var $inspectionComponentsModel;
     var $postItModel;
     var $uninspectiblesModel;

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
          $this->foldersModel = $this->model('Folder'); 
          $this->postItModel = $this->model('Postit');  
          $this->uninspectiblesModel = $this->model('Uninspectible');  
     }

 
     
     
      public function addPostItNote() {
          $data = [];
          if ($_SERVER['REQUEST_METHOD'] == 'POST' 
                    && isset($_POST["idComponentIstance"]) 
                    && isset($_POST["imageName"]) 
                    && isset($_POST["note"]) 
                    && isset($_POST["x"]) 
                    && isset($_POST["y"])) {
               
               $idInspection = $_POST["idInspection"];
               $idComponentIstance = $_POST["idComponentIstance"];
               $imageName = $_POST["imageName"];
               $note = $_POST["note"];
               $x = $_POST["x"];
               $y = $_POST["y"];
  
               // Insert note into database
               $data = [
                    'imageName' => $imageName,
                    'idComponentIstance' => $idComponentIstance,
                    'note' => $note,
                    'x' => $x,
                    'y' => $y,
               ];

               if (!$this->postItModel->insert($data)) {
                    die("Something went wrong");
               }

               // Return success message 
               header('location: ' . URLROOT. "/postits/singleImage?idInspection=$idInspection&imageName=$imageName&idComponent=$idComponentIstance");
          } else {

               header('location: ' . URLROOT. "/folders");
          }
     }

     public function singleImage() {
          $data = [];
          if ($_SERVER['REQUEST_METHOD'] == 'GET' 
                    && isset($_GET["imageName"])
                    && isset($_GET["idComponent"])
                    && isset($_GET["idInspection"]) )   {
 
               $component = $this->componentIstancesModel->getComponentIstanceById($_GET["idComponent"]);
               $inspection =$this->inspectionsModel->getInspectionById($_GET["idInspection"]);     
               $modelIstance = $this->modelIstancesModel->getModelIstanceById($inspection->fk_idModelIstance);
               $model = $this->modelsModel->getModelById($modelIstance->fk_idModel);
               $data = [
                    'imageName' => $_GET["imageName"],
                    'idComponentIstance'=>$_GET["idComponent"]
               ];
               
               $postIts = $this->postItModel->getPostitsByImageNameAndIdComponent($data);
               $uninspectibles = $this->uninspectiblesModel->getUninspectibleByImageNameAndIdComponent($data);

               // Insert note into database
               $data = [
                    'inspection'=>$inspection, 
                    'component'=>$component,
                    'modelIstance'=>$modelIstance,
                    'model'=>$model,
                    'tree'=>$this->foldersModel->getAllFolderTree($model->fk_idFolder), 
                    'postits'=>$postIts,
                    'uninspectibles'=>$uninspectibles
               ];
                

               // Return success message 
               $this->view('postits/index', $data);
          } else {

               header('location: ' . URLROOT. "/folders");
          }
     }

     
     public function deletePostIt() {
          if ($_SERVER['REQUEST_METHOD'] == 'POST' 
                    && isset($_GET["idPostit"])
                    && isset($_GET["idInspection"]))   {
                    
               $postIt = $this->postItModel->getPostitById($_GET["idPostit"]);
               $idComponent = $postIt->fk_idComponentIstance; 
               $imageName = $postIt->imageName;

               if ($this->postItModel->delete($_GET["idPostit"])) {
                    header('location: ' . URLROOT. "/postits/singleImage?idInspection=".$_GET["idInspection"]."&imageName=".$imageName."&idComponent=".$idComponent);
               } else {
                    die("Something went wrong");
               }
          } else {

               header('location: ' . URLROOT. "/folders");
          }
     }

 
}
