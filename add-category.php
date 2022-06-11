<?php

include './config/methods.php';
session_start();

if(isset($_SESSION['user_email']) && isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin'){

    $adminEmail = $_SESSION['user_email'];
    $adminName = $_SESSION['user_name'];
    $adminImage = $_SESSION['user_image'];

    
$newCategory = new newCategory();

if(isset($_POST['add-category'])){

    $nameCategory = $_POST['nameC'];
    $categoryDesc = $_POST['category-desc'];
    $categoryImage = $_POST['category-img'];

    $result = $newCategory->newCategory($nameCategory, $categoryDesc, $categoryImage);

    if($result == 1){
        // header("Location: ./signup.php");
        echo "<script>alert('This category has already found!')</script>";
        echo "<script>window.open('./admin/dashboard.php','_self')</script>";
    }
    if($result == 2){
        // header("Location: ./login.php");
        echo "<script>alert('Category has been added successfully!')</script>";
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

    <title>Add New Category</title> 
</head>
<body>
    
<section class="login-form">
            <p class="section-subtitle">Add new category !!</p>
            <br>
        <br>
        <br>
            <form action="add-category.php" method="POST">
                <div class="form-group">
                    <label for="email">New Category Name :</label>
                    <input type="text" name="nameC" id="email" class="form-control" placeholder="Enter category name">
                </div>

                <div class="form-group">
                    <label for="email">New Category Desc :</label>
                    <textarea name="category-desc" value="" id="" cols="30" rows="5"></textarea>
                </div>

                <div class="form-group">
                    <label for="email">New Category image :</label>
                    <textarea name="category-img" id="" cols="30" rows="5"></textarea>
                </div>
                <br>
        <br>
                <div class="form-group">
                    <button type="submit" name="add-category" class="btn btn-primary">Add category</button>
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
