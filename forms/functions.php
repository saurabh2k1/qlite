<?php

/**
 * To get name of user
 * @param int $userid
 * @return string Name of user
 * 
 */
function getUserName($userid){
    global $db;
    $db->where('id', $userid);
    $user = $db->getOne('users');
    return $user['name'];
}

/**
 * To get last visit details
 */
function ped_getLastVisitDetails($subid){
    global $db;
    $lastvisit = array();
    $db->where('subid', $subid);
    $lv = $db->getOne('ped_screening');
    if ($lv) {
        $lastvisit['visit'] = 'Screening';
        $lastvisit['dov'] = date('d-M-Y', strtotime($lv['dov']));
        $lastvisit['next'] = 'Telephone Day 1';
    }
    $db->where('subid', $subid);
    $lv = $db->getOne('ped_telephone');
    if ($lv) {
        if (1 == $lv['tel_day']) {
            $lastvisit['visit'] = 'Telephone Day 1';
            $lastvisit['next'] = 'Telephone Day 3';
        } else {
            $lastvisit['visit'] = 'Telephone Day 3';
            $lastvisit['next'] = 'End of Visit';
        }
        $lastvisit['dov'] = date('d-M-Y', strtotime($lv['dov']));
    }
    // $db->where('subid', $subid);
    // $lv = $db->getOne('ped_unschedule');
    // if ($lv) {
    //     $lastvisit['visit'] = 'Unschedule';
    //     $lastvisit['dov'] = date('d-M-Y', strtotime($lv['dov']));
    // }
    // $db->where('subid', $subid);
    // $lv = $db->getOne('ped_eos');
    // if ($lv) {
    //     $lastvisit['visit'] = 'End of Study';
    //     $lastvisit['dov'] = date('d-M-Y', strtotime($lv['dov']));
    // }

    return $lastvisit;
}

?>