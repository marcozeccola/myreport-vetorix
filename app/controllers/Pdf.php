<?php
class Pdf extends Controller { 

     var $inspectionsModel;
    public function __construct() { 

         $this->inspectionsModel = $this->model('Inspection');

         if(!isLoggedIn()){  
            header("location:".URLROOT."/users/login");
        } 
    }

    public function index() {
  
               $data = [
               ];
               $this->view('pdfs/index', $data);
    }

    public function report() {

          if(isset($_GET["idInspection"])){ 

               $data = [
                    'inspection' => $this->inspectionsModel->getInspectionById($_GET["idInspection"]),
               ];
                 $this->view('pdfs/report', $data);
          }else{ 
               header("location:".URLROOT."/folders");
          } 
    }
 
 
}
