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
// print_r($_POST);
$data = $_POST;
$arrData = array(
    'siteid' => $data['siteid'],
    'crfid' => $data['crfid'],
    'subid' => $data['subid'],
    'tel_day' => $data['tel_day'],
    'dov' => $data['dov'],
    'dovReason' => $data['dovReason'],
    'isMissedDose' => $data['isMissedDose'],
    'numMissedDose' => $data['numMissedDose'],
    'isParentEntered' => $data['isParentEntered'],
    'reasonParentEntered' => $data['reasonParentEntered'],
    'isParentDaily' => $data['isParentDaily'],
    'reasonParentDaily' => $data['reasonParentDaily'],
    'isParentInformed' => $data['isParentInformed'],
    'reasonParentInformed' => $data['reasonParentInformed'],
    'isMedHistory' => $data['isMedHistory'],
    'isMedInformed' => isset($data['isMedInformed'])? $data['isMedInformed'] : null,
    'reasonMedInformed' => $data['reasonMedInformed'],
    'isAE' => $data['isAE'],
    'isAEInformed' => isset($data['isAEInformed'])? $data['isAEInformed'] : null,
    'reasonAEInformed' => $data['reasonAEInformed'],
    'isFever' => isset($data['isFever'])? $data['isFever']: null,
    'isVomit' => isset($data['isVomit'])? $data['isVomit'] : null,
    'isLoose' => $data['isLoose'],
    'numLoose' => $data['numLoose'],
    'isAlert' => $data['isAlert'],
    'isDrink' => $data['isDrink'],
    'isEnteredDetails' => $data['isEnteredDetails'],
    'reasonEnteredDetails' => $data['reasonEnteredDetails'],
    'created_by'     => $_SESSION['user_id'],
    'created_at'     => $db->now(),
    'created_on'     => $_SERVER['REMOTE_ADDR'] ,
);

$result = $db->insert('ped_telephone', $arrData);

if ($result) {
    if ($data['tel_day'] == '1') {
        $db->where('id', $data['subid']);
        $db->update('ped_subject', array('enrolled' => 2));
    } else {
        $db->where('id', $data['subid']);
        $db->update('ped_subject', array('enrolled' => 3));
    }
    
    $_SESSION['message'] = "Visit details are stored and enrolled.";
} else {
    $_SESSION['message'] = "Some Error happned: " . $db->getLastError();
}
// echo $db->getLastError();

header('location: ../home.php');




