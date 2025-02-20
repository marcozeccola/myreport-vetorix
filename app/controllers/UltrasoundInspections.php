<?php
class UltrasoundInspections extends Controller { 
     
     var $ultrasoundUserModel ;
     var $ultrasoundInspectionModel ;
     var $usersModel ;
     var $couplersModel ;
     var $probeDimensionsModel;
     var $probeFrequencyModel;
     var $probeDetailsModel;



     public function __construct() { 

          if(!isLoggedIn()){  
               header("location:".URLROOT."/users/login");
          } 

          $this->ultrasoundUserModel = $this->model('UltrasoundUser');  
          $this->ultrasoundInspectionModel = $this->model('UltrasoundInspection');  
          $this->usersModel = $this->model('User');     
          $this->couplersModel = $this->model('Coupler');  
          $this->probeDimensionsModel = $this->model('ProbeDimension');  
          $this->probeFrequencyModel = $this->model('ProbeFrequency');  
          $this->probeDetailsModel = $this->model('ProbeDetail');  
     }

 
 
     public function addUltrasound(){
           $data=[];
           if($_SERVER['REQUEST_METHOD'] == 'POST' 
               && isset($_POST["ultrasound"])
               && isset($_POST["idInspection"])
               && isset($_POST["expiration"])
               && isset($_POST["probe"])
               && isset($_POST["sn"]) ){
                
               $idInspection = $_POST["idInspection"];
               $data =[
                    'ultrasound'=>$_POST["ultrasound"],
                    'idInspection'=>$_POST["idInspection"],
                    'expiration'=>$_POST["expiration"],
                    'probe'=>$_POST["probe"],
                    'sn'=>$_POST["sn"] 
               ];
 
               if( $this->ultrasoundInspectionModel->insert($data)){   
                    header('location: ' . URLROOT . "/inspections?id=$idInspection");
               }else{
                    die("something went wrong");
               }

          }else{   

               if(!isset($_GET["idInspection"])){
                    header('location: ' . URLROOT . "/folders");
               } 
 
               $this->view('ultrasoundsInspection/addUltrasound', $data);
          }
     }
 
     public function editUltrasound(){
     $data = [];
     if ($_SERVER['REQUEST_METHOD'] == 'POST' 
          && isset($_POST["ultrasound"])
          && isset($_POST["idInspection"])
          && isset($_POST["expiration"])
          && isset($_POST["probe"])
          && isset($_POST["sn"])
          && isset($_POST["idUltrasound"])) {
               
          $idInspection = $_POST["idInspection"];
          $idUltrasound = $_POST["idUltrasound"];
          $data = [
               'ultrasound' => $_POST["ultrasound"], 
               'expiration' => $_POST["expiration"],
               'probe' => $_POST["probe"],
               'sn' => $_POST["sn"],
               'id' => $idUltrasound
          ];

          if ($this->ultrasoundInspectionModel->update($data)) {

               $this->couplersModel->deleteCouplerByIdUltrasound($_POST["idUltrasound"]);
               
               if($_POST["coupler"] ){
                    foreach($_POST["coupler"] as $coupler){
                         
                         $data =[
                              'coupler'=>$coupler,  
                              'idUltraSound'=>$_POST["idUltrasound"] 
                         ];

                         if(!$this->couplersModel->insert($data)){
                              die("something went wrong");
                         }
                    } 
               }

               
               
               $this->probeDimensionsModel->deleteProbeDimensionByIdUltrasound($_POST["idUltrasound"]);
               
               if($_POST["dimensions"] ){
                    foreach($_POST["dimensions"] as $dimension){
                         
                         $data =[
                              'probeDimension'=>$dimension,  
                              'idUltraSound'=>$_POST["idUltrasound"] 
                         ];

                         if(!$this->probeDimensionsModel->insert($data)){
                              die("something went wrong");
                         }
                    } 
               }

               
               
               $this->probeFrequencyModel->deleteFrequencyByIdUltrasound($_POST["idUltrasound"]);
               
               if($_POST["frequencies"] ){
                    foreach($_POST["frequencies"] as $frequency){
                         
                         $data =[
                              'probefrequency'=>$frequency,  
                              'idUltraSound'=>$_POST["idUltrasound"] 
                         ];

                         if(!$this->probeFrequencyModel->insert($data)){
                              die("something went wrong");
                         }
                    } 
               }
               
               
               $this->probeDetailsModel->deleteDetailByIdUltrasound($_POST["idUltrasound"]);
               
               if($_POST["details"] ){
                    foreach($_POST["details"] as $detail){
                         
                         $data =[
                              'probeDetail'=>$detail,  
                              'idUltraSound'=>$_POST["idUltrasound"] 
                         ];

                         if(!$this->probeDetailsModel->insert($data)){
                              die("something went wrong");
                         }
                    } 
               }


               header('location: ' . URLROOT . "/inspections?id=$idInspection#ultrasounds");
          } else {
               die("something went wrong");
          }

     } else {
          if (!isset($_GET["idUltrasound"])) {
               header('location: ' . URLROOT . "/folders");
          }

          $idUltrasound = $_GET["idUltrasound"];
          $ultrasound = $this->ultrasoundInspectionModel->getUltrasoundInspectionById($idUltrasound);

          $couplers = $this->couplersModel->getCouplerByIdUltrasound($idUltrasound);
          $dimensions = $this->probeDimensionsModel->getProbeDimensionByIdUltrasound($idUltrasound);
          $frequencies = $this->probeFrequencyModel->getProbeFrequencyByIdUltrasound($idUltrasound);
          $details = $this->probeDetailsModel->getProbeDetailByIdUltrasound($idUltrasound);

          $checkedCoupler = array_column($couplers, 'coupler');
          $checkedDimensions = array_column($dimensions, 'probeDimension');
          $checkedFrequencies = array_column($frequencies, 'probeFrequency');
          $checkedDetails = array_column($details, 'probeDetail');
          
          $data = [
               'ultrasoundInspection' => $ultrasound,
               'checkedCoupler' => $checkedCoupler,
               'checkedDimensions' => $checkedDimensions,
               'checkedFrequencies' => $checkedFrequencies,
               'checkedDetails' => $checkedDetails
          ];
          
          $this->view('ultrasoundsInspection/editUltrasound', $data);
     }
     }

   
}
