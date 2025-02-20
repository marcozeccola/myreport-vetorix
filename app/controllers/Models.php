<?php
class Models extends Controller { 
     

     var $foldersModel;
     var $modelsModel;
     var $componentsModel;
     var $modelIstancesModel;

     public function __construct() { 

          if(!isLoggedIn()){  
               header("location:".URLROOT."/users/login");
          } 

          $this->modelsModel = $this->model('Model');  
          $this->foldersModel = $this->model('Folder');  
          $this->componentsModel = $this->model('Component');  
          $this->modelIstancesModel = $this->model('ModelIstance');  
     }


     public function index(){

          if(!isset($_GET["id"])){ 
               header("location:".URLROOT."/folders");
          } 

          $model =$this->modelsModel->getModelById($_GET["id"]);   
          $components = $this->componentsModel->getComponentsByIdModel($_GET["id"]);
          $istances = $this->modelIstancesModel->getModelIstancesByIdModel($_GET["id"]);
  
          $data = [  
               'model'=>$model,
               'components'=>$components,
               'istances'=>$istances,
               'tree'=>$this->foldersModel->getAllFolderTree($model->fk_idFolder)
          ];
  
          $this->view('models/index', $data);
     }
 
     
     
     public function addModel(){
           $data=[];
           if($_SERVER['REQUEST_METHOD'] == 'POST' 
               && isset($_POST["model"])
               && isset($_POST["idFolder"])){
                
               $idFolder = $_POST["idFolder"];
               $data =[
                    'model'=>$_POST["model"],
                    'idFolder'=> $idFolder ,
               ];

               $newId = $this->modelsModel->insert($data);
               header('location: ' . URLROOT . "/folders?idFolder=$idFolder");

          }else{  
               $idFolder = isset($_GET["idFolder"]) ? $_GET["idFolder"] : 0;
               $data=[
                    'idFolder'=>$idFolder,
                    'tree'=>$this->foldersModel->getAllFolderTree($idFolder)
               ];
               $this->view('models/addModel', $data);
          }
     }



     public function changeModelName(){ 

          if($_SERVER['REQUEST_METHOD'] == 'POST'){

               $data =[ 
                    'id'=>$_POST["idModel"],
                    'model'=>$_POST["model"]
               ];

               $this->modelsModel->editModel($data); 
             
               header('location: ' . URLROOT . "/models/index?id=".$data["id"]);
              
          }else{  

               if(isset($_GET["idModel"])){ 
                    $data =[
                        'idModel'=>$_GET["idModel"],  
                        'model'=>$this->modelsModel->getModelById($_GET["idModel"])
                    ];
                    
                    $this->view('models/editModel', $data);
               }else{
                    header('location: ' . URLROOT. "/folders");
               }
               
          }
     }
  
}
