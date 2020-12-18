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

    if($u_id == $_SESSION['u_id'])
    {



        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {

            /*;

            

            move_uploaded_file($avatar['tmp_name'], 'uploads\profile-imgs\\' . $name);

            mysqli_query($db_conn, "UPDATE users SET avatar='$name' WHERE u_id='$u_id'");*/

            $f_name = filter_var($_POST['f_name'], FILTER_SANITIZE_STRING);
            $l_name = filter_var($_POST['l_name'], FILTER_SANITIZE_STRING);
            $gender           = filter_var($_POST['gender']);

            $avatar = filter_var($_FILES['avatar']);

            if(!empty($_FILES['avatar']['name']))
            {

                $name = md5(date('h : m : s')) . '_' . $_FILES['avatar']['name'];

                move_uploaded_file($_FILES['avatar']['tmp_name'], 'uploads\profile-imgs\\' . $name);
                
            }else{

                $name = $fetchuser['avatar'];

            }
            
            if(!empty($f_name) && !empty($l_name))
            {
                mysqli_query($db_conn, "UPDATE users SET f_name='$f_name', l_name='$l_name', gender='$gender', avatar='$name' WHERE u_id='$u_id'");

                header('location: profile.php?u_id='. $u_id .'');
            }
            

            
        
        }
    }else{
        header('location: profile.php?u_id='. $_SESSION['u_id'] .'');
    }


    ?>

   <div class="root">
        <div class="container">
            <form action="" method="POST" enctype="multipart/form-data"> 
                <div class="profile">
                    <div class="profile__header">
                        <div class="upload-img">
                            <input type="file" name="avatar" id="upload-img" accept=".jpg, .png, .jpeg">
                        </div>
                        <label for="upload-img" class="profile__img">
                            
                            <div class="image">
                                <?php
                                    
                                    echo'
                                        <img src="http://localhost:888/edu/uploads/profile-imgs/'. $fetchuser['avatar'] .'" id="image">
                                    ';
                                    
                                ?>
                            </div>
                        </label>
                        <div class="profile__title">
                            <div class="title">
                                <?php echo $fetchuser['f_name'] . ' ' . $fetchuser['l_name']; ?>
                            </div>
                        </div>
                    </div>
                    <div class="profile__information">
                        <div class="info__row-name">
                            <span>First Name</span>
                            <input type="text" name="f_name" id="f_name" value="<?php echo $fetchuser['f_name']; ?>">
                            <input type="text" name="l_name" value="<?php echo $fetchuser['l_name']; ?>">
                        </div>
                        <div class="info__row-gender">
                            <select name="gender">
                                <?php

                                if($fetchuser['gender'] == 'male')
                                {
                                    echo'
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    ';
                                }elseif($fetchuser['gender'] == 'female')
                                {
                                    echo'
                                        <option value="female">Female</option>
                                        <option value="male">Male</option>
                                    ';
                                }

                                ?>
                            </select>
                        </div>
                        <div class="info__update-btn">
                            <button>
                                <span>Save</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
   </div>

   

   <script>
       var btn = document.getElementById('btn');
       var file = document.getElementById('upload-img');

       btn.addEventListener('click', function(){
           file.click();
       })

       
   </script>
</body>
</html>