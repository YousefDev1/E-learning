<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/abf2de4010.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>
<body>
    <?php

        require "conn.php";
        session_start();

    if(!isset($_SESSION['u_id']))
    {

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {


            $email            = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password         = filter_var($_POST['password']);

            $selectusers = mysqli_query($db_conn, "SELECT * FROM users WHERE email='$email'");
            $countusers  = mysqli_num_rows($selectusers);

            $errors = array();


            if($countusers == 0)
            {
                $errors[] = "هذا المستخدم غير موجود";
            }

            if(empty($email) || empty($password))
            {
                $errors[] = "لا يجب ترك اي حقل فارغ";
            }

            $selectusers = mysqli_query($db_conn , "SELECT * FROM users WHERE email = '$email' AND password = '$password'");

            $fetchusers = mysqli_fetch_array($selectusers);
    
            $u_id = $fetchusers['u_id'];
            
            if($fetchusers['email'] != $email)
            {
                $errors[] = "البريد الالكتروني خطأ";
            }

            if($fetchusers['password'] != $password)
            {
                $errors[] = "كلمة السر خطأ";
            }
                

            if(empty($errors))
            {                
                $_SESSION['u_id'] = $u_id;
                
                header('location: profile.php?u_id='. $u_id .'');
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
                    <div class="right__email">
                        <input type="email" placeholder="Email.." name="email">
                    </div>
                    <div class="right__row-password">
                        <input type="password" id="password" placeholder="Password.." name="password">
                        <span id="show-pass"><i class="fas fa-eye"></i></span>
                    </div>
                    <div class="right__login-btn">
                        <button name="login">
                            <span>Login</span>
                        </button>
                    </div>
                    <div class="right__signup-link">
                        <p>Don't have an account ? <a href="signup.php">Sign Up</a></p>
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