<?php

session_start();

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();
    session_destroy();
}
$_SESSION['LAST_ACTIVITY'] = time();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

// include_once 'inc/db.php';

if (isset($_GET['sid']) && !empty($_GET['sid'])) {
    $_SESSION['studyid'] = $_GET['sid'];
}

header("Location: home.php");
die('');