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

//print_r($_POST);
$data = $_POST;

$d = array(
    'siteid' => $data['siteid'],
    'sample_id' => $data['sample_id'],
    'sample_collection_date' => $data['sample_collection_date'],
    'age' => $data['age'],
    'gender' => $data['gender'],
    'diagnosis' => $data['diagnosis'],
    'sample_processing_date' => $data['sample_processing_date'],
    'gram_result' => $data['gram_result'],
    'result_not_done' => $data['result_not_done'],
    'created_by' => $_SESSION['user_id'],
    'created_at' => $db->now(),
    'created_on' => $_SERVER['REMOTE_ADDR']
);

$id = $db->insert('labcrf', $d);
if ($id) {
    for ($i=0; $i < count($data['colony_no']) ; $i++) { 
        $dtable1 = array(
            'labcrf_id' => $id,
            'colony_number' => $data['colony_no'][$i],
            'test_name' => $data['test_name'][$i],
            'result'    => $data['result'][$i], 
            'comment'   => $data['comments'][$i],
            'created_at'=> $db->now(),
            'updated_at'=> $db->now(),
        );
        $db->insert('labtab1', $dtable1);
    }
    for ($i=0; $i < count($data['organismID']) ; $i++) { 
        $dtable2 = array(
            'labcrf_id' => $id,
            'organism_id' => $data['organismID'][$i],
            'surrogate' => $data['surrogate_marker'][$i],
            'cephalexin'    => $data['cephalexin'][$i], 
            'species_identified'   => $data['species'],
            'created_at'=> $db->now(),
            'updated_at'=> $db->now(),
        );
        $db->insert('labtab2', $dtable2);
    }
    for ($i=0; $i < count($data['ATCC']) ; $i++) { 
        $dtable3 = array(
            'labcrf_id' => $id,
            'ATCC25923' => $data['ATCC'][$i],
            'isolate' => $data['isolate'][$i],
            
            'created_at'=> $db->now(),
            'updated_at'=> $db->now(),
        );
        $db->insert('labtab3', $dtable3);
    }

    echo 'Record created. Id=' . $id;
} else {
    echo 'Record insertion failed: ' . $db->getLastError();
}
