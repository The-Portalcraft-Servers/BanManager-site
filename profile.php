<!DOCTYPE html>
<html>
    <?php include'resources/head.php'; ?>
    <body>
        <?php include'resources/navbar.php'; ?>

        <div class="container" style="margin-top:50px;background-color: white; border-radius: 5px">

            <div class="panel panel-default pull-left" style="width: 250px">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php
                        $email = $_SESSION['email'];
                        $default = "https://minotar.net/helm/" . $_SESSION['user'] . "/70.png";
                        $size = 70;
                        $grav_url = "http://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?d=" . urlencode($default) . "&s=" . $size;
                        echo '<img src=' . $grav_url . '"> ' . ucfirst("" . $_SESSION['user']);
                        ?></h3>
                </div>
                <div class="panel-body">
                    <div id="settings" >
                        <ul class="nav nav-tabs nav-stacked" style="border-color: white;">
                            <li style="margin-bottom: 10px"><a href="#">Account</a></li>
                            <li style="margin-bottom: 10px"><a href="#">Security</a></li>
                            <li style="margin-bottom: 10px"><a href="#">sad</a></li>
                            <li style="margin-bottom: 10px"><a href="#">asd</a></li>

                        </ul>
                    </div>
                </div>
            </div>
            <div>
                <?php include './resources/account.php'; ?>
            </div>



        </div>
    </div>
    <?php include 'resources/foot.php'; ?>
</body>
</html>