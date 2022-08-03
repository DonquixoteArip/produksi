<?= $this->include('inc_template/header') ?>
<?= $this->include('inc_template/sidebar') ?>
<?= $this->include('inc_template/navbar') ?>

<div class="main-panel">
    <div class="content-wrapper">
        <section class="section">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="body-header">
                        <span class="fw-bold fs-5 text-primary">Data History</span>
                    </div>
                    <hr>
                    <div class="body-table overflow-auto">
                        <table class="table table-responsive table-hover table-striped table-bordered" id="datatables">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Product Name</td>
                                    <td>Part Number</td>
                                    <td>Order Number</td>
                                    <td>Order Date</td>
                                    <td>Location</td>
                                    <td>Profit Center</td>
                                    <td>MM/YYYY</td>
                                    <td>Batch Number</td>
                                    <td>Serial Number</td>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<?= $this->include('inc_template/footer') ?>