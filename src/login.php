<?php
session_start();

require './classes/class-db-connector.php';
require './classes/class-user.php';

use classes\DBConnector;
use classes\User;

if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST["username"],$_POST["password"])){
        if(empty($_POST["username"]) || empty($_POST["password"])){
            header("Location: loginForm.php?status=1");
        }
        else{
            $username = trim($_POST["username"]);
            $password = trim($_POST["password"]);

            $dbcon = new DBConnector();

            $user = new User($username,$password);

            if($user->login($dbcon->getConnection())){
                $_SESSION['role'] = $user->getRole();
                $_SESSION['user_id'] = $user->getEmpId();
                $_SESSION['username'] = $user->getUsername();

                header("Location: index.php");
            }
            else{
                header("Location: loginForm.php?status=2"); 
            }
        }

    }else{
        header("Location: loginForm.php?status=0");
    }





}


