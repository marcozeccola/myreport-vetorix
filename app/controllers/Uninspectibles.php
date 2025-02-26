<?php
class Uninspectibles extends Controller { 
     

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

      public function addUninspectible() {
          $data = [];
          if ($_SERVER['REQUEST_METHOD'] == 'POST' 
                    && isset($_POST["idComponentIstance"]) 
                    && isset($_POST["imageName"]) 
                    && isset($_POST["width"]) 
                    && isset($_POST["height"]) 
                    && isset($_POST["x"]) 
                    && isset($_POST["y"])) {
               
               $idInspection = $_POST["idInspection"];
               $idComponentIstance = $_POST["idComponentIstance"];
               $imageName = $_POST["imageName"];
               $width = $_POST["width"];
               $height = $_POST["height"];
               $x = $_POST["x"];
               $y = $_POST["y"];
  
               // Insert note into database
               $data = [
                    'imageName' => $imageName,
                    'idComponentIstance' => $idComponentIstance,
                    'height' => $height,
                    'width' => $width,
                    'x' => $x,
                    'y' => $y,
               ];

               if (!$this->uninspectiblesModel->insert($data)) {
                    die("Something went wrong");
               }

          } else {

               header('location: ' . URLROOT. "/folders");
          }
     } 
 
}
