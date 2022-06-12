<?php

include '../config/methods.php';
session_start();

if(isset($_SESSION['user_email'])){

    $userEmail = $_SESSION['user_email'];
    $userName = $_SESSION['user_name'];

    $newMessage = new newMessage();

if(isset($_POST['message-btn'])){

    $senderName = $_POST['sender-name'];
    $senderEmail = $_POST['sender-email'];
    $senderMessage = $_POST['sender-message'];
    $senderSESSIONemail = $_SESSION['user_email'];
    $senderSESSIONimage = $_SESSION['user_image'];

    $result = $newMessage->newMessage($senderName, $senderEmail, $senderMessage, $senderSESSIONemail, $senderSESSIONimage);

    if($result == 1){
        // header("Location: ./signup.php");
        echo "<script>alert('Your message reached us, Thank you!')</script>";
        echo "<script>window.close()</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Stylesheet links: -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="../assets/css/contact.css" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">

        <!-- CDN Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"/>

        <!-- Icons -->
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

        <!-- The title: -->
        <title>iLearning | Message us! </title>
    </head>
    <body>

        <h1>Welcome <?php echo $_SESSION['user_name']; ?></h1>
        
        <div class="container">
            <div class="contact-box">
                <div class="left"></div>
                <div class="right">
                    <h2>Contact Us</h2>
                    <form action="contact.php" method="post">
                        <input type="text" name="sender-name" class="field" placeholder="Your Name" required>
                        <input type="email" name="sender-email" class="field" placeholder="Your Email" required>
                        <textarea placeholder="Message" name="sender-message" class="field" required></textarea>
                        <button name="message-btn" class="btn">Send</button>
                        <br>
                        <a name="back-btn" href="../index.php" class="back-btn btn">Back home</a>
                    </form>
                    
                </div>
            </div>
        </div>


        <!-- footer -->
    <footer>
      <div class = "social-links">
        <a href="https://www.facebook.com/abdallah.ismaili.737" target="_blank"><i class = "fab fa-facebook-f"></i></a>
        <a href="https://github.com/AbdallahIsmaili" target="_blank"><i class = "fab fa-github"></i></a>
        <a href="https://www.instagram.com/ai_smaili/" target="_blank"><i class = "fab fa-instagram"></i></a>
        <a href="www.linkedin.com/in/abdallah-69ismaili" target="_blank"><i class = "fab fa-linkedin"></i></a>
        <a href = ""><i class = "fab fa-twitter"></i></a>
      </div>
      <span>Dev and Programing</span>
    </footer>
    <!-- end of footer -->


        
    </body>
</html>

<?php
}
else{
  echo "<h1>Hello My Friend Please Sign in or create an account to be able to contact us!</h1> <br> <br> <a href='../signin.php'>Log in now!</a>";
}

?>