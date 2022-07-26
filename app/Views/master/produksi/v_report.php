<div class="container bg-white shadow-sm rounded border-0" style="height: max-content;">
    <div class="content p-4 px-2">
        <div class="header-title d-flex justify-content-between align-items-start">
            <span class="fw-bold fs-6 text-secondary">REPORT</span>
            <button class="btn btn-sm btn-primary" id="btn-export">Export</button>
        </div>
        <hr>
        <div class="report-content mt-3">
            <table class="table table-responsive table-hover table-striped table-bordered w-100" id="tbl_data">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Waktu</th>
                        <th>Batch</th>
                        <th>Serial Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    var tbl_rep = $('#tbl_data').DataTable({
        serverSide: true,
        destroy: true,
        ajax: {
            type: 'post',
            url: '<?= base_url('prod/table') ?>',
            data: function(param) {
                return param;
            }
        }
    });
</script>