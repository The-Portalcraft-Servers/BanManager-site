<nav class="navbar navbar-default navbar-fixed-top" role="navigation" >
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href=".">BanManager</a>
        </div>

        <ul class="nav navbar-nav">

            <!-- Ban  -->  
            <li ><a href="bans.php">Bans</a></li>

            <!--
            <li><a href="#">Link</a></li>

           
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                    <li class="divider"></li>
                    <li><a href="#">One more separated link</a></li>
                </ul>
            </li>
            -->
        </ul>

        <ul class="nav navbar-nav navbar-right">

            <!-- Profile -->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?php
                    $email = $_SESSION['email'];
                    $default = "https://minotar.net/helm/" . $_SESSION['user'] . "/20.png";
                    $size = 20;
                    $grav_url = "http://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?d=" . urlencode($default) . "&s=" . $size;
                    echo '<img src=' . $grav_url . '"> ' . ucfirst("" . $_SESSION['user']);
                    ?> <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li class="disabled"><a href="profile.php">Profile</a></li>
                    <?php
                    include 'config.php';
                    $con = mysqli_connect($conf['url'], $conf['user'], $conf['password'], $conf['database']);

                    if (mysqli_connect_errno()) {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    }

                    $result = mysqli_query($con, "SELECT * FROM " . $conf['auth-table'] . " WHERE `username` = '" . $_SESSION['user'] . "'");

                    while ($row = mysqli_fetch_array($result)) {
                        if ($row['admin'] != "") {
                            echo '<li><a href="admin.php">Admin</a></li>';
                        }
                    }
                    ?>
                    <li class="divider"></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>

    </div>     
</nav>