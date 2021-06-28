<h1><?= $title; ?></h1>

<div class="col-md-10">
<form method="POST" action="<?= base_url('Convert/convertDetail') ?>">
    <div class="form-group">
        <label class="font-weight-bolder" for="supplier">Supplier</label>
        <select class="form-control form-control-sm" id="supplier" name="supplier">
            <option value="0" disabled selected>Select Supplier</option>
            <?php foreach ($suppliers as $supplier) : ?>
                <option value="<?= $supplier['id'] ?>"><?= ucwords($supplier['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label class="font-weight-bolder" for="product">Product</label>
        <select class="form-control form-control-sm" id="product" name="product">
            <?php if (count($_POST)) : ?>

            <?php else : ?>
                <option value="0" selected disabled>Select Supplier First</option>
            <?php endif ?>

        </select>
    </div>
    <div class="form-group">
        <label class="font-weight-bolder" for="amount">Amount</label>
        <input type="number" class="form-control form-control-sm" id="amount" name="amount" placeholder="Enter Amount" required autocomplete="off">
    </div>
    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
</form>
</div>

<script>
    document.getElementById('supplier').addEventListener('change', function() {

        fetch("<?= base_url('Convert/getProducts/') ?>" + this.value, {
                method: 'GET',
            })
            .then((response) => response.text())
            .then((data) => {
                console.log(data)
                document.getElementById('product').innerHTML = data
            })
    })
</script>