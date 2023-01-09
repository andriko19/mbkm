<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="container">
      <div class="row d-flex align-items-center">
        <div class="col-lg-6 text-lg-left text-center">
          <div class="copyright">
            &copy; Copyright <strong>2023</strong><a href="http://ict.uwp.ac.id/" style="color: #782f40;" target="_blank"> TIK UWP</a>
          </div>
        </div>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?= base_url(); ?>assets/frontend/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url(); ?>assets/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url(); ?>assets/frontend/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="<?= base_url(); ?>assets/frontend/vendor/php-email-form/validate.js"></script>
  <script src="<?= base_url(); ?>assets/frontend/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="<?= base_url(); ?>assets/frontend/vendor/counterup/counterup.min.js"></script>
  <script src="<?= base_url(); ?>assets/frontend/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="<?= base_url(); ?>assets/frontend/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?= base_url(); ?>assets/frontend/vendor/venobox/venobox.min.js"></script>
  <script src="<?= base_url(); ?>assets/frontend/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url(); ?>assets/frontend/js/main.js"></script>
  
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