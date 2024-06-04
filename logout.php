<?php

@include 'config.php';

session_start();
// les variables
session_unset();
// les donees
session_destroy();

header('location:login.php');

?>