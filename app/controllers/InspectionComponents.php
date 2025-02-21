<?php
class InspectionComponents extends Controller { 
     

     var $foldersModel;
     var $modelsModel;
     var $componentsModel;
     var $modelIstancesModel;
     var $componentIstancesModel;
     var $inspectionsModel;
     var $inspectionComponentsModel;
     var $postItModel;


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
     }


     public function index(){

          if(!isset($_GET["idComponent"]) && !isset($_GET["idInspection"])){ 
               header("location:".URLROOT."/folders");
          } 

          $component = $this->componentIstancesModel->getComponentIstanceById($_GET["idComponent"]);
          $inspection =$this->inspectionsModel->getInspectionById($_GET["idInspection"]);     
          $modelIstance = $this->modelIstancesModel->getModelIstanceById($inspection->fk_idModelIstance);
          $model = $this->modelsModel->getModelById($modelIstance->fk_idModel);
          $postIt = $this->postItModel->getPositsByIdComponent($_GET["idComponent"]);

          $data = [  
               'inspection'=>$inspection, 
               'component'=>$component,
               'modelIstance'=>$modelIstance,
               'model'=>$model,
               'tree'=>$this->foldersModel->getAllFolderTree($model->fk_idFolder), 
               'postIt'=>$postIt
          ];
  
          $this->view('inspectionComponents/index', $data);
     }


     public function addInspectionComponent(){
           $data=[];
           if($_SERVER['REQUEST_METHOD'] == 'POST' 
               && isset($_POST["idInspection"])
               && isset($_POST["idComponentIstance"]) ){
                
               foreach($_POST["idComponentIstance"] as $idComponentIstance){
                    $idInspection = $_POST["idInspection"];
              
                    $data =[
                         'idInspection'=>$idInspection,  
                         'idComponentIstance'=>$idComponentIstance,
                         'interferences'=>NULL
                    ];

                    if(!$this->inspectionComponentsModel->insert($data)){
                         die("something went wrong");
                    }
               } 
 
                   
               header('location: ' . URLROOT . "/inspections?id=$idInspection");
                

          }else{  
               if(!isset($_GET["idInspection"])){
                    header('location: ' . URLROOT . "/folders");
               }

               $idInspection = $_GET["idInspection"]; 
               $inspection = $this->inspectionsModel->getInspectionById($idInspection);
               $idModelIstance = $inspection->fk_idModelIstance;
               $components = $this->componentIstancesModel->getComponentIstanceNotInInspectionByIdModelIstance($idModelIstance);
               $data=[
                    'inspection'=>$inspection,
                    'components'=>$components
               ];
               $this->view('inspectionComponents/addInspectionComponent', $data);
          }
     }
 
  

     public function editInterferences(){
           $data=[];
           if($_SERVER['REQUEST_METHOD'] == 'POST'  
               && isset($_POST["idInspectionComponent"])
               && isset($_POST["interferences"]) ){
               
               $idInspection = $this->inspectionComponentsModel->getInspectionComponentById($_POST["idInspectionComponent"])->fk_idInspection;

               $data =[
                   'idInspectionComponent'=>$_POST["idInspectionComponent"],  
                   'interferences'=>$_POST["interferences"] 
               ];

               if($this->inspectionComponentsModel->editInterferences($data) ){    
                    header('location: ' . URLROOT . "/inspections?id=$idInspection");
               }else{
                    die("something went wrong");
               }

          }else{  
               if(!isset($_GET["idInspection"]) || !isset($_GET["idComponent"])){
                    header('location: ' . URLROOT . "/folders");
               } 
               $inspectionComponent = $this->inspectionComponentsModel->getInspectionComponentByInspectionAndComponent($_GET["idInspection"],$_GET["idComponent"] );
               
               if(!$inspectionComponent){
                    header('location: ' . URLROOT . "/folders"); 
               }
  
               $data=[ 
                    'idInspectionComponent'=>$inspectionComponent->idInspectionComponent,
                    'interferences'=>$inspectionComponent->interferences,
               ];

               $this->view('inspectionComponents/editInterferences', $data);
          }
     }


     public function editNotes(){
           $data=[];
           if($_SERVER['REQUEST_METHOD'] == 'POST'  
               && isset($_POST["idInspectionComponent"])
               && isset($_POST["notes"]) ){
               
               $idInspection = $this->inspectionComponentsModel->getInspectionComponentById($_POST["idInspectionComponent"])->fk_idInspection;

               $data =[
                   'idInspectionComponent'=>$_POST["idInspectionComponent"],  
                   'notes'=>$_POST["notes"] 
               ];

               if($this->inspectionComponentsModel->editNotes($data) ){    
                    header('location: ' . URLROOT . "/inspections?id=$idInspection");
               }else{
                    die("something went wrong");
               }

          }else{  
               if(!isset($_GET["idInspection"]) || !isset($_GET["idComponent"])){
                    header('location: ' . URLROOT . "/folders");
               } 
               $inspectionComponent = $this->inspectionComponentsModel->getInspectionComponentByInspectionAndComponent($_GET["idInspection"],$_GET["idComponent"] );
               
               if(!$inspectionComponent){
                    header('location: ' . URLROOT . "/folders"); 
               }
  
               $data=[ 
                    'idInspectionComponent'=>$inspectionComponent->idInspectionComponent,
                    'notes'=>$inspectionComponent->notes,
               ];

               $this->view('inspectionComponents/editNotes', $data);
          }
     }

    

     
     public function deleteComponent(){
          if(isset($_GET["id"])){   
               $idInspection = $this->inspectionComponentsModel->getInspectionComponentById($_GET["id"])->fk_idInspection;
               $this->inspectionComponentsModel->deleteInspectionComponentById($_GET["id"]);
               header('location: ' . URLROOT . "/inspections/index?id=".$idInspection); 
          }else{
               header('location: ' . URLROOT . "/folders/");  
          }
     }
 
               // Call the view function to display the editInterferences page
   
}
