<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/abf2de4010.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Edu</title>
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
        <div class="container">
            <div class="container__left">
                <div class="container__bolcks">
                    <div class="block">
                        <div class="block__icon">
                            <span"><i class="fas fa-calendar-alt"></i></span>
                        </div>
                        <div class="block__title">
                            <div class="title">
                                Sessions
                            </div>
                        </div>
                    </div>
                    <div class="block">
                        <div class="block__icon">
                            <span"><i class="fas fa-users"></i></span>
                        </div>
                        <div class="block__title">
                            <div class="title">
                                Groups
                            </div>
                        </div>
                    </div>
                    <div class="block">
                        <div class="block__icon">
                            <span><i class="fas fa-paperclip"></i></span>
                        </div>
                        <div class="block__title">
                            <div class="title">
                                HomeWorks
                            </div>
                        </div>
                    </div>
                    <!--<div class="block">
                        <div class="block__icon">
                            <span><i class="fas fa-users"></i></span>
                        </div>
                        <div class="block__title">
                            <div class="title">
                                Groups
                            </div>
                        </div>
                    </div>-->
                </div>
            </div>
            <div class="container__right">
                <?php

                    $selecttop_3 = mysqli_query($db_conn, "SELECT * FROM users ORDER BY rank DESC");
                    $selecttop_10 = mysqli_query($db_conn, "SELECT * FROM users ORDER BY rank DESC");
                    
                    
                ?>
                <div class="right__rank">
                    <div class="rank__title">
                        <div class="title">
                            Top Rank
                        </div>
                    </div>
                    <div class="rank__top-3">
                        <div class="top-3">
                            <?php

                                /*for($i = 0; $i < 3; $i++)
                                {
                                    while($fetchtop_3  = mysqli_fetch_array($selecttop_3))
                                    {

                                        echo'
                                            <div class="user">
                                                <div class="user__img">
                                                    <div class="img">
                                                        <img src="http://localhost:888/edu/uploads/profile-imgs/'. $fetchtop_3['avatar'] .'">
                                                    </div>
                                                </div>
                                            </div> 
                                        ';
                                    }
                                }*/

                                
                            ?>
                        </div>
                    </div>
                    <div class="rank__top-10">
                        
                        <?php

                            /*for($i = 0; $i < 10; $i++)
                            {
                                while($fetchtop_10  = mysqli_fetch_array($selecttop_10))
                                {

                                    echo'
                                        <div class="user">
                                            <div class="user__name">
                                                <div class="name">
                                                    '.$fetchtop_10['f_name'] . ' ' . $fetchtop_10['l_name'] .'
                                                </div>
                                            </div>
                                        </div>
                                    ';
                                }
                            }*/
                        ?>

                        
                        
                    </div>
                    <div class="rank__see-more">
                        <div class="see-more__link">
                            <a href="rank" class="link">See More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="files/jquery-3.5.1.min.js"></script>
    <script>
        $.ajax({
            url: "http://localhost:888/edu/apis/rank.php",
            success: function (data) {
                
                for(var x=0; x < 3; x++)
                {
                    $('.rank__top-3 .top-3').append('<div class="user"><div class="user__img"><div class="img"><img src="http://localhost:888/edu/uploads/profile-imgs/'+ data[x]['avatar'] +'"></div></div></div> ')
                }

                for(var i=0; i < 10; i++)
                {
                    $('.rank__top-10').append('<div class="user"><div class="user__name">' + (i+1) + '- ' + data[i]['f_name'] + ' ' + data[i]['l_name'] +'<div class="name"></div></div></div>');
                }
                
            }
        });
    </script>
</body>
</html>