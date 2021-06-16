<h1>Stock In Raw Material</h1>

<div class="col-md-10">
<form method="POST" action="<?= base_url('raw_material/stockInProcess') ?>">
    <input type="hidden" name="stock_raw_material_id" value="<?= ucwords($stock_raw_materials['stock_raw_material_id']) ?>">
    <input type="hidden" name="supplier_id" value="<?= ucwords($stock_raw_materials['supplier_id']) ?>">
    <input type="hidden" name="raw_material_id" value="<?= ucwords($stock_raw_materials['raw_material_id']) ?>">
    <input type="hidden" name="unit_id" value="<?= ucwords($stock_raw_materials['unit_id']) ?>">
    <div class="form-group">
        <label class="font-weight-bolder" for="supplier">Supplier</label>
        <input type="text" class="form-control form-control-sm" id="supplier" name="supplier" value="<?= ucwords($stock_raw_materials['supplier_name']) ?>" required readonly autocomplete="off">
    </div>
    <div class="form-group">
        <label class="font-weight-bolder" for="raw_material">Raw Material</label>
        <input type="text" class="form-control form-control-sm" id="raw_material" name="raw_material" value="<?= ucwords($stock_raw_materials['raw_material_name']) ?>" required readonly autocomplete="off">
    </div>
    <div class="form-group">
        <label class="font-weight-bolder" for="amount">Amount (<?= ucwords($stock_raw_materials['unit_name']) ?>)</label>
        <input type="number" class="form-control form-control-sm" id="amount" name="amount" placeholder="Enter Amount (<?= ucwords($stock_raw_materials['unit_name']) ?>)..." required autocomplete="off">
    </div>
    <div class="form-group">
        <label class="font-weight-bolder" for="date">Date</label>
        <input type="date" class="form-control form-control-sm" id="date" name="date" placeholder="Enter the date..." required autocomplete="off">
    </div>
    <div class="form-group">
        <label class="font-weight-bolder" for="price">Price (Rp)</label>
        <input type="number" class="form-control form-control-sm" id="price" name="price" placeholder="Enter Price (Rp)..." required autocomplete="off">
    </div>
    <button type="submit" class="btn btn-sm btn-primary">Save</button>
</form>
</div>