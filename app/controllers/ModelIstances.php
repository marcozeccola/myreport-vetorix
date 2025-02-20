<?php
class ModelIstances extends Controller { 
     

     var $foldersModel;
     var $modelsModel;
     var $componentsModel;
     var $modelIstancesModel;
     var $componentIstancesModel;
     var $inspectionsModel;


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
     }


     public function index(){

          if(!isset($_GET["id"])){ 
               header("location:".URLROOT."/folders");
          } 

          $modelIstance =$this->modelIstancesModel->getModelIstanceById($_GET["id"]);    
          $model = $this->modelsModel->getModelById($modelIstance->fk_idModel);
          $inspections = $this->inspectionsModel->getInspectionsByIdModelIstance($_GET["id"]);
           

          $data = [  
               'modelIstance'=>$modelIstance,
               'model'=>$model,
               'tree'=>$this->foldersModel->getAllFolderTree($model->fk_idFolder),
               'inspections'=>$inspections
          ];
  
          $this->view('modelIstances/index', $data);
     }
 
     public function addModelIstance(){
           $data=[];
           if($_SERVER['REQUEST_METHOD'] == 'POST' 
               && isset($_POST["modelIstance"])
               && isset($_POST["idModel"])){
                
               $idModel = $_POST["idModel"];
               $data =[
                    'modelIstance'=>$_POST["modelIstance"],
                    'idModel'=> $idModel ,
               ];

               if($idModelIstance = $this->modelIstancesModel->insert($data)){  

                    $components = $this->componentsModel->getComponentsByIdModel($idModel);
                    foreach($components as $component){
                         $dataComponent = [
                              'componentIstance'=>$component->component,
                              'idModelIstance'=>$idModelIstance
                         ];

                         $idCompIstance = $this->componentIstancesModel->insert($dataComponent);
                         $compDir = APPROOT. "/private/compModels/". $component->idComponent . "/";
                         $compIstDir =  APPROOT. "/private/compInspec/". $idCompIstance . "/";
                          
                         if (!is_dir($compIstDir)) {
                              mkdir($compIstDir, 0777, true);
                         }

                         $files = scandir($compDir);
                         if($files){
                              foreach ($files as $file) {
                                   if ($file !== '.' && $file !== '..') {
                                        $sourceFile = $compDir . '/' . $file;
                                        $destinationFile = $compIstDir . '/' . $file; 
                                        copy($sourceFile, $destinationFile);
                                        
                                   }
                              }
                         }

                    }
                    header('location: ' . URLROOT . "/models?id=$idModel");
               }else{
                    die("something went wrong");
               }

          }else{  
               if(!isset($_GET["idModel"])){
                    header('location: ' . URLROOT . "/folders");
               }

               $idModel = $_GET["idModel"]; 
               $model =$this->modelsModel->getModelById($idModel);  
               $data=[
                    'idModel'=>$idModel,
                    'model'=>$model,
                    'tree'=>$this->foldersModel->getAllFolderTree($model->fk_idFolder)
               ];
               $this->view('modelIstances/addModelIstance', $data);
          }
     }
 
  

     public function changeModelIstanceName(){ 

          if($_SERVER['REQUEST_METHOD'] == 'POST'){

               $data =[ 
                    'id'=>$_POST["idModelIstance"],
                    'modelIstance'=>$_POST["modelIstance"],
                    'date'=>$_POST["date"]
               ];

               $this->modelIstancesModel->editModelIstance($data); 
             
               header('location: ' . URLROOT . "/modelIstances/index?id=".$data["id"]);
              
          }else{  

               if(isset($_GET["idModelIstance"])){ 
                    $data =[
                        'idModelIstance'=>$_GET["idModelIstance"],  
                        'modelIstance'=>$this->modelIstancesModel->getModelIstanceById($_GET["idModelIstance"])
                    ];
                    
                    $this->view('modelIstances/editModelIstance', $data);
               }else{
                    header('location: ' . URLROOT. "/folders");
               }
               
          }
     }
   
}
