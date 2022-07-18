<?= $this->include('inc_template/header') ?>
<?= $this->include('inc_template/sidebar') ?>
<?= $this->include('inc_template/navbar') ?>

<div class="main-panel">
    <div class="content-wrapper pb-0">
        <div class="progress-container d-flex justify-content-center">
            <?= $this->include('master/produksi/v_step') ?>
        </div>
        <div class="p-4">
            <h4 class="text-secondary fw-bold mb-4">Input Produk</h4>
            <form method="POST" id="formproduk">
                <div class="form-group w-25">
                    <label class="fw-bold fs-7" for="choose">Choose Product</label>
                    <select class="form-control form-control-sm" name="product" id="product">
                        <option value="1">A</option>
                        <option value="1">B</option>
                        <option value="1">C</option>
                    </select>
                </div>
                <div class="form-group w-50">
                    <label class="fw-bold fs-7 mt-1" for="partnum">Part Number</label>
                    <input class="form-control form-control-sm" type="text" name="partnum" id="partnum">
                </div>
                <div class="form-group w-50">
                    <label class="fw-bold fs-7 mt-1" for="partnum">Serial Number</label>
                    <input class="form-control form-control-sm" type="text" name="serial" id="serial">
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->include('inc_template/footer') ?>