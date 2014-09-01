<?php

require_once 'resources/GoogleAuthenticator.php';

$ga = new PHPGangsta_GoogleAuthenticator();

$secret = $ga->createSecret();
echo "Secret is: " . $secret . "\n\n";

$qrCodeUrl = $ga->getQRCodeGoogleUrl('BanManager', $secret);
echo '<img src="' . $qrCodeUrl . '">';

$oneCode = $ga->getCode($secret);
echo "Checking Code '$oneCode' and Secret '$secret':\n";

$checkResult = $ga->verifyCode($secret, $oneCode, 2);    // 2 = 2*30sec clock tolerance
if ($checkResult) {
    echo 'OK';
} else {
    echo 'FAILED';
}