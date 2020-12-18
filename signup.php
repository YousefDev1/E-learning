<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/abf2de4010.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/signup.css">
    <title>Sign Up</title>
</head>
<body>
    <?php

        require "conn.php";
        session_start();

    if(!isset($_SESSION['u_id']))
    {

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {


            $f_name           = filter_var($_POST['f_name'], FILTER_SANITIZE_STRING);
            $l_name           = filter_var($_POST['l_name'], FILTER_SANITIZE_STRING);
            $email            = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password         = filter_var($_POST['password']);
            $confirm_password = filter_var($_POST['confirm-password']);

            $selectusers = mysqli_query($db_conn, "SELECT * FROM users WHERE email='$email'");
            $countusers  = mysqli_num_rows($selectusers);

            $errors = array();


            if($countusers > 0)
            {
                $errors[] = "البريد الالكتروني مستخدم بالفعل";
            }

            if(empty($f_name) || empty($l_name) || empty($email) || empty($password) || empty($confirm_password))
            {
                $errors[] = "لا يجب ترك اي حقل فارغ";
            }

            if(strlen($password) < 8)
            {
                $errors[] = "يجب ان تكون كلمة المرور اكبر من 8 حروف";
            }

            if($password != $confirm_password)
            {
                $errors[] = "كلمات المرور لا تتطابق";
            }

            if(empty($errors))
            {
                mysqli_query($db_conn, "INSERT INTO users(
                    `f_name`, `l_name`, `email`, `password`
                )
                VALUES(
                    '$f_name', '$l_name', '$email', '$password'
                )
                ");

                

                header('location: login.php');
            }
        
        }

    }else{
        header('location: profile.php?u_id='. $_SESSION['u_id'] .'');
    }

    ?>
    
    <div class="root">
        <div class="errors">
           
            <?php

                if(!empty($errors))
                {
                    foreach($errors as $error)
                    {
                        echo'<div class="error">
                                '. $error .'
                            </div>
                        ';
                    }
                }

            ?>
        </div>
        <form action="" method="post">
            <div class="container">
                <div class="container__left">
                    <!--<img src="imgs/signup-img.png" alt="">-->
                </div>
                <div class="container__right">
                    <h1 class="right__title">E-Learning</h1>
                    <div class="right__row-name">
                        <input type="text" placeholder="First Name.." name="f_name">
                        <input type="text" placeholder="Last Name.." name="l_name">
                    </div>
                    <div class="right__email">
                        <input type="email" placeholder="Email.." name="email">
                    </div>
                    <div class="right__row-password">
                        <input type="password" id="password" placeholder="Password.." name="password">
                        <span id="show-pass"><i class="fas fa-eye"></i></span>
                        <input type="password"placeholder="Confirm Password.." name="confirm-password">
                    </div>
                    <div class="right__signup-btn">
                        <button name="signup">
                            <span>Sign Up</span>
                        </button>
                    </div>
                    <div class="right__login-link">
                        <p>Already have an account ? <a href="login.php">Login</a></p>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <script src="files/jquery-3.5.1.min.js"></script>
    <script>
        var show_hidepass = document.getElementById('show-pass');
        var password      = document.getElementById('password');

        show_hidepass.addEventListener('click', ()=>{
            if (password.type === "password") {
                password.type = "text";
                show_hidepass.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                password.type = "password";
                show_hidepass.innerHTML = '<i class="fas fa-eye"></i>';
            }
        })

        /***************/

        $(document).ready(function () {
            $('.error').click(function(){
                $(this).fadeOut();
            });
        });
    </script>
</body>
</html>