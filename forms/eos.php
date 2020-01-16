<?php include_once 'header.php'; 
    $crfid = 7;
    // $day = $_GET['d'];
    if(!isset($_GET['s']) || empty($_GET['s'])) {
        
        $new = true;
        $db->where('siteid', $site['siteid'])->where('enrolled >= 3');
        $subjects = $db->get('ped_subject');
        
    } else {
        $subjectID = $_GET['s'];
        $db->where('id', $subjectID);
        $subject = $db->getOne('ped_subject');
        $subjectCode = $subject['code'];
        $new = false;
    }
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <?php if ($new) { ?>
    <div class="row form-row">
        <div class="col-md-3">
            <label class="">Select Subject</label> 
        </div>
        <div class="col-md-3">
            <select class="form-control" id="subjectID">
                <?php foreach ($subjects as $subject) {
        echo "<option value='".$subject['id']."'>".$site['code'].'-'.str_pad($subject['code'], 3, '0', STR_PAD_LEFT).' ('.$subject['initial'].')</option>';
    } ?>
            </select>
        </div>
        <div class="col-md-2">
            <button id="btnGo" class="btn btn-outline-primary">Go</button>
        </div>
    </div> <!-- /row -->
    <?php } ?>
    <?php if (!$new) { ?>
        <form action="saveEos.php" method="post" class="validate" novalidate>
        <input type="hidden" name="crfid" value="<?php echo $crfid; ?>">
        <input type="hidden" name="siteid" value="<?php echo $site['siteid']; ?>">
        <input type="hidden" name="subid" value="<?php echo $subject['id']; ?>">
        <input type="hidden" id="icf" value="2519-12-1">
        <div class="row">
        <div class="col col-md-4 col-xs-6">SUBJECT IDENTIFICATION CODE </div>
        <div class="col col-md-2 col-xs-6"><?php echo $site['code'].'-'. str_pad($subjectCode, 3, '5', STR_PAD_LEFT) ; ?></div>
        <div class="col col-md-3 col-xs-6">Subject Initials</div>
        <div class="col col-md-3 col-xs-6"><?php echo $subject['initial']; ?></div>
    </div> <!-- /row -->
    
    <div class="row">
    <table class="table table-bordered">
        <tbody>
            <tr>
                <td>Date of visit </td><td><input type="text" value="<?php echo date('Y-m-d'); ?>" id="dov" name="dov" data-template="DD MMM YYYY" data-format="YYYY-MM-DD" ></td>
            </tr>
            <tr id="divReason" style="display:none;">
                <td>Visit out of window, Please give reason and <br> file a protocol deviation with the IEC/IRB:  </td>
                <td><input type="text" id="dovReason" name="dovReason" placeholder="Reason"></td> 
            </tr>
            <tr class="thead-dark"><th colspan="2">DIARRHEA HISTORY </th></tr>
            <tr>
                <td>Start Date Time when <span class="text-danger"> FIRST EPISODE </span> of loose, semi liquid <br>or liquid stools recorded by parent in the SDDC (after enrolment)</td>
                <td><input type="text" class="form-control" id="diarrhea_startDt" name="diarrhea_startDt" data-template="DD/MMM/YYYY  HH : mm" data-format="YYYY-MM-DD HH:mm"></td>
            </tr>
            <tr>
                <td>Number of episodes of loose, semi-liquid or liquid stools <br> 
                <span class="text-danger">as reported by parent in SDDC</span></td>
                <td>
                    <div class="row">
                        <div class="col col-md-2">Day 0</div>
                        <div class="col ">Loose: <br> <input class="col-md-8 loose" type="number" id="day0_loose" name="day0_loose"> </div>
                        <div class="col ">Semi-Liquid: <br> <input class="col-md-8 semi" type="number" id="day0_semi" name="day0_semi"> </div>
                        <div class="col ">Liquid: <br> <input class="col-md-8 liquid" type="number" id="day0_liquid" name="day0_liquid"> </div>
                    </div>
                    <div class="row">
                        <div class="col col-md-2">Day 1</div>
                        <div class="col ">Loose: <br> <input class="col-md-8 loose" type="number" id="day1_loose" name="day1_loose"> </div>
                        <div class="col ">Semi-Liquid: <br> <input class="col-md-8 semi" type="number" id="day1_semi" name="day1_semi"> </div>
                        <div class="col ">Liquid: <br> <input class="col-md-8 liquid" type="number" id="day1_liquid" name="day1_liquid"> </div>
                    </div>
                    <div class="row">
                        <div class="col col-md-2">Day 2</div>
                        <div class="col ">Loose: <br> <input class="col-md-8 loose" type="number" id="day2_loose" name="day2_loose"> </div>
                        <div class="col ">Semi-Liquid: <br> <input class="col-md-8 semi" type="number" id="day2_semi" name="day2_semi"> </div>
                        <div class="col ">Liquid: <br> <input class="col-md-8 liquid" type="number" id="day2_liquid" name="day2_liquid"> </div>
                    </div>
                    <div class="row">
                        <div class="col col-md-2">Day 3</div>
                        <div class="col ">Loose: <br> <input class="col-md-8 loose" type="number" id="day3_loose" name="day3_loose"> </div>
                        <div class="col ">Semi-Liquid: <br> <input class="col-md-8 semi" type="number" id="day3_semi" name="day3_semi"> </div>
                        <div class="col ">Liquid: <br> <input class="col-md-8 liquid" type="number" id="day3_liquid" name="day3_liquid"> </div>
                    </div>
                    <div class="row">
                        <div class="col col-md-2">Day 4</div>
                        <div class="col ">Loose: <br> <input class="col-md-8 loose" type="number" id="day4_loose" name="day4_loose"> </div>
                        <div class="col ">Semi-Liquid: <br> <input class="col-md-8 semi" type="number" id="day4_semi" name="day4_semi"> </div>
                        <div class="col ">Liquid: <br> <input class="col-md-8 liquid" type="number" id="day4_liquid" name="day4_liquid"> </div>
                    </div>
                    <div class="row">
                        <div class="col col-md-2">Day 5</div>
                        <div class="col ">Loose: <br> <input class="col-md-8 loose" type="number" id="day5_loose" name="day5_loose"> </div>
                        <div class="col ">Semi-Liquid: <br> <input class="col-md-8 semi" type="number" id="day5_semi" name="day5_semi"> </div>
                        <div class="col ">Liquid: <br> <input class="col-md-8 liquid" type="number" id="day5_liquid" name="day5_liquid"> </div>
                    </div>
                    <div class="row">
                        <div class="col col-md-2">Day 6</div>
                        <div class="col ">Loose: <br> <input class="col-md-8 loose" type="number" id="day6_loose" name="day6_loose"> </div>
                        <div class="col ">Semi-Liquid: <br> <input class="col-md-8 semi" type="number" id="day6_semi" name="day6_semi"> </div>
                        <div class="col ">Liquid: <br> <input class="col-md-8 liquid" type="number" id="day6_liquid" name="day6_liquid"> </div>
                    </div>
                    <div class="row">
                        <div class="col col-md-2">Total</div>
                        <div class="col ">Loose: <br> <input class="col-md-8" readonly type="number" id="total_loose" name="total_loose"> </div>
                        <div class="col ">Semi-Liquid: <br> <input class="col-md-8" readonly type="number" id="total_semi" name="total_semi"> </div>
                        <div class="col ">Liquid: <br> <input class="col-md-8" readonly type="number" id="total_liquid" name="total_liquid"> </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Date Time when was <span class="text-danger"> LAST EPISODE </span> of loose, semi liquid <br>
                or liquid stools recorded by parent in the SDDC (after enrolment)</td>
                <td><input type="text" class="form-control" id="diarrhea_endDt" name="diarrhea_endDt" 
                data-template="DD/MMM/YYYY  HH : mm" data-format="YYYY-MM-DD HH:mm"></td>
            </tr>
            <tr><td>Level of dehydration</td><td>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="isDehydration" id="isDehydration3" value="No Dehydration">
                <label class="form-check-label" for="isDehydration3">No Dehydration</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="isDehydration" id="isDehydration2" value="Some Dehydration">
                <label class="form-check-label" for="isDehydration2">Some Dehydration</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="isDehydration" id="isDehydration1" value="Severe Dehydration">
                <label class="form-check-label" for="isDehydration1">Severe Dehydration</label>
            </div>
            </td></tr>
            <tr><td>Blood in stools</td><td><div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="isBlood_stool" id="isBlood_stool1" value="Y">
                <label class="form-check-label" for="isBlood_stool1">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="isBlood_stool" id="isBlood_stool2" value="N">
                <label class="form-check-label" for="isBlood_stool2">No </label>
            </div></td></tr>
        </tbody>
    </table>

    <table class="table" id="tabVitals">
                                <thead class="thead-dark">
                                    <tr><th>Parameter</th><th>Unit</th><th>Result</th></tr>
                                </thead>
                                <tbody>
            <tr style="display: none;">
                <td>Length/Height</td><td>cm</td><td>
                    <input type="hidden" max="200" id="vital_length" name="vital_length" value="0">
                </td>
            </tr>
            <tr>
                <td>Weight</td><td>Kg</td><td>
                    <input type="text" pattern="[0-9]{2}\.[0-9]" title="Weight eg. 00.0" id="vital_weight" name="vital_weight" required>
                </td>
            </tr>
            <tr>
                <td>Stool status</td><td>--</td><td>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="isStool_Status" id="isStool_Status1" value="Normal" required>
                    <label class="form-check-label" for="isStool_Status1">Normal</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="isStool_Status" id="isStool_Status2" value="Loose">
                    <label class="form-check-label" for="isStool_Status2">Loose</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="isStool_Status" id="isStool_Status3" value="Semi liquid">
                    <label class="form-check-label" for="isStool_Status3">Semi liquid</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="isStool_Status" id="isStool_Status4" value="Liquid">
                    <label class="form-check-label" for="isStool_Status4">Liquid</label>
                </div>
                </td>
            </tr>
            <tr>
                <td>Pulse Rate</td><td>Beats per minute</td><td>
                    <input type="text" pattern="[0-9]{3}" id="pulse" name="pulse" required>
                </td>
            </tr>
            <tr>
                <td>Respiratory Rate</td><td>Breaths per minute</td><td>
                    <input type="text" pattern="[0-9]{2}" id="respiratory" name="respiratory" required>
                </td>
            </tr>
            <tr>
                <td>Body Temperature</td><td>Centigrade</td><td>
                    <input type="text" pattern="[0-9]{2}\.[0-9]" id="temperature" name="temperature" required>
                </td>
            </tr>
            <tr class="thead-light">
                <th>Systemic Examination</th><th>Observation</th><th>If abnormal, Clinical Significance</th>
            </tr>
            <tr>
                <td>Head and Neck</td><td>
                <div class="form-check form-check-inline">
                    <input class="form-check-input exam" type="radio" name="head_ob" id="head_ob1" data-section="head"  value="Normal" required>
                    <label class="form-check-label" for="head_ob1">Normal</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input exam" type="radio" name="head_ob" id="head_ob2" data-section="head" value="Abnormal">
                    <label class="form-check-label" for="head_ob2">Abnormal</label>
                </div>
                </td>
                <td id="div_head">
                <div class="form-check form-check-inline" >
                    <input class="form-check-input exam" type="radio" name="head_ab" id="head_ab1" data-section="head" value="Clinically significant">
                    <label class="form-check-label" for="head_ab1">Clinically significant  </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input exam" type="radio" name="head_ab" id="head_ab2" data-section="head" value="Not clinically significant">
                    <label class="form-check-label" for="head_ab2">Not clinically significant</label>
                </div>
                <div id="divr_head" style="display: none;">
                    <input type="text" id="head_txt" name="head_txt" placeholder="Enter Diagnosis/Abnormality">
                </div>
                </td>
            </tr>

            <tr>
                <td>Respiratory</td><td>
                <div class="form-check form-check-inline">
                    <input class="form-check-input exam" type="radio" name="respiratory_ob" id="respiratory_ob1" data-section="respiratory" value="Normal" required>
                    <label class="form-check-label" for="respiratory_ob1">Normal</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input exam" type="radio" name="respiratory_ob" id="respiratory_ob2" data-section="respiratory" value="Abnormal">
                    <label class="form-check-label" for="respiratory_ob2">Abnormal</label>
                </div>
                </td>
                <td id="div_respiratory">
                <div class="form-check form-check-inline">
                    <input class="form-check-input exam" type="radio" name="respiratory_ab" id="respiratory_ab1" data-section="respiratory" value="Clinically significant">
                    <label class="form-check-label" for="respiratory_ab1">Clinically significant  </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input exam" type="radio" name="respiratory_ab" id="respiratory_ab2" data-section="respiratory" value="Not clinically significant">
                    <label class="form-check-label" for="respiratory_ab2">Not clinically significant</label>
                </div>
                <div id="divr_respiratory" style="display: none;">
                    <input type="text" id="respiratory_txt" name="respiratory_txt" placeholder="Enter Diagnosis/Abnormality">
                </div>
                </td>
            </tr>
            <tr>
                <td>Cardiovascular</td><td>
                <div class="form-check form-check-inline">
                    <input class="form-check-input exam" type="radio" name="cardio_ob" id="cardio_ob1" data-section="cardio" value="Normal" required>
                    <label class="form-check-label" for="cardio_ob1">Normal</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input exam" type="radio" name="cardio_ob" id="cardio_ob2" data-section="cardio" value="Abnormal">
                    <label class="form-check-label" for="cardio_ob2">Abnormal</label>
                </div>
                </td>
                <td id="div_cardio">
                <div class="form-check form-check-inline">
                    <input class="form-check-input exam" type="radio" name="cardio_ab" id="cardio_ab1" data-section="cardio" value="Clinically significant">
                    <label class="form-check-label" for="cardio_ab1">Clinically significant  </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input exam" type="radio" name="cardio_ab" id="cardio_ab2" data-section="cardio" value="Not clinically significant">
                    <label class="form-check-label" for="cardio_ab2">Not clinically significant</label>
                </div>
                <div id="divr_cardio" style="display: none;">
                    <input type="text" id="cardio_txt" name="cardio_txt" placeholder="Enter Diagnosis/Abnormality">
                </div>
                </td>
            </tr>
            <tr>
                <td>Central Nervous System</td><td>
                <div class="form-check form-check-inline">
                    <input class="form-check-input exam" type="radio" name="cns_ob" id="cns_ob1" data-section="cns" value="Normal" required>
                    <label class="form-check-label" for="cns_ob1">Normal</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input exam" type="radio" name="cns_ob" id="cns_ob2" data-section="cns" value="Abnormal">
                    <label class="form-check-label" for="cns_ob2">Abnormal</label>
                </div>
                </td>
                <td id="div_cns">
                <div class="form-check form-check-inline">
                    <input class="form-check-input exam" type="radio" name="cns_ab" id="cns_ab1" data-section="cns" value="Clinically significant">
                    <label class="form-check-label" for="cns_ab1">Clinically significant  </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input exam" type="radio" name="cns_ab" id="cns_ab2" data-section="cns" value="Not clinically significant">
                    <label class="form-check-label" for="cns_ab2">Not clinically significant</label>
                </div>
                <div id="divr_cns" style="display: none;">
                    <input type="text" id="cns_txt" name="cns_txt" placeholder="Enter Diagnosis/Abnormality">
                </div>
                </td>
            </tr>
            <tr>
                <td>Gastroenterology</td><td>
                <div class="form-check form-check-inline">
                    <input class="form-check-input exam" type="radio" name="gastro_ob" id="gastro_ob1" data-section="gastro" value="Normal" required>
                    <label class="form-check-label" for="gastro_ob1">Normal</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input exam" type="radio" name="gastro_ob" id="gastro_ob2" data-section="gastro" value="Abnormal">
                    <label class="form-check-label" for="gastro_ob2">Abnormal</label>
                </div>
                </td>
                <td id="div_gastro">
                <div class="form-check form-check-inline">
                    <input class="form-check-input exam" type="radio" name="gastro_ab" id="gastro_ab1" data-section="gastro" value="Clinically significant">
                    <label class="form-check-label" for="gastro_ab1">Clinically significant  </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input exam" type="radio" name="gastro_ab" id="gastro_ab2" data-section="gastro" value="Not clinically significant">
                    <label class="form-check-label" for="gastro_ab2">Not clinically significant</label>
                </div>
                <div id="divr_gastro" style="display: none;">
                    <input type="text" id="gastro_txt" name="gastro_txt" placeholder="Enter Diagnosis/Abnormality">
                </div>
                </td>
            </tr>
            <tr>
                <td>Reproductive</td><td>
                <div class="form-check form-check-inline">
                    <input class="form-check-input exam" type="radio" name="reproductive_ob" id="reproductive_ob1" data-section="reproductive" value="Normal" required>
                    <label class="form-check-label" for="reproductive_ob1">Normal</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input exam" type="radio" name="reproductive_ob" id="reproductive_ob2" data-section="reproductive" value="Abnormal">
                    <label class="form-check-label" for="reproductive_ob2">Abnormal</label>
                </div>
                </td>
                <td id="div_reproductive">
                <div class="form-check form-check-inline">
                    <input class="form-check-input exam" type="radio" name="reproductive_ab" id="reproductive_ab1" data-section="reproductive"  value="Clinically significant">
                    <label class="form-check-label" for="reproductive_ab1">Clinically significant  </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input exam" type="radio" name="reproductive_ab" id="reproductive_ab2" data-section="reproductive" value="Not clinically significant">
                    <label class="form-check-label" for="reproductive_ab2">Not clinically significant</label>
                </div>
                <div id="divr_reproductive" style="display: none;">
                    <input type="text" id="reproductive_txt" name="reproductive_txt" placeholder="Enter Diagnosis/Abnormality">
                </div>
                </td>
            </tr>
            <tr>
                <td>Renal</td><td>
                <div class="form-check form-check-inline">
                    <input class="form-check-input exam" type="radio" name="renal_ob" id="renal_ob1" data-section="renal"  value="Normal" required>
                    <label class="form-check-label" for="renal_ob1">Normal</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input exam" type="radio" name="renal_ob" id="renal_ob2" data-section="renal" value="Abnormal">
                    <label class="form-check-label" for="renal_ob2">Abnormal</label>
                </div>
                </td>
                <td id="div_renal">
                <div class="form-check form-check-inline">
                    <input class="form-check-input exam" type="radio" name="renal_ab" id="renal_ab1" data-section="renal" value="Clinically significant">
                    <label class="form-check-label" for="renal_ab1">Clinically significant  </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input exam" type="radio" name="renal_ab" id="renal_ab2" data-section="renal" value="Not clinically significant">
                    <label class="form-check-label" for="renal_ab2">Not clinically significant</label>
                </div>
                <div id="divr_renal" style="display: none;">
                    <input type="text" id="renal_txt" name="renal_txt" placeholder="Enter Diagnosis/Abnormality">
                </div>
                </td>
            </tr>
            <tr>
                <td>Musculoskeletal</td><td>
                <div class="form-check form-check-inline">
                    <input class="form-check-input exam" type="radio" name="muscul_ob" id="muscul_ob1" data-section="muscul" value="Normal" required>
                    <label class="form-check-label" for="muscul_ob1">Normal</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input exam" type="radio" name="muscul_ob" id="muscul_ob2" data-section="muscul" value="Abnormal">
                    <label class="form-check-label" for="muscul_ob2">Abnormal</label>
                </div>
                </td>
                <td id="div_muscul">
                <div class="form-check form-check-inline">
                    <input class="form-check-input exam" type="radio" name="muscul_ab" id="muscul_ab1" data-section="muscul" value="Clinically significant">
                    <label class="form-check-label" for="muscul_ab1">Clinically significant  </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input exam" type="radio" name="muscul_ab" id="muscul_ab2" data-section="muscul" value="Not clinically significant">
                    <label class="form-check-label" for="muscul_ab2">Not clinically significant</label>
                </div>
                <div id="divr_muscul" style="display: none;">
                    <input type="text" id="muscul_txt" name="muscul_txt" placeholder="Enter Diagnosis/Abnormality">
                </div>
                </td>
            </tr>
        </tbody>
                            </table>
    <table class="table table-bordered">
                <tr class="thead-dark"><th colspan="2">SUBJECT DAILY DIARY CARD  </th></tr>
                    <tr>
                        <td>Did the parent complete the SDDC on daily basis?</td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isParentDaily" id="isParentDaily1" value="Y">
                                <label class="form-check-label" for="isParentDaily1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isParentDaily" id="isParentDaily2" value="N">
                                <label class="form-check-label" for="isParentDaily2">No</label>
                            </div>
                            <br>
                            <div id="divParentDaily" style="display:none;">If No, then Why? <input type="text" placeholder="Give Reason" id="reasonParentDaily" name="reasonParentDaily"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Was the SDDC Collected at the visit?</td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isSDDCCollected" id="isSDDCCollected1" value="Y">
                                <label class="form-check-label" for="isSDDCCollected1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isSDDCCollected" id="isSDDCCollected2" value="N">
                                <label class="form-check-label" for="isSDDCCollected2">No</label>
                            </div>
                            <br>
                            <div id="divParentInformed" style="display:none;">If No, then Why? <input type="text" placeholder="Give Reason" id="reasonParentInformed" name="reasonParentInformed"></div>
                        </td>
                    </tr>
                <tr>
                    <td>Was there any episode of fever as per parent since last visit?</td>
                    <td>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="isFeverEpisode" id="isFeverEpisode1" value="Y">
                            <label class="form-check-label" for="isFeverEpisode1">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="isFeverEpisode" id="isFeverEpisode2" value="N">
                            <label class="form-check-label" for="isFeverEpisode2">No</label>
                        </div>
                    </td>
                </tr>
                <tr id="divFeverEpisode" style="display:none;">
                    <td>When was the last episode recorded?</td>
                    <td><input type="text" id="lastFever" name="lastFever" data-template="DD MMM YYYY" data-format="YYYY-MM-DD" ></td>
                </tr>
                <tr>
                    <td>Was there any episode of vomiting as per parent since last visit?</td>
                    <td>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="isVomitEpisode" id="isVomitEpisode1" value="Y">
                            <label class="form-check-label" for="isVomitEpisode1">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="isVomitEpisode" id="isVomitEpisode2" value="N">
                            <label class="form-check-label" for="isVomitEpisode2">No</label>
                        </div>
                    </td>
                </tr>
                <tr id="divVomitEpisode" style="display:none;">
                    <td>When was the last episode recorded?</td>
                    <td><input type="text" id="lastVomit" name="lastVomit" data-template="DD MMM YYYY" data-format="YYYY-MM-DD" ></td>
                </tr>
            </table>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th colspan="2">ADVERSE EVENT </th>
                    </tr>
                    <tr>
                        <td>Did the subject experience any adverse event since last visit?</td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isAE" id="isAE1" value="Y">
                                <label class="form-check-label" for="isAE1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isAE" id="isAE2" value="N">
                                <label class="form-check-label" for="isAE2">No</label>
                            </div>
                        </td>
                    </tr>
                </thead>
            </table>
            <table class="table table-bordered table-resonsive" style="display:none;" id="divAE">
                <thead class="thead-light">
                    <th>Select</th><th>Adverse Event Term</th><th>Start  Date of event <br> (DD/MMM/YYYY)</th>
                    <th>Stop date of event <br> (DD/MMM/YYYY)</th> <th>Is the event ongoing?</th>
                    <th>Is the event Serious?*</th><th>Severity Grade**</th><th>Causality Code***</th>
                    <th>Was any concomitant medication prescribed? ****</th>
                </thead>
                <tbody>
                   
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="9"><button type="button" class="btn btn-outline-primary" id="btnAddAE">Add Row</button>
                        <button type="button" id="btnDelAE" class="btn btn-outline-danger delete-row">Delete Row</button>
                        </td>
                    </tr>
                    <tr><td colspan="9"><div class="alert alert-info">
                    * If yes, please complete the SAE form provided in the Investigator Site File<br>
                    ** Please grade the severity as per study protocol <br>
                    **** If medications have been prescribed for management of adverse event, please complete the Medication section below
                    </div>
                    </td></tr>
                </tfoot>
            </table>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr><th >MEDICATION HISTORY (Confirm all medications which were used by the subject<spa class="text-danger"> Since last visit</span>)</th></tr>
                </thead>
                <tbody>
                    <tr><td >Is subject taking any medications from the screening visit till date. Please use this sheet to record such medications.</td></tr>
                    <tr><td>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="isMedication" id="isMedication1" value="Y">
                            <label class="form-check-label" for="isMedication1">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="isMedication" id="isMedication2" value="N">
                            <label class="form-check-label" for="isMedication2">No</label>
                        </div>
                    </td></tr>
                </tbody>
            </table>
            <table class="table table-bordered table-resonsive" style="display:none;" id="tabMedication">
                <thead class="thead-light">
                    <th>Select</th><th>Medication / Device <br><small>(Record Generic or trade name)</small></th>
                    <th>Reason for use <br><small>(Medical History diagnosis or other reason, e.g. Prophylaxis)</small></th>
                    <th>Dose, and units</th> <th>Route</th><th>Start Date <br> (DD/MMM/YYYY)</th><th>Stop Date<br> (DD//MMM/YYY)</th>
                    <th>Or tick if ongoing at Screening Visit?</th> 
                </thead>
                <tbody>
                   
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="8"><button type="button" class="btn btn-outline-primary" id="btnAddMed">Add Row</button>
                        <button type="button" id="btnDelMed" class="btn btn-outline-danger delete-row">Delete Row</button>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr><th colspan="2">STUDY PRODUCT ACCOUNTABILITY & COMPLIANCE</th></tr>
                </thead>
                <tbody>
                    <tr><td>How many kits should the subject have used since last visit?</td>
                    <td><input type="number" id="kit_no" name="kit_no" placeholder="Enter Number"> </td></tr>
                    <tr>
                        <td>Number of <span class="text-danger"> USED </span> study product kits collected</td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isKitUsed" id="isKitUsed1" value="Y">
                                <label class="form-check-label" for="isKitUsed1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isKitUsed" id="isKitUsed2" value="N">
                                <label class="form-check-label" for="isKitUsed2">No</label>
                            </div> <br>
                            <div id="kitUsedYes" style="display:none;">Total number collected <input type="number" id="usedKitNo" name="usedKitNo"></div>
                            <div id="kitUsedNo" style="display:none;">If No, Then Why <input type="text" id="reasonNoUsedKit" name="reasonNoUsedKit" placeholder="If No, Then Why"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Number of <span class="text-danger"> UN-USED </span> study product kits  available with parent/guardian</td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isKitUnUsed" id="isKitUnUsed1" value="Y">
                                <label class="form-check-label" for="isKitUnUsed1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isKitUnUsed" id="isKitUnUsed2" value="N">
                                <label class="form-check-label" for="isKitUnUsed2">No</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isKitUnUsed" id="isKitUnUsed3" value="NA">
                                <label class="form-check-label" for="isKitUnUsed3">NA</label>
                            </div> <br>
                            <div id="kitUnUsedYes" style="display:none;">Total number collected <input type="number" id="unusedKitNo" name="unusedKitNo"></div>
                            <div id="kitUnUsedNo" style="display:none;">If No, Then Why <input type="text" id="reasonNounUsedKit" name="reasonNounUsedKit" placeholder="If No, Then Why"></div>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="thead-dark">
                        <th colspan="2">Investigator Sign-Off:</th>
                    </tr>
                    <tr>
                        <th colspan="2">Details entered are correct as per the medical records.</th>
                    </tr>
                    <tr class="thead-light">
                        <th>Investigator Name: <?php echo $user['name']; ?> <br>
                            Date: <?php echo date('d/M/Y'); ?>  </th><th><button class="btn btn-outline-primary">Save</button></th>
                    </tr>
                </tfoot>
            </table>
    </div><!-- /row -->
    <!-- <hr> -->
        </form>
<?php } ?>
</main>
<?php include_once 'footer.php'; ?>

<script src="../res/moment.min.js" ></script>
<script src="../res/combodate.js" ></script>
<script>
$(function () {
    $("#dov").combodate();
    $("#diarrhea_startDt").combodate();
    $("#diarrhea_endDt").combodate();
    $("#lastFever").combodate();
    $("#lastVomit").combodate();
    $("#btnGo").on('click', function(e){
        e.preventDefault();
        var sid = $("#subjectID").val();
        window.location = 'eos.php?s='+sid;
    });

    $("#dov").on('change', function(e){
        var d = $(this).val();
        var dov = moment(d, 'YYYY-MM-DD');
        var i = $("#icf").val();
        var icf = moment(i, 'YYYY-MM-DD');
        var days = dov.diff(icf, 'days');
        if (days){
            if(days < 4 || days > 6){
                toastr.warning("Visit is Out of Window");
                $("#divReason").show();
            } else {
                $("#divReason").hide();
            }
        }
    });

    $(".loose").on("change", function(){
        var total = 0;
        $('.loose').each(function(){
            if (this.value){
                total += parseInt(this.value);
            }
            
        });
        $("#total_loose").val(total);
    });

    $(".semi").on("change", function(){
        var total = 0;
        $('.semi').each(function(){
            if (this.value){
                total += parseInt(this.value);
            }
            
        });
        $("#total_semi").val(total);
    });

    $(".liquid").on("change", function(){
        var total = 0;
        $('.liquid').each(function(){
            if (this.value){
                total += parseInt(this.value);
            }
            
        });
        $("#total_liquid").val(total);
    });

    $("input[type=radio][name=isParentDaily]").on('change', function(){
        if ($(this).val() == 'N') {
            $("#divParentDaily").show();
        } else {
            $("#divParentDaily").hide();
        }
    });

    $("input[type=radio][name=isSDDCCollected]").on('change', function(){
        if ($(this).val() == 'N') {
            $("#divParentInformed").show();
        } else {
            $("#divParentInformed").hide();
        }
    });
    $("input[type=radio][name=isFeverEpisode]").on('change', function(){
        if ($(this).val() == 'Y') {
            $("#divFeverEpisode").show();
        } else {
            $("#divFeverEpisode").hide();
        }
    });
    $("input[type=radio][name=isVomitEpisode]").on('change', function(){
        if ($(this).val() == 'Y') {
            $("#divVomitEpisode").show();
        } else {
            $("#divVomitEpisode").hide();
        }
    });

    $("input[type=radio][name=isAE]").on('change', function(){
        if ($(this).val() == 'Y') {
            $("#divAE").show();
        } else {
            $("#divAE").hide();
        }
    });

    $("#btnAddAE").on('click', function(e){
        e.preventDefault();
        var markup = ` <tr><td><input type="checkbox" name="record"></td><td><input type="text" id="aeterm1" name="aeterm[]" placeholder="Adverse Event Term" ></td>
                    <td><input type="text" class="AE_startDt" id="aeStartDate1" name="aeStartDate[]" data-template="DD MMM YYYY" data-format="YYYY-MM-DD" ></td>
                    <td><input type="text" class="AE_endDt" id="aeEndDate1" name="aeEndDate[]" data-template="DD MMM YYYY" data-format="YYYY-MM-DD" ></td>
                    <td><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="isOngoing[]" id="isOngoing1" value="Y">
                    <label class="form-check-label" for="isOngoing1">Yes</label></div></td>
                    <td><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="isSerious[]" id="isSerious1" value="Y">
                    <label class="form-check-label" for="isSerious1">Yes</label></div><div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="isSerious[]" id="isSerious2" value="N">
                    <label class="form-check-label" for="isSerious2">No</label></div></td><td><input type="text" id="severityGrade1" name="severityGrade[]" ></td>
                    <td><select name="causalityCode[]"><option value="1">Definitely related</option><option value="2">Probably related</option>
                    <option value="3">Possibly related</option><option value="4">Probably not related</option><option value="5">Definitely not related</option></select></td>
                    <td><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="isMedication[]" id="isMedication1" value="Y">
                    <label class="form-check-label" for="isMedication1">Yes</label></div><div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="isMedication[]" id="isMedication2" value="N">
                    <label class="form-check-label" for="isMedication2">No</label></div></td></tr>`;
        $("#divAE tbody").append(markup);
        $(".AE_startDt").combodate();
        $(".AE_endDt").combodate();
    });
    $("#btnDelAE").on('click', function (e){
     $("#divAE tbody").find('input[name="record"]').each(function(){
         if ($(this).is(":checked")) {
             $(this).parents("tr").remove();
         }
     });
 });
 $("input[type=radio][name=isMedication]").on('change', function(){
        if ($(this).val() == 'Y') {
            $("#tabMedication").show();
        } else {
            $("#tabMedication").hide();
        }
    });
    $("#btnAddMed").on('click', function(e){
     e.preventDefault();
     var markup = '<tr><td><input type="checkbox" name="record"></td>' +
                '<td><input type="text" id="medication1" name="medication[]" ></td>' +
                '<td><input type="text" id="medication_reason1" name="medication_reason[]" ></td>' +
                '<td><select id="dose1" name="dose[]"><option value="1"> g (gram)</option><option value="2"> mg (milligram)</option>' +
                '<option value="3"> µg (microgram)</option><option value="4"> L (Liter)</option><option value="5"> ml (milliliter)</option>' +
                '<option value="6"> IU (International Unit)</option><option value="7"> Other </option></select></td>' +
                '<td><select id="route1" name="route[]"><option value="1">1-Oral </option><option value="2">2-Topical </option>' +
                '<option value="3">3-Subcutaneous </option><option value="4">4-Intradermal </option><option value="5">5-Transdermal</option>' +
                '<option value="6">6-Intraocular </option><option value="7">7-Intramuscular </option><option value="8">8-Inhalation </option>' +
                '<option value="9">9-Intravenous </option><option value="10">10-Intraperitoneal </option><option value="11">11-Nasal</option>' +
                '<option value="12">12-Veginal </option><option value="13">13-Rectal</option><option value="14">14-Other </option></select></td>' +
                '<td><input type="text" id="medication_startDt1" class="medication_startDt" name="medication_startDt[]" data-template="DD/MMM/YYYY" data-format="YYYY-MM-DD"></td>' +
                '<td><input type="text" id="medication_stopDt1" class="medication_stopDt" name="medication_stopDt[]" data-template="DD/MMM/YYYY" data-format="YYYY-MM-DD"> </td>' +
                '<td><div class="form-check"><input class="form-check-input" type="checkbox" value="1" id="medication_ongoing1" name="medication_ongoing[]">' +
                '<label class="form-check-label" for="medication_ongoing1">Ongoing</label></div></td></tr>';
    $("#tabMedication tbody").append(markup);
    $(".medication_startDt").combodate();
    $(".medication_stopDt").combodate();

 });
 $("#btnDelMed").on('click', function (e){
     $("#tabMedication tbody").find('input[name="record"]').each(function(){
         if ($(this).is(":checked")) {
             $(this).parents("tr").remove();
         }
     });
 });

 $("input[type=radio][name=isKitUsed]").on('change', function(){
        if ($(this).val() == 'Y') {
            $("#kitUsedYes").show();
            $("#kitUsedNo").hide();
        } else {
            $("#kitUsedNo").show();
            $("#kitUsedYes").hide();
        }
    });

    $("input[type=radio][name=isKitUnUsed]").on('change', function(){
        if ($(this).val() == 'Y') {
            $("#kitUnUsedYes").show();
            $("#kitUnUsedNo").hide();
        } else if ($(this).val() == 'N')  {
            $("#kitUnUsedNo").show();
            $("#kitUnUsedYes").hide();
        } else {
            $("#kitUnUsedNo").hide();
            $("#kitUnUsedYes").hide();
        }
    });

    $(".exam").on('change', function(){
        var sec = $(this).data('section');
        // alert($(this).val());
        if ($(this).val() == 'Abnormal') {
            $("#div_" + sec).show();
            $("input[type=radio][name="+sec+"_ab]").attr('required', true);
        } else if($(this).val() == 'Normal') {
            $("#div_" + sec).hide();
            $("input[type=radio][name="+sec+"_ab]").attr('required', false);
        } else if($(this).val() == 'Clinically significant'){
            $("#divr_"+sec).show();
            $("#divr_"+sec).attr('required', true);
        } else {
            $("#divr_"+sec).hide();
            $("#divr_"+sec).attr('required', false);
        }
    });
});
</script>
