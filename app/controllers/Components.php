<?php
class Components extends Controller { 
     

     var $foldersModel;
     var $modelsModel;
     var $componentsModel;

     public function __construct() { 

          if(!isLoggedIn()){  
               header("location:".URLROOT."/users/login");
          } 

          $this->componentsModel = $this->model('Component');  
          $this->modelsModel = $this->model('Model');  
          $this->foldersModel = $this->model('Folder');  
     }


     public function index(){

          if(!isset($_GET["id"])){ 
               header("location:".URLROOT."/folders");
          } 

          $component =$this->componentsModel->getComponentById($_GET["id"]);    
          $model =$this->modelsModel->getModelById($component->fk_idModel);   

          $data = [  
               'component'=>$component,
               'model'=>$model,
               'tree'=>$this->foldersModel->getAllFolderTree($model->fk_idFolder)
          ];
  
          $this->view('components/index', $data);
     }
 
     public function addComponent(){
           $data=[];
           if($_SERVER['REQUEST_METHOD'] == 'POST' 
               && isset($_POST["component"])
               && isset($_POST["idModel"])){
                
               $idModel = $_POST["idModel"];
               $data =[
                    'component'=>$_POST["component"],
                    'idModel'=> $idModel ,
               ];

               if($idComponent = $this->componentsModel->insert($data)){
                    $error=array();
                    $extension=array("jpeg","jpg","png","gif");
                    foreach($_FILES["imgs"]["tmp_name"] as $key=>$tmp_name) {
                         $file_name=$_FILES["imgs"]["name"][$key];
                         $file_tmp=$_FILES["imgs"]["tmp_name"][$key];
                         $ext=pathinfo($file_name,PATHINFO_EXTENSION);

                         if(in_array($ext,$extension)) { 

                              if(file_exists($file_tmp) || is_uploaded_file($file_tmp)) {
                                   $dirComponent =  str_replace( ' ', '',APPROOT. "/private/compModels/ ". $idComponent . "/ ");
                                   
                                   if (!file_exists($dirComponent)) {
                                        mkdir(  $dirComponent, 0777, true);
                                   }

                                   $caricamentoProcedure = move_uploaded_file($file_tmp, $dirComponent. $file_name);   
                              }else{
                                   $caricamentoProcedure = true;
                              }
                                   

                         }
                         else {
                              array_push($error,"$file_name, ");
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
               $this->view('components/addComponent', $data);
          }
     }
 
 
     public function addImages(){
           $data=[];
           if($_SERVER['REQUEST_METHOD'] == 'POST'  && isset($_POST["idComponent"]) ){

               $idComponent = $_POST["idComponent"];

               $component = $this->componentsModel->getComponentById($idComponent);
               $model = $this->modelsModel->getModelById($component->fk_idModel);
               $idModel = $model->idModel;

               $error=array();
               $extension=array("jpeg","jpg","png","gif");
               foreach($_FILES["imgs"]["tmp_name"] as $key=>$tmp_name) {
                    $file_name=$_FILES["imgs"]["name"][$key];
                    $file_tmp=$_FILES["imgs"]["tmp_name"][$key];
                    $ext=pathinfo($file_name,PATHINFO_EXTENSION);

                    if(in_array($ext,$extension)) { 

                         if(file_exists($file_tmp) || is_uploaded_file($file_tmp)) {
                              $dirComponent =  str_replace( ' ', '',APPROOT. "/private/compModels/ ". $idComponent . "/ ");
                              
                              if (!file_exists($dirComponent)) {
                                   mkdir(  $dirComponent, 0777, true);
                              }

                              $caricamentoProcedure = move_uploaded_file($file_tmp, $dirComponent. $file_name);   
                         }else{
                              $caricamentoProcedure = true;
                         }
                              

                    }else {
                         array_push($error,"$file_name, ");
                    }
               }
               header('location: ' . URLROOT . "/components?id=$idComponent"); 

          }else{  
               if(!isset($_GET["idComponent"])){
                    header('location: ' . URLROOT . "/folders");
               }

               $idComponent = $_GET["idComponent"]; 
               $component = $this->componentsModel->getComponentById($idComponent);
               $model =$this->modelsModel->getModelById($component->fk_idModel);  
               $data=[
                    'component'=>$component,
                    'model'=>$model,
                    'tree'=>$this->foldersModel->getAllFolderTree($model->fk_idFolder)
               ];
               $this->view('components/addImages', $data);
          }
     }

     public function changeComponentName(){ 

          if($_SERVER['REQUEST_METHOD'] == 'POST'){

               $data =[ 
                    'id'=>$_POST["idComponent"],
                    'component'=>$_POST["component"]
               ];

               $this->componentsModel->editComponent($data); 
             
               header('location: ' . URLROOT . "/components/index?id=".$data["id"]);
              
          }else{  

               if(isset($_GET["idComponent"])){ 
                    $data =[
                        'idComponent'=>$_GET["idComponent"],  
                        'component'=>$this->componentsModel->getComponentById($_GET["idComponent"])
                    ];
                    
                    $this->view('components/editComponent', $data);
               }else{
                    header('location: ' . URLROOT. "/folders");
               }
               
          }
     }
  
     public function deleteImgComponent(){
         
           if(isset($_GET["idComponent"]) 
               && isset($_GET["file"]) 
               && $_GET["file"]!="" 
               && $_GET["idComponent"]!=""){ 

               $cartella = str_replace(' ', '',  APPROOT. "/private/compModels/ ".$_GET["idComponent"]."/ ");
               $file = $cartella . $_GET["file"];
               if(file_exists($file)){
                    unlink($file);
               }

               header('location: ' . URLROOT . "/components/index?id=".$_GET['idComponent']);
          }else{
               header('location: ' . URLROOT . "/folders/");
          }
     }
}
