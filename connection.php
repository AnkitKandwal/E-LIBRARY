
<?php
$server = 'localhost';
$user = 'root';
$dbname = 'elibrary';

$con = mysqli_connect($server, $user, '', $dbname);

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
?>
