<?= $this->extend('layouts/authenticated_layout'); ?>

<?= $this->section('title'); ?>
Buat Set Kupon
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<section class="content">
  <div class="container-fluid" style="max-width: 1024px;">
    <?= form_open(url_to('kupon.update'), ['id' => 'form', 'class' => 'form-horizontal', 'autocomplete' => 'off']); ?>
      <div class="row">
        <div class="col-md-10 mx-auto">
          <div class="card mx-auto p-2">
            <div class="card-header">
              <h5 class="card-title">Informasi Dasar</h5>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="name">Judul Kupon</label>
                <input required type="text" class="form-control" id="name" name="nama" placeholder="Masukan Judul Kupon" value="<?= $kupon['nama'] ?>">
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="code_total">Berapa Banyak?</label>
                    <input disabled type="number" class="form-control" id="code_total" placeholder="Masukan Angka" min="0" value="<?= $kupon['code_total'] ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="code_length">Jumlah Karakter Kode?</label>
                    <input disabled type="number" class="form-control" id="code_length" placeholder="Masukan Angka" min="0" max="12" value="<?= $kupon['code_length'] ?>">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="custom-control custom-switch custom-switch-on-success">
                  <input required type="checkbox" name="status" class="custom-control-input" id="switchCouponStatus" <?= $kupon['status'] == 1 ? 'checked' : '' ?>>
                  <label class="custom-control-label" for="switchCouponStatus">
                    Coupon Status
                  </label>
                </div>
              </div>
              <a href="#">Tampilkan Opsi Lanjutan</a>
            </div>
          </div>

          <div class="card">
            <div class="card-header">
              <h5 class="card-title">Jenis Kupon</h5>
            </div>
            <div class="card-body">
              <div class="form-group">
                <div class="custom-control custom-radio">
                  <input disabled class="custom-control-input custom-control-input-primary custom-control-input-outline" name="coupon_type" value="discount" <?= $kupon['coupon_type'] == 'discount' ? 'checked' : '' ?> type="radio" id="customRadio1">
                  <label for="customRadio1" class="custom-control-label font-weight-normal">Diskon</label>
                </div>
                <div class="custom-control custom-radio">
                  <input disabled class="custom-control-input custom-control-input-primary custom-control-input-outline" name="coupon_type" value="free_shipping" <?= $kupon['coupon_type'] == 'free_shipping' ? 'checked' : '' ?> type="radio" id="customRadio2">
                  <label for="customRadio2" class="custom-control-label font-weight-normal">Gratis Ongkir</label>
                </div>
                <div class="custom-control custom-radio">
                  <input disabled class="custom-control-input custom-control-input-primary custom-control-input-outline" name="coupon_type" value="buy_x_free_y" <?= $kupon['coupon_type'] == 'buy_x_free_y' ? 'checked' : '' ?> type="radio" id="customRadio3">
                  <label for="customRadio3" class="custom-control-label font-weight-normal">Beli X Gratis Y</label>
                </div>
                <div class="custom-control custom-radio">
                  <input disabled class="custom-control-input custom-control-input-primary custom-control-input-outline" name="coupon_type" value="fixed_amount" <?= $kupon['coupon_type'] == 'fixed_amount' ? 'checked' : '' ?> type="radio" id="customRadio4">
                  <label for="customRadio4" class="custom-control-label font-weight-normal">Harga Fix</label>
                </div>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header">
              <h5 class="card-title">Nilai</h5>
            </div>
            <div class="card-body">
              <label for="diterapkan_pada">Diterapkan Pada <span x-text="coupon_applied_on"></span></label>
              <div class="form-group">
                <div class="custom-control custom-radio">
                  <input required class="custom-control-input custom-control-input-primary custom-control-input-outline" name="coupon_applied_on" value="single_product" <?= $kupon['coupon_applied_on'] == 'single_product' ? 'checked' : '' ?> type="radio" id="single_product">
                  <label for="single_product" class="custom-control-label font-weight-normal">Produk Tunggal</label>
                </div>
                <div class="custom-control custom-radio">
                  <input required class="custom-control-input custom-control-input-primary custom-control-input-outline" name="coupon_applied_on" value="multiple_products" <?= $kupon['coupon_applied_on'] == 'multiple_products' ? 'checked' : '' ?> type="radio" id="multiple_products">
                  <label for="multiple_products" class="custom-control-label font-weight-normal">Multi Produk</label>
                </div>
              </div>
              <ul>
                <?php
                  foreach($kupon_products as $kupon_product) {
                    ?>
                      <li>
                        <?= view('admin/kupon/include/form_nilai_row_edit',[
                            'kupon_product' => $kupon_product,
                            'kupon_type' => $kupon['coupon_type'],
                            'kupon_value_type' => $kupon['coupon_value_type'],
                          ]) 
                        ?>
                        <hr class="my-3">
                      </li>
                    <?php
                  }
                ?>
              </ul>
              <div class="form-group" x-show="coupon_applied_on == 'multiple_products'">
                <button type="button" class="btn btn-primary" x-on:click="addProduct()">Tambah Produk</button>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header">
              <h5 class="card-title">Formulir</h5>
            </div>
            <div class="card-body">
              <div class="form-group">
                <select class="form-control select2 w-100" id="formulir_id" name="formulir_id">
                  <option value="" disabled selected>Pilih Formulir</option>
                  <?php foreach ($formulirs as $key => $value) { ?>
                    <option value="<?= $value['id']; ?>" <?= $value['id'] == $kupon['formulir_id'] ? 'selected' : '' ?>><?= $value['nama']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header">
              <h5 class="card-title">Kondisi</h5>
            </div>
            <div class="card-body" x-data="kondisi()">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <p class="text-center text-secondary" x-show="kondisi.length == 0" x-cloak>
                    Tidak ada kondisi, coba tambahkan sesuatu dengan memilih jenis kondisi di bawah ini lalu klik tombol tambah.
                  </p>
                  <template x-for="(k, index) in kondisi" :key="index">
                    <div>
                      <template x-if="k.jenis == 1" x-cloak>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                          </div>
                          <input required type="date" class="form-control" x-model="k.value" name="coupon_date_expired" x-on:input="setMessage(index, k.jenis)" min="<?= date('Y-m-d') ?>">
                          <button type="button" class="btn btn-danger" @click="removeKondisi(index)">Hapus</button>
                        </div>
                      </template>
                      <template x-if="k.jenis == 2" x-cloak>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-users"></i></span>
                          </div>
                          <input required type="number" class="form-control" x-model="k.value" name="coupon_limit" min="0" x-on:input="setMessage(index, k.jenis);
                          k.value = k.value.replace(/^0+/, '')" x-on:change="k.value > $('#code_total').val() ? k.value = $('#code_total').val() : ''">
                          <button type="button" class="btn btn-danger" @click="removeKondisi(index)">Hapus</button>
                        </div>
                      </template>
                      <template x-if="k.jenis == 5" x-cloak>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-edit"></i></span>
                          </div>
                          <input required type="text" class="form-control" x-model="k.value" name="condition_custom[]" x-on:input="setMessage(index, k.jenis)">
                          <button type="button" class="btn btn-danger" @click="removeKondisi(index)">Hapus</button>
                        </div>
                      </template>
                    </div>
                  </template>
                </li>
              </ul>
              <hr>
              <div class="form-group">
                <label for="kondisi_id" class="mr-2">Jenis Kondisi apa yang ingin kamu tambahkan?</label>
                <div class="d-flex">
                  <select class="form-control w-100" id="kondisi_id" x-model="kondisi_id">
                    <option value="" disabled selected>- Pilih -</option>
                    <option value="1" x-bind:disabled="kondisi.find(k => k.jenis == 1) != undefined" x-text="kondisi.find(k => k.jenis == 1) != undefined ? 'Batasan Waktu (Sudah ada)' : 'Batasan Waktu'"></option>
                    <option value="2" x-bind:disabled="kondisi.find(k => k.jenis == 2) != undefined" x-text="kondisi.find(k => k.jenis == 2) != undefined ? 'Jumlah Pengguna (Sudah ada)' : 'Jumlah Pengguna'"></option>Jumlah Pengguna</option>
                    <option value="5">Sesuaikan Sendiri</option>
                  </select>
                  <button x-show="kondisi_id != ''" x-cloak type="button" class="btn btn-primary ml-2" @click="addKondisi()">Tambah</button>
                </div>
              </div>
            </div>
          </div>
          <hr class="my-3">
          <button type="submit" class="btn btn-primary btn-block mb-3">Simpan</button>
        </div>
      </div>
    <?= form_close(); ?>
  </div>
  <!-- /.modal -->

</section>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
  $('.select2').select2({
    placeholder: 'Pilih Formulir',
    theme: 'bootstrap4',
    responsive: true,
    width: 'resolve'
  })
  <?php
    $condition = [];

    if($kupon['coupon_date_expired']) {
      $condition[] = [
        'id' => 1,
        'jenis' => 1,
        'value' => date('Y-m-d', strtotime($kupon['coupon_date_expired'])),
        'message' => 'Batas waktu penggunaan ' . date('d F Y', strtotime($kupon['coupon_date_expired']))
      ];
    }

    if($kupon['coupon_limit']) {
      $condition[] = [
        'id' => 2,
        'jenis' => 2,
        'value' => $kupon['coupon_limit'],
        'message' => 'Batas jumlah penggunaan hingga ' . $kupon['coupon_limit']
      ];
    }

    $custom_condition = json_decode($kupon['custom_condition'], true);
    if($custom_condition != null) {
      foreach($custom_condition as $cc) {
        $condition[] = [
          'id' => count($condition) + 1,
          'jenis' => 5,
          'value' => $cc,
          'message' => $cc
        ];
      }
    }
  ?>
  function kondisi() {
    return {
      kondisi_id: '',
      kondisi: <?= json_encode($condition); ?>,
      addKondisi() {
        const temp = {
          id: this.kondisi.length + 1,
          jenis: this.kondisi_id,
          value: '',
          message: ''
        }
        this.kondisi.push(temp)
        this.setMessage(this.kondisi.length - 1, temp.jenis)
        this.kondisi_id = ''
      },
      removeKondisi(index) {
        this.kondisi.splice(index, 1)
        this.setKondisiSummary()
      },
      setMessage(index, jenis) {
        if(jenis == 1) {
          this.kondisi[index].message = `Batas waktu penggunaan ${new Date(this.kondisi[index].value).toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'})}`
          this.$dispatch('condition-notes', this.kondisi)
          return
        }
        if(jenis == 2) {
          this.kondisi[index].message = `Sebanyak ${this.kondisi[index].value} kupon dapat digunakan`
          this.$dispatch('condition-notes', this.kondisi)
          return
        }
        if(jenis == 5) {
          this.kondisi[index].message =  `${this.kondisi[index].value}`
          this.$dispatch('condition-notes', this.kondisi)
          return
        }
      },
      setKondisiSummary() {
        this.$dispatch('condition-notes', this.kondisi)
      }
    }
  }
</script>
<?= $this->endSection(); ?>