<?php include_once 'header.php'; 
$db->where('siteid', $site['siteid']);
$subjects = $db->get('ped_subject');
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="row">
        <div class="col-md-10 col-lg-12">
            <table class="table table-striped table-bordered" id="tabEnrollment">
                <thead >
                    <tr><th>#</th><th>SUBJECT IDENTIFICATION CODE</th><th>Initials</th>
                    <th>Enrolled?</th><th>Last Visits</th><th>Next Visit</th></tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach($subjects as $subject) { ?>
                    <tr>
                        <td><?php echo $i; ?></td><td>
                        <?php echo $site['code'].'-'.str_pad($subject['code'], 3, '0', STR_PAD_LEFT); ?></td>
                        <td><?php echo $subject['initial']; ?></td>
                        <?php if ($subject['enrolled']) {?>
                        <td class="bg-gradient-directional-success">Yes</td> 
                        <td>
                            <?php $lastVisit = ped_getLastVisitDetails($subject['id']); 
                            echo $lastVisit['visit'] . "(".$lastVisit['dov'].")"; ?>
                        </td>
                        <td><?php echo $lastVisit['next']; ?></td>
                        <?php } else { ?>
                        <td class="bg-gradient-directional-danger">No</td> <td>NA</td><td></td>
                        <?php } ?>
                        
                    </tr>
                    <?php $i++;}
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include_once 'footer.php'; ?>
<script>
    $(document).ready(function() {
    $('#tabEnrollment').DataTable();
} );
</script>