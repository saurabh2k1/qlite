<?php include_once 'header.php'; 

// Todo: Generate Sample ID
$sample_id = "001";


if (isset($_GET['act']) && !empty($_GET['act'])) {
    $act = $_GET['act'];
} else {
    $act = 0;
}

$db->where('siteid', $site['siteid']);
$records = $db->get('labcrf');

?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <?php if ($act === 0) { ?>
    <div class="row">
        <div class="col-md-3">
            <a href="labcrf1.php?act=1" class="btn btn-outline-primary">Add new record</a>
        </div>
        <div class="col-md-3 form-group">
            
            <select id="records" name="records" class="form-control form-control-sm d-inline-block">
                <option value="">Select Sample ID for view Record</option>
                <?php foreach ($records as $record) {
                    echo "<option value='".$record['id']."'>".$record['sample_id']."</option>";
                } ?>   
            </select>
        </div>
        <div class="col-md-3">
            <button id="btnGo" disabled class="btn btn-outline-warning">Go</button>
        </div>
    <?php } else {  ?>
 
    <div class="row">
        <div class="col-md-12">
            <form class="needs-validation" action="save-labcrf1.php" method="post" novalidate>
                <input type="hidden" name="siteid" value="<?php echo $site['siteid']; ?>">
                <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                <div class="form-row">
                    <div class="col-md-2 mb-3">
                        <label for="sample_id">Study Sample ID</label>
                        <input type="text" class="form-control-plaintext" id="sample_id" readonly
                            name="sample_id" placeholder="Study Sample ID" value="<?php echo $site['code'] . "-" . $sample_id; ?>"> 
                        <div class="text-help text-mute">Auto-generated </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="sample_collection_date">Sample Collection Date</label><br/>
                        <input type="text" class="form-control" id="sample_collection_date" name="sample_collection_date" 
                        data-template="DD MMM YYYY" data-format="YYYY-MM-DD" required>
                        <div class="invalid-feedback"> Please fill date. </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="age">Patient Age (Years)</label>
                        <input type="number" class="form-control" id="age" 
                            name="age" placeholder="Age in Years" required > 
                        <div class="invalid-feedback"> Please fill age in years. </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="gender">Patient Gender</label>
                        <select class="custom-select" id="gender" name="gender" required>
                            <option value="">--Choose Gender --</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select>
                        <div class="invalid-feedback">Please choose gender</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-7 mb-3">
                        <label for="diagnosis">Diagnosis</label>
                        <input type="text" id="diagnosis" name="diagnosis" class="form-control" required>
                        <div class="invalid-feedback">Please enter diagnosis</div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="sample_processing_date">Sample Processing Date</label><br/>
                        <input type="text" class="form-control" id="sample_processing_date" name="sample_processing_date" 
                        data-template="DD MMM YYYY" data-format="YYYY-MM-DD" required>
                        <div class="invalid-feedback"> Please fill date. </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-7 mb-3">
                        <label for="gram_result">Result of Gram Stain</label><br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="gram_result1" name="gram_result" class="custom-control-input" value="1" required>
                            <label class="custom-control-label" for="gram_result1">Positive</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="gram_result2" name="gram_result" class="custom-control-input" value="0">
                            <label class="custom-control-label" for="gram_result2">Negative</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="gram_result3" name="gram_result" class="custom-control-input" value="99">
                            <label class="custom-control-label" for="gram_result3">Not done</label>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3" id="div_not_done" style="display:none;">
                        <label for="result_not_done">If not done please explain</label>
                        <input type="text" class="form-control" id="result_not_done" name="result_not_done" > 
                        <div class="invalid-feedback">Please give reason</div>
                    </div>
                </div>
                <div class="form-row">
                    <h5>Test Results</h5>
                </div>
                <div class="form-row">
                    <table class="table table-bordered" id="tabTestResult">
                        <thead class="thead-dark">
                            <tr><th>Select</th><th>Colony Number</th><th>Name of Test</th><th>Result</th><th>Additional Comments (if any)</th></tr>
                        </thead>
                        <tbody>
                            <tr><td colspan="5"><button type="button" class="btn btn-outline-primary" id="btnAddTestResult">Add Row</button>
                            <button type="button" class="btn btn-outline-danger delete-row">Delete Row</button>
                                </td></tr>
                            <tr>
                                <td><input type='checkbox' name='record'></td><td><input type="text" id="colony_no" name="colony_no[]" class="form-control" required></td>
                                <td><input type="text" id="test_name" name="test_name[]" class="form-control" required></td>
                                <td><input type="text" id="result" name="result[]" class="form-control" required></td>
                                <td><input type="text" id="comments" name="comments[]" class="form-control"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="form-row">
                    <h5>VITEK 2C IDENTIFICATION AND ANTIBIOTIC SENSITIVITY TEST: (AST)</h5>
                </div>
                <div class="form-row">
                    <table class="table table-bordered" id="tabAST">
                        <thead class="thead-dark">
                            <tr><th>Select</th><th>Organism ID</th><th>Surrogate Marker Susceptibility</th><th>Cephalexin Interpretation</th></tr>
                        </thead>
                        <tbody>
                        <tr><td colspan="4"><button type="button" class="btn btn-outline-primary" id="btnAddAST">Add Row</button>
                            <button type="button" class="btn btn-outline-danger delete-row1">Delete Row</button>
                                </td></tr>
                            <tr>
                                <td><input type='checkbox' name='record1'></td>
                                <td><input type="text" id="organismID" name="organismID[]" class="form-control" required > </td>
                                <td><input type="text" id="surrogate_marker" name="surrogate_marker[]" class="form-control" required> </td>
                                <td><input type="text" id="cephalexin" name="cephalexin[]" class="form-control" required> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <label for="species">Species Identified</label>
                        <input type="text" class="form-control" id="species" name="species" required>
                        <div class="invalid-feedback">Please enter the data</div>
                    </div>
                </div>
                <div class="form-row">
                    <h5>CEPHALEXIN- KIRBY -BAUER DISC DIFFUSION ZONE SIZE RECORD</h5>
                </div>
                <div class="form-row">
                    <table class="table table-bordered" id="tabAST2">
                        <thead class="thead-dark">
                            <tr><th>Select</th><th>CEPHALEXIN ZONE OF INHIBITION IN S. AUREUS ATCC 25923</th><th>CEPHALEXIN ZONE OF INHIBITION IN ISOLATE</th></tr>
                        </thead>
                        <tbody>
                        <tr><td colspan="3"><button type="button" class="btn btn-outline-primary" id="btnAddAST2">Add Row</button>
                            <button type="button" class="btn btn-outline-danger delete-row2">Delete Row</button>
                                </td></tr>
                            <tr>
                                <td><input type='checkbox' name='record2'></td>
                                <td><input type="text" id="ATCC" name="ATCC[]" class="form-control" required></td>
                                <td><input type="text" id="isolate" name="isolate[]" class="form-control" required></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-primary" type="submit">Submit form</button>
            </form>
        </div>
    </div>
    <?php } ?>
</main>

<?php include_once 'footer.php'; ?>
<script src="../res/moment.min.js"></script>
<script src="../res/combodate.js"></script>
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  var testResultRow = 1;
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


  $("#sample_collection_date").combodate({
        firstItem: 'unknown',
        smartDays: true,
        minYear: 2019,
        maxYear: 2019,
        customClass: 'ssDate',
    });
 $("#sample_processing_date").combodate({
    firstItem: 'unknown',
    smartDays: true,
    minYear: 2019,
    maxYear: 2019,
    customClass: 'ssDate',
    errorClass: 'ssDateError',
 });

 $("input[name='gram_result']").on('click', function(e){
     var value = $("input[name='gram_result']:checked").val();
     if (value == 99) {
        $("#div_not_done").show();
        $("#result_not_done").prop('required', true);
     } else {
        $("#div_not_done").hide();
        $("#result_not_done").prop('required', false);
     }
 });

 $("#btnAddAST").on('click', function(){
    testResultRow++;
    var markup = "<tr><td><input type='checkbox' name='record1'></td>" +
                    "<td><input type='text'  name='organismID[]' class='form-control' required > </td> " +
                    "<td><input type='text'  name='surrogate_marker[]' class='form-control' required> </td> " +
                    "<td><input type='text'  name='cephalexin[]' class='form-control' required> </td> </tr>";
    $("#tabAST tbody").append(markup);
 });

 $(".delete-row").on('click', function (e){
     $("#tabTestResult tbody").find('input[name="record"]').each(function(){
         if ($(this).is(":checked")) {
             $(this).parents("tr").remove();
         }
     });
 });

 $("#btnAddTestResult").on('click', function(){
    
    var markup = "<tr><td><input type='checkbox' name='record'>  </td><td><input type='text' id='colony_no' name='colony_no[]' class='form-control' required></td>"  +
                    "<td><input type='text' id='test_name' name='test_name[]' class='form-control' required></td>" +
                    "<td><input type='text' id='result' name='result[]' class='form-control' required></td>"  +
                     "<td><input type='text' id='comments' name='comments[]' class='form-control'></td> </tr>";
    $("#tabTestResult tbody").append(markup);
 });

 $(".delete-row1").on('click', function (e){
     $("#tabAST tbody").find('input[name="record1"]').each(function(){
         if ($(this).is(":checked")) {
             $(this).parents("tr").remove();
         }
     });
 });

 $("#btnAddAST2").on('click', function(){
    
    var markup = "<tr><td><input type='checkbox' name='record2'></td>" +
                    "<td><input type='text' name='ATCC[]' class='form-control' required></td>" +
                    "<td><input type='text' name='isolate[]' class='form-control' required></td></tr>";
    $("#tabAST2 tbody").append(markup);
 });
 $(".delete-row2").on('click', function (e){
     $("#tabAST2 tbody").find('input[name="record2"]').each(function(){
         if ($(this).is(":checked")) {
             $(this).parents("tr").remove();
         }
     });
 });

 $("#records").on('change', function(e){
     e.preventDefault();
     var recordNo = this.options[this.selectedIndex].value;
     if (recordNo != '') {
         $("#btnGo").attr("disabled", false);
         
         document.location.replace('viewcrf.php?act=' + recordNo);
     } else {
        $("#btnGo").attr("disabled", true);
     }
 });

 $("#btnGo").on('click', function(e){
    var recordNo = $("#records").val();
    if (recordNo != '') {
        document.location.replace('viewcrf.php?act=' + recordNo);
    }
 });


})();
</script>