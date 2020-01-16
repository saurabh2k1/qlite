<?php include_once 'header.php';

if(!isset($_GET['s']) || empty($_GET['s'])) {
    
    $new = true;
    $db->where('siteid', $site['siteid']);
    $lastSubjectID = $db->getValue('ped_subject', 'max(code)', 1);
    $subjectCode = $lastSubjectID + 1;
    // $que= $db->getLastQuery();
} else {
    $subjectID = $_GET['s'];
    $db->where('id', $subjectID);
    $subject = $db->getOne('ped_subject');
    $subjectCode = $subject['code'];
    $new = false;
}

$crfid = 1;
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="row">
        <div class="col-md-12">
            <?php if ($new) { ?>
           
            <form action="ped_subject.php" method="post" class="needs-validation" validate  >
            <input type="hidden" name="siteid" value="<?php echo $site['code']; ?>">
            <input type="hidden" name="code" value="<?php echo $subjectCode; ?>">
            <input type="hidden" name="dov" value="<?php echo $subject['dov']; ?>">
            <table class="table">
                <!-- <tr>
                    <th>CLINICAL STUDY SITE NUMBER </th><td><?php echo $site['code']; ?></td>
                    
                    <th>PRINCIPAL INVESTIGATOR</th><td><?php echo $site['person']; ?></td>
                </tr> -->
                <tr>
                    <th>SUBJECT IDENTIFICATION CODE</th><td><?php echo $site['code'].'-'.str_pad($subjectCode, 3, '0', STR_PAD_LEFT); ?></td>
                    
                    <th>SUBJECT INITIALS</th><td><div class="form-row">
                        <input type="text" class="form-control" id="initials" name="initials" minlength="3" title="Please fill initials. (e.g R_R/RRR)" maxlength="3" required pattern="[a-zA-Z][a-zA-Z_][a-zA-Z]" >
                    <div class="invalid-feedback"> Please fill initials. (e.g R_R/RRR)  </div></div>
                </td>
                </tr>
                <tr>
                    <th>Date of Visit</th>
                    <td colspan="2"><input type="text" id="dov" name="dov" value="<?php echo date('Y-m-d'); ?>" class="form-control"
                    data-template="DD MMM YYYY" data-format="YYYY-MM-DD" required > </td>
                    <td><button class="btn btn-outline-primary" type="submit" >Next</button></td>
                </tr>
            </table>
            </form>
            <?php  } else { ?>

            
            <form action="saveScreening.php" method="post" class="needs-validation" >
            <input type="hidden" name="siteid" value="<?php echo $site['code']; ?>">
            <input type="hidden" name="subid" value="<?php echo $subject['id']; ?>">
            <input type="hidden" name="crfid" value="<?php echo $crfid; ?>">
                <table class="table">
                    <tr>
                        <th>SUBJECT IDENTIFICATION CODE</th><td><?php echo $site['code'].'-'.str_pad($subjectCode, 3, '0', STR_PAD_LEFT); ?></td>
                        
                        <th>SUBJECT INITIALS</th><td><input type="text" class="form-control col-md-2"  id="initials" readonly name="initials" value="<?php echo $subject['initial']; ?>" maxlength="3" pattern="[a-zA-Z][a-zA-Z\-][a-zA-Z]" ></td>
                    </tr>
                </table>
            <hr>
            <div class="accordion" id="crf1">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            INFORMED CONSENT 
                            </button>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapsed  show" aria-labelledby="headingOne" data-parent="#crf1">
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>Date ICF signed by parent/guardian </th><td>
                                        <input type="text" id="icf_date" name="icf_date" value="<?php echo date('Y-m-d'); ?>"
                                    data-template="DD MMM YYYY" data-format="YYYY-MM-DD" required></td>
                                </tr>
                                <tr>
                                    <th>Was a copy of signed ICF handed over to subject’s parent/ guardian </th>
                                    <td><div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="isICF_handover" id="isICF_handover1" value="Y" required>
                                    <label class="form-check-label" for="isICF_handover1">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="isICF_handover" id="isICF_handover2" value="N" >
                                    <label class="form-check-label" for="isICF_handover2">No</label>
                                </div>
                                <div id="divICFReason" style="display:none;">
                                    <input type="text" class="form-control" name="noICFReason" placeholder="Give reason">
                                </div>
                                </td>
                                </tr>
                                <tr><th>Is the child 07-12 years of age</th><td><div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="isChild_less12" id="isChild_less121" value="Y" required>
                                    <label class="form-check-label" for="isChild_less121">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="isChild_less12" id="isChild_less122" value="N">
                                    <label class="form-check-label" for="isChild_less122">No</label>
                                </div></td></tr>
                                <tr id="trChild_less12" style="display:none;"><th>If child is 07-12 years age: Date Assent form signed by child </th>
                                <td><input type="text" id="child_icf_date" name="child_icf_date" value="<?php echo date('Y-m-d'); ?>"
                                data-template="DD MMM YYYY" data-format="YYYY-MM-DD"></td></tr>
                                <tr><th>Was a copy of signed Assent form handed over to subject’s parent/ guardian </th><td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="isAssent_handover" id="isAssent_handover1" value="Y" required>
                                    <label class="form-check-label" for="isAssent_handover1">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="isAssent_handover" id="isAssent_handover2" value="N">
                                    <label class="form-check-label" for="isAssent_handover2">No</label>
                                </div>
                                <div id="divAssent_handover" style="display:none;">
                                    <input type="text" class="form-control" name="noAssent_handover_reason" placeholder="Give reason">
                                </div>
                                </td></tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            DEMOGRAPHIC HISTORY 
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapsed" aria-labelledby="headingTwo" data-parent="#crf1">
                        <div class="card-body">
                        <div class="form-row">
                            <div class="col">Date of birth</div>
                            <div class="col">
                            <input type="text" id="dob" name="dob" value="<?php echo date('Y-m-d', strtotime('-1 years')); ?>" 
                                data-template="DD MMM YYYY" data-format="YYYY-MM-DD"> OR <br>
                            </div>
                        </div><br>
                        <div class="form-row">
                            <div class="col">Age in completed years as on ICF Date </div>
                            <div class="col">
                                <input type="number" class="form-control col-md-2" placeholder="Age" max="20" maxlength="2" id="age" name="age" required>
                            </div>
                        </div>    
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                MEDICAL HISTORY  (Other than Acute Diarrhea)
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapsed" aria-labelledby="headingThree" data-parent="#crf1">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">Does the subject have any relevant medical history?</div>
                                <div class="col">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="isMedical_history" id="isMedical_history1" value="Y" required>
                                    <label class="form-check-label" for="isMedical_history1">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="isMedical_history" id="isMedical_history2" value="N">
                                    <label class="form-check-label" for="isMedical_history2">No</label>
                                </div>
                                </div>
                            </div>
                            <div class="row" id="medicalHistory">
                                <table class="table" id="tabMedHistory" style="display:none;">
                                    <thead class="thead-dark">
                                        <tr><th>Select</th><th>Condition/Illness/Surgical Procedure</th><th>Start date </th><th>Stop date</th><th> OR Ongoing</th></tr>
                                    </thead> 
                                    <tbody>
                                       
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="6"><button type="button" class="btn btn-outline-primary" id="btnAddMedHistory">Add Row</button>
                                            <button type="button" id="btnDelMedMistory" class="btn btn-outline-danger delete-row">Delete Row</button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFour">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            MEDICATION HISTORY 
                            <!-- <br>(Confirm all medications which were used by the subject in the last one month from date of screening) -->
                            </button>
                        </h5>
                    </div>
                    <div id="collapseFour" class="collapsed" aria-labelledby="headingFour" data-parent="#crf1">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">Is subject taking any medications at screening or for 1 month from the screening visit date?</div>
                                <div class="col">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="isOnMedication" id="isOnMedication1" value="Y" required>
                                    <label class="form-check-label" for="isOnMedication1">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="isOnMedication" id="isOnMedication2" value="N">
                                    <label class="form-check-label" for="isOnMedication2">No</label>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <table class="table" id="tabMedication" style="display:none;">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Select</th>
                                            <th>Medication / Device (Record Generic or trade name)</th>
                                            <th>Reason for use (Medical History diagnosis or other reason, e.g. Prophylaxis)</th>
                                            <th>Dose, and units</th>
                                            <th>Route</th><th>Start Date</th><th>Stop Date</th><th>Ongoing</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                        
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                            <td colspan="8"><button type="button" class="btn btn-outline-primary" id="btnAddMedication">Add Row</button>
                                            <button type="button" id="btnDelMedication" class="btn btn-outline-danger delete-row">Delete Row</button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFive">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            DIARRHEA HISTORY  
                            </button>
                        </h5>
                    </div>
                    <div id="collapseFive" class="collapsed" aria-labelledby="headingFive" data-parent="#crf1">
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <td>Start date (first episode as reported by parent)</td>
                                    <td><input type="text" required class="form-control" id="diarrhea_startDt" name="diarrhea_startDt" data-template="DD/MMM/YYYY HH:mm" data-format="YYYY-MM-DD HH:mm"></td>
                                </tr>
                                <tr><td>Number of episodes of loose, semi-liquid or liquid stools in last 48 hours</td>
                                <td><input type="number" class="form-control col-md-2" required id="no_loosemotion" name="no_loosemotion" min="0" maxlength="3" max="999" min="0" ></td></tr>
                                <tr><td>Level of dehydration</td><td><div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="isDehydration" id="isDehydration1" value="Some Dehydration" required>
                                    <label class="form-check-label" for="isDehydration1">Some Dehydration</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="isDehydration" id="isDehydration2" value="No Dehydration">
                                    <label class="form-check-label" for="Dehydration2">No Dehydration</label>
                                </div></td></tr>
                                
                                <tr><td>Blood in stools</td><td><div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="isBlood_stool" id="isBlood_stool1" value="Y" required>
                                    <label class="form-check-label" for="isBlood_stool1">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="isBlood_stool" id="isBlood_stool2" value="N">
                                    <label class="form-check-label" for="isBlood_stool2">No </label>
                                </div></td></tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingSix">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            VACCINE(S)
                            </button>
                        </h5>
                    </div>
                    <div id="collapseSix" class="collapsed" aria-labelledby="headingSix" data-parent="#crf1">
                        <div class="card-body">
                            <table class="table" id="tabVaccine">
                                <thead class="thead-dark">
                                    <tr><th>Select</th><th>Name of Vaccine</th><th>Date Administered (DD/MMM/YYYY)</th></tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3"><button type="button" class="btn btn-outline-primary" id="btnAddVaccine">Add Row</button>
                                        <button type="button" id="btnDelVaccine" class="btn btn-outline-danger delete-row">Delete Row</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingSeven">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                            VITALS &amp; PHYSICAL EXAMINATION
                            </button>
                        </h5>
                    </div>
                    <div id="collapseSeven" class="collapsed" aria-labelledby="headingSeven" data-parent="#crf1">
                        <div class="card-body">
                            <table class="table" id="tabVitals">
                                <thead class="thead-dark">
                                    <tr><th>Parameter</th><th>Unit</th><th>Result</th></tr>
                                </thead>
                                <tbody>
            <tr>
                <td>Length/Height</td><td>cm</td><td>
                    <input type="number" max="200" id="vital_length" name="vital_length" required>
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
                <td>Pulse Rate</td><td>Beats per minute (e.g. 072)</td><td>
                    <input type="text" pattern="[0-9]{3}" id="pulse" name="pulse" required>
                    <div class="invalid-feedback">
                        Please provide pulse rate in 3 digit (e.g. 072)
                    </div>
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
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingEight">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                            STOOL SAMPLE COLLECTION 
                            </button>
                        </h5>
                    </div>
                    <div id="collapseEight" class="collapsed" aria-labelledby="headingEight" data-parent="#crf1">
                        <div class="card-body">
                            <table class="table" id="tabStool">
                                
                                <tbody>
                                    <tr><td>Was the stool sample collected for Rotavirus analysis? </td> 
                                        <td>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="isRotavirusAnalysis" id="isRotavirusAnalysis1" value="Y" required>
                                            <label class="form-check-label" for="isRotavirusAnalysis1">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="isRotavirusAnalysis" id="isRotavirusAnalysis2" value="N">
                                            <label class="form-check-label" for="isRotavirusAnalysis2">No</label>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Date of sample collection</td><td>
                                        <input type="text" class="form-control" id="stool_sampleDt" required name="stool_sampleDt" data-template="DD/MMM/YYYY" data-format="YYYY-MM-DD">
                                        </td> </tr>
                                    <tr>  <td> Time of collection (if available)</td><td>
                                    <input type="text" class="form-control" id="stool_sampleTime" required name="stool_sampleTime" data-template="HH : mm" data-format="HH:mm">
                                     <b>HH : MM</b>
                                    </td>
                                    </tr>
                                    <tr>
                                        <td>Result of Rotavirus Strip test</td><td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="rota_result" id="rota_result1" value="Positive" required>
                                                <label class="form-check-label" for="rota_result1">Positive</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="rota_result" id="rota_result2" value="Negative">
                                                <label class="form-check-label" for="rota_result2">Negative</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="rota_result" id="rota_result3" value="Not conclusive">
                                                <label class="form-check-label" for="rota_result3">Not conclusive</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="rota_result" id="rota_result4" value="Not applicable">
                                                <label class="form-check-label" for="rota_result4">Not applicable</label>
                                            </div>

                                        </td>
                                    </tr>

                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingNine">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                            SUBJECT ELIGIBILITY
                            </button>
                        </h5>
                    </div>
                    <div id="collapseNine" class="collapsed" aria-labelledby="headingNine" data-parent="#crf1">
                        <div class="card-body">
                            <table class="table" id="tabEligibility">
                                <thead class="thead-dark">
                                    <tr><th>S. No.</th><th colspan="2">INCLUSION CRITERIA </th></tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1 A</td><td>Is the patient between 02 to 12 years of age?</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input incl" type="radio" name="r1a" id="r1a1" value="Y" required>
                                                <label class="form-check-label" for="r1a">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input incl" type="radio" name="r1a" id="r1a2" value="N">
                                                <label class="form-check-label" for="r1a2">No</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1 B</td><td>Is the dehydration Mild or moderate (No or some dehydration)</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input incl" type="radio" name="r1b" id="r1b1" value="Y" required>
                                                <label class="form-check-label" for="r1b">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input incl" type="radio" name="r1b" id="r1b2" value="N">
                                                <label class="form-check-label" for="r1b2">No</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td><td>Is there a history of 3 or more loose or unformed stool in the last 24 hours ?</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input incl" type="radio" name="r2" id="r21" value="Y" required>
                                                <label class="form-check-label" for="r2">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input incl" type="radio" name="r2" id="r22" value="N">
                                                <label class="form-check-label" for="r22">No</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td><td>Has the parent /guardian signed the ICF?</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input incl" type="radio" name="r3" id="r31" value="Y" required>
                                                <label class="form-check-label" for="r2">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input incl" type="radio" name="r3" id="r32" value="N">
                                                <label class="form-check-label" for="r32">No</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td><td>Has the child (07-12 years) signed the assent form?</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input incl" type="radio" name="r4" id="r41" value="Y" required>
                                                <label class="form-check-label" for="r41">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input incl" type="radio" name="r4" id="r42" value="N">
                                                <label class="form-check-label" for="r42">No</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input incl" type="radio" name="r4" id="r43" value="NA">
                                                <label class="form-check-label" for="r43">NA</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td><td>Is the Parent and child able to attend all scheduled visits and to comply with the study procedures?</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input incl" type="radio" name="r5" id="r51" value="Y" required>
                                                <label class="form-check-label" for=" r2">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input incl" type="radio" name="r5" id="r52" value="N">
                                                <label class="form-check-label" for="r52">No</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td><td>Does the Subject’s parent/legal guardian have access to a telephone?</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input incl" type="radio" name="r6" id="r61" value="Y" required>
                                                <label class="form-check-label" for="r6">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input incl" type="radio" name="r6" id="r62" value="N">
                                                <label class="form-check-label" for="r62">No</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="thead-dark"><th>S. No.</th><th colspan="2">EXCLUSION CRITERIA</th></tr>
                                    <tr>
                                        <td>1</td><td>Is there a history of diarrhea lasting >48 hrs at time of screening? </td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input excl" type="radio" name="r7" id="r71" value="Y" required>
                                                <label class="form-check-label" for="r7">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input excl" type="radio" name="r7" id="r72" value="N">
                                                <label class="form-check-label" for="r72">No</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td><td>Is there a history of blood in stools? </td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input excl" type="radio" name="r8" id="r81" value="Y" required>
                                                <label class="form-check-label" for="r8">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input excl" type="radio" name="r8" id="r82" value="N">
                                                <label class="form-check-label" for="r82">No</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td><td>Is there severe dehydration or does the patient require IV fluids?</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input excl" type="radio" name="r9" id="r91" value="Y" required>
                                                <label class="form-check-label" for="r9">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input excl" type="radio" name="r9" id="r92" value="N">
                                                <label class="form-check-label" for="r92">No</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td><td>Is there history of chronic diarrhea?</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input excl" type="radio" name="r10" id="r101" value="Y" required>
                                                <label class="form-check-label" for="r10">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input excl" type="radio" name="r10" id="r102" value="N">
                                                <label class="form-check-label" for="r102">No</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td><td>Is there any history of hypersensitivity to probiotics?</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input excl" type="radio" name="r11" id="r111" value="Y" required>
                                                <label class="form-check-label" for="r11">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input excl" type="radio" name="r11" id="r112" value="N">
                                                <label class="form-check-label" for="r112">No</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td><td>Is the patient severely malnourished (Grade III and IV as per IAP Guidelines)?</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input excl" type="radio" name="r12" id="r121" value="Y" required>
                                                <label class="form-check-label" for="r12">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input excl" type="radio" name="r12" id="r122" value="N">
                                                <label class="form-check-label" for="r122">No</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>7</td><td>Are there clinical signs of a coexisting severe acute systemic illness (Pneumonia, 
                                            sepsis, UTI, other co-morbidities) ?</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input excl" type="radio" name="r13" id="r131" value="Y" required>
                                                <label class="form-check-label" for="r13">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input excl" type="radio" name="r13" id="r132" value="N">
                                                <label class="form-check-label" for="r132">No</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>8</td><td>Is there a history/ diagnosis of immune deficiency (AIDS, other congenital 
                                            immunodeficiency syndrome, drug therapy with steroids, anticancer drugs etc.)?</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input excl" type="radio" name="r14" id="r141" value="Y" required>
                                                <label class="form-check-label" for="r14">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input excl" type="radio" name="r14" id="r142" value="N">
                                                <label class="form-check-label" for="r142">No</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>9</td><td>Is there history of administration of antibiotics, 
                                            probiotics or antidiarrheal 7 days before study?</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input excl" type="radio" name="r15" id="r151" value="Y" required>
                                                <label class="form-check-label" for="r15">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input excl" type="radio" name="r15" id="r152" value="N">
                                                <label class="form-check-label" for="r152">No</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>10</td><td>Is there history of participation in another clinical study within 
                                            30 days before the beginning or anytime during the duration of the current clinical study?</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input excl" type="radio" name="r16" id="r161" value="Y" required>
                                                <label class="form-check-label" for="r16">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input excl" type="radio" name="r16" id="r162" value="N">
                                                <label class="form-check-label" for="r162">No</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>11</td><td>Are the Subject’s parent/legal guardian is 
                                            unlikely to adhere to study procedures, keep appointments, 
                                            or is planning to relocate during the study?</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input excl" type="radio" name="r17" id="r171" value="Y" required>
                                                <label class="form-check-label" for="r17">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input excl" type="radio" name="r17" id="r172" value="N">
                                                <label class="form-check-label" for="r172">No</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>12</td><td>Any other reason that in the opinion of the investigator may 
                                            interfere with the evaluation required by the study.<br><br>

                                            Parents or guardians identified as employees of the Investigator or 
                                            study center as well as family members (i.e. immediate, husband, wife and 
                                            their children, adopted or natural) of the employees or the Investigator
                                        </td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input excl" type="radio" name="r18" id="r181" value="Y" required>
                                                <label class="form-check-label" for="r181">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input excl" type="radio" name="r18" id="r182" value="N">
                                                <label class="form-check-label" for="r182">No</label>
                                            </div>
                                            <div id="divOtherReason" style="display: none;">
                                                <input type="text" class="form-control" id="otherReason" name="otherReason" placeholder="Provide Reason" >
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3">Participant’s eligibility Investigator Sign-Off:</th>
                                    </tr>
                                    <tr><td></td><td>
                                    Is the participant eligible to take part in the Clinical Trial? <br><br>
                                    All Inclusion criteria must be yes (or NA in case of criteria 4)<br>
                                    All exclusion criteria must be no

                                    </td>
                                    <td>
                                        <input type="text" id="signoff" name="signoff" readonly class="form-control" value="Yes">
                                    </td>
                                    </tr>
                                    <tr id="divTreatment"><td></td>
                                        <td>Treatment Allotted </td>
                                        <td><select name="treatment_allotted" id="treatment_allotted" class="form-control" required>
                                            <option value="">Select ...</option>
                                            <option value="Sporit GG">Sporit GG</option>
                                            <option value="Econorm">Econorm</option>
                                            <option value="Procillus G">Procillus G</option>
                                            <option value="None">None</option>
                                        </select>
                                    </tr>
                                    <tr class="thead-dark"><th></th>
                                        <th>Investigator Name: <?php echo $user['name']; ?> <br>
                                            Date: <?php echo date('d/M/Y'); ?>  </th><th><button type="submit" class="btn btn-outline-primary">Save</button></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
           
            
            </form>
            <?php } ?>
        </div>
    </div>
</main>
<?php include_once 'footer.php'; ?>

<script src="../res/moment.min.js"></script>
<script src="../res/combodate.js"></script>
<script>
$(function () {

    window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
    $("#icf_date").combodate({
        // firstItem: 'unknown',
        smartDays: true,
        minYear: 2020,
        maxYear: 2020
    });
    $("#dov").combodate({
       // firstItem: 'name',
        smartDays: true,
        minYear: 2020,
        maxYear: 2020
    });
    $("#child_icf_date").combodate({
        smartDays: true,
        minYear: 2020,
        maxYear: 2020,
    });
    $("#dob").combodate({
        firstItem: 'unknown',
        smartDays: true,
    });

    $("#diarrhea_startDt").combodate({
        firstItem: 'name',
        maxYear: 2020,
    });
    $("#med_startDt1").combodate();
    $("#med_stopDt1").combodate();
    $("#stool_sampleDt").combodate({
        firstItem: 'name',
    });
    $("#stool_sampleTime").combodate({
        firstItem: 'unknown',
    });
    $("#medication_startDt1").combodate();
    $("#medication_stopDt1").combodate();

    $("#dob").on('change', function(e){
        var d = $(this).val();
        var dobparts = d.split('-');
        if (dobparts[0] == '0001') {
            $("#age").val();
            $("#age").prop('readonly', false);
            toastr.info("Please enter age!");
        } else {
            var i = $("#icf_date").val();
            var icf = moment(i, 'YYYY-MM-DD');
            var dob = moment(d, 'YYYY-MM-DD');
            var age = icf.diff(dob, 'years', false);
            $("#age").val(age);
            $("#age").prop('readonly', true).change();
            console.log(d);
        }
    });

    $("#age").on('change', function(e){
        var age = $(this).val();
        if(age > 0) {
            if (age < 2 || age > 12) {
                // Do not meet inclusion criteria
                $('#r1a2').attr('checked', true);
                $('#r1a1').attr('checked', false);
                toastr.error('Subject does not meet inclusion criteria');
            } else {
                $('#r1a2').attr('checked', false);
                $('#r1a1').attr('checked', true);
            }
        }
    });

    $("#diarrhea_startDt").on('change', function(e){
        var i = $("#icf_date").val();
        var icf = moment(i, 'YYYY-MM-DD');
        var startDt = $(this).val();
        var hrs = icf.diff(startDt, 'hours', false);
        if (hrs) {
            if (hrs > 48 ) {
                $('#r71').attr('checked', true);
                $('#r72').attr('checked', false);
                toastr.error('Exclusion criteria not met- Duration of diarrhea should be less than 48hrs from ICF signatures');
            } else {
                $('#r72').attr('checked', true);
                $('#r71').attr('checked', false);
            }
        }
        
    });

    $("#no_loosemotion").on('change', function(e){
        var n = $(this).val();
        if (n < 3) {
            $('#r22').attr('checked', true);
            $('#r21').attr('checked', false);
            toastr.error('Inclusion criteria not met- should be more than 3 stools');
        } else {
            $('#r21').attr('checked', true);
            $('#r22').attr('checked', false);
        }
    });

    $('input[type=radio][name=isBlood_stool]').on('change', function(){
        if($(this).val() == 'Y') {
            $('#r81').attr('checked', true);
            $('#r82').attr('checked', false);
            toastr.error('Exclusion criteria not met');
        } else {
            $('#r82').attr('checked', true);
            $('#r81').attr('checked', false);
        }
    });


    $('input[type=radio][name=isICF_handover]').on('change', function(){
        if($(this).val() == 'N') {
            toastr.warning("Please give a copy to parent", "GCP Deviation");
            $("#divICFReason").show();
        } else {
            $("#divICFReason").hide();
        }
    });

    $('input[type=radio][name=isChild_less12]').on('change', function(){
        if($(this).val() == 'Y') {
            
            $("#trChild_less12").show();
        } else {
            $("#trChild_less12").hide();
        }
    });

    $('input[type=radio][name=isAssent_handover]').on('change', function(){
        if($(this).val() == 'N') {
            toastr.warning("Please give a copy to parent", "GCP Deviation");
            $("#divAssent_handover").show();
        } else {
            $("#divAssent_handover").hide();
        }
    });


    $('input[type=radio][name=isMedical_history]').on('change', function(){
        if($(this).val() == 'Y') {
            $('#tabMedHistory').show();
        } else {
            $('#tabMedHistory').hide();
            $('#tabMedHistory tbody').find('tr').remove();
        }
    });

    $('input[type=radio][name=isOnMedication]').on('change', function(){
        if($(this).val() == 'Y') {
            $('#tabMedication').show();
        } else {
            $('#tabMedication').hide();
            $('#tabMedication tbody').find('tr').remove();
        }
    });

    $("#btnAddMedHistory").on('click', function(e){
        e.preventDefault();
        var markup = '<tr><td><input type="checkbox" name="record"></td><td><input type="text" id="medical_condition2" name="medical_condition[]"></td>' +
                    '<td><input type="text" id="med_startDt2" class="med_startDt" name="med_startDt[]" data-template="DD/MMM/YYYY" data-format="YYYY-MM-DD"></td>' +
                    '<td><input type="text" id="med_stopDt2" class="med_stopDt" name="med_stopDt[]" data-template="DD/MMM/YYYY" data-format="YYYY-MM-DD">' +
                    '</td><td><div class="form-check"><input class="form-check-input" type="checkbox" value="1" id="med_ongoing[]">' +
                    '<label class="form-check-label" for="med_ongoing2">Ongoing</label></div></td></tr>';
        $("#tabMedHistory tbody").append(markup);
        $(".med_startDt").combodate();
        $(".med_stopDt").combodate();
    });

    $(".delete-row").on('click', function (e){
     $("#tabMedHistory tbody").find('input[name="record"]').each(function(){
         if ($(this).is(":checked")) {
             $(this).parents("tr").remove();
         }
     });
 });

 $("#btnAddMedication").on('click', function(e){
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

 $("#btnDelMedication").on('click', function (e){
     $("#tabMedication tbody").find('input[name="record"]').each(function(){
         if ($(this).is(":checked")) {
             $(this).parents("tr").remove();
         }
     });
 });

 $("#btnAddVaccine").on('click', function(e){
     e.preventDefault();
     var markup = '<tr><td><input type="checkbox" name="record"></td>' +
                '<td><input type="text" name="vaccine_name[]" ></td>' +
                '<td><input type="text" name="vaccine_dt[]" class="vaccine_dt" data-template="DD/MMM/YYYY" data-format="YYYY-MM-DD" ></td></tr>';
    $("#tabVaccine tbody").append(markup);
    $(".vaccine_dt").combodate();
 });

 $("#btnDelVaccine").on('click', function (e){
     $("#tabVaccine tbody").find('input[name="record"]').each(function(){
         if ($(this).is(":checked")) {
             $(this).parents("tr").remove();
         }
     });
 });

 $('input[type=radio][name=r18]').on('change', function(){
        if($(this).val() == 'Y') {
            
            $("#divOtherReason").show();
        } else {
            $("#divOtherReason").hide();
        }
    });

    $("input[type=radio][name^='r']").on('change', function(){
        var rejected = false;
        $("input.incl:checked").each(function(){
            if (this.value == 'N' && this.checked == true) {
                rejected = true;
            }
        });
        
        $("input.excl:checked").each(function(){
            if (this.value == 'Y' && this.checked == true) {
                rejected = true;
            }
        });
        if(rejected) {
            $("#signoff").val("NO");
            $("#divTreatment").hide();
        } else {
            $("#signoff").val("Yes");
            $("#divTreatment").show();
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