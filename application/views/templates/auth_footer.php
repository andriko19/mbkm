<!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?= base_url(); ?>assets/backend/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?= base_url(); ?>assets/backend/vendors/chart.js/Chart.min.js"></script>
    <script src="<?= base_url(); ?>assets/backend/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="<?= base_url(); ?>assets/backend/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="<?= base_url(); ?>assets/backend/js/dataTables.select.min.js"></script>
    <!-- inject:js -->
    <script src="<?= base_url(); ?>assets/backend/js/off-canvas.js"></script>
    <script src="<?= base_url(); ?>assets/backend/js/hoverable-collapse.js"></script>
    <script src="<?= base_url(); ?>assets/backend/js/template.js"></script>
    <script src="<?= base_url(); ?>assets/backend/js/settings.js"></script>
    <script src="<?= base_url(); ?>assets/backend/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="<?= base_url(); ?>assets/backend/js/dashboard.js"></script>
    <script src="<?= base_url(); ?>assets/backend/js/Chart.roundedBarCharts.js"></script>
    <!-- End custom js for this page-->

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