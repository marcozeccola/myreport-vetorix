<?php
class User {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function register($data) {
        $this->db->query('INSERT INTO users (name, surname ,email, password,qualifications, isActive  role)
                             VALUES(:name, :surname , :email, :password ,:qualifications, :isActive, :role)');
 
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':surname', $data['surname']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']); 
        $this->db->bind(':qualifications', $data['qualifications']); 
        $this->db->bind(':role', $data['role']);
        $this->db->bind(':isActive', true);
 
        if ($this->db->execute()) {
            return $this->db->lastinsertid();
        } else {
            return false;
        }
    }

    public function changePassword($data) {
        $this->db->query('UPDATE users
                            SET password = :password
                            WHERE idUser= :id ');
 
        $this->db->bind(':id', $data['id']); 
        $this->db->bind(':password', $data['password']); 
 
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    
    public function changeQualifications($data) {
        $this->db->query('UPDATE users
                            SET qualifications = :qualifications
                            WHERE idUser = :id ');
 
        $this->db->bind(':id', $data['id']); 
        $this->db->bind(':qualifications', $data['qualifications']); 
 
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    
    
    public function deactivateUser($id) {
        $this->db->query('UPDATE users
                            SET isActive = :isActive
                            WHERE idUser = :id ');
 
        $this->db->bind(':id', $id); 
        $this->db->bind(':isActive', false); 
 
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($email, $password) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
 
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        $hashedPassword = $row->password;

        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    } 
  
    public function getAll(){
        $this->db->query('SELECT * FROM users
                                ORDER BY surname');
  
        
        $row = $this->db->resultSet();
 
        if( $row ) {
            return $row;
        } else {
            return false;
        }
    }

    
    public function getAllActive(){
        $this->db->query('SELECT * FROM users
                                WHERE isActive = :isActive
                                ORDER BY surname');
  
        
        $this->db->bind(':isActive', true);

        $row = $this->db->resultSet();
 
        if( $row ) {
            return $row;
        } else {
            return false;
        }
    }
    public function getAllReviewers(){
        $this->db->query('SELECT * FROM users WHERE role = "reviewer";');
  
        
        $row = $this->db->resultSet();
 
        if( $row ) {
            return $row;
        } else {
            return false;
        }
    }


    public function getAllRestricted(){
        $this->db->query('SELECT * FROM users WHERE role = "restricted";');
  
        
        $row = $this->db->resultSet();
 
        if( $row ) {
            return $row;
        } else {
            return false;
        }
    }

     public function getAllNotAdmin(){
        $this->db->query('SELECT * FROM users WHERE ruolo <> "admin";');
  
        
        $row = $this->db->resultSet();
 
        if( $row ) {
            return $row;
        } else {
            return false;
        }
    }

    public function findUserByEmail($email) { 
        $this->db->query('SELECT idUser FROM users WHERE email = :email');
 
        $this->db->bind(':email', $email); 
        
        $row = $this->db->single();
 
        if( $row && $row->idUser > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function findIdByUsername($username) { 
        $this->db->query("SELECT * 
                            FROM  users
                            WHERE CONCAT(Name, ' ', Surname) = :username");
 
        $this->db->bind(':username', $username); 
        
        $row = $this->db->single();
 
        if( $row && $row->idUser > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getUserById($id) { 
        $this->db->query('SELECT * FROM users WHERE idUser = :id');
 
        $this->db->bind(':id', $id); 
        
        $row = $this->db->single();
 
        if( $row && $row->idUser > 0) {
            return  $row;
        } else {
            return false;
        }
    }
    public function findUserById($id) { 
        $this->db->query('SELECT * FROM users WHERE idUser = :id');
 
        $this->db->bind(':id', $id); 
        
        $row = $this->db->single();
 
        if( $row && $row->idUser > 0) {
            return $row;
        } else {
            return false;
        }
    }
    public function deleteUser($userId){
        $this->db->query("DELETE FROM user 
                            WHERE idUser = :userId ;");

        $this->db->bind(':userId', $userId);  
    
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


  
}
