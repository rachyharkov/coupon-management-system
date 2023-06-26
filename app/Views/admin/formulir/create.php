<?= $this->extend('layouts/authenticated_layout'); ?>

<?= $this->section('title'); ?>
  Tambah Formulir
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<style>
  .field-list .field-item .btn-grip, .field-list .field-item .btn-delete {
    transition: opacity 0.3s ease-in-out;
    opacity: 0;
  }
  .field-list .field-item:hover .btn-grip, .field-list .field-item:hover .btn-delete {
    transition: opacity 0.3s ease-in-out;
    opacity: 1;
  }
</style>

<section class="content" x-data="fields()">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 mx-auto field-list" x-ref="fieldList">
        <template x-for="(fields, index) in fieldss" :key="index">
          <div class="d-flex align-items-start field-item">
            <button class="btn btn-grip" style="cursor: grab;">
              <i class="fas fa-grip-vertical"></i>
            </button>
            <div class="card collapsed-card w-100">
              <div class="card-header" data-card-widget="collapse" title="Collapse">
                <h3 class="card-title" x-text="fields.judul || 'Isian Tidak Bernama'"></h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-plus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" style="display: none;">
                <div class="row">
                  <div class="form-group col">
                    <label for="fieldName">Nama Isian</label>
                    <input type="text" id="fieldName" class="form-control" value="AdminLTE" x-model="fields.judul">
                  </div>
                  <div class="form-group col">
                    <label for="inputStatus">Tipe</label>
                    <select class="form-control custom-select" x-model="fields.tipe">
                      <option value="text">Text</option>
                      <option value="textarea">Textarea</option>
                      <option value="radio">Radio</option>
                      <option value="checkbox">Checkbox</option>
                    </select>
                  </div>
                </div>
                <ul x-show="fields.tipe == 'radio' || fields.tipe == 'checkbox'">
                  <template x-for="(choice, choiceIndex) in fields.choices" :key="choiceIndex">
                    <li class="mb-2">
                      <input type="text" class="form-control form-control-sm" x-model="choice.value">
                    </li>
                  </template>
                </ul>
                <template x-if="fields.tipe == 'radio' || fields.tipe == 'checkbox'">
                  <button type="button" class="btn btn-primary btn-sm" x-on:click="addChoice(index, fields.tipe)">Tambah Pilihan</button>
                </template>
              </div>
            </div>
            <button class="btn btn-delete" x-on:click="removefieldConfirm(index)">
              <i class="fas fa-trash"></i>
            </button>
          </div>
        </template>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8 mx-auto">
        <button type="button" class="btn btn-light" x-on:click="addfields()"><span><i class="fas fa-plus"></i></span>Tambah Isian</button>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modal-confirm-delete">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Hapus Isian</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Anda yakin ingin menghapus isian ini?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" x-on:click="removefield(selected_index)">Hapus</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</section>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
  <script>

    function fields() {
      return {
        fieldss: [],
        selected_index: null,
        init() {
          this.fieldss.push({
            judul: '',
            deskripsi: '',
            tipe: '',
            choices: [],
          });

          Sortable.create(this.$refs.fieldList, {
            handle: '.btn-grip',
            animation: 150,
            onEnd: (evt) => {
              const itemEl = evt.item;
              const item = this.fieldss.splice(evt.oldIndex, 1)[0];
              this.fieldss.splice(evt.newIndex, 0, item);
            },
          });
        },
        addfields() {
          this.fieldss.push({
            judul: '',
            deskripsi: '',
            tipe: '',
            choices: [],
          });
        },
        removefieldConfirm(index) {
          $('#modal-confirm-delete').modal('show');
          this.selected_index = index;
        },
        removefield(index) {
          this.fieldss.splice(index, 1);
          this.selected_index = null;
          $('#modal-confirm-delete').modal('hide');
        },
        addChoice(index, tipe) {
          this.fieldss[index].choices = this.fieldss[index].choices || [];
          this.fieldss[index].choices.push({
            value: '',
          });
        },
      }
    }

  </script>
<?= $this->endSection(); ?>