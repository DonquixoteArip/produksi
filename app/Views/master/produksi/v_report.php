<div class="header-title d-flex justify-content-between align-items-start">
    <span class="fw-bold fs-6 text-secondary">REPORT</span>
    <button class="btn btn-sm btn-primary">Export</button>
</div>
<hr>
<div class="report-content mt-3">
    <table class="table table-responsive table-hover table-striped" id="tbl_data">
        <thead>
            <tr>
                <th>No</th>
                <th>No</th>
                <th>No</th>
                <th>No</th>
                <th>No</th>
                <th>No</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>OUBA978AB</td>
                <td>TIDI</td>
                <td>NAJ</td>
                <td>12345</td>
                <td>0</td>
                <td>
                    <button class="btn btn-sm btn-warning"><i class="fas fa-pencil fs-7set"></i></button>
                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash fs-7set"></i></button>
                </td>
            </tr>
            <tr>
                <td>1</td>
                <td>OUBA978AB</td>
                <td>TIDI</td>
                <td>NAJ</td>
                <td>12345</td>
                <td>0</td>
                <td>
                    <button class="btn btn-sm btn-warning"><i class="fas fa-pencil fs-7set"></i></button>
                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash fs-7set"></i></button>
                </td>
            </tr>
            <tr>
                <td>1</td>
                <td>OUBA978AB</td>
                <td>TIDI</td>
                <td>NAJ</td>
                <td>12345</td>
                <td>0</td>
                <td>
                    <button class="btn btn-sm btn-warning"><i class="fas fa-pencil fs-7set"></i></button>
                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash fs-7set"></i></button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        $('#tbl_data').DataTable({});
    });
</script>