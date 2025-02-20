<?php
class Folders extends Controller { 
     

     var $foldersModel;
     var $modelsModel;

     public function __construct() { 

          if(!isLoggedIn()){  
               header("location:".URLROOT."/users/login");
          } 

          $this->modelsModel = $this->model('Model');  
          $this->foldersModel = $this->model('Folder');  
     }


     public function index(){

          if(!isset($_GET["idFolder"])){
               $currFolder = NULL;
               $idFolder = 0;
               $folders = $this->foldersModel->getRootFolders();
          } else{
               $idFolder = trim($_GET["idFolder"]);
               $currFolder = $this->foldersModel->getFolderById((int)$_GET["idFolder"]);
               $folders = $this->foldersModel->getFoldersByParentId((int)$_GET["idFolder"]);
          }

          $models =$this->modelsModel->getModelsByIdFolder($idFolder);  
          $allModels =  $this->modelsModel->getAllModels();
  
          $data = [  
               'tree'=>$this->foldersModel->getAllFolderTree($idFolder), 
               'folders'=> $folders, 
               'models'=> $models,
               'folder'=>$currFolder 
          ];
  
          $this->view('folders/index', $data);
     }
 
     
     
     public function addFolder(){
           $data=[];
           if($_SERVER['REQUEST_METHOD'] == 'POST' 
               && isset($_POST["folder"])
               && isset($_POST["idFolder"])){
                
               $data =[
                    'folder'=>$_POST["folder"],
                    'idFolder'=>$_POST["idFolder"],
               ];

               $newId = $this->foldersModel->inserisci($data);
               header('location: ' . URLROOT . "/folders?idFolder=$newId");

          }else{  
               $idFolder = isset($_GET["idFolder"]) ? $_GET["idFolder"] : 0;
               $data=[
                    'idFolder'=>$idFolder,
                    'tree'=>$this->foldersModel->getAllFolderTree($idFolder)
               ];
               $this->view('folders/addFolder', $data);
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
