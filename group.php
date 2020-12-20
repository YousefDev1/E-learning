<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/abf2de4010.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/group.css">
    <?php

        require "conn.php";
        @$group_id = $_GET['group_id'];

        $selcetgroup = mysqli_query($db_conn, "SELECT * FROM groups WHERE group_id='$group_id'");
        $fetchgroup  = mysqli_fetch_array($selcetgroup);

    ?>
    <title><?php echo $fetchgroup['group_name']; ?></title>
</head>
<body>
    <?php

        include "tmbl/leftBar.php";

    if(mysqli_num_rows($selcetgroup) > 0)
    {

    ?>

    <div class="main-container">
        <div class="container">
            <div class="container__header">
                <div class="header__group-cover">
                    <div class="group-cover">
                        <div class="cover">
                            <?php  ?>
                            <img src="uploads/groups/group-photos/cover.jpg" alt="" srcset="">
                        </div>
                    </div>
                </div>
                <div class="header__info">
                    <div class="info__group-name">
                        <div class="group-name">
                            <div class="name">
                                <?php echo $fetchgroup['group_name'] ?>
                            </div>
                        </div>
                    </div>
                    <div class="info__group-avatar">
                        <div class="group-avatar">
                            <div class="avatar">
                                <?php  ?>
                                <img src="uploads/groups/group-photos/finish.jpg" alt="" srcset="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container__main">
                <div class="main__left">

                </div>
                <div class="main__right">
                    rytu
                </div>
            </div>
        </div>
    </div>

    <?php

    }else{
        header('location: errors/404');
    }
    ?>


    <script src="files/jquery-3.5.1.min.js"></script>

</body>
</html>