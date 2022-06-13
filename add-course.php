<?php

include './config/methods.php';
session_start();

if(isset($_SESSION['user_email']) && isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin'){

    $adminEmail = $_SESSION['user_email'];
    $adminName = $_SESSION['user_name'];
    $adminImage = $_SESSION['user_image'];

    $newCourse = new newCourse();

if(isset($_POST['add-course'])){
    $idCategory = $_POST['category-id'];
    $CourseName = $_POST['course-name'];
    $CourseFor = $_POST['course-for'];
    $courseDate = $_POST['course-date'];
    $CourseDesc = $_POST['course-desc'];
    $teacher = $_POST['course-owner'];
    $teacherImg = $_POST['teacher-profile'];
    $language = $_POST['language'];
    $CourseImg = $_POST['course-img'];
    $CoursePath= $_POST['course-path'];
    $CourseLength= $_POST['length'];

    $result = $newCourse->newCourse($idCategory, $CourseName, $CourseFor, $courseDate, $CourseDesc, $teacher, $teacherImg, $language, $CourseImg, $CoursePath, $CourseLength);

    if($result == 1){
        echo "<script>alert('The Course has been added successfully!')</script>";
        echo "<script>window.open('./admin/dashboard.php','_self')</script>";
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

    <title>Add New Course</title> 
</head>
<body>
    
<section class="login-form">
            <p class="section-subtitle">Add A New Course!!</p>
            <br>
        <br>
        <br>

            <form action="add-course.php" method="POST">

                <div class="form-group">
                    <label for="name">Category id :</label>
                    <select name="category-id" id="">
                        
                        <?php

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
                                echo "<option value=".$val->idcategory.">".$val->namecategory."</option>";
                            }

                        }catch(PDOException $e){
                            echo $e->getMessage();
                        }

                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="email">Course Name :</label>
                    <input type="text" name="course-name" id="email" class="form-control" placeholder="Enter your email">
                </div>

                <div class="form-group">
                    <label for="email">Course Publish Date :</label>
                    <input type="date" name="course-date" id="email" class="form-control" placeholder="Enter your email">
                </div>

                <div class="form-group">
                    <label for="email">The Owner :</label>
                    <input type="text" name="course-owner" id="email" class="form-control" placeholder="Enter your email">
                </div>

                <div class="form-group">
                    <label for="email">Teacher Profile :</label>
                    <textarea name="teacher-profile" id="" cols="30" rows="5"></textarea>
                </div>

                <div class="form-group">
                    <label for="email">Course Desc :</label>
                    <textarea name="course-desc" id="" cols="30" rows="5"></textarea>
                </div>

                <div class="form-group">
                    <label for="email">Course for :</label>
                    <input type="text" name="course-for" id="email" class="form-control" placeholder="Enter your email">
                </div>

                <div class="form-group">
                    <label for="email">Course image :</label>
                    <textarea name="course-img" id="" cols="30" rows="5"></textarea>
                </div>

                <div class="form-group">
                    <label for="email">Course path :</label>
                    <textarea name="course-path" id="" cols="30" rows="5"></textarea>
                </div>

                <div class="form-group">
                    <label for="email">Course Language :</label>
                    <input type="text" name="language" id="email" class="form-control" placeholder="Enter your email">
                </div>

                <div class="form-group">
                    <label for="email">Course Length :</label>
                    <input type="text" name="length" id="email" class="form-control" placeholder="Enter your email">
                </div>

                <br>
        <br>
                <div class="form-group">
                    <button type="submit" name="add-course" class="btn btn-primary">Add This Course!</button>
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
