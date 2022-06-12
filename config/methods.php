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

$useremail = '';

if(isset($_GET['action']) && isset($_GET['useremail']) && $_GET['action'] == 'delete'){

    if(isset($_GET['useremail'])){
        $useremail = $_GET['useremail'];
    }

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

$useremail = '';

if(isset($_GET['action']) && $_GET['action'] == 'edit'){

if(isset($_GET['useremail'])){
    $useremail = $_GET['useremail'];
}

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
        echo "<script>alert('Problem!');</script>";
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

// UPDATE CATEGORY INFORMATION


class updateCategory extends connection{

    public function updateCategory( $oldID, $newName, $newDesc, $newImage){

        try{
            
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM category WHERE idcategory = '$oldID'";

            $statment = $this->conn->prepare($sql);
            $statment->execute();
            $result = $statment->fetchAll(PDO::FETCH_OBJ);

            // username or email has already been taken
            if(count($result) > 0){

                $sql = "UPDATE category SET namecategory = '$newName', categorydesc = '$newDesc', image = '$newImage' WHERE idcategory = '$oldID'";
                $statment = $this->conn->prepare($sql);
                $statment->execute();
                $result = $statment->fetchAll(PDO::FETCH_OBJ);

                return 1;

            }else {
                
                return 2;
            }

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}


// FUNCTION TO DELETE CATEGORY

if(isset($_GET['action']) && isset($_GET['idCategory']) && $_GET['action'] == 'delete'){

    if(isset($_GET['idCategory'])){
        $idC = $_GET['idCategory'];
    }

$host = "localhost";
$user = "root";
$pass = "";
$db = "elearning";
$conn;

try{
    $conn = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DELETE FROM category WHERE idcategory = :idCategory";
    $statement = $conn->prepare($sql);

    $data = [
        'idCategory' => $idC

    ];
    $result = $statement->execute($data);

    if($result)
    {
        echo "<script>alert('The Category Deleted Successfully!');</script>";
        echo "<script>window.location.href='./admin/dashboard.php';</script>";
        // exit(0);
    }
    else
    {
        echo "<script>alert('The category did not Deleted!');</script>";
        // exit(0);
    }

}catch(PDOException $e){
    echo $e->getMessage();
}

}

// ADD NEW CATEGORY FUNCTION

class newCategory extends connection{

    public function newCategory($nameCategory, $categoryDesc, $categoryImage){

        try{
            
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM category WHERE namecategory = '$nameCategory'";

            $statment = $this->conn->prepare($sql);
            $statment->execute();
            $result = $statment->fetchAll(PDO::FETCH_OBJ);

            if(count($result) > 0){
                return 1;

            }else {
                $sql = "INSERT INTO category (namecategory, categorydesc, image) VALUES ('$nameCategory', '$categoryDesc', '$categoryImage')";
                $statment = $this->conn->prepare($sql);
                $statment->execute();
                $result = $statment->fetchAll(PDO::FETCH_OBJ);

                return 2;
            }

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}


// UPDATE COURSE

class updateCourse extends connection{

    public function updateCourse($oldId, $newIdCategory, $newCourseName, $newCourseFor, $newDate, $newCourseDesc, $teacher, $teacherImg, $language, $CourseImg, $CoursePath){

        try{
            
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM course WHERE idcourse = '$oldId'";

            $statment = $this->conn->prepare($sql);
            $statment->execute();
            $result = $statment->fetchAll(PDO::FETCH_OBJ);

            if(count($result) > 0){

                $sql = "UPDATE course SET idcategory = '$newIdCategory', namecourse = '$newCourseName', coursefor = '$newCourseFor', date= '$newDate', description = '$newCourseDesc', teacher = '$teacher', teacherimage = '$teacherImg', langue = '$language', image = '$CourseImg', path = '$CoursePath' WHERE idcourse = '$oldId'";

                $statment = $this->conn->prepare($sql);
                $statment->execute();
                $result = $statment->fetchAll(PDO::FETCH_OBJ);

                return 1;

            }else {
                
                return 2;
            }

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}

// DELETE A COURSE FUNCTION

if(isset($_GET['action']) && isset($_GET['idcourse']) && $_GET['action'] == 'delete'){

    if(isset($_GET['idcourse'])){
        $idC = $_GET['idcourse'];
    }

$host = "localhost";
$user = "root";
$pass = "";
$db = "elearning";
$conn;

try{
    $conn = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DELETE FROM course WHERE idcourse = :idcourse";
    $statement = $conn->prepare($sql);

    $data = [
        'idcourse' => $idC

    ];
    $result = $statement->execute($data);

    if($result)
    {
        echo "<script>alert('The Course Deleted Successfully!');</script>";
        echo "<script>window.location.href='./admin/dashboard.php';</script>";
        // exit(0);
    }
    else
    {
        echo "<script>alert('The Course did not Deleted!');</script>";
        // exit(0);
    }

}catch(PDOException $e){
    echo $e->getMessage();
}

}

// ADD NEW COURSE 


class newCourse extends connection{

    public function newCourse($idCategory, $CourseName, $CourseFor, $courseDate, $CourseDesc, $teacher, $teacherImg, $language, $CourseImg, $CoursePath, $CourseLength){

        try{
            
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $sql = "INSERT INTO course (idcategory, namecourse, coursefor, date, description, teacher, teacherimage, langue, lenght, image, path) VALUES ('$idCategory', '$CourseName', '$CourseFor', '$courseDate', '$CourseDesc', '$teacher', '$teacherImg', '$language', '$CourseLength', '$CourseImg', '$CoursePath')";

            $statment = $this->conn->prepare($sql);
            $statment->execute();
            $result = $statment->fetchAll(PDO::FETCH_OBJ);

            return 1;

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}

// ADD A COMMENT CLASS

class comment extends connection{

    public function comment($courseId, $userEmail, $publisher, $commentContent, $publishDate){

        try{
            
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO comments (email, idcourse, publisher, content, date) VALUES ('$userEmail', '$courseId', '$publisher', '$commentContent', '$publishDate')";

            $statment = $this->conn->prepare($sql);
            $statment->execute();
            $result = $statment->fetchAll(PDO::FETCH_OBJ);

            if(isset($result)){
                return 1;

            }else {

                return 2;
            }

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}

// DELETE A COMMENT

if(isset($_GET['action']) && isset($_GET['idcomment']) && $_GET['action'] == 'delete'){

    if(isset($_GET['idcomment'])){
        $idC = $_GET['idcomment'];
    }

$host = "localhost";
$user = "root";
$pass = "";
$db = "elearning";
$conn;

try{
    $conn = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DELETE FROM comments WHERE idcomment = :idcomment";
    $statement = $conn->prepare($sql);

    $data = [
        'idcomment' => $idC

    ];
    $result = $statement->execute($data);

    if($result)
    {
        echo "<script>alert('The comment Deleted Successfully!');</script>";
    }
    else
    {
        echo "<script>alert('The comment did not Deleted!');</script>";
    }

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

