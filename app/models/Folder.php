<?php
     class Folder{
          private $db;
          public function __construct() {
               $this->db = new Database;
          }


          public function inserisci($data) {
               $this->db->query('INSERT INTO folders (folder, fk_idFolder)
                                   VALUES(:folder, :idFolder )');
          
               $this->db->bind(':folder', $data["folder"]); 
               $this->db->bind(':idFolder', $data["idFolder"]); 
          
               if ($this->db->execute()) {
                    return $this->db->lastinsertid();
               } else {
                    return false;
               }
          }
          
          public function getAllFolders(){
               $this->db->query("SELECT * FROM folders
                              ORDER BY folder ASC");
               $result = $this->db->resultSet();

               return $result;
          }
          
          public function getFolderById($id){
               $this->db->query("SELECT * FROM folders
                                   WHERE idFolder=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = (object)$this->db->single();

               return $result;
          }

          public function getAllFolderTree($id){
               $resultArr = array();

               $i=0;
 
               do{
                    $this->db->query("SELECT * FROM folders
                         WHERE idFolder=:id  ");

                         
                    $this->db->bind(':id', $id); 

                    $result = (object)$this->db->single();
 
                    if(isset($result->idFolder) && $result->idFolder >0){
                         $id= $result->fk_idFolder;
                         array_push($resultArr, $result);
                    }

               }while(isset($result->idFolder) && $result->idFolder >0);
                     

               return array_reverse($resultArr);
          }

          public function getAllFoldersTree(){

               $this->db->query("SELECT * FROM folders 
                              ORDER BY folder ASC");
               $allFolders = $this->db->resultSet(); 

               $returnArray = array();
               
               foreach($allFolders as $folder){
                    $folderArr = array();
                    $i=0;
                    $id=$folder->idFolder;
                    do{
                         $this->db->query("SELECT * FROM folders
                              WHERE idFolder=:id
                              ORDER BY folder ASC ");

                              
                         $this->db->bind(':id', $id); 

                         $result = (object)$this->db->single();
     
                         if(isset($result->idFolder) && $result->idFolder >0){
                              $id= $result->fk_idFolder;
                              array_push($folderArr, $result);
                         }

                    }while(isset($result->idFolder) && $result->idFolder >0);
                     
                    array_push($returnArray,  array_reverse($folderArr));
               }
               return $returnArray;
          }

          public function getRootFolders(){
               $this->db->query("SELECT * FROM folders
                                   WHERE fk_idFolder=0
                                   ORDER BY folder ASC");
               $result = $this->db->resultSet();

               return $result;
          }

          public function getFoldersByParentId($id){
               $this->db->query("SELECT * FROM folders
                                   WHERE fk_idFolder=:id
                              ORDER BY folder ASC");

               $this->db->bind(':id', $id); 

               $result = $this->db->resultSet();

               return $result;
          }
          

          public function editFolder($data){
               $this->db->query("UPDATE folders 
                        SET folder = :folder
                        WHERE idFolder = :id;");

               $this->db->bind(":folder", $data["folder"]);
               $this->db->bind(":id", $data["id"]); 

               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }
          
          public function deleteFolderById($id){
               $this->db->query("DELETE FROM folders WHERE idFolder = :id");
               $this->db->bind(':id', $id); 
          
               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }

         
     }
?>