<?php

include './config/methods.php';
session_start();

if(isset($_SESSION['user_email']) && isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin'){

    $adminEmail = $_SESSION['user_email'];
    $adminName = $_SESSION['user_name'];
    $adminImage = $_SESSION['user_image'];

    $updateCourse = new updateCourse();
    if(isset($_GET['id'])){
        $oldId = $_GET['id'];
    }

if(isset($_POST['update-course']) && isset($_GET['id'])){
    
    $oldId = $_GET['id'];
    $newIdCourse = $_POST['new-idCo'];
    $newIdCategory = $_POST['category-id'];
    $newCourseName = $_POST['new-nameC'];
    $newCourseFor = $_POST['course-for'];
    $newDate = $_POST['new-date'];
    $newCourseDesc = $_POST['new-course-desc'];
    $teacher = $_POST['course-owner'];
    $teacherImg = $_POST['teacher-profile'];
    $language = $_POST['language'];
    $CourseImg = $_POST['new-course-img'];
    $CoursePath= $_POST['new-course-path'];

    $result = $updateCourse->updateCourse($oldId, $newIdCourse, $newIdCategory, $newCourseName, $newCourseFor, $newDate, $newCourseDesc, $teacher, $teacherImg, $language, $CourseImg, $CoursePath);

    if($result == 1){
        // header("Location: ./signup.php");
        echo "<script>alert('Your course has updated successfully!')</script>";
        echo "<script>window.close();</script>";
    }
    if($result == 2){
        // header("Location: ./login.php");
        echo "<script>alert('Problem!')</script>";
        echo "<script>window.open('./admin/dashboard.php','_self')</script>";
    }
    if($result == 3){
        // header("Location: ./login.php");
        echo "<script>alert('Course id is already taken, please choose an other one!')</script>";
    }
}

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="../assets/css/dashboard.css?v1.1">
     
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Edit - <?php echo $_GET['title']; ?></title> 
</head>
<body>
    
<section class="login-form">
            <p class="section-subtitle">Update <?php echo $_GET['title']; ?>!!</p>
            <br>
        <br>
        <br>

        
        

            <form action="edit-course.php?id=<?php echo $oldId; ?>&title=<?php echo $_GET['title']; ?>&desc=<?php echo $_GET['desc']; ?>&for=<?php echo $_GET['for']; ?>&img=<?php echo $_GET['img']; ?>&path=<?php echo $_GET['path']; ?>&idcat=<?php echo $_GET['idcat']; ?>&date=<?php echo $_GET['date']; ?>&teacher=<?php echo $_GET['teacher']; ?>&teacherimg=<?php echo $_GET['teacherimg']; ?>&language=<?php echo $_GET['language']; ?>" method="POST">

                <div class="form-group">
                    <label for="name">New id :</label>
                    <input type="number" name="new-idCo" id="name" value="<?php echo $_GET['id']; ?>" class="form-control" placeholder="Enter your name">
                </div>

                <div class="form-group">
                    <label for="name">Category id :</label>

                    <select name="category-id" id="">
                        <option value="<?php echo $_GET['idcat']; ?>" selected><?php echo $_GET['idcat']; ?></option>
                        
                        <?php

                            $idC = $_GET['idcat'];

                            $host = "localhost";
                            $user = "root";
                            $pass = "";
                            $db = "elearning";
                            $conn;

                            try{
                            $conn = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $sql = "SELECT * FROM category";
                            $statement = $conn->prepare($sql);
                            $statement->execute();
                            $result = $statement->fetchAll(PDO::FETCH_OBJ);

                            foreach ($result as $val) {
                                # code...
                                echo "<option value=".$val->idcategory.">".$val->idcategory."</option>";
                            }

                        }catch(PDOException $e){
                            echo $e->getMessage();
                        }

                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="email">New course Name :</label>
                    <input type="text" name="new-nameC" id="email" value="<?php echo $_GET['title']; ?>" class="form-control" placeholder="Enter your email">
                </div>

                <div class="form-group">
                    <label for="email">Course Publish Date :</label>
                    <input type="date" name="new-date" id="email" value="<?php echo $_GET['date']; ?>" class="form-control" placeholder="Enter your email">
                </div>

                <div class="form-group">
                    <label for="email">The Owner :</label>
                    <input type="text" name="course-owner" id="email" value="<?php echo $_GET['teacher']; ?>" class="form-control" placeholder="Enter your email">
                </div>

                <div class="form-group">
                    <label for="email">Teacher Profile :</label>
                    <textarea name="teacher-profile" value="<?php echo $_GET['teacherimg']; ?>" id="" cols="30" rows="5"><?php echo $_GET['teacherimg']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="email">New course Desc :</label>
                    <textarea name="new-course-desc" value="<?php echo $_GET['desc']; ?>" id="" cols="30" rows="5"><?php echo $_GET['desc']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="email">Course for :</label>
                    <input type="text" name="course-for" id="email" value="<?php echo $_GET['for']; ?>" class="form-control" placeholder="Enter your email">
                </div>

                <div class="form-group">
                    <label for="email">New course image :</label>
                    <textarea name="new-course-img" value="<?php echo $_GET['img']; ?>" id="" cols="30" rows="5"><?php echo $_GET['img']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="email">Course path :</label>
                    <textarea name="new-course-path" value="<?php echo $_GET['path']; ?>" id="" cols="30" rows="5"><?php echo $_GET['path']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="email">Course Language :</label>
                    <input type="text" name="language" id="email" value="<?php echo $_GET['language']; ?>" class="form-control" placeholder="Enter your email">
                </div>

                <br>
        <br>
                <div class="form-group">
                    <button type="submit" name="update-course" class="btn btn-primary">Update course info</button>
                </div>
            </form>
            <!-- <a href="./config/connect.php">test</a> -->

        </section>

</body>
</html>

<?php
}
else{
  header("Location: ./signin.php");
}

?>
