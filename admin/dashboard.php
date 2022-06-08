<?php

include '../config/methods.php';
session_start();

if(isset($_SESSION['user_email']) && isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin'){

    $adminEmail = $_SESSION['user_email'];
    $adminName = $_SESSION['user_name'];
    $adminImage = $_SESSION['user_image'];

    ?>

<!DOCTYPE html>
<!--=== Coding by CodingLab | www.codinglabweb.com === -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="../assets/css/dashboard.css?v1.1">
     
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>iLearning Dashboard Panel</title> 
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="../assets/images/logo.png" alt="">
            </div>

            <span class="logo_name">iLearning</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="#dashboard">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dashboard</span>
                </a></li>
                <li><a href="#categories">
                    <i class="uil uil-files-landscapes"></i>
                    <span class="link-name">Categories</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-files-landscapes"></i>
                    <span class="link-name">users</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-chart"></i>
                    <span class="link-name">Analytics</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-thumbs-up"></i>
                    <span class="link-name">Courses</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-share"></i>
                    <span class="link-name">Posts & blog</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-comments"></i>
                    <span class="link-name">Comments</span>
                </a></li>
            </ul>
            
            <ul class="logout-mode">
                <li><a href='../index.php?useremail=<?php echo $_SESSION['user_email']; ?>&action=logout'>
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>

                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                    <span class="link-name">Dark Mode</span>
                </a>

                <div class="mode-toggle">
                  <span class="switch"></span>
                </div>
            </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard" id="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div>


            <!-- get user image -->
    <?php

        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "elearning";
        $conn;

        try{
            $conn = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT path FROM images WHERE idimage = '$adminImage'";
            $statment = $conn->prepare($sql);
            $statment->execute();
            $result = $statment->fetchAll(PDO::FETCH_OBJ);

            if(count($result) > 0){
                $userImagePath = $result[0]->path;
            }else{
                echo "<script>alert('We run into a Problem!!');</script>";
            }


        }catch(PDOException $e){
            echo $e->getMessage();
        }
    ?>
            <h3><?php echo $adminName ?></h3>
            <img src="<?php echo $userImagePath; ?>" alt="">
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Dashboard</span>
                </div>

                <div class="boxes">
                    <div class="box box1">
                        <i class="uil uil-user"></i>
                        <span class="text">Total Users</span>

                        <div class="number">
                            <?php
                                $totalUsers = getTotalUsers();
                                echo $totalUsers;
                            ?>
                        </div>

                    </div>
                    <div class="box box2">
                        <i class="uil uil-comments"></i>
                        <span class="text">Comments</span>
                        <div class="number">
                            <?php
                                $totalComments = getTotalComments();
                                echo $totalComments;
                            ?>
                        </div>
                    </div>
                    <div class="box box3">
                        <i class="uil uil-presentation-play"></i>
                        <span class="text">Courses</span>
                        <div class="number">
                            <?php
                                $totalCourses = getTotalCourses();
                                echo $totalCourses;
                            ?>
                        </div>
                    </div>
                    <div class="box box4">
                        <i class="uil uil-notebooks"></i>
                        <span class="text">Categories</span>
                        <div class="number">
                            <?php
                                $totalCategories = getTotalCategories();
                                echo $totalCategories;
                            ?>
                        </div>
                    </div>
                    <div class="box box5">
                        <i class="uil uil-book"></i>
                        <span class="text">Posts</span>
                        <div class="number">
                            <?php
                                $totalPosts = getTotalPosts();
                                echo $totalPosts;
                            ?>
                        </div>
                    </div>
                    <div class="box box4">
                        <i class="uil uil-constructor"></i>
                        <span class="text">Admin</span>
                        <div class="number">
                            <?php
                                $totalAdmin = getTotalAdmin();
                                echo $totalAdmin;
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Recent Activity</span>
                </div>

                <div class="activity-data">
                    <div class="data names">
                        <span class="data-title">Username</span>

                        <!-- get usernames from data base -->
                        <?php

                            $host = "localhost";
                            $user = "root";
                            $pass = "";
                            $db = "elearning";
                            $conn;

                            try{
                                $conn = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $sql = "SELECT name FROM users";
                                $statment = $conn->prepare($sql);
                                $statment->execute();
                                $result = $statment->fetchAll(PDO::FETCH_OBJ);

                                if(count($result) > 0){
                                    foreach($result as $row){
                                        echo "<span class='data-list'>".$row->name."</span>";
                                    }
                                }else{
                                    echo "<script>alert('We run into a Problem!!');</script>";
                                }
                            }catch(PDOException $e){
                                echo $e->getMessage();
                            }

                        ?>
                        
                    </div>
                    <div class="data email">
                        <span class="data-title">User email</span>
                        
                        <!-- get email from data base -->
                        <?php

                            $host = "localhost";
                            $user = "root";
                            $pass = "";
                            $db = "elearning";
                            $conn;

                            try{
                                $conn = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $sql = "SELECT email FROM users";
                                $statment = $conn->prepare($sql);
                                $statment->execute();
                                $result = $statment->fetchAll(PDO::FETCH_OBJ);

                                if(count($result) > 0){
                                    foreach($result as $row){
                                        echo "<span class='data-list'>".$row->email."</span>";
                                    }
                                }else{
                                    echo "<script>alert('We run into a Problem!!');</script>";
                                }
                            }catch(PDOException $e){
                                echo $e->getMessage();
                            }

                        ?>
                    </div>
                    <div class="data joined">
                        <span class="data-title">User gender</span>
                        <!-- get user sex from data base -->
                        <?php

                            $host = "localhost";
                            $user = "root";
                            $pass = "";
                            $db = "elearning";
                            $conn;

                            try{
                                $conn = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $sql = "SELECT sex FROM users";
                                $statment = $conn->prepare($sql);
                                $statment->execute();
                                $result = $statment->fetchAll(PDO::FETCH_OBJ);

                                if(count($result) > 0){
                                    foreach($result as $row){
                                        echo "<span class='data-list'>".$row->sex."</span>";
                                    }
                                }else{
                                    echo "<script>alert('We run into a Problem!!');</script>";
                                }
                            }catch(PDOException $e){
                                echo $e->getMessage();
                            }

                        ?>
                    </div>
                    <div class="data type">
                        <span class="data-title">User type</span>
                        <!-- get user type from data base -->
                        <?php

                            $host = "localhost";
                            $user = "root";
                            $pass = "";
                            $db = "elearning";
                            $conn;

                            try{
                                $conn = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $sql = "SELECT type FROM users";
                                $statment = $conn->prepare($sql);
                                $statment->execute();
                                $result = $statment->fetchAll(PDO::FETCH_OBJ);

                                if(count($result) > 0){
                                    foreach($result as $row){
                                        echo "<span class='data-list'>".$row->type."</span>";
                                    }
                                }else{
                                    echo "<script>alert('We run into a Problem!!');</script>";
                                }
                            }catch(PDOException $e){
                                echo $e->getMessage();
                            }

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="dashboard categories" id="categories">
    <div class="dash-content">

    <h1>All About Categories Here!</h1>

    <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">All Categories</span>
                </div>

                <div class="activity-data">
                    <div class="data names">
                        <span class="data-title">Category Id</span>

                        <!-- get usernames from data base -->
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
                                $statment = $conn->prepare($sql);
                                $statment->execute();
                                $result = $statment->fetchAll(PDO::FETCH_OBJ);

                                if(count($result) > 0){
                                    foreach($result as $row){
                                        echo "<span class='data-list'>".$row->idcategory."</span>";
                                    }
                                }else{
                                    echo "<script>alert('We run into a Problem!!');</script>";
                                }
                            }catch(PDOException $e){
                                echo $e->getMessage();
                            }

                        ?>
                        
                    </div>
                    <div class="data email">
                        <span class="data-title">Category name</span>
                        
                        <!-- get email from data base -->
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
                                $statment = $conn->prepare($sql);
                                $statment->execute();
                                $result = $statment->fetchAll(PDO::FETCH_OBJ);

                                if(count($result) > 0){
                                    foreach($result as $row){
                                        echo "<span class='data-list'>".$row->namecategory."</span>";
                                    }
                                }else{
                                    echo "<script>alert('We run into a Problem!!');</script>";
                                }
                            }catch(PDOException $e){
                                echo $e->getMessage();
                            }

                        ?>
                    </div>
                    <div class="data joined">
                        <span class="data-title">Category description</span>
                        <!-- get user sex from data base -->
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
                                $statment = $conn->prepare($sql);
                                $statment->execute();
                                $result = $statment->fetchAll(PDO::FETCH_OBJ);

                                if(count($result) > 0){
                                    foreach($result as $row){
                                        echo "<span class='data-list'>".$row->categorydesc."</span>";
                                    }
                                }else{
                                    echo "<script>alert('We run into a Problem!!');</script>";
                                }
                            }catch(PDOException $e){
                                echo $e->getMessage();
                            }

                        ?>
                    </div>

                    <div class="data joined">
                        <span class="data-title">Actions</span>
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
                                $statment = $conn->prepare($sql);
                                $statment->execute();
                                $result = $statment->fetchAll(PDO::FETCH_OBJ);

                                if(count($result) > 0){
                                    foreach($result as $row){
                                        echo "<div class='data-list'>Delete</div>";
                                    }
                                }else{
                                    echo "<script>alert('We run into a Problem!!');</script>";
                                }
                            }catch(PDOException $e){
                                echo $e->getMessage();
                            }

                        ?>
                    </div>
                    
                </div>
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Edit category</span>
                </div>
            </div>
        </div>

    </section>



    <script src="../assets/js/main.js"></script>
</body>
</html>

<?php
}
else{
  header("Location: ../signin.php");
}

?>
