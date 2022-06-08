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

    public function registerUser($name, $email, $sex, $password, $confirm_password, $idimage){

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
                    $sql = "INSERT INTO users (email, password, name, sex, type, idimage) VALUES ('$email', '$password', '$name', '$sex', 'user', '$idimage')";
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
                    $_SESSION['user_name'] = $result[0]->name;
                    $_SESSION['user_image'] = $result[0]->idimage;

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


if(isset($_GET['action']) && $_GET['action'] == 'delete'){

$useremail = $_GET['useremail'];

$host = "localhost";
$user = "root";
$pass = "";
$db = "elearning";
$conn;

try{
    $conn = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DELETE FROM users WHERE email = :useremail";
    $statement = $conn->prepare($sql);

    $data = [
        'useremail' => $useremail
    ];
    $result = $statement->execute($data);

    if($result)
    {
        session_start();

        session_unset(); 

        session_destroy(); 
        echo "<script>alert('Account Deleted Successfully!');</script>";
        echo "<script>window.location.href='./index.php';</script>";
        // exit(0);
    }
    else
    {
        echo "<script>alert('Account did not Deleted!');</script>";
        // exit(0);
    }

}catch(PDOException $e){
    echo $e->getMessage();
}

}


// EDIT PROFILE FUNCTION


if(isset($_GET['action']) && $_GET['action'] == 'edit'){

$useremail = $_GET['useremail'];

$host = "localhost";
$user = "root";
$pass = "";
$db = "elearning";
$conn;

try{
    $conn = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM users WHERE email = :useremail";
    $statement = $conn->prepare($sql);

    $data = [
        'useremail' => $useremail
    ];
    $result = $statement->execute($data);
    $result = $statement->fetchAll(PDO::FETCH_OBJ);

    if(count($result) > 0)
    {
        $username = $result[0]->name;
        $userEmail = $result[0]->email;
        $userPassword = $result[0]->password;
        $userGender = $result[0]->sex;
        $userIdImage = $result[0]->idimage;
    }
    else
    {
        echo "<script>alert('Problem!');</sc$result>";
    }

}catch(PDOException $e){
    echo $e->getMessage();
}

}

// UPDATE INFORMATION CLASS

class update extends connection{

    public function updateUser($newName, $oldEmail, $newEmail, $newPassword, $confirm_password, $newIdImage){

        try{
            
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM users WHERE email = '$oldEmail'";

            $statment = $this->conn->prepare($sql);
            $statment->execute();
            $result = $statment->fetchAll(PDO::FETCH_OBJ);

            // username or email has already been taken
            if(count($result) > 0){
                if($newPassword == $confirm_password){
                    $sql = "UPDATE users SET email = '$newEmail', name = '$newName', password = '$newPassword', idimage = '$newIdImage' WHERE email = '$oldEmail'";
                    $statment = $this->conn->prepare($sql);
                    $statment->execute();
                    $result = $statment->fetchAll(PDO::FETCH_OBJ);

                    return 1;

                }else{
                    return 2;
                }

            }else {
                
                return 3;
            }

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}

// LOG OUT FROM MY ACCOUNT

if(isset($_GET['action']) && $_GET['action'] == 'logout'){

    session_start();

    session_unset(); 

    session_destroy();
    echo "<script>window.location.href='./index.php';</script>";

}

// GET TOTAL USERS

function getTotalUsers(){
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "elearning";

    try{
        $conn = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM users";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);

        return count($result);

    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

// GET TOTAL COMMENTS FUNCTION 

function  getTotalComments(){
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "elearning";

    try{
        $conn = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM comments";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);

        return count($result);

    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

// GET TOTAL COURSES FUNCTION

function getTotalCourses(){
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "elearning";

    try{
        $conn = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM course";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);

        return count($result);

    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

// GET TOTAL CATEGORIES FUNCTION 

function getTotalCategories(){
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "elearning";

    try{
        $conn = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM category";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);

        return count($result);

    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

// GET TOTAL POSTS FUNCTION 

function getTotalPosts(){
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "elearning";

    try{
        $conn = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM posts";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);

        return count($result);

    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

// GET TOTAL ADMIN FUNCTION 

function getTotalAdmin(){
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "elearning";

    try{
        $conn = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM users where type = 'admin'";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);

        return count($result);

    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

// class profile extends connection{

//     public $username;
//     public $userImage ;
//     public $userEmail;
//     public $userSex;

//     public function getUserProfile($email){

//         try{
//             $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//             $sql = "SELECT * FROM users WHERE email = '$email'";
//             $statment = $this->conn->prepare($sql);
//             $statment->execute();
//             $result = $statment->fetchAll(PDO::FETCH_OBJ);

//             if(count($result) > 0){
                

//                 // $username = $result[0]->name;
//                 $this->username = $result[0]->name;

//                 // $userEmail = $result[0]->email;
//                 $this->userEmail = $result[0]->email;

//                 // $userSex = $result[0]->sex;
//                 $this->userSex = $result[0]->sex;

//                 // $userImage = $result[0]->idimage;
//                 $this->userImage = $result[0]->idimage;
//                 $_POST[$this->userImage];

//                 // header("Location: ./profile.php");

//                 return 1;
//             }else{
//                 return 2;
//             }

//         }catch(PDOException $e){
//             echo $e->getMessage();
//         }
//     }

// }

