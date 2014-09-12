<!DOCTYPE html>
<html>
    <?php include'resources/head.php'; ?>
    <body>

        <?php include'resources/navbar.php'; ?>
        <div class="container" style="margin-top:100px; background-color: white; border-radius: 5px">
            <table class="table table-striped">
                <thead>  
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Admin?</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    include 'config.php';
                    $con = mysqli_connect($conf['url'], $conf['user'], $conf['password'], $conf['database']);

                    if (mysqli_connect_errno()) {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    }

                    $result = mysqli_query($con, "SELECT * FROM " . $conf['auth-table']);

                    while ($row = mysqli_fetch_array($result)) {
                        echo '<tr>
                        <td>' . $row['username'] . '</td>
                        <td>' . $row['email'] . '</td>';
                        if ($row['admin'] == "1") {
                            echo'
                        <td><span class="glyphicon glyphicon-ok" style="color: green"></td>
                    </tr>';
                        } else {
                            echo '<td ><span class="glyphicon glyphicon-remove" style="color: #a94442"></td></tr>';
                        }
                    }
                    ?>
                </tbody>

            </table>
        </div>
        <?php include 'resources/foot.php'; ?>
    </body>
</html>