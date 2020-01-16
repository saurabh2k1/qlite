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

$eosData = array(
    'siteid' => $data['siteid'],
    'subid' => $data['subid'],
    'dov'   => $data['dov'],
    'dovReason' => $data['dovReason'],
    'diarrhea_startDt' => $data['diarrhea_startDt'],
    'day0_loose' => $data['day0_loose'],
    'day0_semi'  => $data['day0_semi'],
    'day0_liquid' => $data['day0_liquid'],
    'day1_loose' => $data['day1_loose'],
    'day1_semi'  => $data['day1_semi'],
    'day1_liquid' => $data['day1_liquid'],
    'day2_loose' => $data['day2_loose'],
    'day2_semi'  => $data['day2_semi'],
    'day2_liquid' => $data['day2_liquid'],
    'day3_loose' => $data['day3_loose'],
    'day3_semi'  => $data['day3_semi'],
    'day3_liquid' => $data['day3_liquid'],
    'day4_loose' => $data['day4_loose'],
    'day4_semi'  => $data['day4_semi'],
    'day4_liquid' => $data['day4_liquid'],
    'day5_loose' => $data['day5_loose'],
    'day5_semi'  => $data['day5_semi'],
    'day5_liquid' => $data['day5_liquid'],
    'day6_loose' => $data['day6_loose'],
    'day6_semi'  => $data['day6_semi'],
    'day6_liquid' => $data['day6_liquid'],
    'total_loose' => $data['total_loose'],
    'total_semi'  => $data['total_semi'],
    'total_liquid' => $data['total_liquid'],
    'diarrhea_endDt' => $data['diarrhea_endDt'],
    'isDehydration' => $data['isDehydration'],
    'isBlood_stool' => $data['isBlood_stool'],
    'isParentDaily' => $data['isParentDaily'],
    'reasonParentDaily' => $data['reasonParentDaily'],
    'isSDDCCollected'  => $data['isSDDCCollected'],
    'reasonParentInformed' => $data['reasonParentInformed'],
    'isFeverEpisode'  => $data['isFeverEpisode'],
    'lastFever'  => $data['lastFever'],
    'isVomitEpisode' => $data['isVomitEpisode'],
    'lastVomit' => $data['lastVomit'],
    'isAE'  => $data['isAE'],
    'isMedication' => $data['isMedication'],
    'kit_no' => $data['kit_no'],
    'isKitUsed' => $data['isKitUsed'],
    'usedKitNo' => $data['usedKitNo'],
    'reasonNoUsedKit' => $data['reasonNoUsedKit'],
    'isKitUnUsed' => $data['isKitUnUsed'],
    'unusedKitNo' => $data['unusedKitNo'],
    'reasonNounUsedKit' => $data['reasonNounUsedKit'],
    'created_by'     => $_SESSION['user_id'],
    'created_at'     => $db->now(),
    'created_on'     => $_SERVER['REMOTE_ADDR'] ,
);

$entered = $db->insert('ped_eos', $eosData);


if (isset($data['aeterm']) && is_array($data['aeterm'])) {
    for ($i = 0; $i < count($data['aeterm']); ++$i) {
        $aeData = array(
            'crfid' => $data['crfid'],
            'siteid' => $data['siteid'],
            'subid' => $data['subid'],
            'aeterm' => $data['aeterm'][$i],
            'aeStartDate' => $data['aeStartDate'][$i],
            'aeEndDate' => $data['aeEndDate'][$i],
            'isOngoing' => $data['isOngoing'][$i],
            'isSerious' => $data['isSerious'][$i],
            'severityGrade' => $data['severityGrade'][$i],
            'causalityCode' => $data['causalityCode'][$i],
            'isMedication' => $data['isMedication'][$i],
        );

        $db->insert('ped_ae_record', $aeData);
        // echo $db->getLastQuery();
        // echo $db->getLastError();
    }
}

if (isset($data['medication']) && is_array($data['medication'])) {
    for ($i = 0; $i < count($data['medication']); ++$i) {
        $aeData = [
            'crfid' => $data['crfid'],
            'siteid' => $data['siteid'],
            'subid' => $data['subid'],
            'medication' => $data['medication'][$i],
            'medication_reason' => $data['medication_reason'][$i],
            'dose' => $data['dose'][$i],
            'route' => $data['route'][$i],
            'medication_startDt' => $data['medication_startDt'][$i],
            'medication_stopDt' => $data['medication_stopDt'][$i],
            'medication_ongoing' => $data['medication_ongoing'][$i],
            
        ];

        $db->insert('ped_med_record', $aeData);
        // echo $db->getLastQuery();
        // echo $db->getLastError();
    }
}

$pedData = array(
    'crfid'         => $data['crfid'],
    'siteid'        => $data['siteid'],
    'subid'         => $data['subid'],
    'vital_length'  => $data['vital_length'],
    'vital_weight'  => $data['vital_weight'],
    'isStool_Status' => $data['isStool_Status'],
    'pulse'         => $data['pulse'],
    'respiratory'   => $data['respiratory'],
    'temperature'   => $data['temperature'],
    'head_ob'       => $data['head_ob'],
    'head_ab'       => isset($data['head_ab'])? $data['head_ab'] :null,
    'head_txt'      => $data['head_txt'],
    'respiratory_ob' => $data['respiratory_ob'],
    'respiratory_ab' => isset($data['respiratory_ab'])? $data['respiratory_ab'] : null,
    'respiratory_txt' => $data['respiratory_txt'],
    'cardio_ob'     => $data['cardio_ob'],
    'cardio_ab'     => isset($data['cardio_ab'])? $data['cardio_ab'] : null,
    'cardio_txt'    => $data['cardio_txt'],
    'cns_ob'        => $data['cns_ob'],
    'cns_ab'        => isset($data['cns_ab'])? $data['cns_ab'] : null,
    'cns_txt'       => $data['cns_txt'],
    'gastro_ob'     => $data['gastro_ob'],
    'gastro_ab'     => isset ($data['gastro_ab'])? $data['gastro_ab'] : null,
    'gastro_txt'    => $data['gastro_txt'],
    'reproductive_ob'  => $data['reproductive_ob'],
    'reproductive_ab'  => isset($data['reproductive_ab'])? $data['reproductive_ab'] : null,
    'reproductive_txt'  => $data['reproductive_txt'],
    'renal_ob'      => $data['renal_ob'],
    'renal_ab'      => isset($data['renal_ab'])? $data['renal_ab'] : null,
    'renal_txt'     => $data['renal_txt'],
    'muscul_ob'     => $data['muscul_ob'],
    'muscul_ab'     => isset($data['muscul_ab'])? $data['muscul_ab'] :null,
    'muscul_txt'    => $data['muscul_txt'],
);
$db->insert('ped_vital', $pedData);
header('location: ../home.php');