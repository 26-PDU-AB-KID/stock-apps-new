<h1><?= $title; ?></h1>

<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addProduct"><i class="fas fa-plus"></i> Add New Product</button>

<table class="table table-border">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Barcode</th>
      <th scope="col">Name</th>
      <th scope="col">Weight</th>
      <th scope="col">Unit</th>
      <th scope="col">Cost of Goods</th>
      <th scope="col">Selling Price of Goods</th>
      <th scope="col">Stock</th>
      <th scope="col" class="text-center">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php $no=1; ?>
    <?php foreach($products as $product) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $product['barcode'] ?></td>
            <td><?= ucwords($product['product_name']) ?></td>
            <td class="text-right"><?= $product['weight'] ?></td>
            <td><?= ucwords($product['product_unit']) ?></td>
            <td class="text-right"><?= 'Rp' . number_format($product['cost_of_goods'],0,",",".") ?></td>
            <td class="text-right"><?= 'Rp' . number_format($product['selling_price_of_goods'],0,",",".") ?></td>
            <td class="text-right"><?= $product['stock'] ?></td>
            <td class="text-center">
                <button class="btn btn-sm btn-success" data-target="#editProduct<?= $product['id'] ?>" data-toggle="modal"><i class="fas fa-edit"></i> Edit</button>
                <button class="btn btn-sm btn-danger" data-target="#deleteProduct<?= $product['id'] ?>" data-toggle="modal"><i class="fas fa-trash-alt"></i> Delete</button>
            </td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<!-- Modal Add Product -->
<div class="modal fade" id="addProduct" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bolder" id="addProductLabel">Form Add New product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?= base_url('product/addProduct') ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bolder" for="barcode">Barcode</label>
                        <input type="number" class="form-control form-control-sm" id="barcode" name="barcode" placeholder="Enter Product Barcode..." required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bolder" for="name">Name</label>
                        <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Enter Product Name..." required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bolder" for="product_unit">Product Unit</label>
                        <input type="text" class="form-control form-control-sm" id="product_unit" name="product_unit" placeholder="Enter Product Unit... ex(gram)" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bolder" for="weight">Weight</label>
                        <input type="text" class="form-control form-control-sm" id="weight" name="weight" placeholder="Enter Product Weight... ex(500)" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bolder" for="cost_of_goods">Cost of Goods</label>
                        <input type="number" class="form-control form-control-sm" id="cost_of_goods" name="cost_of_goods" placeholder="Enter Cost of Goods..." required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bolder" for="selling_price_of_goods">Selling Price of Goods</label>
                        <input type="number" class="form-control form-control-sm" id="selling_price_of_goods" name="selling_price_of_goods" placeholder="Enter Selling Price of Goods..." required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bolder" for="raw_material">Raw Material</label>
                        <select class="form-control form-control-sm" id="raw_material" name="raw_material">
                            <option value="0" disabled selected>Select Raw Material</option>
                            <?php foreach ($raw_materials as $raw_material) : ?>
                                <option value="<?= $raw_material['id'] ?>"><?= ucwords($raw_material['raw_material_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Product -->
<?php foreach($products as $product) : ?>
<div class="modal fade" id="editProduct<?= $product['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editProductLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bolder" id="editProductLabel">Form Edit <?= ucwords($product['product_name']) ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?= base_url('product/editProduct') ?>">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $product['id'] ?>">
                    <div class="form-group">
                        <label class="font-weight-bolder" for="barcode">Barcode</label>
                        <input type="number" class="form-control form-control-sm" name="barcode" value="<?= $product['barcode'] ?>" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bolder" for="name">Name</label>
                        <input type="text" class="form-control form-control-sm" name="name" value="<?= $product['product_name'] ?>" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bolder" for="product_unit">Product Unit</label>
                        <input type="text" class="form-control form-control-sm" name="product_unit" value="<?= ucwords($product['product_unit']) ?>" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bolder" for="weight">Weight</label>
                        <input type="text" class="form-control form-control-sm" name="weight" value="<?= $product['weight'] ?>" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bolder" for="cost_of_goods">Cost of Goods</label>
                        <input type="number" class="form-control form-control-sm" name="cost_of_goods" value="<?= $product['cost_of_goods'] ?>" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bolder" for="selling_price_of_goods">Selling Price of Goods</label>
                        <input type="number" class="form-control form-control-sm" name="selling_price_of_goods" value="<?= $product['selling_price_of_goods'] ?>" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bolder" for="raw_material">Raw Material</label>
                        <select class="form-control form-control-sm" name="raw_material">
                            <option value="0" disabled selected>Select Raw Material</option>
                            <?php foreach ($raw_materials as $raw_material) : ?>
                                <option value="<?= $raw_material['id'] ?>" <?php if($raw_material['id'] == $product['raw_material_id']) : ?> selected <?php endif; ?>><?= ucwords($raw_material['raw_material_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
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

<!-- Modal Delete Product -->
<?php foreach($products as $product) : ?>
<div class="modal fade" id="deleteProduct<?= $product['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="deleteProductLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bolder" id="deleteProductLabel">Form Delete <?= ucwords($product['product_name']) ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?= base_url('product/deleteProduct') ?>">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $product['id'] ?>">
                    <div class="form-group">
                        <label class="font-weight-bolder">Reason of Delete</label>
                        <textarea class="form-control form-control-sm" name="remark" required autocomplete="off"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i> Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>