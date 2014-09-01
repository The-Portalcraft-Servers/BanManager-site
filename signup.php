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
            $email = $_POST["email"];
            $otp = $_POST["otp"];
            $secret = $_POST["secret"];
            include 'config.php';
            require_once 'resources/GoogleAuthenticator.php';

            $ga = new PHPGangsta_GoogleAuthenticator();

            $connect = mysql_connect($conf['url'], $conf['user'], $conf['password']) or die("Connection problem.");
            mysql_select_db($conf['database']) or die("Couldn't connect to the database");


            $query = mysql_query("SELECT * FROM " . $conf['auth-table'] . " WHERE username='" . $username . "'");


            $numrow = mysql_num_rows($query);

            if ($numrow == 0) {

                $row = mysql_fetch_assoc($query);


                $checkResult = $ga->verifyCode($secret, $otp, 2);
                if ($checkResult) {
                    $i = "INSERT INTO " . $conf['auth-table'] . " (`username`, `email`, `otp`) VALUES ('" . $username . "', '" . $email . "', '" . $secret . "');";
                    $insert = mysql_query($i);
                    session_start();
                    $_SESSION['user'] = $username;
                    $_SESSION['email'] = $row['email'];
                    header('Location: index.php');
                } else {
                    echo '<div class="alert alert-danger" style="width: 500px;margin-left: auto;
    margin-right: auto">The OTP is incorrect</div>';
                }
            } else {
                echo '<div class="alert alert-danger" style="width: 500px;margin-left: auto;
    margin-right: auto">That name is already taken</div>';
            }
        }
        ?>

        <div class="container" style="background-color: white">
            <form class="form-signin " role="form" action="" method="POST">
                <h2 class="form-signin-heading">BanManager</h2>
                <input type="text" name="username" class="form-control" placeholder="Username" required="" autofocus="" autocomplete="off" style="margin-top: 20px">
                <input type="email" name="email" class="form-control" placeholder="Email" required="" autofocus="" autocomplete="off" style="margin-top: 20px">
                <div class="alert alert-success" role="alert" style="margin-top: 10px"><b>OTP</b> stands for One Time Password.<br>Download the <a href="https://www.authy.com/consumers" target="_blank"><b>Authy</b></a> app and scan the code below.</div>
                <?php
                require_once 'resources/GoogleAuthenticator.php';

                $ga = new PHPGangsta_GoogleAuthenticator();

                $secret = $ga->createSecret();
                echo "<input type='hidden' name='secret' required=''value='" . $secret . "'>";

                $qrCodeUrl = $ga->getQRCodeGoogleUrl('BanManager', $secret);
                echo '<center> <img src="' . $qrCodeUrl . '"</center>';
                ?>

                <input type="text" name="otp" class="form-control" placeholder="OTP" required="" autofocus="" autocomplete="off" style="margin-top: 10px">
                <div align="right"><button class="btn btn-success " type="submit" name="subDoLoginAction" style="margin-top: 5px" >Sign up</button></div>
            </form>
        </div>
    </body>
</html>