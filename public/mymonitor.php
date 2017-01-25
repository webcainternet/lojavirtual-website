<?php
/* *** mysql check *** */

ini_set('display_errors', 1);

$host = '172.17.0.1';
$user = 'monitor';
$pass = 'wcam0n1t0r';
$base = 'monitor';

$sql="SELECT texto, CURTIME() as data FROM mymonitor";
$con = new mysqli($host, $user, $pass, $base);

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    echo 'Falha ao desativar conta';
    exit();
}

if ($result = $con->query($sql)) {
    /* fetch object array */
    while ($row = $result->fetch_row()) {
        echo $row[0].' '.$row[1];
    }

    /* free result set */
    $result->close();
}

mysqli_close($con);
?>
