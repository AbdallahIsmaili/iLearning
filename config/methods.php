<?php

class connection{

    public $host = "localhost";
    public $user = "root";
    public $pass = "";
    public $db = "elearning";
    public $conn;

    public function __construct(){

        try{
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db,$this->user,$this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $e){
            echo "Connection failed: ".$e->getMessage();
        }

    }
}

class register extends connection{

    public function registerUser($name, $email, $password, $confirm_password){

        try{
            
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM users WHERE email = '$email'";

            $statment = $this->conn->prepare($sql);
            $statment->execute();
            $result = $statment->fetchAll(PDO::FETCH_OBJ);

            // username or email has already been taken
            if(count($result) > 0){
                return 1;

            }else {
                if($password == $confirm_password){
                    $sql = "INSERT INTO users (email, password, name, type) VALUES ('$email', '$password', '$name', 'user')";
                    $statment = $this->conn->prepare($sql);
                    $statment->execute();
                    $result = $statment->fetchAll(PDO::FETCH_OBJ);

                    return 3;

                }else{
                    return 2;
                }
            }

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}


class login extends connection{

    public function loginUser($email, $password){
        try{
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $statment = $this->conn->prepare($sql);
            $statment->execute();
            $result = $statment->fetchAll(PDO::FETCH_OBJ);

            if(count($result) > 0){
                if($result[0]->password == $password){
                    session_start();
                    $_SESSION['user_email'] = $result[0]->email;
                    $_SESSION['user_type'] = $result[0]->type;

                    return 1;
                }else{
                    return 2;
                }
            }else{
                return 3;
            }

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function getUserType(){
        return $_SESSION['user_type'];
    }

}

