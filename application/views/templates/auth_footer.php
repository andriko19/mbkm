    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?= base_url(); ?>assets/backend/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= base_url(); ?>assets/backend/js/off-canvas.js"></script>
    <script src="<?= base_url(); ?>assets/backend/js/hoverable-collapse.js"></script>
    <script src="<?= base_url(); ?>assets/backend/js/template.js"></script>
    <script src="<?= base_url(); ?>assets/backend/js/settings.js"></script>
    <script src="<?= base_url(); ?>assets/backend/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Template Sweetalert2 JS-->
    <script src="<?= base_url(); ?>assets/frontend/sweetalert2/sweetalert2.min.js"></script>
    <!-- custome js -->
    <script>
      window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove(); 
        });
      }, 5000);
    </script>
    <!-- end custome js -->
  </body>

</html>