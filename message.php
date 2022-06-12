<?php

include './config/methods.php';
session_start();

if(isset($_SESSION['user_email']) && isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin'){

    $adminEmail = $_SESSION['user_email'];
    $adminName = $_SESSION['user_name'];
    $adminImage = $_SESSION['user_image'];

    $updateEvent = new updateEvent();
    if(isset($_GET['id'])){
        $mesId = $_GET['id'];
    }

    $email = $_GET['email'];
    $trueEmail = $_GET['true'];
    $name = $_GET['name'];
    $image = $_GET['image'];
    $date = $_GET['date'];
    $content = $_GET['content'];
    $read = $_GET['read'];
    $main = $_GET['pub'];

// if(isset($_POST['update-event']) && isset($_GET['id'])){

//     $result = $updateEvent->updateEvent($oldId, $eventTitle, $eventDate, $eventStarting, $eventEnding, $eventWhere, $eventDetails);

//     if($result == 1){
//         // header("Location: ./signup.php");
//         echo "<script>alert('Your event has updated successfully!')</script>";
//         echo "<script>window.close();</script>";
//     }
//     if($result == 2){
//         // header("Location: ./login.php");
//         echo "<script>alert('Problem!')</script>";
//         echo "<script>window.open('./admin/dashboard.php','_self')</script>";
//     }
// }

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

    <title>Message</title> 
</head>
<body>
    
<section class="login-form">

            <h2>Sender info: </h2>
            <p class="section-subtitle"><?php echo $name; ?> message!</p>
            <p class="section-subtitle"><?php echo $email; ?>!</p>
            <p class="section-subtitle"><?php echo $trueEmail; ?>!</p>
            <p class="section-subtitle"><?php echo $date; ?>!</p>

            <br>
        
            <div>
                <?php 

                if($read == '0'){
                    echo "<p class='section-subtitle'>This message is not read yet!</p>";
                }else{
                    echo "<p class='section-subtitle'>This message is read already!</p>";
                }

                    $host = "localhost";
                    $user = "root";
                    $pass = "";
                    $db = "elearning";
                    $conn;

                    try{
                        $conn = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = "SELECT * FROM images WHERE idimage = '$image'";

                        $statment = $conn->prepare($sql);
                        $statment->execute();
                        $result = $statment->fetchAll(PDO::FETCH_OBJ);

                        if(count($result) > 0){
                            foreach($result as $row){
                                $imagePath = $row->path;
                            }
                        }else{
                            echo "<script>alert('We run into a Problem!!');</script>";
                        }

                        $sql = "UPDATE messages SET readit = 1 WHERE idmessage = '$mesId'";

                        $statment = $conn->prepare($sql);
                        $statment->execute();
                        

                    }catch(PDOException $e){
                        echo $e->getMessage();
                    }

                ?>
                <img width="400px" height="auto" src="<?php echo $imagePath; ?>" alt="">

                <h2>Message Content: </h2>
                <p class="section-subtitle"><?php echo $content; ?>!</p>
            </div>

            <br>

            <div>
                <?php 

                if($main == '1'){
                    echo "<a href='./index.php?idmessage=".$mesId."&pub=".$main."&action=launch-event' name='launch-event'>Delete launching</a>";

                }else{
                    echo "<a href='./index.php?idmessage=".$mesId."&pub=".$main."&action=launch-event' name='launch-event'>Start launching</a>";
                }

                ?>
            </div>

            <br>

            <div>
                <a href="./admin/dashboard.php" class="btn btn-primary">Back</a>
            </div>

        </section>

</body>
</html>

<?php
}
else{
  header("Location: signin.php");
}

?>
