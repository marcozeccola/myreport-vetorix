<?php
class Pages extends Controller { 
     var $usersModel ; 
     
    public function __construct() {
        
        if(!isLoggedIn()){  
            header("location:".URLROOT."/users/login");
        }  
        $this->usersModel = $this->model('User'); 

    }

    public function index() { 

        if(isLoggedIn()){  
            header("location:".URLROOT."/folders");
        }else{
            header("location:".URLROOT."/users/login");
        }
        
    }
 
}
