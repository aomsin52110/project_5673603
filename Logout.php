<?php
session_start();
session_destroy();
echo "<script type = 'text/javascript'>";
echo "alert('You're now Logged out!');";
header('location: Login.php');
?>