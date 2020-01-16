<?php include_once 'header.php'; 

if (isset($_GET['act']) && !empty($_GET['act'])) {
    $act = $_GET['act'];
    $db->where('id', $act);
    $record = $db->getOne('labcrf');
    $db->where('labcrf_id', $act);
    $tab1_records = $db->get('labtab1');
    $db->where('labcrf_id', $act);
    $tab2_records = $db->get('labtab2');
    $db->where('labcrf_id', $act);
    $tab3_records = $db->get('labtab3');
} else {
    $act = 0;
}
?>
<style>
    em {
    padding: 6px;
    margin-bottom: 3px;
    font-weight: 500;
    background-color: gray;
    color: white;
    border-radius: 4px;
    }
</style>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="row">
        <div class="col col-md-3 mr-auto"><a class="btn btn-outline-primary" href="labcrf1.php"><span data-feather="file-text"></span> Go Back</a></div>
        <div class="col col-md-3 ml-auto"><a class="btn btn-outline-warning" href="../home.php"> <span data-feather="home"></span> Go To Dashboard</a></div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4 mb-3 mr-auto">
            <label for="sample_id">Study Sample ID</label>
            <em><?php echo $record['sample_id']; ?></em> 
        </div>
        <div class="col-md-4 mb-3 ml-auto">
            <label for="sample_collection_date">Sample Collection Date</label>
            <em><?php echo date('d-M-Y', strtotime($record['sample_collection_date']));?></em>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-3 mr-auto">
            <label for="age">Patient Age </label>
            <em><?php echo $record['age'] ?> </em> (Years)
        </div>
        <div class="col-md-4 mb-3 ml-auto">
            <label for="gender">Patient Gender</label>
            <em><?php echo $record['gender']; ?></em>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-4 mb-3 mr-auto">
            <label for="diagnosis">Diagnosis</label>
            <em><?php echo $record['diagnosis']; ?></em>
        </div>
        <div class="col-md-4 mb-3 ml-auto">
            <label for="sample_processing_date">Sample Processing Date</label>
            <em><?php echo date('d-M-Y', strtotime($record['sample_processing_date']));?></em>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-7 mb-3">
            <label for="gram_result">Result of Gram Stain</label>
            <em>
            <?php switch ($record['gram_result']) {
                case '1':
                    echo "Positive";
                    break;
                case '0':
                    echo "Negative";
                    break;
                case '99':
                    echo "Not Done  </em>  because : <em>" . $record['result_not_done'];
                    break;
                default:
                    # code...
                    break;
            } ?>
            </em>
        </div>
    </div>
    <div class="form-row">
        <h5>Test Results</h5>
    </div>
    <div class="form-row">
        <table class="table table-bordered" id="tabTestResult">
            <thead class="thead-dark">
                <tr><th>#</th><th>Colony Number</th><th>Name of Test</th><th>Result</th><th>Additional Comments (if any)</th></tr>
            </thead>
            <tbody>
                <!-- <tr><td colspan="5"><button type="button" class="btn btn-outline-primary" id="btnAddTestResult">Add Row</button>
                <button type="button" class="btn btn-outline-danger delete-row">Delete Row</button>
                    </td></tr> -->
                <?php $i=1; foreach ($tab1_records as $trecord) { ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $trecord['colony_number']; ?></td>
                        <td><?php echo $trecord['test_name']; ?></td>
                        <td><?php echo $trecord['result']; ?></td>
                        <td><?php echo $trecord['comment']; ?></td>
                    </tr>
                <?php $i++; } ?>
                
            </tbody>
        </table>
    </div>
    <div class="form-row">
        <h5>VITEK 2C IDENTIFICATION AND ANTIBIOTIC SENSITIVITY TEST: (AST)</h5>
    </div>
    <div class="form-row">
        <table class="table table-bordered" id="tabAST">
            <thead class="thead-dark">
                <tr><th>#</th><th>Organism ID</th><th>Surrogate Marker Susceptibility</th><th>Cephalexin Interpretation</th></tr>
            </thead>
            <tbody>
            <!-- <tr><td colspan="4"><button type="button" class="btn btn-outline-primary" id="btnAddAST">Add Row</button>
                <button type="button" class="btn btn-outline-danger delete-row1">Delete Row</button>
                    </td></tr> -->
                <?php $i = 1; foreach ($tab2_records as $trecord) {  ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $trecord['organism_id']; ?></td>
                        <td><?php echo $trecord['surrogate']; ?></td>
                        <td><?php echo $trecord['cephalexin']; ?> </td>
                    </tr>
                <?php $species = $trecord['species_identified'];  $i++; } ?>
                
            </tbody>
        </table>
    </div>
    <div class="form-row">
        <div class="col-md-6 mb-3">
            <label for="species">Species Identified</label>
            <em><?php echo $species; ?></em>
        </div>
    </div>
    <div class="form-row">
        <h5>CEPHALEXIN- KIRBY -BAUER DISC DIFFUSION ZONE SIZE RECORD</h5>
    </div>
    <div class="form-row">
        <table class="table table-bordered" id="tabAST2">
            <thead class="thead-dark">
                <tr><th>#</th><th>CEPHALEXIN ZONE OF INHIBITION IN S. AUREUS ATCC 25923</th><th>CEPHALEXIN ZONE OF INHIBITION IN ISOLATE</th></tr>
            </thead>
            <tbody>
            <!-- <tr><td colspan="3"><button type="button" class="btn btn-outline-primary" id="btnAddAST2">Add Row</button>
                <button type="button" class="btn btn-outline-danger delete-row2">Delete Row</button>
                    </td></tr> -->

                <?php $i = 1; foreach ($tab3_records as $trecord) { ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $trecord['ATCC25923']; ?></td>
                        <td><?php echo $trecord['isolate']; ?></td>
                    </tr>
                <?php $i++; } ?>
                
            </tbody>
        </table>
    </div>
    <div class="form-row">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                <th>
                    Record created by </th> <th> <?php echo getUserName($record['created_by']); ?> </th> 
                <!-- </tr>
                <tr> -->
                <th>
                    Timestamp </th> <th><?php echo date('d-M-Y H:i:s', strtotime($record['created_at'])); ?>
                </th>
                </tr>
            </thead>
        </table>
        
    </div>
</main>
<?php include_once 'footer.php'; ?>
