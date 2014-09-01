<!DOCTYPE html>
<html>
    <?php include'resources/head.php'; ?>
    <body>

        <?php include'resources/navbar.php'; ?>
        <div class="container" style="margin-top:100px; background-color: white; border-radius: 5px">

            <div id="welcome" style="margin-left: 10px">
                <h3>Welcome back, <?php include 'config.php';
        echo ucfirst("" . $_SESSION['user']);
        ?></h3>
            </div>

            <div id="right" style="margin-left: 10px">
                asd
            </div>



        </div>
<?php include 'resources/foot.php'; ?>
    </body>
</html>