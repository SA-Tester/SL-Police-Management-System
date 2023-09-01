<?php

namespace classes;

use FTP\Connection;
use PDO;
use PDOException;

class User{

    private $empID;
    private $username;
    private $password;
    private $role;

    public function __construct($username,$password)
    {
       $this->username = $username; 
       $this->password = $password;
    }

    public function getEmpId(){
        return $this->empID;
    }
    public function setEmpId($empId){
        $this->empID = $empId;
    }
    public function getUsername(){
        return $this->username;
    }
    public function setUsername($username){
        $this->username = $username;
    }
    public function getPassword(){
        return $this->password;
    }
    public function setPassword($password){
        $this->password = $password;
    }
    public function getRole(){
        return $this->role;
    }
    public function setRole($role){
        $this->role = $role;
    }

    public function login($con){
        try{
            
            $query = "SELECT * FROM login WHERE username=?";
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1,$this->getUsername());
            $pstmt->execute();

            $rs = $pstmt->fetch(PDO::FETCH_OBJ);
            $db_password = $rs->password;

            if(!empty($rs)){
                //for hashed password
                /*if(password_verify($this->password, $db_password)){ 
                    $this->empID = $rs->empID;
                    $this->username = $rs->username;
                    $this->role = $rs->role;
                    $this->password = null;
                    return true;
                }*/
                if($this->password === $db_password){
                    $this->empID = $rs->empID;
                    $this->username = $rs->username;
                    $this->role = $rs->role;
                    $this->password = null;
                    return true;
                }
                else{
                    return false;
                }
            }else{
                return false;
            }



        }catch(PDOException $e){
            die("Error in User class's login function: ".$e->getMessage());
        }
    }

}
