<?= $this->extend('layouts/authenticated_layout'); ?>

<?= $this->section('title'); ?>
  Formulir
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <table id="dataTable" class="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Dibuat</th>
                  <th>#</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($formulirs as $key => $value) { ?>
                  <tr>
                    <td><?= $key+1; ?></td>
                    <td><?= $value->nama; ?></td>
                    <td><?= $value->created_at; ?></td>
                    <td>
                      <a href="<?= url_to('formulir.detail', $value->id); ?>" class="btn btn-primary btn-sm">Detail</a>
                      <a href="<?= url_to('formulir.edit', $value->id); ?>" class="btn btn-warning btn-sm">Edit</a>
                      <form action="<?= url_to('formulir.delete', $value->id); ?>" method="post" style="display: inline-block;">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                      </form>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- Default box -->
      </div>
    </div>
  </div>
</section>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
  <script>
    $("#dataTable").DataTable({
      "responsive": true, 
      "lengthChange": false, 
      "autoWidth": false,
      // add custom button
      buttons: [
        {
          text: 'Tambah',
          action: function ( e, dt, node, config ) {
            window.location.href = "<?= url_to('formulir.create'); ?>";
          }
        }
      ]
    }).buttons().container().appendTo('#dataTable_wrapper .col-md-6:eq(0)');
  </script>
<?= $this->endSection(); ?>