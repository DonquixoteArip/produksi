<div class="container bg-white shadow-sm rounded border-0" style="height: max-content;">
    <div class="content p-4 px-2" id="prodcontent">
        <div class="header-title text-start">
            <span class="fw-bold fs-6 text-primary">PRODUK</span>
        </div>
        <hr>
        <div class="product-content">
            <div class="row">
                <div class="col-lg-4">
                    <div class="container text-center bg-primary rounded w-75 p-2">
                        <h6 class="text-white fs-7 fw-semibold">Total</h6>
                        <span class="fw-light text-white" id="counts">0</span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="container text-center bg-primary rounded w-75 p-2">
                        <h6 class="text-white fs-7 fw-semibold">Total Match</h6>
                        <span class="fw-light text-white" id="tot_match">0</span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="container text-center bg-primary rounded w-75 p-2">
                        <h6 class="text-white fs-7 fw-semibold">Total Unmatch</h6>
                        <span class="fw-light text-white" id="tot_unm">0</span>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="product-view">
            <div class="row">
                <div class="col-lg-6">
                    <span class="text-primary fw-semibold">Hasil Scan</span>
                    <hr>
                    <div class="row px-2" id="load-datas">

                    </div>
                </div>
                <!-- Vertical Divider -->
                <div class="col-lg-6" style="border-left: 1px solid #C1C1C1;">
                    <span class="text-primary fw-semibold">Hasil Kamera</span>
                    <hr>
                    <form method="POST" id="formProd">
                        <div class="form-inline d-flex justify-content-center">
                            <button type="button" id="btn-prod" class="btn btn-primary btn-sm w-100" style="height: 45px;"><span class="fw-semibold fs-7">Scan</span></button>
                        </div>
                    </form>
                    <hr>
                    <input type="hidden" name="direct" id="direct">
                    <div class=" row mt-2" id="filProd">

                    </div>
                    <hr class="">
                    <div class="w-100 d-flex justify-content-end mt-3">
                        <button class="btn btn-success w-25" id="btn-fold" disabled>Save</button>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#load-datas').load('<?= base_url('prod/load') ?>');
    $('#counts').load('<?= base_url('prod/count') ?>');
    var image = '',
        snid = '',
        status = '',
        msg = '',
        text = '';

    function resetProd() {
        $('#filProd').html("");
        $('#tot_match').text("0");
        $('#tot_unm').text("0");
        $('.elem_compare').each(function() {
            $(this).removeClass('bg-success');
            $(this).addClass('bg-secondary');
        });
    }

    $('#btn-prod').on('click', function() {
        var link = '<?= base_url('prod/compare') ?>',
            num = '';

        $.ajax({
            url: link,
            type: 'post',
            dataType: 'json',
            success: function(res) {
                if (res.length != '') {
                    image = res[0].imgname;
                    text = res[1].txtname;
                    snid = res[1].serialnum;
                    num = res[1].txt;
                    direct = res[1].dir;
                    $('#btn-fold').attr('disabled', false);
                    $('.elem_compare').each(function() {
                        if ($(this).attr('id') == num) {
                            $(this).removeClass('bg-secondary');
                            $(this).addClass('bg-success');
                            status = '1';
                            msg = 'Resulting Compared Data';
                            $('#filProd').html(
                                "\
                                <div class='col-lg-12 text-center'>\
                                    <div class='row d-flex justify-content-center'>\
                                        <div class='col-lg-6'>\
                                            <div class='card bg-success bg-opacity-75'>\
                                                <a href='#' class='text-decoration-none text-secondary'>\
                                                    <div class='card-body'>\
                                                        <span class='fs-7 text-white'>" + num + "</span>\
                                                    </div>\
                                                </a>\
                                            </div>\
                                            <label class='fs-7set fw-semibold text-secondary'>" + res[1].txtname + "</label>\
                                        </div>\
                                        <div class='col-lg-6'>\
                                            <div class='card bg-secondary bg-opacity-75'>\
                                                <a href='data:image/png;base64, " + res[0].img + "' class='fancybox' data-fancybox='img'>\
                                                    <img src='data:image/png;base64," + res[0].img + "' class='rounded' id='img-comp' width='100%' height='100%'>\
                                                </a>\
                                            </div>\
                                            <label class='fs-7set fw-semibold text-secondary'>" + res[0].imgname + "</label>\
                                        </div>\
                                    </div>\
                                </div>\
                                "
                            );
                            return false;
                        } else {
                            $(this).removeClass('bg-success');
                            $(this).addClass('bg-secondary');
                            msg = 'Resulting Uncompared Data';
                            status = '3';
                            $('#filProd').html(
                                "\
                                <div class='col-lg-12 text-center'>\
                                    <div class='row d-flex justify-content-center'>\
                                        <div class='col-lg-6'>\
                                            <div class='card bg-secondary bg-opacity-75'>\
                                                <a href='#' class='text-decoration-none text-secondary'>\
                                                    <div class='card-body'>\
                                                        <span class='fs-7 text-white'>" + num + "</span>\
                                                    </div>\
                                                </a>\
                                            </div>\
                                            <label class='fs-7set fw-semibold text-secondary'>" + res[1].txtname + "</label>\
                                        </div>\
                                        <div class='col-lg-6'>\
                                            <div class='card bg-secondary bg-opacity-75'>\
                                                <img src='data:image/png;base64," + res[0].img + "' class='rounded' id='img-comp'>\
                                            </div>\
                                            <label class='fs-7set fw-semibold text-secondary'>" + res[0].imgname + "</label>\
                                        </div>\
                                    </div>\
                                </div>\
                                "
                            );
                        }
                    });
                    $('#img-comp').hover(
                        function() {
                            $(this).css('cursor', 'pointer');
                        },
                        function() {
                            $(this).css('cursor', 'none');
                        }
                    )
                    $('#img-comp').on('click', function() {
                        // Zoom goes here
                    });
                } else {
                    $.notify("This directory has no files", 'warn');
                }

                $.notify(msg, 'success');
                $('#tot_match').text(res[1].count);
                var all = parseInt($('#counts').text()),
                    comp = parseInt(res[1].count),
                    summ = all - comp;
                $('#tot_unm').text(summ);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $.notify(thrownError, 'error');
            }
        })

    });

    $('#btn-fold').on('click', function() {
        var link = '<?= base_url('prod/result') ?>',
            imgname = image,
            serial = snid,
            sts = status,
            txtname = text;

        $.ajax({
            url: link,
            type: 'post',
            dataType: 'json',
            data: {
                imgN: imgname,
                sid: serial,
                stats: sts,
                txtn: txtname,
            },
            success: function(res) {
                if (res.success == 1) {
                    resetProd();
                    $('#btn-fold').attr('disabled', true);
                    $.notify(res.msg, 'success');
                } else {
                    $.notify(res.msg, 'warn');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $.notify(thrownError, 'error');
            }
        })
    })
</script>