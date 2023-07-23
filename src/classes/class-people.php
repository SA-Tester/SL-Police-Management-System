<?php

namespace classes;
use PDOException;

class People {
    private $nic;
    private $name;
    private $address;
    private $contact;
    private $email;
    private $con;
    
    public function __construct($nic, $name, $address, $contact, $email){
        $this->nic = $nic;
        $this->name = $name;
        $this->address = $address;
        $this->contact = $contact;
        $this->email = $email;
    }

    public function getNIC(){
        return $this->nic;
    }

    public function setCon($con){
        $this->con = $con;
    }

    public function addPerson(){
        $query1 = "INSERT INTO people(nic, name, address, contact, email) VALUES(?, ?, ?, ?, ?)";

        try{
            $pstmt = $this->con->prepare($query1);
            $pstmt->bindValue(1, $this->nic);
            $pstmt->bindValue(2, $this->name);
            $pstmt->bindValue(3, $this->address);
            $pstmt->bindValue(4, $this->contact);
            $pstmt->bindValue(5, $this->email);
            $a = $pstmt->execute();
            if($a>0){
                echo "PEOPLE: Record inserted successfully<br>";
            }
            else{
                die("Record insertion failed");
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}