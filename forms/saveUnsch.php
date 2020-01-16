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
// echo "<br><br>";
$data = $_POST;
$unschdNumber = 1;
$unschData = array (
    'crfid'         => $data['crfid'],
    'siteid'        => $data['siteid'],
    'subid'         => $data['subid'],
    'dov'           => $data['dov'],
    'looseCount' => $data['looseCount'],
    'semiCount'  => $data['semiCount'],
    'liquidCount'=> $data['liquidCount'],
    'totalCount' => $data['totalCount'],
    'lastLoose'  => $data['lastLoose'],
    'dehydrationLevel'  => $data['dehydrationLevel'],
    'isBloodStool'      => $data['isBloodStool'],
    'isParentDaily'     => $data['isParentDaily'],
    'reasonParentDaily' => isset($data['reasonParentDaily'])? $data['reasonParentDaily'] : null,
    'isParentInformed'  => $data['isParentInformed'],
    'reasonParentInformed' => isset($data['reasonParentInformed'])? $data['reasonParentInformed']: null,
    'isFeverEpisode'    => $data['isFeverEpisode'],
    'lastFever'         => empty($data['lastFever'])? null : $data['lastFever'],
    'isVomitEpisode'    => $data['isVomitEpisode'],
    'lastVomit'         => empty($data['lastVomit'])? null : $data['lastVomit'],
    'isAE'          => $data['isAE'],
    'isMedication'  => $data['isMedication'],
    'kit_no'        => $data['kit_no'],
    'isKitUsed'     => $data['isKitUsed'],
    'usedKitNo'     => isset($data['usedKitNo'])? $data['usedKitNo']: 0,
    'reasonNoUsedKit'=> isset($data['reasonNoUsedKit'])? $data['reasonNoUsedKit']: null,
    'isKitUnUsed'   => $data['isKitUnUsed'],
    'unusedKitNo'   => isset($data['unusedKitNo'])? $data['unusedKitNo']: 0,
    'reasonNoUsedKit'=> isset($data['reasonNoUsedKit'])? $data['reasonNoUsedKit']: null,
    'created_by'     => $_SESSION['user_id'],
    'created_at'     => $db->now(),
    'created_on'     => $_SERVER['REMOTE_ADDR'] ,
);
$recordID = $db->insert('ped_unschedule', $unschData);
// echo "<br><br>";
// echo $db->getLastQuery();
// echo $db->getLastError();
if ($recordID) {
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
            'unscheduledVisit' => $unschdNumber,
        );

        $db->insert('ped_ae_record', $aeData);
    }
    $pedData = array(
        'crfid' => $data['crfid'],
        'siteid' => $data['siteid'],
        'subid' => $data['subid'],
        'vital_length' => $data['vital_length'],
        'vital_weight' => $data['vital_weight'],
        'isStool_Status' => $data['isStool_Status'],
        'pulse' => $data['pulse'],
        'respiratory' => $data['respiratory'],
        'temperature' => $data['temperature'],
        'head_ob' => $data['head_ob'],
        'head_ab' => isset($data['head_ab']) ? $data['head_ab'] : null,
        'head_txt' => $data['head_txt'],
        'respiratory_ob' => $data['respiratory_ob'],
        'respiratory_ab' => isset($data['respiratory_ab']) ? $data['respiratory_ab'] : null,
        'respiratory_txt' => $data['respiratory_txt'],
        'cardio_ob' => $data['cardio_ob'],
        'cardio_ab' => isset($data['cardio_ab']) ? $data['cardio_ab'] : null,
        'cardio_txt' => $data['cardio_txt'],
        'cns_ob' => $data['cns_ob'],
        'cns_ab' => isset($data['cns_ab']) ? $data['cns_ab'] : null,
        'cns_txt' => $data['cns_txt'],
        'gastro_ob' => $data['gastro_ob'],
        'gastro_ab' => isset($data['gastro_ab']) ? $data['gastro_ab'] : null,
        'gastro_txt' => $data['gastro_txt'],
        'reproductive_ob' => $data['reproductive_ob'],
        'reproductive_ab' => isset($data['reproductive_ab']) ? $data['reproductive_ab'] : null,
        'reproductive_txt' => $data['reproductive_txt'],
        'renal_ob' => $data['renal_ob'],
        'renal_ab' => isset($data['renal_ab']) ? $data['renal_ab'] : null,
        'renal_txt' => $data['renal_txt'],
        'muscul_ob' => $data['muscul_ob'],
        'muscul_ab' => isset($data['muscul_ab']) ? $data['muscul_ab'] : null,
        'muscul_txt' => $data['muscul_txt'],
    );

    $db->insert('ped_vital', $pedData);
    // echo '<br><br>';
    // echo $db->getLastQuery();
    if (isset($data['medication']) && is_array($data['medication'])) {
        for ($i = 0; $i < count($data['medication']); ++$i) {
            $aeData = array(
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
                'unscheduledVisit' => $unschdNumber,
            );

            $db->insert('ped_med_record', $aeData);
            // echo $db->getLastQuery();
            // echo $db->getLastError();
        }
    }
}

header('location: ../home.php');
