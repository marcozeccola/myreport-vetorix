<?php
class StructurePositions extends Controller { 
     

     var $foldersModel;
     var $modelsModel;
     var $componentsModel;
     var $modelIstancesModel;
     var $componentIstancesModel;
     var $inspectionsModel;
     var $inspectionComponentsModel;
     var $postCaresModel;
     var $structurePositionsModel;


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
          $this->postCaresModel = $this->model('PostCare');
          $this->structurePositionsModel = $this->model('StructurePosition');
     }

 
 
     public function edit(){
           $data=[];
           if($_SERVER['REQUEST_METHOD'] == 'POST'   
               && isset($_POST["idInspection"]) ){ 

               $this->structurePositionsModel->deleteStructurePositionByIdInspection($_POST["idInspection"]);
               
               if($_POST["positions"] ){
                    foreach($_POST["positions"] as $position){
                         
                         $data =[
                              'position'=>$position,  
                              'idInspection'=>$_POST["idInspection"] 
                         ];

                         if(!$this->structurePositionsModel->insert($data)){
                              die("something went wrong");
                         }
                    } 
               }
                   
               header('location: ' . URLROOT . "/inspections?id=".$_POST["idInspection"]."#info");
               

          }else{  
               if(!isset($_GET["idInspection"])){
                    header('location: ' . URLROOT . "/folders");
               }

               $idInspection = $_GET["idInspection"]; 
               $positions = $this->structurePositionsModel->getStructurePositionByIdInspection($idInspection);

               $data=[
                    'idInspection'=>$idInspection,
                    'positions'=>$positions
               ];
               $this->view('structurePositions/edit', $data);
          }
     }
 
  
 
   
}
