<?php
     class ModelIstance{
          private $db;
          public function __construct() {
               $this->db = new Database;
          }


          public function insert($data) {
               $this->db->query('INSERT INTO modelistances (modelIstance, date, fk_idModel)
                                   VALUES(:modelistance, :date ,:idModel )');
          
               $this->db->bind(':modelistance', $data["modelIstance"]); 
               $this->db->bind(':date', date('Y-m-d')); 
               $this->db->bind(':idModel', $data["idModel"]); 
          
               if ($this->db->execute()) {
                    return $this->db->lastinsertid();
               } else {
                    return false;
               }
          }
          
          public function getAllModelIstances(){
               $this->db->query("SELECT * FROM modelistances
                              ORDER BY modelIstance ASC");
               $result = $this->db->resultSet();

               return $result;
          }
          
          public function getModelIstanceById($id){
               $this->db->query("SELECT * FROM modelistances
                                   WHERE idModelIstance=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = (object)$this->db->single();

               return $result;
          }

          
          public function getModelIstancesByIdModel($id){
               $this->db->query("SELECT * FROM modelistances
                                   WHERE fk_idModel=:id");

                                   
               $this->db->bind(':id', $id); 

               $result = $this->db->resultSet();

               return $result;
          }
 
 
  
          

          public function editModelIstance($data){
               $this->db->query("UPDATE modelistances 
                        SET modelIstance = :modelistance,
                                   date = :date
                        WHERE idModelIstance = :id;");

               $this->db->bind(":modelistance", $data["modelIstance"]);
               $this->db->bind(":date", $data["date"]);
               $this->db->bind(":id", $data["id"]); 

               if ($this->db->execute()) {
                    return true;
               } else {
                    return false;
               }
          }
           

         
     }
?>