<h1><?= $title ?> <?= ucwords($products['product_name']) ?> <?= $products['weight'] ?> <?= ucwords($products['product_unit']) ?></h1>

<div class="container">
  <div class="row mt-5">
    <div class="col-6">
      <div class="card">
        <div class="card-header">
            Product to be converted
        </div>
        <div class="card-body">
          <blockquote class="blockquote mb-0">
            <p><?= $amount ?> Pcs</p>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="card">
        <div class="card-header">
          Will reduce stock by
        </div>
        <div class="card-body">
          <blockquote class="blockquote mb-0">
            <p><?= $amount * $products['per_pcs'] ?> <?= $products['unit_name'] ?></p>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-5">
    <div class="col-6">
      <div class="card">
        <div class="card-header">
          Stock Product Become
        </div>
        <div class="card-body">
          <blockquote class="blockquote mb-0">
            <p><?= $products['amount'] + $amount ?> Pcs</p>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="card">
        <div class="card-header">
          Stock Left
        </div>
        <div class="card-body">
          <blockquote class="blockquote mb-0">
            <p><?= $stock_raw_materials['amount'] - ($amount * $products['per_pcs']) ?> <?= $products['unit_name'] ?></p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container mt-5">
  <div class="row">
    <div class="col-6 offset-3 text-center">
    <form method="POST" action="<?= base_url('Convert/convertProcess') ?>">
      <input type="hidden" class="form-control form-control-sm" name="raw_material" value="<?= $products['raw_material_id'] ?>">
      <input type="hidden" class="form-control form-control-sm" name="product" value="<?= $products['product_id'] ?>">
      <input type="hidden" class="form-control form-control-sm" name="supplier" value="<?= $stock_raw_materials['supplier_id'] ?>">
      <input type="hidden" class="form-control form-control-sm" name="amount_raw_material" value="<?= $amount * $products['per_pcs']  ?>">
      <input type="hidden" class="form-control form-control-sm" name="amount_product" value="<?= $amount ?>">
      <button type="submit" class="btn btn-lg btn-primary">Convert</button>
    </form>
    </div>
  </div>
</div>