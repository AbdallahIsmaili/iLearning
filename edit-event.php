<?php

include './config/methods.php';
session_start();

if(isset($_SESSION['user_email']) && isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin'){

    $adminEmail = $_SESSION['user_email'];
    $adminName = $_SESSION['user_name'];
    $adminImage = $_SESSION['user_image'];

    $updateEvent = new updateEvent();
    if(isset($_GET['id'])){
        $oldId = $_GET['id'];
    }

if(isset($_POST['update-event']) && isset($_GET['id'])){

    $eventTitle = $_POST['event-title'];
    $eventDate = $_POST['event-date'];
    $eventStarting = $_POST['event-starting'];
    $eventEnding = $_POST['event-ending'];
    $eventWhere = $_POST['where'];
    $eventDetails = $_POST['event-details'];

    $result = $updateEvent->updateEvent($oldId, $eventTitle, $eventDate, $eventStarting, $eventEnding, $eventWhere, $eventDetails);

    if($result == 1){
        // header("Location: ./signup.php");
        echo "<script>alert('Your event has updated successfully!')</script>";
        echo "<script>window.close();</script>";
    }
    if($result == 2){
        // header("Location: ./login.php");
        echo "<script>alert('Problem!')</script>";
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

    <title>Edit - <?php echo $_GET['title']; ?></title> 
</head>
<body>
    
<section class="login-form">
            <p class="section-subtitle">Update <?php echo $_GET['title']; ?> event !!</p>
            <br>
        <br>
        <br>
        
        <form action="edit-event.php?id=<?php echo $_GET['id'];?>&title=<?php echo $_GET['title'];?>&desc=<?php echo $_GET['desc'];?>&in=<?php echo $_GET['in'];?>&at=<?php echo $_GET['at'];?>&to=<?php echo $_GET['to'];?>&date=<?php echo $_GET['date'];?>" method="POST">

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
                <button type="submit" name="update-event" class="btn btn-primary">Update this event</button>
            </div>
            </form>

        </section>

</body>
</html>

<?php
}
else{
  header("Location: signin.php");
}

?>
