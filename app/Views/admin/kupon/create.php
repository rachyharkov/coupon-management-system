<?= $this->extend('layouts/authenticated_layout'); ?>

<?= $this->section('title'); ?>
Buat Set Kupon
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<section class="content">
  <div class="container-fluid" style="max-width: 1024px;">
    <?= form_open(url_to('kupon.store'), ['id' => 'form', 'class' => 'form-horizontal', 'autocomplete' => 'off']); ?>
      <div class=" row">
        <div class="col-md-8">
          <div class="card mx-auto p-2" x-data="informasiDasar()">
            <div class="card-header">
              <h5 class="card-title">Informasi Dasar</h5>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="name">Judul Kupon</label>
                <input required type="text" class="form-control" id="name" name="nama" placeholder="Masukan Judul Kupon" x-model="title" x-on:input="$dispatch('preview-title', title)">
              </div>
              <div class="form-group">
                <div class="custom-control custom-radio">
                  <input required class="custom-control-input custom-control-input-primary custom-control-input-outline" value="all" type="radio" id="generateRandomCode" name="code_generate_mode" checked>
                  <label for="generateRandomCode" class="custom-control-label font-weight-normal">Bentuk Kode Acak</label>
                </div>
                <div class="custom-control custom-radio disabled">
                  <input required class="custom-control-input custom-control-input-primary custom-control-input-outline" disabled value="all" type="radio" id="generateSpecificCode" name="code_generate_mode">
                  <label for="generateSpecificCode" class="custom-control-label font-weight-normal">Buat Kode Spesifik (Currently under development)</label>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="code_total">Berapa Banyak?</label>
                    <input required type="number" class="form-control" name="code_total" id="code_total" placeholder="Masukan Angka" min="0" x-model.number="codeCount" x-on:input="codeCount = parseInt(codeCount, 10)">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="code_length">Jumlah Karakter Kode?</label>
                    <input required type="number" class="form-control" name="code_length" id="code_length" placeholder="Masukan Angka" min="0" max="12" x-model.number="codeLength" x-on:change="codeLength = parseInt(codeLength, 10)" x-on:input="codeLength = codeLength > 12 ? 12 : codeLength">
                  </div>
                </div>
              </div>
              <a href="#" @click="showAlert">Tampilkan Opsi Lanjutan</a>
            </div>
          </div>

          <div class="card" x-data="jenisKupon()">
            <div class="card-header">
              <h5 class="card-title">Jenis Kupon</h5>
            </div>
            <div class="card-body">
              <div class="form-group">
                <div class="custom-control custom-radio">
                  <input required class="custom-control-input custom-control-input-primary custom-control-input-outline" name="coupon_type" x-model="coupon_type" value="discount" type="radio" id="customRadio1">
                  <label for="customRadio1" class="custom-control-label font-weight-normal">Diskon</label>
                </div>
                <div class="custom-control custom-radio">
                  <input required class="custom-control-input custom-control-input-primary custom-control-input-outline" name="coupon_type" x-model="coupon_type" value="free_shipping" type="radio" id="customRadio2">
                  <label for="customRadio2" class="custom-control-label font-weight-normal">Gratis Ongkir</label>
                </div>
                <div class="custom-control custom-radio">
                  <input required class="custom-control-input custom-control-input-primary custom-control-input-outline" name="coupon_type" x-model="coupon_type" value="buy_x_free_y" type="radio" id="customRadio3">
                  <label for="customRadio3" class="custom-control-label font-weight-normal">Beli X Gratis Y</label>
                </div>
                <div class="custom-control custom-radio">
                  <input required class="custom-control-input custom-control-input-primary custom-control-input-outline" name="coupon_type" x-model="coupon_type" value="fixed_amount" type="radio" id="customRadio4">
                  <label for="customRadio4" class="custom-control-label font-weight-normal">Harga Fix</label>
                </div>
              </div>
            </div>
          </div>

          <div class="card" x-data="formNilaiKupon()" @coupon-type.window="setCouponForm($event.detail)">
            <div class="card-header">
              <h5 class="card-title">Nilai</h5>
              
              <template x-if="coupon_type == 'discount'">
                <div class="btn-group btn-group-sm btn-group-toggle float-right" data-toggle="buttons">
                  <label class="btn bg-secondary active">
                    <input required type="radio" name="coupon_value_type" id="option_b1" x-model="coupon_value_type" value="percentage"> Percentage
                  </label>
                  <label class="btn bg-secondary">
                    <input required type="radio" name="coupon_value_type" id="option_b2" x-model="coupon_value_type" value="fixed"> Fixed
                  </label>
                </div>
              </template>
            </div>
            <div class="card-body">
              <label for="diterapkan_pada">Diterapkan Pada <span x-text="coupon_applied_on"></span></label>
              <div class="form-group">
                <div class="custom-control custom-radio">
                  <input required class="custom-control-input custom-control-input-primary custom-control-input-outline" name="coupon_applied_on" value="single_product" type="radio" id="single_product" x-model="coupon_applied_on">
                  <label for="single_product" class="custom-control-label font-weight-normal">Produk Tunggal</label>
                </div>
                <div class="custom-control custom-radio">
                  <input required class="custom-control-input custom-control-input-primary custom-control-input-outline" name="coupon_applied_on" value="multiple_products" type="radio" id="multiple_products" x-model="coupon_applied_on">
                  <label for="multiple_products" class="custom-control-label font-weight-normal">Multi Produk</label>
                </div>
              </div>
              <ul>
                <template x-for="(product, index_product) in products" :key="index_product">
                  <li>
                    <?= view('admin/kupon/include/form_nilai_row') ?>
                    <hr class="my-3">
                  </li>
                </template>
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
                    <option value="<?= $value['id']; ?>"><?= $value['nama']; ?></option>
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
                  <p class="text-center text-secondary" x-show="kondisi.length == 0">
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
        <div class="col-md-4">
          <div class="card" x-data="summary()">
            <div class="card-header">
              <h4 class="card-title">Summary</h4>
            </div>
            <div class="card-body">
              <h4 class="text-start font-weight-bold" @preview-title.window="titlePreviewChange($event.detail);" x-text="title_preview">Judul Kupon</h4>
              <div class="badge badge-success" x-show="status" x-cloak>Aktif</div>
              <div class="badge badge-danger" x-show="!status" x-cloak>Tidak Aktif</div>
              <div class="row mt-2">
                <div class="col" @coupon-notes.window="setOverviewNotes($event.detail)" @condition-notes.window="setConditionNotes($event.detail)">
                  <ul class="pl-4">
                    <template x-for="(note_overview, index) in coupon_notes.overview" :key="index">
                      <li x-text="note_overview"></li>
                    </template>
                    <template x-if="coupon_notes.condition.length <= 0">
                      <template x-for="item in ['Tidak dibatasi waktu', 'Tidak dibatasi jumlah penggunaan kupon']" :key="index">
                        <li x-text="item"></li>
                      </template>
                    </template>
                    <template x-for="(note_condition, index) in coupon_notes.condition" :key="index">
                      <li x-text="note_condition.message"></li>
                    </template>
                  </ul>
                </div>
              </div>
              <hr class="my-2">
              <!-- create bordered coupon css -->
              <h4 class="text-start font-weight-bold"
              style="border: 4px dotted #bbb; padding: 10px; border-radius: 5px;" @preview-code.window="codePreviewChange($event.detail);" x-text="code_preview"></h4>-</h4>
            </div>
            <div class="card-footer">
              <div class="form-group">
                <div class="custom-control custom-switch custom-switch-on-success">
                  <input required type="checkbox" class="custom-control-input" id="switchCouponStatus" x-model="status">
                  <label class="custom-control-label" for="switchCouponStatus">
                    Coupon Status
                  </label>
                </div>
              </div>
            </div>
            
          </div>
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

  function informasiDasar() {
    return {
      title: '',
      deskripsi: '',
      codeCount: 0,
      codeLength: 0,
      init() {
        // watch codeCount and codeLength
        this.$watch('codeCount', (value) => {
          this.generateDummyCodePreview()
        })
        this.$watch('codeLength', (value) => {
          this.generateDummyCodePreview()
        })
      },
      switchStatus() {
        this.status = !this.status
      },
      generateDummyCodePreview() {
        const codeCount = this.codeCount == null || this.codeCount == '' ? 0 : this.codeCount
        const codeLength = this.codeLength == null || this.codeLength == '' ? 0 : this.codeLength
        
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let couponCode = '';

        // Generate random characters based on the specified length
        for (let i = 0; i < codeLength; i++) {
          const randomIndex = Math.floor(Math.random() * characters.length);
          couponCode += characters.charAt(randomIndex);
        }

        this.$dispatch('preview-code', couponCode)
      },
      showAlert() {
        Swal.fire({
          title: 'Segera Hadir',
          text: 'Fitur sedang dalam pengembangan',
          icon: 'info'
        })
      }
    }
  }

  function jenisKupon() {
    return {
      coupon_type: 'discount',
      init() {
        this.$watch('coupon_type', (value) => {
          this.$dispatch('coupon-type', value)
        })
      }
    }
  }

  function formNilaiKupon() {
    return {
      coupon_type: 'discount',
      coupon_value_type: 'percentage',
      coupon_type_label: 'Masukan Nilai Diskon',
      coupon_applied_on: 'single_product',
      products: [
        {
          name: '',
          coupon_value_price_old: 0,
          coupon_value_in_fixed: 0,
          coupon_value_in_percent: 0,
          coupon_value_in_buy: '',
          coupon_value_in_free: '',
        }
      ],
      init() {
        this.$watch('coupon_type', (value) => {
          this.setCouponForm(value)
        })
        
        this.$watch('coupon_applied_on', (value) => {
          if (value == 'single_product') {
            // remove all products except first product
            const products = this.products
            products.splice(1, products.length - 1)
            this.products = products
          }

          this.$nextTick(() => {
            console.log(this.coupon_type)
            this.setCouponForm(this.coupon_type)
          })
        })

        this.$nextTick(() => {
          this.setCouponForm(this.coupon_type)
        })
      },
      setCouponForm(type) {
        this.coupon_type = type
        switch (type) {
          case 'discount':
            this.coupon_type_label = 'Masukan Nilai Diskon'
            this.$dispatch('coupon-notes', [
              this.setMessageIfDiscount()[0],
            ])
            break;
          case 'free_shipping':
            this.coupon_type_label = 'Masukan nominal ongkos kirim yang dibebaskan'
            this.$dispatch('coupon-notes', [
              this.setMessageIfFreeShipping()
            ])
            break;
          case 'buy_x_free_y':
            this.coupon_type_label = 'Masukan syarat jumlah pembelian maupun produk apa yang harus dibeli, lalu masukan jumlah produk yang akan diberikan secara gratis'
            this.$dispatch('coupon-notes', [
              this.setMessageIfBuyXFreeY()
            ])
            break;
          default:
            this.coupon_type_label = 'Masukan Harga'
            this.$dispatch('coupon-notes', [
              this.setMessageIfFixedPrice()
            ])
            break;
        }
      },
      setMessageIfDiscount() {
        if(this.products.length > 1) {

          let max_discount = 0

          if (this.coupon_value_type == 'percentage') {
            max_discount = this.products.reduce((prev, current) => {
              return (prev.coupon_value_in_percent > current.coupon_value_in_percent) ? prev : current
            }).coupon_value_in_percent
          } else {
            max_discount = this.products.reduce((prev, current) => {
              return (prev.coupon_value_in_fixed > current.coupon_value_in_fixed) ? prev : current
            }).coupon_value_in_fixed
          }

          if (this.coupon_value_type == 'percentage') {
            return [`Diskon semuanya hingga ${max_discount}%`]
          } else {
            return [`Diskon semuanya hingga Rp. ${max_discount}`]
          }
        } else {
          if (this.coupon_value_type == 'percentage') {
            return [`Diskon ${this.products[0].coupon_value_in_percent}% untuk produk/jasa ini`]
          } else {
            return [`Diskon hingga Rp. ${this.products[0].coupon_value_in_fixed} untuk produk/jasa ini`]
          }
        }
      },
      setMessageIfFreeShipping() {
        // return `Ongkos Kirim Gratis Rp.${this.coupon_value_in_fixed}`
        if (this.products.length > 1) {
          const max_cutoff = this.products.reduce((prev, current) => {
            return (prev.coupon_value_in_fixed > current.coupon_value_in_fixed) ? prev : current
          }).coupon_value_in_fixed

          return [`Ongkos Kirim Gratis hingga Rp.${max_cutoff}`]
        } else {
          return [`Ongkos Kirim Gratis Rp.${this.products[0].coupon_value_in_fixed}`]
        }
      },
      setMessageIfBuyXFreeY() {
        return `Beli produk, Gratis produk lainnya`
      },
      setMessageIfFixedPrice() {
        // return `Dapatkan Harga Rp. ${this.coupon_value_in_fixed}`
        if (this.products.length > 1) {
          const max_cutoff = this.products.reduce((prev, current) => {
            return (prev.coupon_value_in_fixed > current.coupon_value_in_fixed) ? prev : current
          }).coupon_value_in_fixed

          return [`Dapatkan Harga hingga Rp.${max_cutoff}`]
        } else {
          return [`Dapatkan Harga Rp.${this.products[0].coupon_value_in_fixed}`]
        }
      },
      addProduct() {
        const temp = {
          name: '',
          coupon_value_price_old: 0,
          coupon_value_in_fixed: 0,
          coupon_value_in_percent: 0,
          coupon_value_in_buy: '',
          coupon_value_in_free: '',
        }
        this.products = [...this.products, temp]
        console.log('added')
      },
      resetValue() {
        this.coupon_value_price_old = 0
        this.coupon_value_in_fixed = 0
        this.coupon_value_in_percent = 0
        this.coupon_value_type = 'percentage'
        this.coupon_value_in_buy = ''
        this.coupon_value_in_free = ''
      }
    }
  }

  function kondisi() {
    return {
      kondisi_id: '',
      kondisi: [],
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

  function summary() {
    return {
      title_preview: null || 'Judul Kupon',
      code_preview: null || '-',
      coupon_notes: {
        overview : [],
        condition : [],
      },
      status: true,
      switchStatus() {
        this.status = !this.status
      },
      titlePreviewChange(title) {
        if (title == '') {
          this.title_preview = 'Judul Kupon'
        } else {
          this.title_preview = title
        }
      },
      codePreviewChange(code) {
        if (code == '') {
          this.code_preview = '-'
        } else {
          this.code_preview = code
        }
      },
      setOverviewNotes(messages) {
        this.coupon_notes.overview = [...messages]
      },
      setConditionNotes(messages) {
        this.coupon_notes.condition = [...messages]
      }
    }
  }
</script>
<?= $this->endSection(); ?>