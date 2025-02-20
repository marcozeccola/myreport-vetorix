<?php
class BuildingTechniques extends Controller { 
     

     var $foldersModel;
     var $modelsModel;
     var $componentsModel;
     var $modelIstancesModel;
     var $componentIstancesModel;
     var $inspectionsModel;
     var $inspectionComponentsModel;
     var $postCaresModel;
     var $tecsComponentIstanceModel;


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
          $this->tecsComponentIstanceModel = $this->model('TecComponentIstance');
     }

 
 
     public function edit(){
           
           $data=[];
           if($_SERVER['REQUEST_METHOD'] == 'POST' 
               && isset($_POST["idComponent"]) 
               && isset($_POST["idInspection"]) ){ 

               $this->tecsComponentIstanceModel->deleteTecByIdComponentIstance($_POST["idComponent"]);
               
               if($_POST["tecs"]){
                    foreach($_POST["tecs"] as $tec){
                         
                         $data =[
                              'technique'=>$tec,  
                              'idComponentIstance'=>$_POST["idComponent"] 
                         ];

                         if(!$this->tecsComponentIstanceModel->insert($data)){
                              die("something went wrong");
                         }
                    } 
               }
 
                   
               header('location: ' . URLROOT . "/inspections?id=".$_POST["idInspection"]."#areainfo");
               

          }else{  
               if(!isset($_GET["idInspection"]) || !isset($_GET["idComponent"])){
                    header('location: ' . URLROOT . "/folders");
               }

               $idInspection = $_GET["idInspection"]; 
               $tecs = $this->tecsComponentIstanceModel->getTecCompByIdComponentIstance($_GET["idComponent"]);
               $component = $this->componentIstancesModel->getComponentIstanceById($_GET["idComponent"]);

               $data=[
                    'idComponent'=>$_GET["idComponent"],
                    'idInspection'=>$idInspection,
                    'tecs'=>$tecs,
                    'component'=>$component
               ];
               $this->view('buildingTechniques/edit', $data);
          } 
     }
 
  
 
   
}
