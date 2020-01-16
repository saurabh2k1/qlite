<?php include_once 'header.php';

if(isset($_GET['d']) && !empty($_GET['d'])) {
    $day = $_GET['d'];
    if ($day == 1){
        $crfid = 4;
        $db->where('enrolled', 1);
    } 
    if ($day == 3){
        $crfid = 5;
        $db->where('enrolled',  2);
    } 
    if(!isset($_GET['s']) || empty($_GET['s'])) {
        
        $new = true;
        $db->where('siteid', $site['siteid']);
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
        <form action="saveTelephone.php" method="post" class="validate" novalidate>
        <input type="hidden" name="crfid" value="<?php echo $crfid; ?>">
    <input type="hidden" name="siteid" value="<?php echo $site['siteid']; ?>">
    <input type="hidden" name="subid" value="<?php echo $subject['id']; ?>">
    <input type="hidden" name="tel_day" value="<?php echo $day; ?>">
    <div class="row">
        <div class="col col-md-4 col-xs-6">SUBJECT IDENTIFICATION CODE </div>
        <div class="col col-md-2 col-xs-6"><?php echo $site['code'].'-'. str_pad($subjectCode, 3, '0', STR_PAD_LEFT) ; ?></div>
        <div class="col col-md-3 col-xs-6">Subject Initials</div>
        <div class="col col-md-3 col-xs-6"><?php echo $subject['initial']; ?></div>
    </div> <!-- /row -->
    <div class="row">
        <div class="col col-md-12 text-white bg-dark text-center">Telephone Visit Record Day <?php echo $day; ?></div>
    </div><!-- /row -->
    <div class="row">
        <div class="col col-md-12">
            <input type="hidden" id="icf" value="2019-12-1">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>Date of visit </td><td><input type="text" value="<?php echo date('Y-m-d'); ?>" id="dov" name="dov" data-template="DD MMM YYYY" data-format="YYYY-MM-DD" ></td>
                    </tr>
                    <tr id="divReason" style="display:none;">
                        <td>Visit out of window, Please give reason</td><td><input type="text" id="dovReason" name="dovReason" placeholder="Reason"></td> 
                    </tr>
                    <tr class="thead-dark"><th colspan="2">STUDY PRODUCT USE: </th></tr>
                    <tr>
                        <td>Has the patient missed any dose since last visit / contact?</td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isMissedDose" id="isMissedDose1" value="Y">
                                <label class="form-check-label" for="isMissedDose1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isMissedDose" id="isMissedDose2" value="N">
                                <label class="form-check-label" for="isMissedDose2">No</label>
                            </div>
                            <br>
                            <div id="divMissedDose" style="display:none;">How many doses were missed? <input type="number" id="numMissedDose" name="numMissedDose"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Has the parent entered details of study product use in the SDDC?</td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isParentEntered" id="isParentEntered1" value="Y">
                                <label class="form-check-label" for="isParentEntered1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isParentEntered" id="isParentEntered2" value="N">
                                <label class="form-check-label" for="isParentEntered2">No</label>
                            </div>
                            <br>
                            <div id="divParentEntered" style="display:none;">If No, then Why? <input type="text" placeholder="Give Reason" id="reasonParentEntered" name="reasonParentEntered"></div>
                        </td>
                    </tr>
                    <tr class="thead-dark"><th colspan="2">SUBJECT DAILY DIARY CARD  </th></tr>
                    <tr>
                        <td>Is the parent completing the SDDC on daily basis?</td>
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
                        <td>Was the parent/ guardian informed to complete the details of 
                            study product use, adverse events, medication use and stool status?</td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isParentInformed" id="isParentInformed1" value="Y">
                                <label class="form-check-label" for="isParentInformed1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isParentInformed" id="isParentInformed2" value="N">
                                <label class="form-check-label" for="isParentInformed2">No</label>
                            </div>
                            <br>
                            <div id="divParentInformed" style="display:none;">If No, then Why? <input type="text" placeholder="Give Reason" id="reasonParentInformed" name="reasonParentInformed"></div>
                        </td>
                    </tr>
                    <tr class="thead-dark"><th colspan="2">MEDICATION HISTORY </th></tr>
                    <tr>
                        <td>Has the subject take any medications since last visit</td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isMedHistory" id="isMedHistory1" value="Y">
                                <label class="form-check-label" for="isMedHistory1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isMedHistory" id="isMedHistory2" value="N">
                                <label class="form-check-label" for="isMedHistory2">No</label>
                            </div>
                           
                        </td>
                    </tr>
                    <tr id="divMedHistory" style="display:none;">
                        <td>If yes, was the parent asked to enter details in study diary and 
                            bring the prescription to the site during next visit.</td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isMedInformed" id="isMedInformed1" value="Y">
                                <label class="form-check-label" for="isMedInformed1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isMedInformed" id="isMedInformed2" value="N">
                                <label class="form-check-label" for="isMedInformed2">No</label>
                            </div>
                            <br>
                            <div id="divMedInformed" style="display:none;">If No, then Why? <input type="text" placeholder="Give Reason" id="reasonMedInformed" name="reasonMedInformed"></div>
                        </td>
                    </tr>
                    <tr class="thead-dark"><th colspan="2">ADVERSE EVENT  </th></tr>
                    <tr>
                        <td>Did the subject experience any adverse event since last visit?</td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isAE" id="isAE1" value="Y" required>
                                <label class="form-check-label" for="isAE1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isAE" id="isAE2" value="N">
                                <label class="form-check-label" for="isAE2">No</label>
                            </div>
                           
                        </td>
                    </tr>
                    <tr class="divAE" style="display:none;">
                        <td>If yes, was the parent asked to enter details in study diary and 
                            bring the prescription to the site during next visit.</td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isAEInformed" id="isAEInformed1" value="Y">
                                <label class="form-check-label" for="isAEInformed1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isAEInformed" id="isAEInformed2" value="N">
                                <label class="form-check-label" for="isAEInformed2">No</label>
                            </div>
                            <br>
                            <div id="divAEInformed" style="display:none;">If No, then Why? <input type="text" placeholder="Give Reason" id="reasonAEInformed" name="reasonAEInformed"></div>
                        </td>
                    </tr>
                    <tr class="divAE" style="display:none;">
                        <td>Was there any episode of fever as per parent since last visit?</td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isFever" id="isFever1" value="Y">
                                <label class="form-check-label" for="isFever1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isFever" id="isFever2" value="N">
                                <label class="form-check-label" for="isFever2">No</label>
                            </div>
                            
                        </td>
                    </tr>
                    <tr class="divAE" style="display:none;">
                        <td>Was there any episode of vomiting as per parent since last visit?</td>
                        <td>
                            <div class="form-check form-check-inline"> 
                                <input class="form-check-input" type="radio" name="isVomit" id="isVomit1" value="Y">
                                <label class="form-check-label" for="isVomit1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isVomit" id="isVomit2" value="N">
                                <label class="form-check-label" for="isVomit2">No</label>
                            </div>
                            
                        </td>
                    </tr>
                    <tr class="thead-dark"><th colspan="2">DIARRHEA HISTORY </th></tr>
                    <tr>
                        <td>Did the subject have loose, semi-liquid or liquid stools since last visit/contact?</td>
                        <td>
                            <div class="form-check form-check-inline"> 
                                <input class="form-check-input" type="radio" name="isLoose" id="isLoose1" value="Y">
                                <label class="form-check-label" for="isLoose1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isLoose" id="isLoose2" value="N">
                                <label class="form-check-label" for="isLoose2">No</label>
                            </div>
                        </td>
                    </tr>
                    <tr id="divNumLoose" style="display:none;">
                        <td>If yes, <br><br> Number of episodes of loose, semi liquid or liquid stools since last visit/ contact</td>
                        <td><input type="number" id="numLoose" min="0" value=0 name="numLoose" placeholder="Enter Number">  </td>
                    </tr>
                    <tr>
                        <td>What is the general status of the subject alert?</td>
                        <td>
                            <div class="form-check form-check-inline"> 
                                <input class="form-check-input" type="radio" name="isAlert" id="isAlert1" value="Well and alert">
                                <label class="form-check-label" for="isAlert1">Well and alert </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isAlert" id="isAlert2" value="Irritable, restless">
                                <label class="form-check-label" for="isAlert2">Irritable, restless</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isAlert" id="isAlert3" value="Lethargic, drowsy">
                                <label class="form-check-label" for="isAlert3">Lethargic, drowsy</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>How well is the subject able to drink water or liquids?</td>
                        <td>
                            <div class="form-check form-check-inline"> 
                                <input class="form-check-input" type="radio" name="isDrink" id="isDrink1" value="Drinks normally">
                                <label class="form-check-label" for="isDrink1">Drinks normally</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isDrink" id="isDrink2" value="Drinks eagerly">
                                <label class="form-check-label" for="isDrink2">Drinks eagerly</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isDrink" id="isDrink3" value="Drinks poorly or unable to drink">
                                <label class="form-check-label" for="isDrink3">Drinks poorly or unable to drink</label>
                            </div>
                        </td>
                    </tr>
                    <tr >
                        <td>Has the parent entered details in study diary? </td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isEnteredDetails" id="isEnteredDetails1" value="Y">
                                <label class="form-check-label" for="isEnteredDetails1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isEnteredDetails" id="isEnteredDetails2" value="N">
                                <label class="form-check-label" for="isEnteredDetails2">No</label>
                            </div>
                            <br>
                            <div id="divEnteredDetails" style="display:none;">If No, then Why? <input type="text" placeholder="Give Reason" id="reasonEnteredDetails" name="reasonEnteredDetails"></div>
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
        </div>
    </div><!-- /row -->
        </form>
    <?php } ?>
</main>
<?php include_once 'footer.php'; ?>

<script src="../res/moment.min.js" ></script>
<script src="../res/combodate.js" ></script>
<script>
$(function () {

    $("#dov").combodate();
    $("#btnGo").on('click', function(e){
        e.preventDefault();
        var sid = $("#subjectID").val();
        window.location = 'telephone.php?s='+sid+'&<?php echo $_SERVER['QUERY_STRING']; ?>';
    });

    $("#dov").on('change', function(e){
        var d = $(this).val();
        var dov = moment(d, 'YYYY-MM-DD');
        var i = $("#icf").val();
        var icf = moment(i, 'YYYY-MM-DD');
        var days = dov.diff(icf, 'days');
        // alert ("ICF: " + icf);
        // alert ("Days: " + days);
        if (days) {        
        <?php if ($day == 1) { ?>
        if (days > 1) {
            $("#divReason").show();
            toastr.warning("Date of Visit is out of window. Please give reasons and file a protocol deviation with the IEC/IRB");
        } else {
            $("#divReason").hide();
        }
        <?php } else if($day == 3) { ?>
        if (days == 3) {
            $("#divReason").hide();
        } else {
            $("#divReason").show();
            toastr.warning("Date of Visit is out of window. Please give reasons and file a protocol deviation with the IEC/IRB");
        }
        <?php } ?>
    }
    });

    $("input[type=radio][name=isMissedDose]").on('change', function(){
        if ($(this).val() == 'Y') {
            $("#divMissedDose").show();
        } else {
            $("#divMissedDose").hide();
        }
    });

    $("input[type=radio][name=isParentEntered]").on('change', function(){
        if ($(this).val() == 'N') {
            $("#divParentEntered").show();
        } else {
            $("#divParentEntered").hide();
        }
    });

    $("input[type=radio][name=isParentDaily]").on('change', function(){
        if ($(this).val() == 'N') {
            $("#divParentDaily").show();
        } else {
            $("#divParentDaily").hide();
        }
    });

    $("input[type=radio][name=isParentInformed]").on('change', function(){
        if ($(this).val() == 'N') {
            $("#divParentInformed").show();
        } else {
            $("#divParentInformed").hide();
        }
    });

    $("input[type=radio][name=isMedHistory]").on('change', function(){
        if ($(this).val() == 'Y') {
            $("#divMedHistory").show();
        } else {
            $("#divMedHistory").hide();
        }
    });

    $("input[type=radio][name=isMedInformed]").on('change', function(){
        if ($(this).val() == 'N') {
            $("#divMedInformed").show();
        } else {
            $("#divMedInformed").hide();
        }
    });
    $("input[type=radio][name=isAE]").on('change', function(){
        if ($(this).val() == 'Y') {
            $(".divAE").show();
        } else {
            $(".divAE").hide();
        }
    });
    $("input[type=radio][name=isAEInformed]").on('change', function(){
        if ($(this).val() == 'N') {
            $("#divAEInformed").show();
        } else {
            $("#divAEInformed").hide();
        }
    });

    $("input[type=radio][name=isLoose]").on('change', function(){
        if ($(this).val() == 'Y') {
            $("#divNumLoose").show();
        } else {
            $("#divNumLoose").hide();
        }
    });
    $("input[type=radio][name=isEnteredDetails]").on('change', function(){
        if ($(this).val() == 'N') {
            $("#divEnteredDetails").show();
        } else {
            $("#divEnteredDetails").hide();
        }
    });

});
</script>
<?php
} else {

}