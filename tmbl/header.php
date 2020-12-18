

<div class="container__header">
    <form action="search.php">
        <div class="header__search">
            <button class="search__search-btn">
                <span><i class="fas fa-search"></i></span>
            </button>
            <input type="text" placeholder="Search..." name="q" class="search__search-box">
        </div>
    </form>
    <div class="header__links">
        <div class="profile-img">
            <?php

                echo'
                    <a href="profile.php?u_id='. $_SESSION['u_id'] .'"><img src="http://localhost:888/edu/uploads/profile-imgs/'. $fetchuser['avatar'] .'"></a>
                ';
            ?>
        </div>
    </div>
</div>