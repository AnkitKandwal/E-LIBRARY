<?php
session_start();

if (isset($_GET['logout'])) {
    if ($_GET['logout'] === 'true') {
        echo '<script>';
        echo 'if (confirm("Are you sure to logout?")) {';
        echo 'window.location.href = "logout.php";';
        echo '} else {';
        echo 'window.location.href = "booklisting.php";';
        echo '}';
        echo '</script>';
        exit;
    }
}

// Rest of your code...

session_unset();
header("location:login.php");
session_destroy();
exit;
?>
