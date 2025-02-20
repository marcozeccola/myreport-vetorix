<?php
class SurfaceConditions extends Controller { 
     

     var $foldersModel;
     var $modelsModel;
     var $componentsModel;
     var $modelIstancesModel;
     var $componentIstancesModel;
     var $inspectionsModel;
     var $inspectionComponentsModel;
     var $postCaresModel;
     var $surfaceConditionsModel;


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
          $this->surfaceConditionsModel = $this->model('SurfaceCondition');
     }

 
 
     public function edit(){
           $data=[];
           if($_SERVER['REQUEST_METHOD'] == 'POST'   
               && isset($_POST["idInspection"]) ){ 

               $this->surfaceConditionsModel->deleteSurfaceConditionByIdInspection($_POST["idInspection"]);
               
               if($_POST["conditions"] ){
                    foreach($_POST["conditions"] as $condition){
                         
                         $data =[
                              'condition'=>$condition,  
                              'idInspection'=>$_POST["idInspection"] 
                         ];

                         if(!$this->surfaceConditionsModel->insert($data)){
                              die("something went wrong");
                         }
                    } 
               }

               if(isset($_POST["other"]) && $_POST["other"]!="" ){ 
                    $data =[
                         'condition'=>$_POST["other"],  
                         'idInspection'=>$_POST["idInspection"] 
                    ];

                    if(!$this->surfaceConditionsModel->insert($data)){
                         die("something went wrong");
                    } 
               }
                   
               header('location: ' . URLROOT . "/inspections?id=".$_POST["idInspection"]."#info");
               

          }else{  
               if(!isset($_GET["idInspection"])){
                    header('location: ' . URLROOT . "/folders");
               }

               $idInspection = $_GET["idInspection"]; 
               $conditions = $this->surfaceConditionsModel->getSurfaceConditionByIdInspection($idInspection);

               $data=[
                    'idInspection'=>$idInspection,
                    'conditions'=>$conditions
               ];
               $this->view('surfaceConditions/edit', $data);
          }
     }
 
  
 
   
}
