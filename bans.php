<!DOCTYPE html>
<html>
    <?php include'resources/head.php'; ?>
    <?php
    if (isset($_GET['unban']) && !empty($_GET['unban'])) {

        $unban = $_GET['unban'];
        include 'config.php';
        $con = mysqli_connect($conf['url'], $conf['user'], $conf['password'], $conf['database']);

        $st = $con->prepare("DELETE FROM `bans` WHERE `UUID` = ?");
        $st->bind_param("s", $unban);
        $st->execute();
        $st->close();
        $con->close();
    }
    ?>
    <body>
        <?php include'resources/navbar.php'; ?>
        <div class="container" style="margin-top:100px; background-color: white; border-radius: 5px">
            <div class="row">
                <div class="col-md-3">Player</div>
                <div class="col-md-3">Reason</div>
                <div class="col-md-3">Expires</div>
                <div class="col-md-3">Banner</div>
            </div>

            <?php
            include 'config.php';
            $con = mysqli_connect($conf['url'], $conf['user'], $conf['password'], $conf['database']);

            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }

            $result = mysqli_query($con, "SELECT * FROM " . $conf['table']);

            while ($row = mysqli_fetch_array($result)) {

                if ($row['time'] > time()) {
                    echo '<div class="row" style="margin-top:20px">
                <div class="col-md-3"><img src="https://minotar.net/helm/' . $row["name"] . '/30.png" > ' . $row["name"] . '</div>' .
                    '<div class="col-md-3">' . $row["reason"] . '</div>' .
                    '<div class="col-md-3">' . gmdate("Y-m-d H:i:s ", $row['time']) . '</div>';
                    echo '<div class="col-md-2">'; if($row["banner"] != "CONSOLE") { echo '<img src="https://minotar.net/helm/' . $row["banner"] . '/30.png" > '; } echo $row["banner"] . '</div>';
                    echo '<div class="col-md-1"><a href="bans.php?unban=' . $row['UUID'] . '"><span class="glyphicon glyphicon-trash"></span></a></div>';
                    echo '</div>';
                }
            }
            ?>
        </div>
    </body>
</html>