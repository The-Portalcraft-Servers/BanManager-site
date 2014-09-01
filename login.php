<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/vnd.microsoft.icon"  href="./resources/favicon.ico"/>
        <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="http://getbootstrap.com/examples/signin/signin.css" rel="stylesheet">
        <title></title>
    </head>
    <body>
        <?php
        if (isset($_POST['subDoLoginAction'])) {
            login();
        }

        function login() {

            $username = $_POST["username"];
            $otp = $_POST["otp"];
            include 'config.php';
            require_once 'resources/GoogleAuthenticator.php';

            $ga = new PHPGangsta_GoogleAuthenticator();

            $connect = mysql_connect($conf['url'], $conf['user'], $conf['password']) or die("Connection problem.");
            mysql_select_db($conf['database']) or die("Couldn't connect to the database");


            $query = mysql_query("SELECT * FROM " . $conf['auth-table'] . " WHERE username='" . $username . "'");

            if ($query != null) {
                $numrow = mysql_num_rows($query);

                if ($numrow != 0) {

                    $row = mysql_fetch_assoc($query);

                    if ($username == $row["username"]) {
                        $checkResult = $ga->verifyCode($row['otp'], $otp, 2);
                        if ($checkResult) {
                            session_start();
                            $_SESSION['user'] = $username;
                            $_SESSION['email'] = $row['email'];
                            header('Location: index.php');
                        }
                    }
                }
            }
            echo '<br><div class="alert alert-danger" style="width: 500px;margin-left: auto;
    margin-right: auto">Incorrect username or OTP</div>';
        }
        ?>

        <div class="container" style="margin-top: 80px">
            <div class="panel" style="margin-left: auto;
                 margin-right: auto;margin-top: auto;margin-bottom: auto;width: 500px">
                <form class="form-signin" role="form" action="" method="POST">
                    <h2 class="form-signin-heading">BanManager</h2>
                    <input type="text" name="username" class="form-control" placeholder="Username" required="" autofocus="" autocomplete="off" style="margin-top: 20px">
                    <input type="text" name="otp" class="form-control" placeholder="OTP" required="" autofocus="" autocomplete="off" style="margin-top: 10px">
                    <p>Don't have an account? <a href='signup.php'>Sign up</a></p><div align="right"><button class="btn btn-primary " type="submit" name="subDoLoginAction" style="margin-top: 5px" >Login</button></div>
                </form>
            </div>


        </div>
    </body>
</html>