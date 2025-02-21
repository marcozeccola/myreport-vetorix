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

               // Insert note into database
               $data = [
                    'inspection'=>$inspection, 
                    'component'=>$component,
                    'modelIstance'=>$modelIstance,
                    'model'=>$model,
                    'tree'=>$this->foldersModel->getAllFolderTree($model->fk_idFolder), 
                    'postits'=>$postIts
               ];
                

               // Return success message 
               $this->view('postits/index', $data);
          } else {

               header('location: ' . URLROOT. "/folders");
          }
     }



     public function changeFolderName(){ 

          if($_SERVER['REQUEST_METHOD'] == 'POST'){

               $data =[ 
                    'id'=>$_POST["idFolder"],
                    'folder'=>$_POST["folder"]
               ];

               $this->foldersModel->editFolder($data); 
             
               header('location: ' . URLROOT . "/folders/index?idFolder=".$data["id"]);
              
          }else{  

               if(isset($_GET["idFolder"])){ 
                    $data =[
                        'idFolder'=>$_GET["idFolder"],  
                        'folder'=>$this->foldersModel->getFolderById($_GET["idFolder"])
                    ];
                    
                    $this->view('folders/editFolder', $data);
               }else{
                    header('location: ' . URLROOT. "/folders");
               }
               
          }
     }
 
     public function deleteFolder(){
          if(isset($_GET["idFolder"]) 
               && !($this->modelsModel->getModelsByIdFolder($_GET["idFolder"]))->scalar
               && !$this->foldersModel->getFoldersByParentId($_GET["idFolder"]) ){  
               $fkFolder = $this->foldersModel->getFolderById($_GET["idFolder"])->fk_idFolder;
               $this->foldersModel->deleteFolderById($_GET["idFolder"]);
               header('location: ' . URLROOT . "/folders/index?idFolder=".$fkFolder); 
          }elseif(isset($_GET["idFolder"]) ){
                header('location: ' . URLROOT . "/folders/index?idFolder=".$_GET["idFolder"]."&error=1");  
          }else{
               header('location: ' . URLROOT . "/folders/");  
          }
     }
}
