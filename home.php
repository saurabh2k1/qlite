<?php 
include_once 'header.php';
$db->join("user_study_allocation u", "s.id = u.studyid");
$db->joinWhere("user_study_allocation u","u.userid", $userid);
$studies = $db->get("studies s", null, "s.*");
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
<?php if (empty($_SESSION['studyid'])) { ?>  
<div class="row">
    <?php foreach($studies as $study) { ?> 
    <div class="col-md-4">
        <div class="card mycard">
            <div class="card-body">
                <h3 class="card-title"><?php echo $study['name']; ?> </h3>
            </div>
            <div class="card-footer text-center">
                <a class="btn btn-primary btn-lg" href="select-study.php?sid=<?php echo $study['id']; ?>">Enter the study</a>
            </div>
        </div>
    </div>
    <?php }  ?>
</div>
<?php } else if($_SESSION['studyid'] == 1) {?>
    <div class="row">
    <div class="col-xl-3 col-lg-6 col-12">
            <div class="card bg-gradient-directional-danger">
                
                <div class="card-body">
                    <div class="media d-flex">
                        <div class="media-body text-left">
                        <h3 class="text-white"><?php  $subjects = $db->get('ped_subject'); echo $db->count; ?></h3>
                        <span class="text-white">Screened Subject</span>    
                        </div>
                        <div class="align-self-center">
                            <i class="fa fa-search text-white float-right i-ss"></i>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card bg-gradient-directional-primary">
                
                <div class="card-body">
                    <div class="media d-flex">
                        <div class="media-body text-left">
                        <h3 class="text-white"><?php $db->where('enrolled > 0'); $subjects = $db->get('ped_subject'); echo $db->count; ?></h3>
                        <span class="text-white">Enrolled Subject</span>    
                        </div>
                        <div class="align-self-center">
                            <i class="fa fa-user-md text-white float-right i-ss"></i>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card bg-gradient-directional-warning">
                
                <div class="card-body">
                    <div class="media d-flex">
                        <div class="media-body text-left">
                        <h3 class="text-white"><?php $db->where('enrolled >= 2'); $subjects = $db->get('ped_subject'); echo $db->count; ?></h3>
                        <span class="text-white">Telephone Visit</span>    
                        </div>
                        <div class="align-self-center">
                            <i class="fa fa-volume-control-phone text-white float-right i-ss"></i>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card bg-gradient-directional-success">
                
                <div class="card-body">
                    <div class="media d-flex">
                        <div class="media-body text-left">
                        <h3 class="text-white"><?php $db->where('enrolled', 10); $subjects = $db->get('ped_subject'); echo $db->count; ?></h3>
                        <span class="text-white">EOS Visit copleted</span>    
                        </div>
                        <div class="align-self-center">
                            <i class="fa fa-paper-plane-o text-white float-right i-ss"></i>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <br>
    <div class="row">
    <div class="col-xl-3 col-lg-6 col-12">
            <div class="card">
                <a class="btn bg-gradient-directional-danger text-white" href="forms/enrollment.php">Enrollment Record</a>
            </div>
        </div>
    <div class="col-xl-3 col-lg-6 col-12">
        
            <div class="card">
                <a class="btn btn-purple btn-purple-grad text-white" href="forms/screening.php">Enroll new subject</a>
            </div>
        </div>
        
        
    </div>
<?php } ?>
</main>
<?php 
include_once 'footer.php';
?>