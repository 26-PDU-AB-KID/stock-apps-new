<h1>Raw Material</h1>

<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addRawMaterial"><i class="fas fa-plus"></i> Add New Raw Material</button>

<table class="table table-border">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Code</th>
      <th scope="col">Name</th>
      <th scope="col">Unit</th>
      <th scope="col">Stock</th>
      <th scope="col" class="text-center">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php $no=1; ?>
    <?php foreach($raw_materials as $raw_material) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $raw_material['code'] ?></td>
            <td><?= ucwords($raw_material['raw_material_name']) ?></td>
            <td><?= $raw_material['unit_name'] ?></td>
            <td><?= ($raw_material['stock'] == NULL) ? '0' : $raw_material['stock'] ?></td>
            <td class="text-center">
                <a class="btn btn-sm btn-primary" href="<?= base_url('raw_material/detailRawMaterial/'. $raw_material['code'] . '/' . md5($raw_material['id'])) ?>"><i class="fas fa-info"></i> Detail</a>
                <button class="btn btn-sm btn-success" data-target="#editRawMaterial<?= $raw_material['id'] ?>" data-toggle="modal"><i class="fas fa-edit"></i> Edit</button>
                <button class="btn btn-sm btn-danger" data-target="#deleteRawMaterial<?= $raw_material['id'] ?>" data-toggle="modal"><i class="fas fa-trash-alt"></i> Delete</button>
            </td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<!-- Modal Add Raw Material -->
<div class="modal fade" id="addRawMaterial" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addRawMaterialLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bolder" id="addRawMaterialLabel">Form Add New Raw Material</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?= base_url('raw_material/addRawMaterial') ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bolder" for="name">Name</label>
                        <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Enter Raw Material name..." required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bolder" for="unit">Unit</label>
                        <select class="form-control form-control-sm" id="unit" name="unit">
                            <option value="0" disabled selected>Select Unit</option>
                            <?php foreach ($units as $unit) : ?>
                                <option value="<?= $unit['id'] ?>"><?= $unit['name'] ?></option>
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

<!-- Modal Edit Raw Material -->
<?php foreach($raw_materials as $raw_material) : ?>
<div class="modal fade" id="editRawMaterial<?= $raw_material['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editRawMaterialLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bolder" id="editRawMaterialLabel">Form Edit Raw Material <?= ucwords($raw_material['raw_material_name']) ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?= base_url('raw_material/editRawMaterial') ?>">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $raw_material['id'] ?>">
                    <div class="form-group">
                        <label class="font-weight-bolder" for="name">Name</label>
                        <input type="text" class="form-control form-control-sm" name="name" value="<?= ucwords($raw_material['raw_material_name']) ?>" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bolder" for="unit">Unit</label>
                        <select class="form-control form-control-sm" name="unit">
                            <option value="0" disabled selected>Select Unit</option>
                            <?php foreach ($units as $unit) : ?>
                                <option value="<?= $unit['id'] ?>" <?php if ($unit['id'] == $raw_material['unit_id']) : ?> selected <?php endif ?>><?= $unit['name'] ?></option>
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

<!-- Modal Delete RawMaterial -->
<?php foreach($raw_materials as $raw_material) : ?>
<div class="modal fade" id="deleteRawMaterial<?= $raw_material['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="deleteRawMaterialLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bolder" id="deleteRawMaterialLabel">Form Delete raw_material <?= $raw_material['raw_material_name'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?= base_url('raw_material/deleteRawMaterial') ?>">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $raw_material['id'] ?>">
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