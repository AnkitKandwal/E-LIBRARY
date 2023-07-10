
<?php
$server = 'localhost';
$user = 'root';
$password = '';
$dbname = 'elibrary';

$con = mysqli_connect($server, $user, $password, $dbname);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
?>
