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
    <?= form_open('formulir/store', ['id' => 'formulir-form', 'enctype' => 'multipart/form-data']); ?>
      <div class="row">
        <div class="col-md-8 mx-auto">
          <div class="form-group">
            <label>Nama Formulir</label>
            <input type="text" class="form-control" name="nama_formulir" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8 mx-auto field-list" x-ref="fieldList">
          <template x-for="(field, index) in fields" :key="index">
            <div class="d-flex align-items-start field-item">
              <button class="btn btn-grip" style="cursor: grab;">
                <i class="fas fa-grip-vertical"></i>
              </button>
              <div class="card collapsed-card w-100">
                <div class="card-header" data-card-widget="collapse" title="Collapse">
                  <h3 class="card-title" x-text="field.judul || 'Isian Tidak Bernama'"></h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-plus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body" style="display: none;">
                  <div class="row">
                    <div class="form-group col">
                      <label>Nama Isian</label>
                      <input type="text" class="form-control judul" value="AdminLTE" name="judul[]" x-model="field.judul" required>
                    </div>
                    <div class="form-group col">
                      <label for="inputStatus">Tipe</label>
                      <select class="form-control custom-select tipe" name="tipe[]" x-model="field.tipe" required x-on:change="if (field.tipe == 'radio' || field.tipe == 'checkbox') { field.choices = ['']; } else { field.splice('choices', 1); }">
                        <option value="text">Text</option>
                        <option value="textarea">Textarea</option>
                        <option value="radio">Radio</option>
                        <option value="checkbox">Checkbox</option>
                      </select>
                    </div>
                  </div>
                  <ul x-show="field.tipe == 'radio' || field.tipe == 'checkbox'">
                    <template x-for="(choice, choiceIndex) in field.choices" :key="choiceIndex">
                      <li class="mb-2 d-flex align-items-center">
                        <input type="text" class="form-control form-control-sm" :name="'choice[' + index + '][]'" x-model="choice.value" required>
                        <button type="button" class="btn btn-delete btn-sm ml-2" x-on:click="removeChoice(index, choiceIndex)">
                          <i class="fas fa-trash"></i>
                        </button>
                      </li>
                    </template>
                  </ul>
                  <template x-if="field.tipe == 'radio' || field.tipe == 'checkbox'">
                    <button type="button" class="btn btn-primary btn-sm" x-on:click="addChoice(index, field.tipe)">Tambah Pilihan</button>
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
          <button type="submit" class="btn btn-primary float-right">Simpan</button>
        </div>
      </div>
    <?= form_close(); ?>
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
        fields: [],
        selected_index: null,
        sortable: null,
        init() {
          this.sortable = Sortable.create(this.$refs.fieldList, {
            handle: '.btn-grip',
            animation: 150,
          });
        },
        addfields() {
          this.fields.push({
            urutan: this.fields.length + 1,
            judul: null,
            tipe: 'text'
          });
        },
        removefieldConfirm(index) {
          $('#modal-confirm-delete').modal('show');
          this.selected_index = index;
        },
        removefield(index) {
          this.fields.splice(index, 1);
          this.selected_index = null;
          $('#modal-confirm-delete').modal('hide');
        },
        addChoice(index, tipe) {
          this.fields[index].choices.push({
            value: null
          });
        },
        removeChoice(index, choiceIndex) {
          this.fields[index].choices.splice(choiceIndex, 1);
        }
      }
    }

  </script>
<?= $this->endSection(); ?>