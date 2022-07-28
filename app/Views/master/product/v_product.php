<?= $this->include('inc_template/header') ?>
<?= $this->include('inc_template/sidebar') ?>
<?= $this->include('inc_template/navbar') ?>

<div class="main-panel">
    <div class="content-wrapper">
        <section class="section">
            <div class="card p-4 rounded border-0 shadow-sm">
                <div class="header-card d-flex justify-content-between">
                    <span class="fw-bold fs-5 text-secondary">Master Produk</span>
                    <button class="btn btn-sm btn-primary rounded-pill" id="btn-add"><span class="fw-semibold fs-7">Add Data</span></button>
                </div>
                <hr class="mt-2 mb-3">
                <div class="body-card">
                    <table class="table table-responsive table-hover table-striped table-bordered w-100" id="datatables">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Part Number</th>
                                <th>Product Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>

<?= $this->include('inc_template/footer') ?>
<script>
    $('#btn-add').on('click', function() {
        var link = '<?= base_url('product/form') ?>';
        $.ajax({
            url: link,
            type: 'post',
            dataType: 'json',
            success: function(res) {
                $('#crudmodal').modal('toggle');
                $('#formcrud').html(res.view);
                $('#addTitle').text('Add Product');
                $('#btncrud').html('Save');
            }
        })
    });
</script>