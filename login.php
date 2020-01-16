<?php
include_once 'inc/db.php';
session_start();
$email = !empty($_POST['email']) ? trim($_POST['email']) : null;
$password = !empty($_POST['password']) ? trim($_POST['password']) : null;

$db->where('email', $email);
$user = $db->getOne('users');
if ($user) {
    $expire = strtotime($user['expires']);
    $today = strtotime("today");
    if ($today >= $expire) {
        die('Your account expired! Please contact Administrator.');
    }
    $validPassword = password_verify($password, $user['password']);
    if ($validPassword) {
        session_regenerate_id();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['logged_in'] = time();
        $terminal = $_SERVER['REMOTE_ADDR'];
        $db->insert('logins', array('userid' => $user['id'], 'terminal' => $terminal));
        header('Location: home.php');
        exit;
    }
} 
die('Incorrect username/password combination!');
?>