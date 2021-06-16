<h1>Customer</h1>

<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addCustomer"><i class="fas fa-plus"></i> Add New Customer</button>

<table class="table table-border">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Code</th>
      <th scope="col">Name</th>
      <th scope="col">PIC</th>
      <th scope="col">Phone</th>
      <th scope="col">Address</th>
      <th scope="col" class="text-center">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php $no=1; ?>
    <?php foreach($customers as $customer) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $customer['code'] ?></td>
            <td><?= ucwords($customer['name']) ?></td>
            <td><?= ucwords($customer['pic']) ?></td>
            <td><?= $customer['phone'] ?></td>
            <td><?= $customer['address'] ?></td>
            <td class="text-center">
                <button class="btn btn-sm btn-success" data-target="#editCustomer<?= $customer['id'] ?>" data-toggle="modal"><i class="fas fa-edit"></i> Edit</button>
                <button class="btn btn-sm btn-danger" data-target="#deleteCustomer<?= $customer['id'] ?>" data-toggle="modal"><i class="fas fa-trash-alt"></i> Delete</button>
            </td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<!-- Modal Add Customer -->
<div class="modal fade" id="addCustomer" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addcustomerLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bolder" id="addCustomerLabel">Form Add New Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?= base_url('customer/addCustomer') ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bolder" for="name">Name</label>
                        <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Enter customer name..." required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bolder" for="pic">PIC</label>
                        <input type="text" class="form-control form-control-sm" id="pic" name="pic" placeholder="Enter customer PIC..." required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bolder" for="phone">Phone</label>
                        <input type="number" class="form-control form-control-sm" id="phone" name="phone" placeholder="Enter customer phone number..." required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bolder" for="address">Address</label>
                        <textarea class="form-control form-control-sm" id="address" name="address" rows="3" placeholder="Enter customer address..." required autocomplete="off"></textarea>
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

<!-- Modal Edit customer -->
<?php foreach($customers as $customer) : ?>
<div class="modal fade" id="editCustomer<?= $customer['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editcustomerLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bolder" id="editCustomerLabel">Form Edit customer <?= ucwords($customer['name']) ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?= base_url('customer/editCustomer') ?>">
                <div class="modal-body">
                <input type="hidden" id="id" name="id" value="<?= $customer['id'] ?>">
                    <div class="form-group">
                        <label class="font-weight-bolder" for="name">Name</label>
                        <input type="text" class="form-control form-control-sm" id="name" name="name" value="<?= ucwords($customer['name']) ?>" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bolder" for="pic">PIC</label>
                        <input type="text" class="form-control form-control-sm" id="pic" name="pic" value="<?= ucwords($customer['pic']) ?>" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bolder" for="phone">phone</label>
                        <input type="number" class="form-control form-control-sm" id="phone" name="phone" value="<?= $customer['phone'] ?>" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bolder" for="address">Address</label>
                        <textarea class="form-control form-control-sm" id="address" name="address" rows="3"  required autocomplete="off"><?= $customer['address'] ?></textarea>
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

<!-- Modal Delete Customer -->
<?php foreach($customers as $customer) : ?>
<div class="modal fade" id="deleteCustomer<?= $customer['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="deletecustomerLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bolder" id="deletecustomerLabel">Form Delete Customer <?= $customer['name'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?= base_url('customer/deleteCustomer') ?>">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $customer['id'] ?>">
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