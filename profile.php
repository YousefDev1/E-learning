<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/abf2de4010.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/profile.css">
    <?php

        require "conn.php";
        session_start();

        @$u_id = $_GET['u_id'];

        $selectuser = mysqli_query($db_conn, "SELECT * FROM users WHERE u_id='$u_id'");
        $fetchuser  = mysqli_fetch_array($selectuser);

    ?>
    <title><?php echo $fetchuser['f_name'] . ' ' . $fetchuser['l_name']; ?></title>
</head>
<body>
    <?php


        echo $u_id;

        echo'
            <img src="http://localhost:888/edu/uploads/'. $fetchuser['avatar'] .'" alt="">
        ';

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {

            $avatar = $_FILES['avatar'];

            $name = md5(date('h : m : s')) . '_' . $avatar['name'];

            move_uploaded_file($avatar['tmp_name'], 'uploads\\' . $name);

            mysqli_query($db_conn, "UPDATE users SET avatar='$name' WHERE u_id='$u_id'");

            
        
        }



    ?>

   

   
</body>
</html>