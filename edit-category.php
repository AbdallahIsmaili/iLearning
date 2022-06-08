<?php

include './config/methods.php';
session_start();

if(isset($_SESSION['user_email']) && isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin'){

    $adminEmail = $_SESSION['user_email'];
    $adminName = $_SESSION['user_name'];
    $adminImage = $_SESSION['user_image'];

    $updateCategory = new updateCategory();
    if(isset($_GET['id'])){
        $oldId = $_GET['id'];
    }

if(isset($_POST['update-category']) && isset($_GET['id'])){

    $newID = $_POST['new-idC'];
    $newName = $_POST['new-nameC'];
    $oldId = $_GET['id'];
    $newDesc = $_POST['new-category-desc'];
    $newImage = $_POST['new-category-img'];

    $result = $updateCategory->updateCategory($newID, $oldId, $newName, $newDesc, $newImage);

    echo $result;

    if($result == 1){
        // header("Location: ./signup.php");
        echo "<script>alert('Your category has updated successfully!')</script>";
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
            <p class="section-subtitle">Update <?php echo $_GET['title']; ?> category !!</p>
            <br>
        <br>
        <br>
            <form action="edit-category.php?id=<?php echo $oldId; ?>&title=<?php echo $_GET['title']; ?>&desc=<?php echo $_GET['desc']; ?>&img=<?php echo $_GET['img']; ?>" method="POST">
                <div class="form-group">
                    <label for="name">New id :</label>
                    <input type="number" name="new-idC" id="name" value="<?php echo $_GET['id']; ?>" class="form-control" placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <label for="email">New Category Name :</label>
                    <input type="text" name="new-nameC" id="email" value="<?php echo $_GET['title']; ?>" class="form-control" placeholder="Enter your email">
                </div>

                <div class="form-group">
                    <label for="email">New Category Desc :</label>
                    <textarea name="new-category-desc" value="<?php echo $_GET['desc']; ?>" id="" cols="30" rows="5"><?php echo $_GET['desc']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="email">New Category image :</label>
                    <textarea name="new-category-img" value="<?php echo $_GET['img']; ?>" id="" cols="30" rows="5"><?php echo $_GET['img']; ?></textarea>
                </div>
                <br>
        <br>
                <div class="form-group">
                    <button type="submit" name="update-category" class="btn btn-primary">Update category info</button>
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
