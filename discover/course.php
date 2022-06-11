<?php

include '../config/methods.php';
session_start();

if(isset($_SESSION['user_email'])){

    $userEmail = $_SESSION['user_email'];
    $userName = $_SESSION['user_name'];

    if(isset($_GET['title']) && isset($_GET['id'])){
        $courseTitle = $_GET['title'];
        $courseId = $_GET['id'];
    }

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="../assets/css/style.css?v1.6">
    <link rel="stylesheet" href="../assets/css/media_queries.css?v1.5">
    <link rel="stylesheet" href="../assets/css/animation.css?v1.5">

    <!-- Video Player -->
    <link href="https://vjs.zencdn.net/7.19.2/video-js.css" rel="stylesheet" />
     
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title><?php echo $_GET['title']; ?></title> 
</head>
<body>
    
    <div class="container">
        <header>

            <nav class="navbar">

                <div class="navbar-brand">
                    <img src="../assets/images/logo.png" alt="Educator Logo">
                </div>

                <ul class="navbar-nav">

                    <li class="nav-item">
                    <a href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                    <a href="#about">About Us</a>
                    </li>
                    <li class="nav-item">
                    <a href="categories.php">Categories</a>
                    </li>
                    <li class="nav-item">
                    <a href="#blog">Blog</a>
                    </li>
                    <li class="nav-item">
                    <a href="#contact">Contact Us</a>
                    </li>
                </ul>

                <?php
                    if(isset($_SESSION['user_email'])){
                        // if user active we will show his name in the active button, if not we will show login button
                        echo '<a class="btn btn-primary" name="myProfile" href="user/profile.php">
                                <p class="btn-text">My account!</p>
                                <span class="square"></span>
                            </a>';
                    }
                    else{
                    echo '<a class="btn btn-primary" href="signin.php">
                                <p class="btn-text">Log in!</p>
                                <span class="square"></span>
                            </a>';
                    }

                ?>

                <button class="nav-toggle-btn">
                    <span class="one"></span>
                    <span class="two"></span>
                    <span class="three"></span>
                </button>

            </nav>

        </header>

        <?php 

            $host = "localhost";
            $user = "root";
            $pass = "";
            $db = "elearning";

            try{
                $conn = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT * FROM course where idcourse = '$courseId'";
                $statement = $conn->prepare($sql);
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_OBJ);

                foreach($result as $row){
                    $CourseFor = $row->coursefor;
                    $courseDate = $row->date;
                    $CourseDesc = $row->description;
                    $teacher = $row->teacher;
                    $teacherImg = $row->teacherimage;
                    $language = $row->langue;
                    $CourseImg = $row->image;
                    $CoursePath= $row->path;
                    $CourseLength= $row->lenght;
                }

            }catch(PDOException $e){
                echo $e->getMessage();
            }

        ?>

        <section class="course" id="course">
            <div class="course-header">
                <h2 class="main-heading"><?php echo $courseTitle; ?></h2> <br>
                <p class="section-subtitle"><?php echo $CourseFor ?></p>
                <h4><?php echo $CourseLength ?>, <?php echo $language ?></h4>
            </div>
            <br>

            <div class="course-vid">
            
                <iframe src="<?php echo $CoursePath ?>" width="100%" height="500px" allow='accelerometer; autoplay; ' frameborder="0" allowfullscreen></iframe>

            </div>

            <br>

            <div class="vid-info">

                <p class="subtitle">By: <?php echo $teacher ?>, published at <?php echo $courseDate ?> </p>
                <br>
                <p class="course-description"><?php echo $CourseDesc?></p>

            </div>

        </section>

        <!-- Recommanded Courses -->

        <section class="course" id="course">

        <?php

            $host = "localhost";
            $user = "root";
            $pass = "";
            $db = "elearning";

            try{
                $conn = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT * FROM course where coursefor = '$CourseFor'";
                $statement = $conn->prepare($sql);
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_OBJ);

                $txt = "Recommended For ".$CourseFor.""; 

                echo "<h2 class='section-title'>".$txt."</h2>" ;

            }catch(PDOException $e){
                echo $e->getMessage();
            }

         ?>

        <div class="course-grid">


        <?php

            $host = "localhost";
            $user = "root";
            $pass = "";
            $db = "elearning";

            try{
                $conn = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT * FROM course where idcourse != '$courseId' and coursefor = '$CourseFor' ORDER BY idcourse DESC LIMIT 3";
                $statement = $conn->prepare($sql);
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_OBJ);

                foreach($result as $row){
                    echo '<div class="course-card">

                    <div class="course-banner">
                      <img src="'.$row->image.'" alt="course banner">
        
                      <div class="course-tag-box">
                        <a href="category.php?idcategory='.$row->idcategory.'" class="badge-tag orange">'.$row->coursefor.'</a>
                      </div>
                    </div>
        
                    <div class="course-content">
        
                      <h3 class="card-title">
                        <a href="./discover/course.php?id='.$row->idcourse.'&title='.$row->namecourse.'">'.$row->namecourse.'</a>
                      </h3>
        
                      <div class="wrapper border-bottom">
        
                        <div class="author">
                          <img src="'.$row->teacherimage.'" alt="course instructor image" class="author-img">
        
                          <a href="./discover/teacher.php" class="author-name">'.$row->teacher.'</a>
                        </div>
        
                      </div>
        
                      <div class="wrapper">
                        <div class="course-price">'.$row->lenght.'</div>
        
                        <div class="enrolled">
        
                          <p>'.$row->date.'</p>
                        </div>
                      </div>
        
                    </div>
        
                  </div>';
                }

            }catch(PDOException $e){
                echo $e->getMessage();
            }

          ?>

        </div>

      </section>

    </div>


                 

    <script src="../assets/js/main.js"></script>
</body>
</html>

<?php
}
else{
  echo "<h1>Hello My Friend Please Sign in or create an account to see that beautiful course for free!</h1> <br> <br> <a href='../signin.php'>Log in now!</a>";
}

?>
