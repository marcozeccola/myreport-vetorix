<?php
     class Component{
          private $db;
          public function __construct() {
               $this->db = new Database;
          }


          public function insert($data) {
               $this->db->query('INSERT INTO components (component, fk_idModel)
                                   VALUES(:component, :idModel )');
          
               $this->db->bind(':component', $data["component"]); 
               $this->db->bind(':idModel', $data["idModel"]); 
          
               if ($this->db->execute()) {
                    return $this->db->lastinsertid();
               } else {
                    return false;
               }
          }
          
          public function getAllComponents(){
               $this->db->query("SELECT * FROM components
                              ORDER BY component ASC");
               $result = $this->db->resultSet();

               return $result;
          }
          
          public function getComponentById($id){
               $this->db->query("SELECT * FROM components
                                   WHERE idComponent=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = (object)$this->db->single();

               return $result;
          }

          
          public function getComponentsByIdModel($id){
               $this->db->query("SELECT * FROM components
                                   WHERE fk_idModel=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = $this->db->resultSet();

               return $result;
          }
 
 
  
          

          public function editComponent($data){
               $this->db->query("UPDATE components 
                        SET component = :component
                        WHERE idComponent = :id;");

               $this->db->bind(":component", $data["component"]);
               $this->db->bind(":id", $data["id"]); 

               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }
           

         
     }
?>