<?php
// Destroy the session to log out the user
session_start();
session_unset();
session_destroy();
header("Location: index.php");
exit;
?>