<?= script_tag('assets/plugins/jquery/jquery.min.js') ?>
<?= script_tag('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>
<!-- DataTables  & Plugins -->
<?= script_tag('assets/plugins/datatables/jquery.dataTables.min.js') ?>
<?= script_tag('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>
<?= script_tag('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>
<?= script_tag('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>
<?= script_tag('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') ?>
<?= script_tag('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') ?>
<?= script_tag('assets/plugins/jszip/jszip.min.js') ?>
<?= script_tag('assets/plugins/pdfmake/pdfmake.min.js') ?>
<?= script_tag('assets/plugins/pdfmake/vfs_fonts.js') ?>
<?= script_tag('assets/plugins/datatables-buttons/js/buttons.html5.min.js') ?>
<?= script_tag('assets/plugins/datatables-buttons/js/buttons.print.min.js') ?>
<?= script_tag('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') ?>

<?= script_tag('assets/js/adminlte.min.js') ?>
<?= script_tag('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.13.0/Sortable.min.js"></script>
<?= script_tag('assets/plugins/sweetalert2/sweetalert2.min.js') ?>

<?php
  // if session flashdata exists then show alert
  if(session()->getFlashdata('success')) {
?>
  <script>
    var Toast = Swal.mixin({
      toast: true,
      position: 'top',
      showConfirmButton: false,
      timer: 5000
    });

    Toast.fire({
      icon: 'success',
      title: '<?= session()->getFlashdata('success'); ?>'
    })
  </script>
<?php
  }
?>

<?= $this->renderSection('script') ?>