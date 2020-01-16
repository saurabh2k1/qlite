<?php
session_start();

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();
    session_destroy();
}
$_SESSION['LAST_ACTIVITY'] = time();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

include_once '../inc/db.php';
include_once 'functions.php';
$userid = $_SESSION['user_id'];
$db->where('id', $userid);
$user = $db->getOne('users');

$db->where('userid', $userid)->orderBy('timestamp', 'DESC');
$lastlogin = $db->get('logins',array(1,1));
if (is_array($lastlogin)) {
    $lastlogin = $lastlogin[0];
}
$db->join("user_site_allocation u", "s.id = u.siteid");
$db->joinWhere("user_site_allocation u","u.userid", $userid);
$site = $db->getOne("sites s", null, "s.*");

$filename = basename($_SERVER['PHP_SELF']); 

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../res/saurabh.css">
    <!-- <link rel="stylesheet" href="../res/dashboard.css"> -->
    <link rel="stylesheet" href="../res/toastr/toastr.min.css">
    <title>CRF</title>
    <style>
    #body-row {
    margin-left:0;
    margin-right:0;
}
    #sidebar-container {
        min-height: 100vh;   
        background-color: #333;
        padding: 0;
    }
        /* Sidebar sizes when expanded and expanded */
    .sidebar-expanded {
        width: 250px;
    }
    .sidebar-collapsed {
        width: 60px;
    }

/* Menu item*/
#sidebar-container .list-group a {
    height: 60px;
    color: white;
}

/* Submenu item*/
#sidebar-container .list-group .sidebar-submenu a {
    height: 55px;
    padding-left: 10px;
}
.sidebar-submenu {
    font-size: 0.9rem;
}

/* Separators */
.sidebar-separator-title {
    background-color: #333;
    height: 35px;
}
.sidebar-separator {
    background-color: #333;
    height: 25px;
}
.logo-separator {
    background-color: #333;    
    height: 60px;
}

/* Closed submenu icon */
#sidebar-container .list-group .list-group-item[aria-expanded="false"] .submenu-icon::after {
  content: " \f0d7";
  font-family: FontAwesome;
  display: inline;
  text-align: right;
  padding-left: 10px;
}
/* Opened submenu icon */
#sidebar-container .list-group .list-group-item[aria-expanded="true"] .submenu-icon::after {
  content: " \f0da";
  font-family: FontAwesome;
  display: inline;
  text-align: right;
  padding-left: 10px;
}
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow" style="width: 100vw">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">
            <img src="../res/img/QdataEDCLite.png" class="d-inline-block align-top" style="border-radius: 10px; height:50px;" alt="QDataEDC LITE" />
            <!-- <span class="menu-collapsed">e-CRF</span> -->
        </a>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#top">
                    <span data-feather="user"></span>    
                    <?php echo $user['name']; ?>
                    </a>    
               </li>
                <li class="nav-item">
                <a href="../logout.php" class="nav-link">
                    <span data-feather="log-out"></span>    
                    Logout
                    </a>
                </li>
                <!-- Side menu for smaller screen -->
                <li class="nav-item dropdown d-sm-block d-md-none">
                <a class="nav-link dropdown-toggle" href="#" id="smallerscreenmenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Menu </a>
                <div class="dropdown-menu" aria-labelledby="smallerscreenmenu">
                    <a class="dropdown-item" href="../home.php">Dashboard</a>
                    <a class="dropdown-item" href="../reset-study.php">CHANGE STUDY</a>
                    <?php if (!empty($_SESSION['studyid'])) { 
                    $db->where("id", $_SESSION['studyid']);
                    $study = $db->getOne('studies');
                    if ($study) {
                        $db->where('studyid', $study['id'])->orderBy('sequence', 'ASC');
                        $forms = $db->get('crfs');
                        foreach ($forms as $form) { ?>
                            <a class="dropdown-item" href="<?php echo $form['filename']; ?>">
                                 
                                <?php echo $form['title']; ?>
                            </a>
                        <?php }
                    } }?>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#password_modal">
                            
                        Change Password
                    </a>
                <span class="dropdown-item-text" >Last Login: <?php echo date('d-M-Y H:i:s', strtotime($lastlogin['timestamp'])); ?></span>
                </div>
                
                </li>
                <!-- /Side menu for smaller screen -->
            </ul>
        </div>
    </nav>

    
    <div class="row" id="body-row">
        <!-- Side Bar -->
        <div id="sidebar-container" class="sidebar-expanded d-none d-md-block">
            <ul class="list-group">
                <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <?php echo $site['name']; ?>
                </li>
                <a href="../home.php" class="bg-dark list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fa fa-dashboard fa-fw mr-3"></span>
                        <span class="menu-collapsed">Dashboard</span>
                    </div>
                </a>
                <a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fa fa-user fa-fw mr-3"></span>
                        <span class="menu-collapsed">Profile</span>
                        <span class="submenu-icon ml-auto"></span>
                    </div>
                </a>
                <!-- Submenu content -->
                <div id='submenu2' class="collapse sidebar-submenu">
                    <a href="#password_modal" data-target="#password_modal" data-toggle="modal" class="list-group-item list-group-item-action bg-dark text-white">
                    <span data-feather="edit"></span>      
                    Change Password
                    </a>
                    <a href="../logout.php" class="list-group-item list-group-item-action bg-dark text-white">
                    <span data-feather="log-out"></span>    
                    Logout
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="" >Last Login: <?php echo date('d-M-Y H:i:s', strtotime($lastlogin['timestamp'])); ?></span>
                    </a>
                </div>
                <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <small>STUDY</small>
            </li>
                <?php if (!empty($_SESSION['studyid'])) { 
                    $db->where("id", $_SESSION['studyid']);
                    $study = $db->getOne('studies');
                    if ($study) { ?>
                    <a href="#studySubmenu" class="bg-dark list-group-item list-group-item-action flex-column align-items-start"  id="visits"  data-toggle="collapse" aria-expanded="true" >
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <span class="fa fa-book fa-fw mr-3"></span>
                            <span class="menu-collapsed"><?php echo $study['name'];?></span>
                            <span class="submenu-icon ml-auto"></span>
                        </div>    
                    </a>
                    <!-- Sub menu content -->
                    <div id="studySubmenu" class="collapse sidebar-submenu">
                        <a class="list-group-item list-group-item-action bg-dark text-white" title="Change Study" href="../reset-study.php">
                            <span  class="fa fa-edit fa-fw mr-3"></span> CHANGE STUDY
                        </a>
                        <?php 
                            $db->where("studyid", $study['id'])->orderBy('sequence', 'ASC');
                            $forms = $db->get('crfs');
                            foreach($forms as $form) {
                        ?>
                            <a class="list-group-item list-group-item-action bg-dark text-white" href="<?php echo $form['filename']; ?>">
                                <span data-feather="file-text" class="mr-3"></span>    
                                <?php echo $form['title']; ?>
                            </a>
                        <?php } ?>
                    </div>
                    <?php }
                } ?>
                <a href="#top" data-toggle="sidebar-colapse" class="bg-dark list-group-item list-group-item-action d-flex align-items-center">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span id="collapse-icon" class="fa fa-angle-double-left fa-2x mr-3"></span>
                        <span id="collapse-text" class="menu-collapsed">Collapse</span>
                    </div>
                </a>
            </ul>
        </div> <!-- Sidebar-container -->
    <div class="col p-4"
