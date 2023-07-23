<?php

namespace classes;
use PDO;
use PDOException;

class DBConnector{
    private $hostname = "localhost";
    private $dbname = "sl-police";
    private $username = "testuser";
    private $password = "testuser";

    public function getConnection(){
        $dsn = "mysql:host=$this->hostname;dbname=$this->dbname;";
        try{
            $con = new PDO($dsn, $this->username, $this->password);
            return $con;
        }
        catch(PDOException $e){
            die("Connection Failed: ". $e->getMessage());
        }
    }
}