<?php
     class ComponentIstance{
          private $db;
          public function __construct() {
               $this->db = new Database;
          }


          public function insert($data) {
               $this->db->query('INSERT INTO componentistances (componentIstance, fk_idModelIstance)
                                   VALUES(:componentIstance, :idModel )');
          
               $this->db->bind(':componentIstance', $data["componentIstance"]);  
               $this->db->bind(':idModel', $data["idModelIstance"]); 
          
               if ($this->db->execute()) {
                    return $this->db->lastinsertid();
               } else {
                    return false;
               }
          }
          
          public function getAllComponentIstances(){
               $this->db->query("SELECT * FROM componentistances
                              ORDER BY componentIstance ASC");
               $result = $this->db->resultSet();

               return $result;
          }
          
          public function getComponentIstanceById($id){
               $this->db->query("SELECT * FROM componentistances
                                   WHERE idComponentIstance = :id");

                                   
               $this->db->bind(':id', $id); 

               $result = (object)$this->db->single();

               return $result;
          }

          
          public function getComponentIstanceByIdModelIstance($id){
               $this->db->query("SELECT * FROM componentistances
                                   WHERE fk_idModelIstance=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = $this->db->resultSet();

               return $result;
          }


          
          public function getComponentIstanceNotInInspectionByIdModelIstance($id){
               $this->db->query("SELECT * FROM componentistances
                                   LEFT JOIN inspectioncomponents ON inspectioncomponents.fk_idComponentIstance = componentistances.idComponentIstance
                                   WHERE inspectioncomponents.fk_idComponentIstance IS NULL
                                   AND fk_idModelIstance=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = $this->db->resultSet();

               return $result;
          }
 
 
  
          

          public function editComponentIstance($data){
               $this->db->query("UPDATE componentistances 
                        SET componentIstance = :componentIstance
                        WHERE idComponentIstance = :id;");

               $this->db->bind(":componentIstance", $data["componentIstance"]); 
               $this->db->bind(":id", $data["id"]); 

               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }
           

         
     }
?>