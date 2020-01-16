<?php
include_once 'inc/db.php';

$email = 'kol2@gmail.com';
$password = 'kol2@123';
$name = 'Kolkata LAB User2';

$data = array(
    'email' => $email,
    'password' => password_hash($password, PASSWORD_DEFAULT),
    'name' => $name,
    'created_at' => $db->now(),
    'expires' => $db->now('+1Y'),
    'updatedAt' => $db->now(),
);

$updateColumns = Array ("updatedAt");
$lastInsertId = "id";
$db->onDuplicate($updateColumns, $lastInsertId);
$id = $db->insert ('users', $data);