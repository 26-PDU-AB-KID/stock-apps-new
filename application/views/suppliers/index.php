<h1>Supplier</h1>

<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addSupplier"><i class="fas fa-plus"></i> Add New Supplier</button>

<table class="table table-border">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Name</th>
      <th scope="col">Address</th>
      <th scope="col" class="text-center">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php $no=1; ?>
    <?php foreach($suppliers as $supplier) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= ucwords($supplier['name']) ?></td>
            <td><?= $supplier['address'] ?></td>
            <td class="text-center">
            <a class="btn btn-sm btn-primary" href="<?= base_url('supplier/detailSupplier/'. $supplier['id'] . '/' . md5($supplier['address'])) ?>"><i class="fas fa-info"></i> Detail</a>
                <button class="btn btn-sm btn-success" data-target="#editSupplier<?= $supplier['id'] ?>" data-toggle="modal"><i class="fas fa-edit"></i> Edit</button>
                <button class="btn btn-sm btn-danger" data-target="#deleteSupplier<?= $supplier['id'] ?>" data-toggle="modal"><i class="fas fa-trash-alt"></i> Delete</button>
            </td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<!-- Modal Add Supplier -->
<div class="modal fade" id="addSupplier" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addSupplierLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bolder" id="addSupplierLabel">Form Add New Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?= base_url('supplier/addSupplier') ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bolder" for="name">Name</label>
                        <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Enter supplier name..." required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bolder" for="address">Address</label>
                        <textarea class="form-control form-control-sm" id="address" name="address" rows="3" placeholder="Enter supplier address..." required autocomplete="off"></textarea>
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

<!-- Modal Edit Supplier -->
<?php foreach($suppliers as $supplier) : ?>
<div class="modal fade" id="editSupplier<?= $supplier['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editSupplierLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bolder" id="editSupplierLabel">Form Edit Supplier <?= $supplier['name'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?= base_url('supplier/editSupplier') ?>">
                <div class="modal-body">
                    <input type="hidden" id="id" name="id" value="<?= $supplier['id'] ?>">
                    <div class="form-group">
                        <label class="font-weight-bolder" for="name">Name</label>
                        <input type="text" class="form-control form-control-sm" id="name" name="name" value="<?= ucwords($supplier['name']) ?>" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bolder" for="address">Address</label>
                        <textarea class="form-control form-control-sm" id="address" name="address" rows="3"  required autocomplete="off"><?= $supplier['address'] ?></textarea>
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

<!-- Modal Delete Supplier -->
<?php foreach($suppliers as $supplier) : ?>
<div class="modal fade" id="deleteSupplier<?= $supplier['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="deleteSupplierLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bolder" id="deleteSupplierLabel">Form Delete Supplier <?= $supplier['name'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?= base_url('supplier/deleteSupplier') ?>">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $supplier['id'] ?>">
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