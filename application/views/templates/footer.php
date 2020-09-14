<footer class="main-footer text-center">
    <strong>Copyright &copy; 2020 Fakultas Hukum Universitas Brawijaya.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>


<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url("plugins/jquery/jquery.min.js") ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url("plugins/jquery-ui/jquery-ui.min.js") ?> "></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url("plugins/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>
<!-- ChartJS -->
<script src="<?= base_url("plugins/chart.js/Chart.min.js") ?>"></script>
<!-- Toaster -->
<script src="<?= base_url("plugins/toastr/toastr.min.js") ?>"></script>

<!-- daterangepicker -->
<script src="<?= base_url("plugins/moment/moment.min.js") ?>"></script>
<script src="<?= base_url("plugins/daterangepicker/daterangepicker.js") ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url("plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js") ?>"></script>
<!-- Summernote -->
<script src="<?= base_url("plugins/summernote/summernote-bs4.min.js") ?>"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url("plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js") ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url("assets/js/adminlte.js") ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url("assets/js/pages/dashboard.js") ?>"></script>
<!-- AdminLTE for demo purposes -->

<!-- <script src="<?= base_url("plugins/datatables/dataTables.bootstrap4.js") ?>"></script> -->
<!-- <script src="<?= base_url("plugins/datatables/jquery.dataTables.js") ?>"></script> -->
<script src="<?= base_url('assets/vendor/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js'); ?>"></script>

<!-- my script -->
<script src="<?= base_url("assets/js/alluser.js") ?>"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
        $('#data').DataTable();
    });

    if ($('.toasterSuccess').val()) {
        $(document).Toasts('create', {
            class: 'bg-success',
            title: 'Berhasil',

            body: $('.toasterSuccess').val()
        })

    }

    if ($('.toasterDanger').val()) {
        $(document).Toasts('create', {
            class: 'bg-danger',
            title: 'Gagal',

            body: $('.toasterDanger').val()
        })
    }
</script>
</body>

</html>