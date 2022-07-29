<form method="POST" id="formprod">
    <div class="form-group">
        <input type="hidden" name="idp" id="idp" value="<?= (($type == 'edit' ? $row['productid'] : '')) ?>">
        <label class="fw-semibold fs-7 text-secondary">Part Number</label>
        <input type="text" class="form-control rounded" name="partnum" id="partnum" value="<?= (($type == 'edit' ? $row['partnumber'] : '')) ?>">
    </div>
    <div class="form-group">
        <label class="fw-semibold fs-7 text-secondary">Product Name</label>
        <input type="text" class="form-control rounded" name="productname" id="productname" value="<?= (($type == 'edit' ? $row['productname'] : '')) ?>">
    </div>
    <div class="form-group">
        <label class="fw-semibold fs-7 text-secondary">Product Image</label>
        <input type="file" class="form-control rounded" name="productimg" id="productimg" value="">
    </div>
</form>