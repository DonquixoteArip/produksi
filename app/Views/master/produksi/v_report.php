<div class="container bg-white shadow-sm rounded border-0 mt-2" style="height: max-content;">
    <div class="content p-4 px-2">
        <div class="header-title d-flex justify-content-between align-items-start">
            <span class="fw-bold fs-6 text-secondary">REPORT</span>
            <button class="btn btn-sm btn-primary">Export</button>
        </div>
        <hr>
        <div class="report-content mt-3">
            <table class="table table-responsive table-hover table-striped table-bordered" id="tbl_data">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Waktu</th>
                        <th>Batch</th>
                        <th>Serial Number</th>
                        <th>Status</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>5</td>
                        <td>20 Mei 2022 17:09</td>
                        <td>5245166198</td>
                        <td>464864AD84AE</td>
                        <td>
                            <div class="badge badge-success">Done</div>
                        </td>
                        <td>Admin</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>15 Juli 2022 15:49</td>
                        <td>5656465654</td>
                        <td>464864ADATVAE</td>
                        <td>
                            <div class="badge badge-warning">Pending</div>
                        </td>
                        <td>Member 4</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>20 April 2022 11:09</td>
                        <td>5245166198</td>
                        <td>GVA4864AD84AE</td>
                        <td>
                            <div class="badge badge-danger">Cancel</div>
                        </td>
                        <td>Admin</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <script>
            $(document).ready(function() {
                $('#tbl_data').DataTable({});
            });
        </script>
    </div>
</div>