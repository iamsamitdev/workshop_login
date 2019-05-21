<?php
session_start();
// Clear session
session_destroy();
// Redirect to login page
header('location:login.php');
