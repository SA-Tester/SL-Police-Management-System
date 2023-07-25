<?php

namespace classes;

use PDOException;

class Location{
    private $location_id;
    private $name;
    private $district;
    private $city;
    private $latitude;
    private $longitude;
    private $con;

    public function __construct($name, $district, $city, $latitude, $longitude){
        $this->name = $name;
        $this->district = $district;
        $this->city = $city;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function setCon($con){
        $this->con = $con;
    }

    public function getLocationID(){
        return $this->location_id;
    }

    public function addLocation(){
        $query = "INSERT INTO location(location_name, district, city, latitude, longitude) VALUES(?, ?, ?, ?, ?)";
        try{
            $pstmt = $this->con->prepare($query);
            $pstmt->bindValue(1, $this->name);
            $pstmt->bindValue(2, $this->district);
            $pstmt->bindValue(3, $this->city);
            $pstmt->bindValue(4, $this->latitude);
            $pstmt->bindValue(5, $this->longitude);
            
            $a = $pstmt->execute();
            $this->location_id = $this->con->lastInsertId();

            if($a>0){
                return true;
            }
            else{
                return false;
                die("An error occured");
            }
        }
        catch(PDOException $e){
            $e->getMessage();
        }
    }
}