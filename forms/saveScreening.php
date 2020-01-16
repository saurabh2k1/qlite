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
// exit();
$rowData = array(
    'siteid' => $data['siteid'],
    'subid'  => $data['subid'],
    'dov'    => $data['dov'],
    'icf_date' => $data['icf_date'],
    'isICF_handover'  => $data['isICF_handover'],
    'noICFReason' =>  isset($data['noICFReason'])? $data['noICFReason']: null,
    'isChild_less12'  => $data['isChild_less12'],
    'child_icf_date' => isset($data['child_icf_date'])? $data['child_icf_date']: null ,
    'isAssent_handover'  => $data['isAssent_handover'],
    'noAssent_handover_reason' => isset($data['noAssent_handover_reason'])? $data['noAssent_handover_reason']: null ,
    'dob'  => $data['dob'],
    'age' => $data['age'],
    'isMedical_history'  => $data['isMedical_history'],
    'isOnMedication' => $data['isOnMedication'],
    'diarrhea_startDt' => $data['diarrhea_startDt'],
    'no_loosemotion'  => $data['no_loosemotion'],
    'isDehydration'  => $data['isDehydration'],
    'isBlood_stool'  => $data['isBlood_stool'],
    'isRotavirusAnalysis'  => $data['isRotavirusAnalysis'],
    'stool_sampleDt'  => $data['stool_sampleDt'],
    'stool_sampleTime'  => $data['stool_sampleTime'],
    'rota_result'  => $data['rota_result'],
);

$id = $db->insert('ped_screening', $rowData);
if ($id){
    if($data['isMedical_history'] == 'Y'){
        if (isset($data['medical_condition']) && is_array($data['medical_condition'])) {
            for ($i = 0; $i < count($data['medical_condition']); ++$i) {
                $medData = array(
                    'siteid' => $data['siteid'],
                    'subid' => $data['subid'],
                    'medical_condition' => $data['medical_condition'][$i],
                    'med_startDt' => $data['med_startDt'][$i],
                    
                );
                if(isset($data['med_ongoing'][$i])) {
                    $medData['med_ongoing'] = $data['med_ongoing'][$i];
                } else {
                    $medData['med_stopDt'] = $data['med_stopDt'][$i];
                }
                $db->insert('ped_medical', $medData);
                // echo $db->getLastQuery();
                // echo "</br>";
                // echo $db->getLastError();
            }
        }
    }
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
                
            );
    
            $db->insert('ped_med_record', $aeData);
            // echo $db->getLastQuery();
            // echo $db->getLastError();
        }
    }

    if (isset($data['vaccine_name']) && is_array($data['vaccine_name'])){
        for ($i = 0; $i < count($data['vaccine_name']); ++$i) {
            $vaccineData = array(
                'crfid'         => $data['crfid'],
                'siteid'        => $data['siteid'],
                'subid'         => $data['subid'],
                'name'          => $data['vaccine_name'][$i],
                'given'         => $data['vaccine_dt'][$i]
            );
            $db->insert('ped_vaccine', $vaccineData);
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
    
    $incData = array(
        'siteid'        => $data['siteid'],
        'subid'         => $data['subid'],
        'r1a'           => $data['r1a'],
        'r1b'           => $data['r1b'],
        'r2'            => $data['r2'],
        'r3'            => $data['r3'],
        'r4'            => $data['r4'],
        'r5'            => $data['r5'],
        'r6'            => $data['r6'],
        'r7'            => $data['r7'],
        'r8'            => $data['r8'],
        'r9'            => $data['r9'],
        'r10'            => $data['r10'],
        'r11'            => $data['r11'],
        'r12'            => $data['r12'],
        'r13'            => $data['r13'],
        'r14'            => $data['r14'],
        'r15'            => $data['r15'],
        'r16'            => $data['r16'],
        'r17'            => $data['r17'],
        'r18'            => $data['r18'],
        'otherReason'    => $data['otherReason'],
        'signoff'        => $data['signoff'],
        'treatment_allotted' => $data['treatment_allotted'],
        'created_by'     => $_SESSION['user_id'],
        'created_at'     => $db->now(),
        'created_on'     => $_SERVER['REMOTE_ADDR'] ,
    
    );
    $db->insert('ped_inclusion', $incData);
    
    // echo $db->getLastQuery();
    // echo "</br>";
    // echo $db->getLastError();
    if ($data['signoff'] == 'Yes') {
        $db->where('id', $data['subid']);
        $db->update('ped_subject', array('enrolled' => 1));
        $_SESSION['message'] = "Subject details are stored and enrolled.";
    } else {
        $_SESSION['message'] = "Subject details are stored, but not enrolled.";
    }
    
    header('location: ../home.php');
} else {
    // echo $db->getLastQuery();
    // echo "</br>";
    echo $db->getLastError();
}