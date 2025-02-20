<?php
class UltrasoundUsers extends Controller { 
     
     var $ultrasoundUserModel ;
     var $usersModel ;


     public function __construct() { 

          if(!isLoggedIn()){  
               header("location:".URLROOT."/users/login");
          } 

          $this->ultrasoundUserModel = $this->model('UltrasoundUser');  
          $this->usersModel = $this->model('User');     
     }


     public function index(){
          if(isset($_GET["idUser"]) && !isAdmin() &&  $_SESSION["user_id"] != $_GET["idUser"] ){
               header('location: ' . URLROOT . "/folders"); 
          }

          $userId = isset($_GET["idUser"]) ? $_GET["idUser"] : $_SESSION["user_id"];
          $ultrasound =$this->ultrasoundUserModel->getUsedUltrasoundUserById($userId);     
          $user = $this->usersModel->getUserById($userId);
          $data = [  
               'user'=>$user,
               'ultrasound'=>$ultrasound
          ];
  
          $this->view('ultrasoundsUser/index', $data);
     }
 
     public function addUltrasound(){
           $data=[];
           if($_SERVER['REQUEST_METHOD'] == 'POST' 
               && isset($_POST["ultrasound"])
               && isset($_POST["idUser"])
               && isset($_POST["expiration"])
               && isset($_POST["probe"])
               && isset($_POST["sn"])
               && (isAdmin() || $_POST["idUser"] == $_SESSION["user_id"])){
                
                
               $data =[
                    'ultrasound'=>$_POST["ultrasound"],
                    'idUser'=>$_POST["idUser"],
                    'expiration'=>$_POST["expiration"],
                    'probe'=>$_POST["probe"],
                    'sn'=>$_POST["sn"] 
               ];

               $idUser = $_POST["idUser"];
               $this->ultrasoundUserModel->unUseAllUltrasoundByUserId($data["idUser"]);
               if( $this->ultrasoundUserModel->insert($data)){   
                    header('location: ' . URLROOT . "/ultrasoundusers?idUser=$idUser");
               }else{
                    die("something went wrong");
               }

          }else{   

               $idUser = isset($_GET["idUser"]) ? $_GET["idUser"] : $_SESSION["user_id"]; 
               $data=[
                    'idUser'=>$idUser
               ];
               $this->view('ultrasoundsUser/addUltrasound', $data);
          }
     }
 
   
}
