<?php 
include_once 'header.php';
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="row" id="sec1">
        <div class="col-md-10 mx-auto">
        <h2>SECTION A: MEDIA INFORMATION</h2>
        <form>
                    <div class="form-row">
                        <div class="col">
                            <label class="col-form-label">Date of QC: </label>
                            <input type="text" id="qcDate" name="qcdate" data-format="YYYY-MM-DD"
                                data-template="DD MMM YYYY">
                        </div>
                    </div>
                    <div class="form-row">
                        <table class="table table-bordered" >
                            <thead class="thead-dark">
                                <tr>
                                    <th>S. No.</th>
                                    <th>Culture Media</th>
                                    <th>Lot No.</th>
                                    <th>Date of expiry*</th>
                                    <th>QC Performance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td> </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
        </div>
    </div>
    <div class="row" id="sec2">
        <div class="col-md-10 mx-auto">
        <h2>SECTION B: ATCC STRAIN AND EQUIPMENT IDENTIFICATION:</h2>
                <form>
                    <table class="table table-bordered" >
                        <thead class="thead-dark">
                            <tr>
                                <th>S. No.</th>
                                <th>ATCC STRAIN</th>
                                <th>Lot No.</th>
                                <th>Date of expiry*</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="alert alert-info">
                            <strong>*</strong>Do not use any micro-organism that will expire within one month of
                            date of processing
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" >
                            <thead class="thead-dark">
                                <tr>
                                    <th>S. No.</th>
                                    <th>Name of Equipment</th>
                                    <th>ID No.</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
                <div class="row">
                    <div class="col-md-6">
                        Recorded by: ____________________Sign:______________Date: ________________
                    </div>
                    <div class="col-md-6"> Reviewed by: ____________________Sign:______________Date: ________________
                    </div>
                </div>
        </div>
    </div>
    <div class="row" id="sec3">
        <div class="col-md-10 mx-auto">
        <h2>Section C: QC PROCEDURE:</h2>
                <form>
                    <div class="form-row">
                        <div class="col">
                            <label>Date of Procedure: </label>
                            <input type="text" id="procDate" name="procedure_date" data-smartDays="true"
                                data-format="YYYY-MM-DD" data-template="DD MMM YYYY">
                        </div>
                    </div>
                    <div class="form-row">
                        <em>Check as steps completed</em>
                        <table class="table table-bordered" >
                            <thead class="thead-dark">
                                <tr>
                                    <th>Media Quality Control</th>
                                    <th>Step completed by &#8211; Name and sign</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><p>1. Visually inspect media for damage, contamination etc.</p>
                                        <p>Observation: <textarea></textarea></p>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><p>2.Inoculate two units of media for each micro-organism as
                                            per table at the end of this document</p>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><p>3.Label two un-inoculated units as negative controls</p>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><p> 4.Time at which media incubated: <input type="text" id="incubatedTime"
                                                name="incubatedTime" data-format="HH:mm" data-template="HH : mm">
                                        </p>
                                        <p>5.
                                            Temperature at which media incubated: <input type="text" name="temp"
                                                id="temp">
                                        </p>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
        </div>
    </div>
    <div class="row" id="sec4">
        <div class="col-md-10 mx-auto">
        <h2>SECTION D. RESULTS OF QC:</h2>
                <form>
                    <div class="form-row">
                        <table class="table table-bordered" >
                            <thead class="thead-dark">
                                <tr>
                                    <th>Media Quality Control</th>
                                    <th>Step completed by &#8211; Name and sign</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><p>1.For agar plates, after incubation examine for typical
                                            and atypical colony formations and record results.</p>
                                        <p>Observation:</p>
                                        <p>a. Date and Time out of
                                            incubator: <input type="text" id="IncubDate" data-format="YYYY-MM-DD HH:mm"
                                                data-template="DD MMM YYYY HH:mm">
                                        </p>
                                        <p>b. Results:</p>
                                        <table class="table" border="1" cellspacing="0" cellpadding="0">
                                            <thead>
                                                <tr>
                                                    <td>Micro-organism</td>
                                                    <td>Growth description</td>
                                                    <td>Quantity</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td> </td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td> </td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td> </td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td> </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-row">
                        
                            RESULT OF QC:
                        </p>
                        <table class="table table-bordered" >
                            <thead class="thead-dark">
                                <tr>
                                    <th>Organism</th>
                                    <th>Strain</th>
                                    <th>QC Result (Pass/ Fail)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Escherichia coli</td>
                                    <td>ATCC 25922</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Staphylococccus aureus</td>
                                    <td>ATCC 25923</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Enterococcus faecalis</td>
                                    <td>ATCC 29212</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-row">
                        <p>Recorded by: ____________________Sign:______________Date: ________________
                        </p>
                        <p>Result verified by: ____________________Sign:______________Date:
                            ________________
                        </p>
                        <p>SIGNATURE OF INVESTIGATOR:</p>
                        <p>By signing below I attest that all the information in these Lab Case Record
                            Forms are accurate.
                        </p>
                        <p>Name of Investigator:_______________________</p>
                        <p>Signature:________________________</p>
                        <p>Date:____________________________</p>
                    </div>
                </form>
        </div>
    </div>
    <div class="row" id="sec5">
        <div class="col-md-10 mx-auto">
        <p>Reference strains for quality control:
                </p>
                <table class="table table-bordered" >
                    <thead class="thead-dark">
                        <tr>
                            <th>Organism</th>
                            <th>Strain</th>
                            <th>Characteristics</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Escherichia coli</td>
                            <td>ATCC 25922</td>
                            <td>Susceptible, wild-type, beta-lactamase negative</td>
                        </tr>
                        <tr>
                            <td>Staphylococccus aureus</td>
                            <td>ATCC 25923</td>
                            <td>beta-lactamase negative, oxacillin susceptible</td>
                        </tr>
                        <tr>
                            <td>Enterococcus faecalis</td>
                            <td>ATCC 29212</td>
                            <td>for checking of thymidine or thymine level of MHA</td>
                        </tr>
                    </tbody>
                </table>
        </div>
    </div>
    
</main>
<?php 
include_once 'footer.php';
?>
<script src="res/moment.min.js"></script>
    <script src="res/combodate.js"></script>
    <script>
        $(function () {
            $("#qcDate").combodate({
                
            });
            $("#procDate").combodate({
                smartDays: true,
                minYear: 2019,
                maxYear: 2019,
            });
            $("#incubatedTime").combodate();
            $("#IncubDate").combodate({
                smartDays: true,
                minYear: 2019,
                maxYear: 2019
            })
        });
    </script>