<?php
session_start();

if (isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = null;
    unset($_SESSION['user_id']);
}

// Correct the path depending on where the file is located
header("Location: ../login.php"); // Or use "/demo/login.php" if using an absolute path
die();
?>
