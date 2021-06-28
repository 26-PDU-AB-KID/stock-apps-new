<h1>Detail Supplier</h1>

<div class="col-6">
  <table class="table table-borderless">
      <tr>
        <td>Name</td>
        <td>: <?= ucwords($supplier['name']) ?></td>
      </tr>
      <tr>
        <td>Address</td>
        <td>: <?= $supplier['address'] ?></td>
      </tr>
  </table>
</div>

<div class="row px-5 mt-5">
  <div class="col-6">
    <h4>Available Raw Materials</h4>
    <table class="table table-borderless">
      <?php $id_detail_raw_materials[] = 0; ?>
      <?php foreach($detail_raw_materials as $detail_raw_material) : 
        $id_detail_raw_materials[] = $detail_raw_material['raw_material_id'];
      ?>
      <tr>
        <td><?= ucwords($detail_raw_material['raw_material_name']) ?></td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
  <div class="col-6">
    <h4>Not Available Raw Materials</h4>
    <table class="table table-borderless">
      <?php foreach($raw_materials as $raw_material) : ?>
        <?php if( in_array($raw_material['id'], $id_detail_raw_materials) ) : ?>
          <?php else : ?>
            <tr>
              <td>
                <?= ucwords($raw_material['raw_material_name']) ?>
              </td>
              <td class="text-right">
              <button class="btn btn-sm btn-primary" data-target="#addRawMaterial<?= $raw_material['id'] ?>" data-toggle="modal"><i class="fas fa-plus"></i> Add</button>
              </td>
            </tr>
        <?php endif; ?>
      <?php endforeach; ?>
    </table>
  </div>
</div>

<div class="row px-5 mt-3">
  <div class="col-6">
    <h4>Available Products</h4>
    <table class="table table-borderless">
      <?php $id_detail_products[] = 0; ?>
      <?php foreach($detail_products as $detail_product) : 
        $id_detail_products[] = $detail_product['product_id'];
      ?>
      <tr>
        <td><?= ucwords($detail_product['product_name']) ?> <?= $detail_product['weight'] ?> <?= ucwords($detail_product['product_unit']) ?></td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
  <div class="col-6">
    <h4>Not Available Products</h4>
    <table class="table table-borderless">
      <?php foreach($products as $product) : ?>
        <?php if( in_array($product['id'], $id_detail_products) ) : ?>
          <?php else : ?>
            <tr>
              <td>
                <?= ucwords($product['product_name']) ?> <?= $product['weight'] ?> <?= ucwords($product['product_unit']) ?>
              </td>
              <td class="text-right">
              <button class="btn btn-sm btn-primary" data-target="#addProduct<?= $product['id'] ?>" data-toggle="modal"><i class="fas fa-plus"></i> Add</button>
              </td>
            </tr>
        <?php endif; ?>
      <?php endforeach; ?>
    </table>
  </div>
</div>

<!-- Modal Add Raw Material -->
<?php foreach($raw_materials as $raw_material) : ?>
<div class="modal fade" id="addRawMaterial<?= $raw_material['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addRaw_materialLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bolder" id="addRaw_materialLabel">Are You Sure Want to Add <?= ucwords($raw_material['raw_material_name']) ?> ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?= base_url('supplier/addDetailRawMaterial') ?>">
                <div class="modal-body">
                <input type="hidden" name="supplier_id" value="<?= $supplier['id'] ?>">
                <input type="hidden" name="address" value="<?= $address ?>">
                <input type="hidden" name="raw_material_id" value="<?= $raw_material['id'] ?>">
                <p>Choose "Save" below when you are sure to add this raw material.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- Modal Add Product -->
<?php foreach($products as $product) : ?>
<div class="modal fade" id="addProduct<?= $product['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bolder" id="addProductLabel">Are You Sure Want to Add <?= ucwords($product['product_name']) ?> <?= $product['weight'] ?> <?= ucwords($product['product_unit']) ?> ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?= base_url('supplier/addDetailProduct') ?>">
                <div class="modal-body">
                <input type="hidden" name="supplier_id" value="<?= $supplier['id'] ?>">
                <input type="hidden" name="address" value="<?= $address ?>">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                <input type="hidden" name="raw_material_id" value="<?= $product['raw_material_id'] ?>">
                <p>Choose "Save" below when you are sure to add this product.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>