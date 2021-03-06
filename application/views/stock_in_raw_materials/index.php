<h1>Stock In Raw Material</h1>

<div class="col-md-10">
<form method="POST" action="<?= base_url('Stock_in_raw_material/stockInProcess') ?>">
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
        <label class="font-weight-bolder" for="raw_material">Raw Material</label>
        <select class="form-control form-control-sm" id="raw_material" name="raw_material">
            <?php if (count($_POST)) : ?>

            <?php else : ?>
                <option value="0" selected disabled>Select Supplier First</option>
            <?php endif ?>

        </select>
    </div>
    <div class="form-group">
        <label class="font-weight-bolder" for="unit">Unit</label>
        <select class="form-control form-control-sm" id="unit" name="unit">
            <?php if (count($_POST)) : ?>

            <?php else : ?>
                <option value="0" selected disabled>Select Raw Material First</option>
            <?php endif ?>
        </select>
    </div>
    <div class="form-group">
        <label class="font-weight-bolder" for="amount">Amount</label>
        <input type="number" class="form-control form-control-sm" id="amount" name="amount" placeholder="Enter Amount" required autocomplete="off">
    </div>
    <div class="form-group">
        <label class="font-weight-bolder" for="date">Date</label>
        <input type="text" class="form-control form-control-sm" id="date" name="date" placeholder="Enter the date..." required autocomplete="off">
    </div>
    <div class="form-group">
        <label class="font-weight-bolder" for="price">Price (Rp)</label>
        <input type="number" class="form-control form-control-sm" id="price" name="price" placeholder="Enter Price (Rp)..." required autocomplete="off">
    </div>
    <button type="submit" class="btn btn-sm btn-primary">Save</button>
</form>
</div>

<script>
    jQuery('#date').datetimepicker({
        timepicker: false,
        format: 'd F Y'
    });

    document.getElementById('supplier').addEventListener('change', function() {

        fetch("<?= base_url('Stock_in_raw_material/getRawMaterial/') ?>" + this.value, {
                method: 'GET',
            })
            .then((response) => response.text())
            .then((data) => {
                console.log(data)
                document.getElementById('raw_material').innerHTML = data
            })
    })

    document.getElementById('raw_material').addEventListener('change', function() {

        fetch("<?= base_url('Stock_in_raw_material/getUnit/') ?>" + this.value, {
                method: 'GET',
            })
            .then((response) => response.text())
            .then((data) => {
                console.log(data)
                document.getElementById('unit').innerHTML = data
            })
    })
</script>