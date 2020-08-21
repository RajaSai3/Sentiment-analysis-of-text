<?php
session_start();
unset($_SESSION['Name']);
unset($_SESSION['userid']);
header("Location:login.html");
?>