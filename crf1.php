<?php 
include_once 'header.php';
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="row" id="sec1">
        <div class="col-md-10 mx-auto">
        <h2>SECTION A: SAMPLE IDENTIFICATION</h2>
        <form>
            <div class="form-row">
                <div class="col">
                <label class="col-form-label">Local Lab Sample ID: </label>
                    <input class="form-control" type="text" id="lab_sampleID" name="lab_sampleID" >
                </div>
                <div class="col">
                <label class="col-form-label">Study Sample ID: </label>
                    <input class="form-control" type="text" id="study_sampleID" name="study_sampleID" >
                </div>
                <div class="col">
                    <label class="col-form-label">Patient Age (years):</label>
                    <input class="form-control" type="number" id="pat_age" name="pat_age">
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                <label class="col-form-label">Date Sample Collected from patient: </label> <br>
                            <input class="form-control" type="text" id="sampleDate" name="sampleDate" data-format="YYYY-MM-DD"
                                data-template="DD MMM YYYY">
                </div>
                <div class="col">
                    <label class="col-form-label">Patient Gender: <label><br>
                        <select class="form-control" id="gender" name="gender">
                        <option value=""></option>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                </div>
                <div class="col">
                    <label class="col-form-label">Diagnosis:</label>
                    <input class="form-control" type="text" id="diagnosis" name="diagnosis" />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="alert alert-info">
                    Please exclude if sample is from-surgical wounds, post instrumentation, diabetic foot infections,
        human or animal bite infections or from patients with history of
        hospital stay in last 3 weeks
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <label class="col-form-label">Date sample processed at local lab:</label><br>
                    <input class="form-control" type="text" id="sample_process_date" name="sample_process_date" 
                    data-template="DD MMM YYYY" data-format="YYYY-MM-DD" >
                </div>
                <div class="col">
                    <label class="col-form-label">Result of Gram Stain procedure at local lab:</label>
                    <input class="form-control" type="text" id="lab_gram_result" name="lab_gram_result" />
                    <small id="passwordHelpBlock" class="form-text text-muted">
                    Please exclude if gram negative
                    </small>
                </div>
                <div class="col">
                    <label class="col-form-label">Result of culture at local lab:</label>
                    <input class="form-control" type="text" id="lab_culture_result" name="lab_culture_result" />
                    <small id="passwordHelpBlock" class="form-text text-muted">
                    Please exclude if culture negative or contaminated
                    </small>
                </div>
            </div>
            <div class="form-row">
            <p>
    <strong>
        Name, signature, date of person completing from (if different from
        investigator)_________________________________
    </strong>
</p>
<p>
    <strong>
        Name, signature, date of Investigator:_______________________________
    </strong>
</p>
            </div>
        </form>
        </div>
    </div>
    <div class="row" id="sec2">
        <div class="col-md-10 mx-auto">
            <h2>SECTION B: SAMPLE PROCESSING FOR STUDY:</h2>
            <form>
                <div class="form-row">
                    <div class="col">
                        <label class="col-form-label">Date Sample Processing started for study</label>
                        <input class="form-control" type="text" id="study_process_start_date" name="study_process_start_date" 
                        data-template="DD MMM YYYY" data-format="YYYY-MM-DD">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <h3>1. MEDIA &amp; EQUIPMENT USED:</h3>
                        <table class="table table-bordered" >
    <thead class="thead-dark">
        <tr>
            <th>S. No.</th>
            <th>Name of Media</th>
            <th >Lot No.</th>
            <th >Date of expiry*</th>
            <th >Media Free from visible contamination (Yes/No) *</th>
        </tr>
    </thead>
        <tbody>
        <tr>
            <td >1.</td>
            <td >Blood Agar</td>
            <td >            </td>
            <td >            </td>
            <td >            </td>
        </tr>
        <tr>
            <td >2.</td>
            <td >Mac Conkey Agar</td>
            <td >            </td>
            <td >            </td>
            <td >            </td>
        </tr>
        <tr>
            <td >3</td>
            <td >Mueller Hinton Agar</td>
            <td >           </td>
            <td >            </td>
            <td >            </td>
        </tr>
    </tbody>
</table>
                    </div>
                </div>
                <div class="row">
                <div class="col">
                    <div class="alert alert-info">
                    <em>
                        *Do not use any media that will expire within one month of date of
                        sample processing or has visible contamination
                    </em>
                    </div>
                </div>
            </div>
            <table class="table table-bordered" >
    <thead class="thead-dark">
        <tr>
            <th >S. No.</th>
            <th>Name of Equipment</th>
            <th>ID No.</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td >1.</td>
            <td >VITEK 2C</td>
            <td >            </td>
        </tr>
        <tr>
            <td >2.</td>
            <td >Incubator</td>
            <td >            </td>
        </tr>
        <tr>
            <td >3.</td>
            <td >Autoclave</td>
            <td >            </td>
        </tr>
    </tbody>
</table>
<p>
    Recorded by: ____________________Sign:______________Date: ________________
</p>
<p>
    Reviewed by: ____________________Sign:______________Date: ________________
</p>

<h3>2. SAMPLE INOCULATION &amp; INCUBATION:</h3>
<div class="row">
    <div class="col">
        <div class="alert alert-warning">
        <em>Match the Local sample ID and Study Sample ID before inoculation</em>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col">
        <label class="col-form-lable">Date &amp; Time of Inoculation:</label>
        <input class="form-control" type="text" id="inoculation_date" name="inoculation_date" 
        data-template="DD MMM YYYY  - HH : mm" data-format="YYYY-MM-DD HH:mm">
    </div>
</div>
<div class="row">
<table class="table table-bordered" >
    <thead class="thead-dark">
        <tr>
            <th>S. No.</td>
            <th>Name of Media</th>
            <th >Incubation (at 37 &#176; C) Start Date and Time</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td >            </td>
            <td >            </td>
            <td >            </td>
        </tr>
        <tr>
            <td >            </td>
            <td >            </td>
            <td >            </td>
        </tr>
        <tr>
            <td >            </td>
            <td >            </td>
            <td >            </td>
        </tr>
    </tbody>
</table>
<p>
    Recorded/ Sample Inoculated-Incubated by:
    ____________________Sign:______________Date: ________________
</p>
<p>
    Reviewed by: ____________________Sign:______________Date: ________________
</p>
<p>

</div>
<div class="row">
    <h3>3. MONITORING AND READING CULTURE PLATES:</h3>
</div>
<div class="row">
<table class="table table-bordered" >
    <thead>
        <tr>
            <th>S. No.</th>
            <th >Name of Media</th>
            <th>Date and Time Out</th>
            <th>Growth Description/ Colony Morphology</th>
            <th>Quantity</th>
            <th>Additional tests initiated</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td >            </td>
            <td >            </td>
            <td >            </td>
            <td >            </td>
            <td >            </td>
            <td >            </td>
        </tr>
        <tr>
            <td >            </td>
            <td >            </td>
            <td >            </td>
            <td >            </td>
            <td >            </td>
            <td >            </td>
        </tr>
        <tr>
            <td >            </td>
            <td >            </td>
            <td >            </td>
            <td >            </td>
            <td >            </td>
            <td >            </td>
        </tr>
    </tbody>
</table>
<p>
    Recorded by: ____________________Sign:______________Date: ________________
</p>
<p>
    Reviewed by: ____________________Sign:______________Date: ________________
</p>

</div>
<div class="row">
    <h3>4. ADDITIONAL TESTS:</h3>
    <h4>4.1 GRAM STAINING:</h4>
    <table class="table table-bordered" >
    <thead class="thead-dark">
        <tr>
            <th >S. No.</th>
            <th>Name of Reagent</th>
            <th>Lot No. of Reagent</th>
            <th>Expiry Date of reagent</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td >1.</td>
            <td >Gentian Violet</td>
            <td >            </td>
            <td >            </td>
        </tr>
        <tr>
            <td >2.</td>
            <td >Gram&#8217;s Iodine</td>
            <td >            </td>
            <td >            </td>
        </tr>
        <tr>
            <td >3.</td>
            <td >Acetone-alcohol/Alcohol</td>
            <td >            </td>
            <td >            </td>
        </tr>
        <tr>
            <td >4.</td>
            <td >Saffranin</td>
            <td >            </td>
            <td >            </td>
        </tr>
    </tbody>
</table>
<div class="form-row">
    <div class="col">
        <label class="col-form-label">Date and Time of test:</label>
        <input class="form-control" type="text" id="gram_test_date" name="gram_test_date"
        data-template="DD MMM YYYY  - HH : mm" data-format="YYYY-MM-DD HH:mm">
    </div>
</div>


</div>
<div class="form-row">
    <div class="col-md-4">
        <label class="col-form-label">RESULT OF GRAM STAIN:</label>
        <select id="gram_stain_result" name="gram_stain_result" class="form-control">
            <option value=""></option>
            <option value="1">Positive</option>
            <option value="2">Negative</option>
            <option value="99">Not done</option>
        </select>
    </div>
</div>
<p>
    Recorded/ Sample tested by:
    ____________________Sign:_____&#173;&#173;&#173;&#173;______ Date:
    _________
</p>
<p>
    Reviewed by: ____________________Sign:______________Date: ________________
</p>
<div class="row">
    <h4>4.2 BIO-CHEMICAL TESTS (FOR PRELIMINARY IDENTIFICATION)</h4>
    <table class="table table-bordered" >
    <thead class="thead-dark">
        <tr>
            <th>S. No.</th>
            <th>Name of Reagent</th>
            <th>Lot No. of Reagent</th>
            <th >Expiry Date of reagent</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td >            </td>
            <td >            </td>
            <td >            </td>
            <td >            </td>
        </tr>
        <tr>
            <td >            </td>
            <td >            </td>
            <td >            </td>
            <td >            </td>
        </tr>
        <tr>
            <td >            </td>
            <td >            </td>
            <td >            </td>
            <td >            </td>
        </tr>
    </tbody>
</table>

</div>
<div class="row">
<p>
    TEST RESULTS:
</p>
<table class="table table-bordered" >
    <thead class="thead-dark">
        <tr>
            <th >S. No.</th>
            <th >Colony Number</th>
            <th>Name of Test</th>
            <th>Result</th>
            <th>Additional comments (if any)</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td >            </td>
            <td >            </td>
            <td >            </td>
            <td >            </td>
            <td >            </td>
        </tr>
        <tr>
            <td >            </td>
            <td >            </td>
            <td >            </td>
            <td >            </td>
            <td >            </td>
        </tr>
        <tr>
            <td >            </td>
            <td >            </td>
            <td >            </td>
            <td >            </td>
            <td >            </td>
        </tr>
    </tbody>
</table>
<p>
    Recorded/ Sample tested by:
    ____________________Sign:_____&#173;&#173;&#173;&#173;______ Date:
    _________
</p>
<p>
    Reviewed by: ____________________Sign:______________Date: ________________
</p>

</div>
<div class="row">
    <h3>5. VITEK 2C IDENTIFICATION AND ANTIBIOTIC SENSITIVITY TEST: (AST)</h3>
</div>
<div class="form-row">
    <div class="col">
        <label class="col-form-label">Date of test:</label>
        <input class="form-control" type="text" id="vitek_test_date" name="vitek_test_date"
        data-template="DD MMM YYYY  - HH : mm" data-format="YYYY-MM-DD HH:mm">
    </div>
</div>
<div class="row">
<p>
    VITEK 2 C REPORT
</p>
<table class="table table-bordered" >
    <thead class="thead-dark">
        <tr>
            <th>ORGANISM ID</td>
            <th>SURROGATE MARKER SUSCEPTIBILITY (CEFOXITIN IN CASE OF
                    S.AUREUS/PENICILLIN IN CASE OF STREPTOCOCCUS PYOGENES)</td>
            <th>CEPHALEXIN INTERPRETATION</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td >            </td>
            <td >            </td>
            <td >            </td>
        </tr>
        <tr>
            <td >            </td>
            <td >            </td>
            <td >            </td>
        </tr>
    </tbody>
</table>


</div>
<div class="row">
    <div class="col-md-4">
        <label class="col-form-label">SPECIES IDENTIFIED:</label>
        <input class="form-control" type="text" id="species" name="species" >
    </div>
</div>
<div class="row">
    <h3>6. CEPHALEXIN- KIRBY -BAUER DISC DIFFUSION ZONE SIZE RECORD</h3>
</div>
<div class="form-row">
    <div class="col">
        <label class="col-form-label">Date of test:</label>
        <input class="form-control" type="text" id="kirby_test_date" name="kirby_test_date"
        data-template="DD MMM YYYY" data-format="YYYY-MM-DD">
    </div>
</div>
<div class="row">
<table class="table table-bordered" >
    <thead class="thead-dark">
        <tr>
            <th>CEPHALEXIN ZONE OF INHIBITION IN S. AUREUS ATCC 25923</th>
            <th>CEPHALEXIN ZONE OF INHIBITION IN ISOLATE</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td >            </td>
            <td >            </td>
        </tr>
        <tr>
            <td >            </td>
            <td >            </td>
        </tr>
    </tbody>
</table>
<p>
    Recorded/ Sample Inoculated-Incubated by:
    ____________________Sign:______________Date: ________________
</p>
<p>
    Reviewed by: ____________________Sign:______________Date: ________________
</p>
<p>
    SIGNATURE OF INVESTIGATOR:
</p>
<p>
    By signing below I attest that all the information in these Lab Case Record
    Forms are accurate.
</p>
<p>
    Name of Investigator:_______________________
</p>
<p>
    Signature:________________________
</p>
<p>
    Date:____________________________
</p>

</div>
            </form>
        </div>
    </div>
    <div class="row" id="sec3">
        <div class="col-md-10 mx-auto"></div>
    </div>
    <div class="row" id="sec4">
        <div class="col-md-10 mx-auto"></div>
    </div>
    <div class="row" id="sec5">
        <div class="col-md-10 mx-auto"></div>
    </div>
    
</main>
<?php 
include_once 'footer.php';
?>
<script src="res/moment.min.js"></script>
    <script src="res/combodate.js"></script>
    <script>
        $(function () {
            $("#sampleDate").combodate({
                
            });
            $("#sample_process_date").combodate({
                smartDays: true,
                minYear: 2019,
                maxYear: 2019,
            });
            $("#study_process_start_date").combodate();
            $("#inoculation_date").combodate({
                smartDays: true,
                minYear: 2019,
                maxYear: 2019
            });
            $("#gram_test_date").combodate({
                smartDays: true,
                minYear: 2019,
                maxYear: 2019
            });
            $("#vitek_test_date").combodate({
                smartDays: true,
                minYear: 2019,
                maxYear: 2019
            });
            $("#kirby_test_date").combodate({
                smartDays: true,
                minYear: 2019,
                maxYear: 2019
            });
        });
    </script>