<?php
class Users extends Controller {
     var $userModel ;
     var $usersProjectsModel;
     var $projectModel;
    public function __construct() {
        $this->userModel = $this->model('User'); 
    }

    public function register() {

        if(!isAdmin()){
            header("location:".URLROOT);
        }

        $data = [
            'name' => '',
            'surname' => '',
            'email' => '',
            'password' => '', 
            'qualifications' => '', 
            'role' => '',
            'nameError' => '', 
            'surnameError' => '', 
            'confirmPassword' => '',
            'emailError' => '',
            'passwordError' => '', 
            'roleError' => '',
            'confirmPasswordError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'name' => trim($_POST['name']),
                'surname' => trim($_POST['surname']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']), 
                'role' => trim($_POST['role']),
                'qualifications' =>  trim($_POST['qualifications']), 
                'nameError' => '', 
                'surnameError' => '', 
                'emailError' => '',
                'passwordError' => '', 
                'roleError' => '',
                'confirmPasswordError' => ''
            ];
 
            $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";
 
            //validazione nome
            if (empty($data['name'])) {
                $data['nameError'] = 'Enter Name.';
            }

            
            //validazione cognome
            if (empty($data['surname'])) {
                $data['surnameError'] = 'Enter surname.';
            }

 
            //Validazione email
            if (empty($data['email'])) { 
                $data['emailError'] = 'Insert email.';
            }elseif($this->userModel->findUserByEmail($data['email'])) { 
                $data['emailError'] = 'Email already used'; 
            }
 
            // validazione password
            if(empty($data['password'])){
              $data['passwordError'] = 'Insert password.';
            } elseif(strlen($data['password']) < 6){
              $data['passwordError'] = 'At least 6 characters';
            } elseif (preg_match($passwordValidation, $data['password'])) {
              $data['passwordError'] = 'At least a number & a letter';
            }

            //validazione confirm password
             if (empty($data['confirmPassword'])) {
                $data['confirmPasswordError'] = 'Reinsert password.';
            } else {
                if ($data['password'] != $data['confirmPassword']) {
                    $data['confirmPasswordError'] = 'Passwords does not match!';
                }
            }

            // se non ci sono errori registra l'utente
            if (empty($data['nameError']) 
                && empty($data['surnameError']) 
                && empty($data['emailError']) 
                && empty($data['passwordError'])
                && empty($data['confirmPasswordError']) 
                && empty($data['roleError'])
                ) {

                // Hash della password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
 
                if ($idUtenteRegistrato = $this->userModel->register($data)) {
                    
                    /*se utente restricted gli vengono aggiunti tutti i permessi in automatico
                    if($data["role"]== "restricted"){ 
                         
                        $progetti = $this->projectModel->getAllProgetti();
                        foreach($progetti as $progetto){
                             
                            $data = [
                                "idProgetto"=>$progetto->idProgetto,
                                "idUser"=>$idUtenteRegistrato
                            ];
                            
                            $this->usersProjectsModel->inserisci($data );
                        }
                    }*/

                    //Redirect alla dashboard specialisti
                    header('location: ' . URLROOT . '/users/usersDashboard');
                } else {
                    die('Qualcosa è andato storto.');
                }
            }
        } 
            
        if(isLoggedIn()){  
            $this->view('users/register', $data);
        }else{
            header("location:".URLROOT."/users/login");
        }
        
    }

    public function login() {
 
        $data = [
            'title' => 'Login page',
            'email' => '',
            'password' => '',
            'usernameError' => '',
            'emailError' => '',
            'passwordError' => ''
        ];

       
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'emailError' => '',
                'passwordError' => ''
            ];

            //validazione email
            if (empty($data['email'])) {
                $data['emailError'] = 'Insert email.';
            }

            //validazione password
            if (empty($data['password'])) {
                $data['passwordError'] = 'Insert password.';
            }
 
            //se non ci sono errori avvia routine di login
            if (empty($data['emailError']) && empty($data['passwordError'])) {
                
                //constrolla se l'utente esiste
                if( $userExists = $this->userModel->findUserByEmail($data['email'])){
 
                    //richiama il metodo di log
                    $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                    
                    //se psw e usrn sono giusti crea sessione dell'utente
                    if ($loggedInUser && $loggedInUser->isActive) {
                        $this->createUserSession($loggedInUser);  
                    }
                }

                if(!$userExists || !$loggedInUser ){
                    $data['passwordError'] = 'Wrong password or email. Retry';

                    $this->view('users/login', $data);
                }
            }

        }  

        $this->view('users/login', $data);
    }
    public function signature(){
        
        $data = [
            'title' => 'Add Signature'
        ]; 
        
        if(!isLoggedIn()){
            header("location:".URLROOT);
        }
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
              
            $id = isset($_POST["idUser"]) ? $_POST["idUser"] : $_SESSION["user_id"];

            if(!isAdmin() &&  $_SESSION["user_id"] != $id ){
                header("location:".URLROOT);
            } 

            if(file_exists($_FILES['signature']['tmp_name']) || is_uploaded_file($_FILES['signature']['tmp_name'])) {
                $dirFirma = str_replace(' ', '',PUBLICROOT. "/signatures/ ".$id."/ " );
                
                //se c'è già una firma inserita la elimina
                if(is_dir($dirFirma)){
                    /*Elimina il file contenuto della directory */
                    $files = array_diff(scandir($dirFirma), array('.', '..')); 
                    foreach ($files as $file) { 
                        unlink("$dirFirma/$file"); 
                    }
                    /* Elimina e poi ricrea la cartella */
                    rmdir($dirFirma);
                }

                mkdir(  $dirFirma, 0777, true); 

                $caricamentoFirma = move_uploaded_file($_FILES["signature"]["tmp_name"],  $dirFirma.$_FILES["signature"]["name"] );
            }else{
                $caricamentoFirma = true;
            } 
 
            
            if(  $caricamentoFirma ){  
                header("location:".URLROOT."/users/usersDashboard"); 
            }
            
        }else{ 
            $this->view('users/addSignature', $data);
        }
    }

    public function changePassword(){
        if(!isLoggedIn()){
            header("location:".URLROOT."/users/login");
        }

        $data = [
            'title' => 'Change password page',
            'id' => '',
            'password' => '',
            'confirmPassword' => '',
            'passwordError' => '',
            'confirmPasswordError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'id' => trim($_SESSION['user_id']), 
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),  
                'passwordError' => '', 
                'confirmPasswordError' => ''
            ];
 
            $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";
 
 
            // validazione password
            if(empty($data['password'])){
              $data['passwordError'] = 'Enter password.';
            } elseif(strlen($data['password']) < 6){
              $data['passwordError'] = 'At least 6 characters';
            } elseif (preg_match($passwordValidation, $data['password'])) {
              $data['passwordError'] = 'At least one number.';
            }

            //validazione confirm password
             if (empty($data['confirmPassword'])) {
                $data['confirmPasswordError'] = 'Confirm password.';
            } else {
                if ($data['password'] != $data['confirmPassword']) {
                    $data['confirmPasswordError'] = 'Passwords do not match!';
                }
            }

            // se non ci sono errori cambia password all'utente
            if (empty($data['passwordError'])
                && empty($data['confirmPasswordError']) 
                ) {

                // Hash della password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if ($this->userModel->changePassword($data)) {
                    //Redirect all'index
                    header('location: ' . URLROOT);
                } else {
                    die('Something went wrong.');
                }
            }
        } 
            

        $this->view('users/change-password', $data);
    }

    public function changeQualifications(){
        if(!isLoggedIn()){
            header("location:".URLROOT); 
        }

        if(isset($_POST["qualifications"])){
            $idUser = isset($_POST["idUser"]) ? $_POST["idUser"] : $_SESSION["user_id"];

            if(!isAdmin() &&  $_SESSION["user_id"] != $idUser ){
                header("location:".URLROOT);
            }

            $data = [
                'id' => $idUser,
                'qualifications' => $_POST["qualifications"]
            ];
            $this->userModel->changeQualifications($data);

            header("location:".URLROOT."/users/usersDashboard"); 

        }else{ 
            $idUser = isset($_GET["idUser"]) ? $_GET["idUser"] : $_SESSION["user_id"];

            if(!isAdmin() &&  $_SESSION["user_id"] != $idUser ){
                header("location:".URLROOT);
            }

            $data = [
                'user'=> $this->userModel->getUserById($idUser)
            ];

            $this->view('users/change-qualifications', $data);
        }
    }
 
    public function deactivate(){
        if(!isLoggedIn() || !isAdmin()){
            header("location:".URLROOT); 
        }

        if(isset($_GET["idUser"])){  
 
            $this->userModel->deactivateUser($_GET["idUser"]);

            header("location:".URLROOT."/users/usersDashboard"); 

        } 
    }
    public function usersDashboard() { 
        
        if(!isLoggedIn()){
            header("location:".URLROOT);
        }

        if(!isAdmin()){
            header("location:".URLROOT);
        }

        $data = [
            'title' => 'Home page', 
            'users'=> $this->userModel->getAllActive(),
        ];
         
        $this->view('/users/usersDashboard', $data);
         
    } 
  
    public function deleteUser(){
        if(!isLoggedIn()){
            header("location:".URLROOT);
        }
        
        if(!isAdmin()){
            header("location:".URLROOT);
        }

        if(isset($_GET["userId"]) && $_GET["userId"]!=$_SESSION["user_id"]  ){
            $this->usersProjectsModel->deleteProgettoUserByUser($_GET["userId"]);
            $this->userModel->deleteUser($_GET["userId"]);
        }

        header('location: ' . URLROOT . "/users/usersDashboard"); 

        
    }

    public function createUserSession($user) {
        $_SESSION['user_id'] = $user->idUser;
        $_SESSION['username'] = $user->name .  " " .$user->surname ; 
        $_SESSION['name'] = $user->name  ; 
        $_SESSION['surname'] = $user->surname ; 
        $_SESSION['email'] = $user->email ; 
        $_SESSION['role'] = $user->role; 
        header('location:' . URLROOT . '/pages/index');
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']); 
        unset($_SESSION['name']);
        unset($_SESSION['surname']);
        unset($_SESSION['email']);
        unset($_SESSION['role']);
        header('location:' . URLROOT . '/users/login');
    }
}
