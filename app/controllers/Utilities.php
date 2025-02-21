<?php
class Utilities extends Controller { 
     

     var $foldersModel;
     var $modelsModel;

     public function __construct() { 

          if(!isLoggedIn()){  
               header("location:".URLROOT."/users/login");
          } 

          $this->modelsModel = $this->model('Model');  
          $this->foldersModel = $this->model('Folder');  
     }


      
    public function getPrivateFile(){
        if(isset($_GET["file"]) && isset($_GET["type"]) && isset($_GET["id"]) ){
 
            $data = [
                "file"=>$_GET["file"],
                "type"=>$_GET["type"],
                "id"=>$_GET["id"]
            ];

            $this->view('utilities/getPrivateFile', $data);
        }else{ 
            header('location: ' . URLROOT . "/folders/");
        }
    }
  
}
