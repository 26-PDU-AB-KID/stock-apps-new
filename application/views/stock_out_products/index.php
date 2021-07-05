<h1><?= $title ?></h1>

<form method="POST" action="<?= base_url('Stock_out_product/add_to_cart') ?>">
    <div class="row mx-3">
        <div class="col-md-4">
            <div class="form-group">
                <label class="font-weight-bolder" for="supplier">Supplier</label>
                <select class="form-control form-control-sm" id="supplier" name="supplier">
                    <option value="0" disabled selected>Select Supplier</option>
                    <?php foreach ($suppliers as $supplier) : ?>
                        <option value="<?= $supplier['id'] ?>"><?= ucwords($supplier['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="font-weight-bolder" for="product">Product</label>
                <select class="form-control form-control-sm" id="product" name="product">
                    <?php if (count($_POST)) : ?>

                    <?php else : ?>
                        <option value="0" selected disabled>Select Supplier First</option>
                    <?php endif ?>

                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="font-weight-bolder" for="amount">Amount</label>
                <input type="number" class="form-control form-control-sm" id="amount" name="amount" placeholder="Enter Amount" required autocomplete="off">
            </div>
        </div>
        <div>
            <button type="submit" class="btn btn-sm btn-primary float-right">Save</button>
        </div>
    </div>
</form>

<div class="row mx-1 mt-5">
    <table class="table table-border">
    <thead>
        <tr>
        <th scope="col">No</th>
        <th scope="col">Name</th>
        <th scope="col">Supplier</th>
        <th scope="col">Price</th>
        <th scope="col">Qty</th>
        <th scope="col"></th>
        <th scope="col">Sub Total</th>
        <th scope="col" class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; ?>
        <?php foreach($this->cart->contents() as $items) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= ucwords($items['name']) ?> <?= $items['weight'] ?> <?= $items['product_unit'] ?></td>
                <td><?= $items['supplier_id'] ?></td>
                <td><?= $items['price'] ?></td>
                <td><?= $items['qty'] ?></td>
                <td><button type="submit" class="btn btn-sm btn-info"><span class="fa fa-plus"></button></td>
                <td><?= $items['subtotal'] ?></td>
                <td class="text-center">
                  <a href="<?= base_url('stock_out_product/remove/'.$items['rowid']); ?>" class="btn btn-danger btn-sm">
                  <i class="fas fa-times"></i>
                  </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
</div>

<script>
    document.getElementById('supplier').addEventListener('change', function() {

        fetch("<?= base_url('Stock_out_product/getProduct/') ?>" + this.value, {
                method: 'GET',
            })
            .then((response) => response.text())
            .then((data) => {
                console.log(data)
                document.getElementById('product').innerHTML = data
            })
    })
</script>