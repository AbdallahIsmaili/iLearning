<?php

include './config/methods.php';
session_start();

if(isset($_SESSION['user_email']) && isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin'){

    $adminEmail = $_SESSION['user_email'];
    $adminName = $_SESSION['user_name'];
    $adminImage = $_SESSION['user_image'];

    
$newEvent = new newEvent();

if(isset($_POST['add-event'])){

    $eventTitle = $_POST['event-title'];
    $eventDate = $_POST['event-date'];
    $eventStarting = $_POST['event-starting'];
    $eventEnding = $_POST['event-ending'];
    $eventWhere = $_POST['where'];
    $eventDetails = $_POST['event-details'];

    $result = $newEvent->newEvent($eventTitle, $eventDate, $eventStarting, $eventEnding, $eventWhere, $eventDetails);

    if($result == 1){
        // header("Location: ./signup.php");
        echo "<script>alert('The event has been posted!')</script>";
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

    <title>Add New Event</title> 
</head>
<body>
    
<section class="login-form">
            <p class="section-subtitle">Add new event !!</p>
            <br>
        <br>
        <br>
            <form action="add-event.php" method="POST">

                <div class="form-group">
                    <label for="email">Event title: </label>
                    <input type="text" name="event-title" class="form-control" placeholder="Enter event title">
                </div>
                
                <div class="form-group">
                    <label for="email">Event date: </label>
                    <input type="date" name="event-date" class="form-control" placeholder="Event date">
                </div>

                <div class="form-group">
                    <label for="email">Event starting at: </label>
                    <input type="text" name="event-starting" class="form-control" placeholder="Event starting time">
                </div>

                <div class="form-group">
                    <label for="email">Event ending at: </label>
                    <input type="text" name="event-ending" class="form-control" placeholder="Event ending time">
                </div>

                <div class="form-group">
                    <label for="email">Where: </label>
                    <input type="text" name="where" class="form-control" placeholder="Where it will be">
                </div>

                <div class="form-group">
                    <label for="email">Event details :</label>
                    <textarea name="event-details" value="" id="" cols="30" rows="5"></textarea>
                </div>

                <br>
        <br>
                <div class="form-group">
                    <button type="submit" name="add-event" class="btn btn-primary">Add this event</button>
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
