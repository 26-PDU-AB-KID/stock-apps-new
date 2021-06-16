<h1>Stock Raw Material <?= ucwords($raw_material['name']) ?></h1>
<?php if($detail_raw_material != NULL) : ?>
  <h4>Amount <?= $detail_raw_material['stock']; ?> <?= $detail_raw_material['unit_name']; ?></h4>
<?php endif; ?>

<table class="table table-border">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Supplier Name</th>
      <th scope="col">Stock</th>
      <th scope="col" class="text-center">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php $no=1; ?>
    <?php foreach($stock_raw_materials as $stock_raw_material) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= ucwords($stock_raw_material['supplier_name']) ?></td>
            <td><?= ($stock_raw_material['amount'] == NULL) ? '0' : $stock_raw_material['amount'] ?></td>
            <td class="text-center">
                <a class="btn btn-sm btn-primary" href="<?= base_url('raw_material/stockIn/'. $stock_raw_material['stock_raw_material_id'] . '/' . $stock_raw_material['supplier_id'] . '/' . $stock_raw_material['raw_material_id'] . '/' . md5($stock_raw_material['supplier_name'])) ?>"><i class="fas fa-info"></i> Stock In</a>
            </td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>