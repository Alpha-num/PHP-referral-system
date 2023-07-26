<?php
define('HOSTNAME', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DATABASE', 'referral_system');

$connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);
if(!$connection){
    die("could not connect to database");
}

?>