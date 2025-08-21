</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
  <div class="p-3">
    <h5>Title</h5>
    <p>Sidebar content</p>
  </div>
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<footer class="main-footer">
  <!-- To the right -->
  <div class="float-right d-none d-sm-inline">
    Versi 1.0.0 <i>Powered by D-Team</i>
  </div>
  <!-- Default to the left -->
  <strong>Copyright &copy; 2022.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

</body>
<!-- Custom -->
<script src="<?= base_url("assets"); ?>/dist/js/ubah_pass.js"></script>

</html>
<script>
  function logout() {
    $('#frmLogout').modal({
      show: true,
      keyboard: false,
      backdrop: 'static'
    });
  }
</script>