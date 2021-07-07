<h1><?= $title ?></h1>

<form method="POST" action="<?= base_url('Stock_out_product/add_to_cart') ?>">
    <div class="row mx-3">
        <div class="col-md-6">
            <div class="form-group">
                <label class="font-weight-bolder" for="product">Product</label>
                <select class="form-control form-control-sm" id="product" name="product">
                    <option value="0" disabled selected>Select Product</option>
                    <?php foreach ($products as $product) : ?>
                        <option value="<?= $product['id'] ?>"><?= ucwords($product['product_name']) ?> <?= $product['weight'] ?> <?= ucwords($product['product_unit']) ?> | Stock : <?= $product['amount'] ?> </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="font-weight-bolder" for="amount">Amount</label>
                <input type="number" class="form-control form-control-sm" id="amount" name="amount" placeholder="Enter Amount" required autocomplete="off">
            </div>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-sm btn-primary" style="margin-top: 2rem">Save</button>
        </div>
    </div>
</form>

<div class="row mx-1 mt-5">
    <table class="table table-border">
    <thead>
        <tr>
        <th scope="col">No</th>
        <th scope="col">Name</th>
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
                <td><?= ucwords($items['name']) ?> <?= $items['weight'] ?> <?= ucwords($items['product_unit']) ?></td>
                <td>Rp <?= number_format($items['price']) ?></td>
                <form action="<?= base_url('stock_out_product/update_qty'); ?>" method="POST">
                  <td>
                    <input type="hidden" name="rowId" value="<?= $items['rowid'] ?>">
                    <input type="hidden" name="product_id" value="<?= $items['id'] ?>">
                    <input class="form-control form-control-sm" type="number" name="qty" value="<?= $items['qty'];?>" style="width: 75px; margin: auto; margin-top: -5px; font-size: 1em;">    
                  </td>
                  <td>
                    <div class="text-center mt-n1">
                        <button type="submit" class="btn btn-sm btn-info"><span class="fa fa-plus"></button>
                    </div>
                  </td>
                </form>
                <td>Rp <?= number_format($items['subtotal']) ?></td>
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

<div class="container mt-5">
    <form method="POST" action="<?= base_url('stock_out_product/checkout'); ?>">
        <div class="form-row">
          <div class="col text-right font-weight-bold mt-1 mr-1">
            <label>Total Price (Rp)</label>
          </div>
          <div class="col">
            <input class="form-control text-right" type="text" value="<?= number_format($this->cart->total(), 0, ",", ".");?>" readonly>
            <input type="hidden" id="total" name="total_price" value="<?= $this->cart->total(); ?>">
          </div>
        </div>
        <div class="form-row mt-1">
            <div class="col text-right font-weight-bold mt-1 mr-1">
            <label for="customer">Customer</label>
            <a href="<?= base_url('customer') ?>" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus-square text-white"></i>
            </a>
            </div>
            <div class="col">
            <select class="form-control selectpicker" name="customer" data-live-search="true" title="Select Customer">
                <option selected disabled>Select Customer</option>
                <?php foreach ($customers as $customer) : ?>
                <option value="<?= $customer['id'] ?>"><?= ucwords($customer['name']) ?> | PIC : <?= ucwords($customer['pic']) ?> </option>
                <?php endforeach; ?>
            </select>
            </div>
        </div>
        <div class="form-row mt-1">
            <div class="col-6 text-right font-weight-bold mt-1 mr-1">
            <label for="">Shipping</label>
            </div>
            <div class="col-1">
            <input class="form-control form-control-sm" type="checkbox" name="shipping" onclick="if(this.checked){myFunction()}else{myFunction2()}" style="margin-top: 3px;">
            </div>
            <div class="col" id="amount_shipping"></div>
        </div>
        <div class="form-row mt-1">
            <div class="col text-right font-weight-bold mt-1 mr-1">
            <label for="">Payment</label>
            </div>
            <div class="col">
            <select class="form-control selectpicker" name="payment" title="Select Payment">
                <option value="Cash">Cash</option>
                <option value="Transfer">Transfer</option>
            </select>
            </div>
        </div>
        <div class="form-row mt-1">
            <div class="col text-right font-weight-bold mt-1 mr-1">
            <label for="">PPN</label>
            </div>
            <div class="col">
            <select name="ppn" class="form-control selectpicker" title="Select This...">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
            <button type="submit" class="btn btn-primary float-right">
                <i class="fas fa-save"></i> Save Sale
            </button>
            </div>
        </div>
    </form>
</div>

<script>
function myFunction() {
  document.getElementById("amount_shipping").innerHTML = '<input class="form-control text-right" type="text" name="amount_shipping" placeholder="Amount of Shipping..." required>';
}

function myFunction2() {
  document.getElementById("amount_shipping").innerHTML = '';
}
</script>