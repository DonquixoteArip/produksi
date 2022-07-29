<div class="container bg-white shadow-sm rounded border-0 mb-4" style="height: max-content;">
    <div class="content p-4 px-2">
        <div class="d-flex justify-content-between">
            <div class="header-title text-start">
                <span class="fw-bold fs-6 text-primary">MATERIAL</span>
            </div>
            <button type="button" class="btn btn-primary" style="width: 150px;" id="sub_all">Save</button>
        </div>
        <hr>
        <div class="form-content mt-0">
            <form method="POST" id="formproduct">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="fs-7 fw-semibold">Material</label>
                            <select class="form-control form-control" name="mater" id="mater">
                                <?php foreach ($product as $p) : ?>
                                    <option value="<?= $p['productid'] ?>"><?= $p['productname'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="fs-7 fw-semibold">Part Number</label>
                            <input class="form-control form-control-sm" type="text" name="pnum" id="pnum" disabled>
                        </div>
                        <div class="form-group">
                            <label class="fs-7 fw-semibold">Image</label>
                            <div class="form-control form-control-sm p-0">
                                <img class="rounded" width="345" height="215" id="imgprev">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="fs-7 fw-semibold">Order Number</label>
                            <input class="form-control form-control-sm" type="text" name="ordernum" id="ordernum" placeholder="Order Number">
                        </div>
                        <div class="form-group">
                            <label class="fs-7 fw-semibold">Order Date</label>
                            <input class="form-control form-control-sm" type="date" name="orderdate" id="orderdate" placeholder="Order Date">
                        </div>
                        <div class="form-group">
                            <label class="fs-7 fw-semibold">Location</label>
                            <input class="form-control form-control-sm" type="text" name="loc" id="loc" placeholder="Location">
                        </div>
                        <div class="form-group">
                            <label class="fs-7 fw-semibold">Profit Center</label>
                            <input class="form-control form-control-sm" name="profcenter" id="profcenter" placeholder="Profit Center">
                        </div>
                        <div class="form-group">
                            <label class="fs-7 fw-semibold">Batch</label>
                            <input class="form-control form-control-sm" name="batch" id="batch" placeholder="Batch">
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex justify-content-center align-items-center">
                        <div class="card bg-primary border-0 text-center" style="width: 250px; height: 250px;">
                            <div class="card-body d-flex justify-content-center align-items-center rounded">
                                <div class="row">
                                    <span class="fs-2 fw-semibold text-white">Total</span>
                                    <span class="fs-2 fw-bold text-white" id="count-ser">0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="mt-0">
                <div class="header-title text-start">
                    <span class="fw-bold fs-6 text-primary">DETAIL SERIAL</span>
                </div>
                <hr>
                <div class="row mt-2">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="fw-semibold fs-7">Type</label>
                            <select class="form-control form-control-sm" id="types" name="types">
                                <option value="1">Scan</option>
                                <option value="2">Non-Scan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3" id="form-const">
                        <div class='form-group'>
                            <label class='fw-semibold fs-7'>Serial Number</label>
                            <input type='text' class='form-control form-control-sm' name="serialnum" id="serialnum" placeholder='Serial Number'>
                        </div>
                    </div>
                    <div class="col-lg-3 d-flex align-items-center justify-content-start">
                        <button type="button" class="btn btn-sm btn-primary me-2" id="sub_serial" form="serial"><i class="fas fa-plus fs-7"></i></button>
                        <button type="button" class="btn btn-sm btn-warning fs-7" id="tbl_res">Reset</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="table-content mt-2">
            <table class="table table-responsive table-hover table-striped table-bordered w-100" id="tbl_prod">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Serial Number</th>
                        <th style="width: 75px; text-align: center;">#</th>
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

        .select2-results__option,
        .select2-selection__rendered {
            font-size: 12px;
        }

        .select2-container .select2-selection--single {
            height: 40px !important;
            border: 1px solid #E4E9F0;
            padding-left: 2px !important;
            vertical-align: middle;
            padding-top: 5px;
        }

        .select2-selection__arrow {
            margin-top: 5px;
            margin-right: 8px;
        }
    </style>
    <script>
        $(document).ready(function() {
            var d = new Date();
            var format = d.getFullYear() + '-' + ("0" + (d.getMonth() + 1)).slice(-2) + '-' + ("0" + d.getDate()).slice(-2);
            $('#orderdate').val(format);
        })

        function resetTable() {
            $('#tbl_prod tbody tr').remove();
            $('#count-ser').text("0");
        }

        function appendTable() {
            var tbl = document.getElementById('tbl_body');
            var previx = $('#previx').val(),
                msg = '',
                tbl_dt = [],
                serialnum = $('#serialnum').val(),
                startnum = parseInt($('#startnum').val()),
                qty = parseInt($('#qty').val());

            if (serialnum != '' && previx != '') {
                if ($("#sub_serial").attr('form') == 'serial') {
                    $('#tbl_body').append(
                        '<tr>\
                            <td>' + (tbl.rows.length + 1) + '</td>\
                            <td>' + serialnum + '</td>\
                            <td><button class="btn btn-sm btn-danger btndel" idt=' + (tbl.rows.length) + '><i class="fas fa-close fs-7"></i></button></td>\
                        </tr>\
                        '
                    );
                    $('#count-ser').text(tbl.rows.length);
                } else if ($("#sub_serial").attr('form') == 'previx') {
                    var sum = startnum + qty;
                    for (var i = sum; startnum <= sum; startnum++) {
                        $('#tbl_body').append(
                            '<tr>\
                                <td>' + (tbl.rows.length + 1) + '</td>\
                                <td>' + previx + startnum + '</td>\
                                <td><button class="btn btn-sm btn-danger btndel" idt=' + (tbl.rows.length) + '><i class="fas fa-close fs-7"></i></button></td>\
                            </tr>\
                        '
                        );
                        $('#count-ser').text(tbl.rows.length);
                    }
                    $.notify('Append ' + String(tbl.rows.length) + ' data to table', 'success');
                } else {
                    $.notify('Invalid Button Type', 'warn');
                }
            } else {
                $.notify('Serial Number required', 'warn');
            }
            $('.btndel').each(function() {
                $(this).on('click', function() {
                    $(this).closest('tr').remove();
                    $('#count-ser').text(tbl.rows.length);
                })
            });
        }

        $('#mater').select2({
            width: "100%",
            height: "40px",
            minimumResultsForSearch: Infinity,
        });

        $('#mater').change(function() {
            var link = '<?= base_url('prod/prev') ?>',
                id = $(this).val();

            $.ajax({
                url: link,
                type: 'post',
                dataType: 'json',
                data: {
                    id: id,
                },
                success: function(res) {
                    $('#pnum').val(res.partnum);
                    $('#imgprev').attr('src', '<?= base_url('public/product_img') ?>' + '/' + res.img + '')
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.notify(thrownError, 'error');
                }
            })
        })

        $('#tbl_res').on('click', function() {
            resetTable();
        });

        $("#formproduct input[type!=date]").keydown(function(e) {
            if (e.keyCode == 13) {
                var index = $('#formproduct input[type!=date]').index($(this)) + 1;
                $('#formproduct input[type!=date]').eq(index).focus();
            }
        });

        $('#sub_all').on('click', function(ev) {
            var link = '<?= base_url('prod/data') ?>',
                tbl_data = [],
                msg = '',
                data = $('#formproduct').serialize();

            var tbl_data = [];
            $('#tbl_prod tr').each(function(row, tr) {
                if ($(tr).find('td:eq(1)').text() == "") {
                    // if null
                } else {
                    var sub = {
                        'serial': $(tr).find('td:eq(1)').text(),
                    };
                    tbl_data.push(sub);
                }
            });
            $.notify(msg, 'warn');
            $.ajax({
                url: link,
                type: 'post',
                dataType: 'json',
                data: {
                    idp: $('#idp').val(),
                    ordernum: $('#ordernum').val(),
                    orderdate: $('#orderdate').val(),
                    mater: $('#mater').val(),
                    batch: $('#batch').val(),
                    loc: $('#loc').val(),
                    profcenter: $('#profcenter').val(),
                    serialnum: $('#serialnum').val(),
                    previx: $('#previx').val(),
                    startnum: $('#startnum').val(),
                    qty: $('#qty').val(),
                    tbl: tbl_data,
                },
                success: function(res) {
                    if (res.success == 1) {
                        $.notify(res.msg, 'success');
                        $('#formproduct')[0].reset();
                        resetTable();
                    } else {
                        $.notify(res.msg, 'warn');
                    }
                    $('#load-datas').load('<?= base_url('prod/load') ?>');
                    $('#counts').load('<?= base_url('prod/count') ?>');
                    tbl_rep.ajax.reload();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.notify(thrownError, "error");
                }
            });
            ev.stopPropagation();
        });

        $('#sub_serial').on('click', function() {
            if ($('#serialnum').val() != '') {
                appendTable();
            } else {
                $.notify('Serial Number required', 'warn');
            }
        });

        $('#serialnum').keydown(function(e) {
            if (e.keyCode == 13) {
                if ($(this).val() != '') {
                    appendTable();
                } else {
                    $.notify('Serial Number required', 'warn');
                }
                $(this).val("");
            }
        })

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
                    $('#serialnum').keydown(function(e) {
                        if (e.keyCode == 13) {
                            if ($(this).val() != '') {
                                appendTable();
                                $('#serialnum').val("");
                            } else {
                                $.notify('Serial Number required', 'warn');
                            }
                        }
                    })
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.notify(thrownError, 'error');
                }
            })
        });
    </script>
</div>