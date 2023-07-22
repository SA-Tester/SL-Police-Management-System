<?php

require './classes/DBConnector.php';
use classes\DBConnector;

function login($username,$password){
    $dbcon = new DBConnector();

    try{
        $con = $dbcon->getConnection();
        $query = "SELECT * FROM login WHERE username=?";
        $pstmt = $con->prepare($query);
        $pstmt->bindValue(1,$username,PDO::PARAM_STR);
        $pstmt->execute();

        $userData = $pstmt-> fetch(PDO::FETCH_ASSOC);
        
        if($userData && $userData['password'] === $password){               //password_verify($password,$userData['password'])
            session_start();
            $_SESSION['username']= $username;
            $_SESSION['role'] = $userData['role'];
            header('Location: index.php');
            exit();
        }
        else{
            header("Location: loginForm.php?error=2");
            exit;
        }
    }catch(PDOException $ex){
        echo $ex->getMessage();
    }

}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["username"], $_POST["password"])) {
        if(empty($_POST["username"]) || empty($_POST["password"])){
            header("Location: loginForm.php?error=1");
            exit;
        }
        else{
            $username = $_POST["username"];
            $password = $_POST["password"];
            login($username,$password);
     
        }
    }
}


