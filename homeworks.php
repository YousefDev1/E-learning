<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/abf2de4010.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/homeworks.css">
    <title>Home Works</title>
</head>
<body>
    <?php

        require "conn.php";
        session_start();

        if(isset($_SESSION['u_id']))
        {
            include "tmbl/leftBar.php";

            $u_id = $_SESSION['u_id']; 

            $selectuser = mysqli_query($db_conn, "SELECT * FROM users WHERE u_id='$u_id' ");
            $fetchuser  = mysqli_fetch_array($selectuser);

        }else{
            header('location: login.php');
        }

    ?>
    <div class="main-container">
        <?php include "./tmbl/header.php"; ?>
        
    </div>
</body>
</html>