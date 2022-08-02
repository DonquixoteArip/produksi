<div class="container bg-white shadow-sm rounded border-0 mb-4" style="height: max-content;">
    <div class="content p-4 px-2">
        <div class="header-title d-flex justify-content-between align-items-start">
            <input type="hidden" name="hid" id="hid" value="62">
            <span class="fw-bold fs-6 text-primary">REPORT</span>
            <a target="_blank" href="" class="btn btn-sm btn-primary" id="btn-export">Export</a>
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
    $('#btn-export').click(function() {
        $('#smartwizard').smartWizard("goToStep", 0);
        $(this).attr('disabled', true);
        setTimeout(() => {
            $('#smartwizard').smartWizard("reset");
            $(this).attr('href', '');
        }, 100);
    });

    var tbl_rep = $('#tbl_data').DataTable({
        serverSide: true,
        destroy: true,
        ajax: {
            type: 'post',
            url: '<?= base_url('prod/table') ?>',
            data: function(res) {
                return res;
            }
        }
    });
</script>