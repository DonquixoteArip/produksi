<div class="container bg-white shadow-sm rounded border-0" style="height: max-content;">
    <div class="content p-4 px-2">
        <div class="header-title text-start">
            <span class="fw-bold fs-6 text-secondary">INPUT MATERIAL</span>
        </div>
        <hr>
        <div class="form-content mt-0">
            <form method="POST" id="formproduct">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input type="hidden" name="idp" id="idp">
                            <label class="fw-semibold fs-7">Order Number</label>
                            <input type="text" class="form-control form-control-sm" name="ordernum" id="ordernum" placeholder="Order Number">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="fw-semibold fs-7">Order Date</label>
                            <input type="date" class="form-control form-control-sm" name="orderdate" id="orderdate">
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex align-items-center justify-content-end">
                        <button type="button" class="btn w-50 btn-primary" id="sub_all">Save</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="fw-semibold fs-7">Material</label>
                            <select class="form-control form-control-sm" name="mater" id="mater">
                                <option value="0" disabled selected>Select Material</option>
                                <option value="111">Satu</option>
                                <option value="222">Dua</option>
                                <option value="333">Tiga</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="fw-semibold fs-7">Batch</label>
                            <input type="text" class="form-control form-control-sm" name="batch" id="batch" placeholder="Batch">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="fw-semibold fs-7">Location</label>
                            <input type="text" class="form-control form-control-sm" name="loc" id="loc" placeholder="Location">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="fw-semibold fs-7">Profit Center</label>
                            <input type="text" class="form-control form-control-sm" name="profcenter" id="profcenter" placeholder="Profit Center">
                        </div>
                    </div>
                </div>
                <hr class="mt-0">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="fw-semibold fs-7">Type</label>
                            <select class="form-control form-control-sm" id="types" name="types">
                                <option value="0" disabled selected>Select Type</option>
                                <option value="1">Scan</option>
                                <option value="2">Non-Scan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3" id="form-const">
                        <div class='form-group'>
                            <label class='fw-semibold fs-7'>Serial Number</label>
                            <input type='text' class='form-control form-control-sm' name='serialnum' id='serialnum' placeholder='Serial Number'>
                        </div>
                    </div>
                    <div class="col-lg-3 d-flex align-items-center justify-content-start">
                        <button type="button" class="btn btn-sm btn-primary" id="sub_serial"><i class="fas fa-plus fs-7"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="table-content mt-2">
            <table class="table table-responsive table-hover table-striped table-bordered w-100" id="tbl_prod">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Serial Number</th>
                    </tr>
                </thead>
                <tbody id="tbl_body">

                </tbody>
            </table>
        </div>
    </div>
    <style>
        .dataTables_empty {
            display: none;
        }
    </style>
    <script>
        $('#sub_all').on('click', function() {
            var link = '<?= base_url('prod/data') ?>',
                data = $('#formproduct').serialize();

            $.ajax({
                url: link,
                type: 'post',
                dataType: 'json',
                data: data,
                success: function(res) {
                    if (res.success == 1) {
                        $.notify(res.num, 'success');
                    } else {
                        $.notify(res.msg, 'warn');
                    }
                    $('#formproduct')[0].reset();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.notify(thrownError, "error");
                }
            })
        });

        $('#sub_serial').on('click', function() {
            $.notify("samlekom", 'error');
            var previx = $('#previx').val(),
                serialnum = $('#serialnum').val(),
                startnum = $('#startnum').val(),
                qty = $('#qty').val();

            if ($(this).attr('form') == 'serial') {
                $('#tbl_body').append(
                    '<tr>\
                    <td>No</td>\
                    <td>' + serialnum + '</td>\
                </tr>\
                '
                );
                $('#serialnum').val("");
            } else if ($(this).attr('form') == 'previx') {
                for (startnum; startnum < qty; startnum++) {
                    $('#tbl_body').append(
                        '<tr>\
                        <td>No</td>\
                        <td>' + previx + startnum + '</td>\
                        </tr>\
                        '
                    );
                }
                $('#previx').val("");
                $('#startnum').val("");
                $('#qty').val("");
            } else {
                $.notify('Serial Number Required', 'warn');
            }
        });

        $('#types').change(function() {
            var type = $(this).val(),
                link = '<?= base_url('prod/type') ?>';

            if (type == 1) {
                $('#form-const').removeClass('col-lg-6');
                $('#form-const').addClass('col-lg-3');
                $('#sub_serial').attr('form', 'serial');
            } else if (type == 2) {
                $('#form-const').removeClass('col-lg-4');
                $('#form-const').addClass('col-lg-6');
                $('#sub_serial').attr('form', 'previx');
            }

            $.ajax({
                url: link,
                type: 'post',
                data: {
                    type: type,
                },
                success: function(res) {
                    $('#form-const').html(res);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.notify(thrownError, 'error');
                }
            })
        });
    </script>
</div>