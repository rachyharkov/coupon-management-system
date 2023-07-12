<div class="row">
  <? print_r($kupon_product); ?>
  <div class="form-group col-12">
    <input disabled class="form-control" name="product_name[]" placeholder="Masukan Nama Produk" value="<?= $kupon_product['product_name'] ?>">
  </div> 
  <div class="form-group col-12">
    <?php
     if($kupon_type == 'discount') {
      ?>
      <div class="row">
        <div class="form-group mb-3 col-6">
          <label for="price_old">Harga Asli</span></label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Rp</span>
            </div>
            <input disabled type="number" class="form-control" id="price_old" placeholder="Masukan Nilai" min="0" value="<?= $kupon_product['price_original'] ?>">
          </div>
        </div>
        <div class="form-group mb-3 col-6">
          <label for="value">Potongan <span x-text="coupon_value_type"></label>
          <?php 
           if($kupon_value_type == 'percentage') {
            ?>
            <div class="input-group">
              <input disabled type="number" class="form-control" id="value" placeholder="Masukan Nilai" min="0" max="100" value="<?= $kupon_product['discount_percentage'] ?>">
              <div class="input-group-append">
                <span class="input-group-text">%</span>
              </div>
            </div>
            <?php
           } ?>
          <?php 
           if($kupon_value_type == 'fixed') {
            ?>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Rp</span>
                </div>
                <input disabled type="number" class="form-control" id="value" value="<?= $kupon_product['discount_fixed'] ?>">
              </div>
            <?php
           } ?>
        </div>
      </div>
    <?php
     } elseif($kupon_type == 'free_shipping') {
      ?>
      <div class="input-group">
        <div class="input-group-append">
          <span class="input-group-text">Rp</span>
        </div>
        <input disabled x-on:change="setCouponForm(coupon_type)" disabled type="number" class="form-control" id="value" value="<?= $kupon_product['discount_fixed'] ?>">
      </div>
    <?php
     } elseif($kupon_type == 'buy_x_free_y') {
      ?>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">Beli</span>
        </div>
        <input disabled x-on:change="setCouponForm(coupon_type)" type="text" class="form-control" value="<?= $kupon_product['value_buy'] ?>">
        <div class="input-group-append">
          <span class="input-group-text">Gratis</span>
        </div>
        <input disabled x-on:change="setCouponForm(coupon_type)" type="text" class="form-control" value="<?= $kupon_product['value_free'] ?>">
      </div>
    <?php
     } elseif($kupon_type == 'fixed_amount') {
      ?>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">Rp</span>
        </div>
        <input disabled x-on:change="setCouponForm(coupon_type)" disabled type="number" class="form-control" id="value" value="<?= $kupon_product['value_fixed'] ?>">
      </div>
      <?php
     } ?>
  </div>
</div>