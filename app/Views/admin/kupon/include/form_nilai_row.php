<div class="row">
  <div class="form-group col-12">
    <input required class="form-control" name="product_name[]" placeholder="Masukan Nama Produk" x-model="product.name">
  </div> 
  <div class="form-group col-12">
    <template x-if="coupon_type == 'discount'">
      <div class="row">
        <div class="form-group mb-3 col-6">
          <label for="price_old">Harga Asli</span></label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Rp</span>
            </div>
            <input required x-on:change="setCouponForm(coupon_type)" type="number" class="form-control" id="price_old" name="coupon_value_in_price_original[]" placeholder="Masukan Nilai" min="0" x-model.number="product.coupon_value_price_old" x-on:input="product.coupon_value_price_old = parseInt(product.coupon_value_price_old, 10)">
          </div>
        </div>
        <div class="form-group mb-3 col-6">
          <label for="value">Potongan <span x-text="coupon_value_type"></label>
          <template x-if="coupon_value_type == 'percentage'">
            <div class="input-group">
              <input required x-on:change="setCouponForm(coupon_type)" type="number" class="form-control" id="value" name="coupon_value_in_discount_percentage[]" placeholder="Masukan Nilai" min="0" max="100" x-model.number="product.coupon_value_in_percent" x-on:input="product.coupon_value_in_percent = Math.min(product.coupon_value_in_percent, 100); product.coupon_value_in_percent = parseInt(product.coupon_value_in_percent,10)">
              <div class="input-group-append">
                <span class="input-group-text">%</span>
              </div>
            </div>
          </template>
          <template x-if="coupon_value_type == 'fixed'">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Rp</span>
              </div>
              <input required x-on:change="setCouponForm(coupon_type)" type="number" class="form-control" id="value" name="coupon_value_in_discount_fixed[]" placeholder="Masukan Nilai" min="0" x-model.number="product.coupon_value_in_fixed" x-on:input="product.coupon_value_in_fixed = parseInt(product.coupon_value_in_fixed, 10)">
            </div>
          </template>
        </div>
      </div>
    </template>
    <template x-if="coupon_type == 'free_shipping'">
      <div class="input-group">
        <div class="input-group-append">
          <span class="input-group-text">Rp</span>
        </div>
        <input required x-on:change="setCouponForm(coupon_type)" type="number" class="form-control" id="value" placeholder="Masukan Nilai" min="0" name="coupon_value_in_fixed[]" x-model.number="product.coupon_value_in_fixed" x-on:input="product.coupon_value_in_fixed = parseInt(product.coupon_value_in_fixed, 10)">
      </div>
    </template>
    <template x-if="coupon_type == 'buy_x_free_y'">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">Beli</span>
        </div>
        <input required x-on:change="setCouponForm(coupon_type)" type="text" class="form-control" name="coupon_value_in_buy[]" placeholder="Masukan Nilai" x-model="product.coupon_value_in_buy">
        <div class="input-group-append">
          <span class="input-group-text">Gratis</span>
        </div>
        <input required x-on:change="setCouponForm(coupon_type)" type="text" class="form-control" name="coupon_value_in_free[]" placeholder="Masukan Nilai" x-model="product.coupon_value_in_free">
      </div>
    </template>
    <template x-if="coupon_type == 'fixed_amount'">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">Rp</span>
        </div>
        <input required x-on:change="setCouponForm(coupon_type)" type="number" class="form-control" id="value" placeholder="Masukan Nilai" min="0" max="100" name="coupon_value_in_fixed[]" x-model.number="product.coupon_value_in_fixed" x-on:input="product.coupon_value_in_fixed = parseInt(product.coupon_value_in_fixed, 10)">
      </div>
    </template>
  </div>
</div>