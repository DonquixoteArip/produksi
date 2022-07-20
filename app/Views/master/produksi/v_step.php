<div id="smartwizard" style="width: 100%; max-width: 1320px;">
    <ul class="nav nav-progress">
        <li class="nav-item">
            <a class="nav-link" href="#form" urls="<?= base_url('produksi/form') ?>">
                <div class="num">1</div>
                <span class="text-secondary">Form</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#product" urls="<?= base_url('produksi/produk') ?>">
                <span class="num">2</span>
                <span class="text-secondary">Product</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#report" urls="<?= base_url('produksi/report') ?>">
                <span class="num">3</span>
                <span class="text-secondary">Report</span>
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