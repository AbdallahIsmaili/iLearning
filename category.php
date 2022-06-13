<?php

include './config/methods.php';
session_start();


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>iLearning - Online Courses</title>

  <!--
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="./assets/css/media_queries.css">
  <link rel="stylesheet" href="./assets/css/animation.css">

  <!--
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700;800;900&family=Roboto:wght@400;500&display=swap"
    rel="stylesheet">

</head>

<body>

  <!--
    - main container
  -->

  <div class="container">

    <!--
      - #HEADER
    -->

    <header>

      <nav class="navbar">

        <div class="navbar-brand">
          <img src="./assets/images/logo.png" alt="Educator Logo">
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





    <main>

      <!--
        - #HOME SECTION
      -->

      <section class="home" id="home">

        <div class="deco-shape shape-1">
          <img src="./assets/images/shape-1.png" alt="art shape" width="70">
        </div>
        <div class="deco-shape shape-2">
          <img src="./assets/images/shape-2.png" alt="art shape" width="55">
        </div>
        <div class="deco-shape shape-3">
          <img src="./assets/images/shape-3.png" alt="art shape" width="120">
        </div>
        <div class="deco-shape shape-4">
          <img src="./assets/images/shape-4.png" alt="art shape" width="30">
        </div>

        <div class="home-left">

          <p class="section-subtitle">Choose a course and start learning</p>

          <h1 class="main-heading">
            Get The Course
            <span class="underline-img">You Need! <img src="./assets/images/banner-line.png" alt="line"></span>
          </h1>

          <p class="section-text">
            Integer in magna in est ultrices bibendum eget enim et dui imperdiet faucibus. Fusce eu tristique felis.
          </p>

          <div class="home-btn-group">
            <button class="btn btn-primary">
              <p class="btn-text">Explore More Categories</p>
              <span class="square"></span>
            </button>

            <button class="btn btn-secondary">
              <p class="btn-text">Contact Us</p>
              <span class="square"></span>
            </button>
          </div>

        </div>

        <div class="home-right">

          <div class="img-box">

            <img src="./assets/images/banner-img-bg.png" alt="colorful background shape" class="background-shape">
            <img src="./assets/images/course-banner-img.png" alt="banner image" class="banner-img">

            <img src="./assets/images/banner-aliment-icon-1.png" alt="" class="icon-1 smooth-zigzag-anim-1" width="250">
            <img src="./assets/images/banner-aliment-icon-2.png" alt="" class="icon-2 smooth-zigzag-anim-2" width="240">
            <img src="./assets/images/banner-aliment-icon-3.png" alt="" class="icon-3 smooth-zigzag-anim-3" width="195">
            <img src="./assets/images/banner-aliment-icon-4.png" alt="" class="icon-4 drop-anim">

          </div>

        </div>

      </section>

      <!--
        - #COURSE SECTION
      -->

      <section class="course" id="course">

        <p class="section-subtitle">Our Online Courses</p>

        <?php

            $host = "localhost";
            $user = "root";
            $pass = "";
            $db = "elearning";

            try{
                $conn = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $idCategory = $_GET['idcategory'];

                $sql = "SELECT * FROM category where idcategory = '$idCategory'";
                $statement = $conn->prepare($sql);
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_OBJ);

                $txt = "Online Courses For ".$result[0]->namecategory.""; 

                echo "<h2 class='section-title'>".$txt."</h2>" ;

            }catch(PDOException $e){
                echo $e->getMessage();
            }

         ?>

        <div class="search-box">
          <form action="category.php?idcategory=<?php echo $idCategory ?>" method="post">

            <input type="text" name='search-about' placeholder="Search for a course">
            <br>
            <button type="submit" name='search-course' class="btn btn-primary">
              <p class="btn-text">Search</p>
              <span class="square"></span>
            </button>

          </form>
        </div>



        <div class="course-grid">


        <?php

            $host = "localhost";
            $user = "root";
            $pass = "";
            $db = "elearning";

            try{
                $conn = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $idCategory = $_GET['idcategory'];

                if(!isset($_POST['search-course'])){
                    $sql = "SELECT * FROM course where idcategory = '$idCategory'";
                }
                else{
                  if(isset($_POST['search-about'])){
                      $search = $_POST['search-about'];
                      $sql = "SELECT * FROM course where idcategory = '$idCategory' and namecourse like '%$search%'";
                  }
                }

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





      <!--
        - #EVENT SECTION
      -->

      <section class="event">

        <div class="event-left">

          <div class="event-banner">
            <img src="./assets/images/event-img.jpg" alt="event banner" class="banner-img">
          </div>

          <button class="play smooth-zigzag-anim-1">
            <div class="play-icon pulse-anim">
              <ion-icon name="play-circle"></ion-icon>
            </div>

            <p>Watch Us !</p>
          </button>

        </div>

        <div class="event-right">

          <p class="section-subtitle">Our Events</p>

          <h2 class="section-title">Join Our Upcoming Events</h2>

          <div class="event-card-group">

            <div class="event-card">

              <div class="content-left">
                <p class="day">28</p>
                <p class="month">Feb, 2022</p>
              </div>

              <div class="content-right">
                <div class="schedule">
                  <p class="time">10:30am To 2:30pm</p>
                  <p class="place">Poland</p>
                </div>

                <a href="#" class="event-name">Business creativity workshops</a>
              </div>

            </div>

            <div class="event-card">

              <div class="content-left">
                <p class="day">15</p>
                <p class="month">Mar, 2022</p>
              </div>

              <div class="content-right">
                <div class="schedule">
                  <p class="time">10:30am To 2:30pm</p>
                  <p class="place">Poland</p>
                </div>

                <a href="#" class="event-name">Street Performance: Call for Art.</a>
              </div>

            </div>

            <div class="event-card">

              <div class="content-left">
                <p class="day">20</p>
                <p class="month">May, 2022</p>
              </div>

              <div class="content-right">
                <div class="schedule">
                  <p class="time">10:30am To 2:30pm</p>
                  <p class="place">Poland</p>
                </div>

                <a href="#" class="event-name">Digital transformation conference</a>
              </div>

            </div>

          </div>

        </div>

      </section>

      <!--
        - #CONTACT
      -->

      <section class="contact">

        <div class="contact-card" id="contact">
          <img src="./assets/images/cta-bg-img.png" alt="shape" class="contact-card-bg">

          <h2>Start Your Best Online Classes With Us</h2>

          <button class="btn btn-primary">
            <p class="btn-text">Contact Us</p>
            <span class="square"></span>
          </button>
        </div>

      </section>

    </main>





    <!--
      - #FOOTER
    -->

    <footer>

      <div class="footer-grid">

        <div class="grid-item">

          <div class="footer-logo">
            <img src="./assets/images/logo-footer.png" alt="educator logo white">
          </div>

          <p class="footer-text">
            Duis a tempor magna. Maecenas ligula felis, imperdiet quis arcu eget, blandit ultricies risus. Vivamus
            fringilla urna
            vel risus congue accumsan.
          </p>

          <div class="social-link">
            <a href="#">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
            <a href="#">
              <ion-icon name="logo-instagram"></ion-icon>
            </a>
            <a href="#">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
            <a href="#">
              <ion-icon name="logo-youtube"></ion-icon>
            </a>
          </div>

        </div>

        <ul class="grid-item">

          <h4 class="item-heading">Our Link</h4>

          <li class="list-item">
            <a href="#home">Home</a>
          </li>

          <li class="list-item">
            <a href="#about">About Us</a>
          </li>

          <li class="list-item">
            <a href="#course">Courses</a>
          </li>

          <li class="list-item">
            <a href="#blog">Blog</a>
          </li>

          <li class="list-item">
            <a href="#contact">Contact Us</a>
          </li>

        </ul>

        <ul class="grid-item">

          <h4 class="item-heading">Other Link</h4>

          <li class="list-item">
            <a href="#">Instructor</a>
          </li>

          <li class="list-item">
            <a href="#">FAQ</a>
          </li>

          <li class="list-item">
            <a href="#">Event</a>
          </li>

          <li class="list-item">
            <a href="#">Privacy Policy</a>
          </li>

          <li class="list-item">
            <a href="#">Term & Condition</a>
          </li>

        </ul>

        <div class="grid-item">

          <h4 class="item-heading">Subscribe Now</h4>

          <div class="wrapper">
            <input type="text" name="subscribe" placeholder="Email Address">
            
            <button class="send-btn">
              <ion-icon name="paper-plane"></ion-icon>
            </button>
          </div>

        </div>

      </div>

      <p class="copyright">
        Copyright © 2022 <a href="#">codewithsadee</a>. All rights reserved.
      </p>

    </footer>

  </div>





  <!--
    - custom js link
  -->
  <script src="./assets/js/script.js"></script>

  <!--
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>