<?php
class PostCares extends Controller { 
     

     var $foldersModel;
     var $modelsModel;
     var $componentsModel;
     var $modelIstancesModel;
     var $componentIstancesModel;
     var $inspectionsModel;
     var $inspectionComponentsModel;
     var $postCaresModel;


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
     }

 
 
     public function edit(){
           $data=[];
           if($_SERVER['REQUEST_METHOD'] == 'POST' 
               && isset($_POST["idComponent"]) 
               && isset($_POST["idInspection"]) ){
                var_dump($_POST);
            $this->postCaresModel->deletePostCareByIdComponentIstance($_POST["idComponent"]);
               
               if($_POST["postCare"]){       
                    foreach($_POST["postCare"] as $PostCare){
                         
                         $data =[
                              'postcare'=>$PostCare,  
                              'idComponentIstance'=>$_POST["idComponent"] 
                         ];

                         if(!$this->postCaresModel->insert($data)){
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
               $PostCare = $this->postCaresModel->getPostCareByIdComponentIstance($_GET["idComponent"]);

               $data=[
                    'idComponent'=>$_GET["idComponent"],
                    'idInspection'=>$idInspection,
                    'postCare'=>$PostCare
               ];
               $this->view('postCares/editPostCare', $data);
          }
     }
 
  
 
   
}
