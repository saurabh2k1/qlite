</div>
<!-- </div> -->
<div class="modal fade" id="password_modal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
    <form action="../password-reset.php" method="post">
        <input type="hidden" name="userid" value="<?php echo $userid; ?>">
    <div class="modal-content">
    <div class="modal-header">
        <h3>Change Password <span class="extra-title muted"></span></h3>
    </div>
    <div class="modal-body form-horizontal">
        <div class="control-group">
            <label class="control-label" for="current_password">Current Password</label>
            <div class="controls">
                <input name="current_password" type="password">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="new_password">New Password</label>
            <div class="controls">
                <input name="new_password" type="password">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="confirm_password">Confirm Password</label>
            <div class="controls">
                <input name="confirm_password" type="password">
            </div>
        </div>      
    </div>
    <div class="modal-footer">
        <button class="btn btn-secondary" aria-hidden="true" href="#" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="password_modal_save" >Save changes</button>
    </div>
    </div>
    </form>
    </div>
</div>
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="../res/toastr/toastr.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
 <!-- Icons -->
 <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace();
     
      toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "500",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
};
<?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])) { ?>
        toastr.info(<?php echo $_SESSION['message']; unset($_SESSION['message']); ?>);
     <?php } ?>

// Sidebar 

// Hide submenus
$('#body-row .collapse').collapse('hide'); 

// Collapse/Expand icon
$('#collapse-icon').addClass('fa-angle-double-left'); 

// Collapse click
$('[data-toggle=sidebar-colapse]').click(function() {
    SidebarCollapse();
});

function SidebarCollapse () {
    $('.menu-collapsed').toggleClass('d-none');
    $('.sidebar-submenu').toggleClass('d-none');
    $('.submenu-icon').toggleClass('d-none');
    $('#sidebar-container').toggleClass('sidebar-expanded sidebar-collapsed');
    
    // Treating d-flex/d-none on separators with title
    var SeparatorTitle = $('.sidebar-separator-title');
    if ( SeparatorTitle.hasClass('d-flex') ) {
        SeparatorTitle.removeClass('d-flex');
    } else {
        SeparatorTitle.addClass('d-flex');
    }
    
    // Collapse/Expand icon
    $('#collapse-icon').toggleClass('fa-angle-double-left fa-angle-double-right');
}

    </script>
</body>
</html>