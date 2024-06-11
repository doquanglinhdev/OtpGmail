<script>
  // active navbar
  const navItems = document.querySelectorAll('.nav-item a');
  const currentLocation = location.href;
  for (let i = 0; i < navItems.length; i++) {
    if (navItems[i].href === currentLocation) {
      navItems[i].classList.add('active');
    }
  }
</script>
<script>
  new DataTable('#myTable');
</script>
<div id="thongbao"></div>
<!-- Main Footer -->
<footer class="main-footer">
  <!-- To the right -->
  <div class="float-right d-none d-sm-inline">
    Phiên bản <b style="color:red;">1.0.0</b>
  </div>
  <!-- Default to the left -->
  <strong>Copyright &copy; 2022-2023 <a href="" target="_blank">WEBHOME.VN</a>.</strong> All rights reserved.
</footer>
</div>
<!-- jQuery -->
<script src="/assets/vendor/admin_lte/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/assets/vendor/admin_lte/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/assets/vendor/admin_lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/assets/vendor/admin_lte/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/assets/vendor/admin_lte/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/assets/vendor/admin_lte/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/assets/vendor/admin_lte/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/assets/vendor/admin_lte/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/assets/vendor/admin_lte/plugins/moment/moment.min.js"></script>
<script src="/assets/vendor/admin_lte/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/assets/vendor/admin_lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/assets/vendor/admin_lte/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/assets/vendor/admin_lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/assets/vendor/admin_lte/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/assets/vendor/admin_lte/dist/js/pages/dashboard.js"></script>

<script src="/assets/vendor/admin_lte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/vendor/admin_lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/vendor/admin_lte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/vendor/admin_lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/assets/vendor/admin_lte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/assets/vendor/admin_lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

<!-- <script src="../../dist/js/adminlte.min.js?v=3.2.0"></script> -->

<script src="/assets/vendor/admin_lte/plugins/flot/jquery.flot.js"></script>
<script src="/assets/vendor/admin_lte/plugins/flot/plugins/jquery.flot.resize.js"></script>
<script src="/assets/vendor/admin_lte/plugins/flot/plugins/jquery.flot.pie.js"></script>

</body>

</html>