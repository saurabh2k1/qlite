<?php

session_start();

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();
    session_destroy();
}
$_SESSION['LAST_ACTIVITY'] = time();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

include_once '../inc/db.php';
$data = $_POST;
$d = array(
    'siteid' => $data['siteid'],
    'code'   => $data['code'],
    'initial'=> strtoupper($data['initials']),
    'dov'    => $data['dov'],
    'created_by' => $_SESSION['user_id'],
    'created_at' => $db->now(),
    'created_on' => $_SERVER['REMOTE_ADDR'] 
);

$id = $db->insert('ped_subject', $d);
if ($id) {
    header('Location: screening.php?s='. $id);
} else {
    echo 'Record insertion failed: ' . $db->getLastError();
}
?>