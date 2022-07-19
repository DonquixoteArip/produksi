<div id="smartwizard" class="w-100">
    <ul class="nav nav-progress">
        <li class="nav-item me-3">
            <a class="nav-link btn-tabs" href="#form" urls="<?= base_url('produksi/form') ?>">
                <div class="num">1</div>
                <span class="fs-7">Form</span>
            </a>
        </li>
        <li class="nav-item me-3">
            <a class="nav-link btn-tabs" href="#product" urls="<?= base_url('produksi/produk') ?>">
                <span class="num">2</span>
                <span class="fs-7">Product</span>
            </a>
        </li>
        <li class="nav-item me-3">
            <a class="nav-link btn-tabs" href="#report" urls="<?= base_url('produksi/report') ?>">
                <span class="num">3</span>
                <span class="fs-7">Report</span>
            </a>
        </li>
    </ul>

    <div class="tab-content w-100 mt-0">
        <div id="#form" class="tab-pane" role="tabpanel">
            <?= $this->include('master/produksi/v_form') ?>
        </div>
        <div id="#product" class="tab-pane" role="tabpanel">
            <?= $this->include('master/produksi/v_produk') ?>
        </div>
        <div id="#report" class="tab-pane" role="tabpanel">
            <?= $this->include('master/produksi/v_report') ?>
        </div>
    </div>
</div>