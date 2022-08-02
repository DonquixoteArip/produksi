<div class="container bg-white shadow-sm rounded border-0 mb-4" style="height: max-content;">
    <div class="content p-4 px-2" id="prodcontent">
        <div class="header-title text-start">
            <span class="fw-bold fs-6 text-primary">PRODUK</span>
        </div>
        <hr>
        <div class="px-2">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="fs-7 fw-semibold text-secondary">Product Name</label>
                        <input type="text" class="form-control form-control-sm" id="name_input" disabled>
                    </div>
                    <div class="form-group">
                        <label class="fs-7 fw-semibold text-secondary">Part Number</label>
                        <input type="text" class="form-control form-control-sm" id="part_input" disabled>
                    </div>
                    <div class="form-group" style="width: 350px; height: 218px;">
                        <label class="fs-7 fw-semibold text-secondary">Product Image</label>
                        <div class="form-control form-control-sm p-0" style="height: 218px;" id="img_input">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" style="border-left: 1px solid #C1C1C1;">
                    <div class="container text-center p-2 mb-2">
                        <div class="card bg-primary rounded">
                            <div class="card-body">
                                <h6 class="text-white fs-6 fw-semibold">Total</h6>
                                <span class="fw-light text-white" id="counts">0</span>
                            </div>
                        </div>
                    </div>
                    <div class="container text-center p-2 mb-2">
                        <div class="card bg-primary rounded">
                            <div class="card-body">
                                <h6 class="text-white fs-6 fw-semibold">Total Match</h6>
                                <span class="fw-light text-white" id="tot_match">0</span>
                            </div>
                        </div>
                    </div>
                    <div class="container text-center p-2">
                        <div class="card bg-primary rounded">
                            <div class="card-body">
                                <h6 class="text-white fs-6 fw-semibold">Total Unmatch</h6>
                                <span class="fw-light text-white" id="tot_unm">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="product-view">
            <div class="row">
                <div class="col-lg-6">
                    <input type="hidden" name="idh" id="idh">
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
            header = $('#idh').val(),
            num = '';

        $.ajax({
            url: link,
            type: 'post',
            dataType: 'json',
            data: {
                header: header,
            },
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
                                            <div class='card bg-secondary bg-opacity-75' id='lightgallery'>\
                                                <img src='data:image/png;base64," + res[0].img + "' class='rounded' id='img-comp' width='100%' height='100%'>\
                                            </div>\
                                            <label class='fs-7set fw-semibold text-secondary' id='imgName'>" + res[0].imgname + "</label>\
                                        </div>\
                                    </div>\
                                </div>\
                                "
                            );
                            return false;
                        } else if ($(this).attr('id') != num) {
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
                                            <div class='card bg-secondary bg-opacity-75' id='lightgallery'>\
                                                <img src='data:image/png;base64," + res[0].img + "' class='rounded' id='img-comp' width='100%' height='100%'>\
                                            </div>\
                                            <label class='fs-7set fw-semibold text-secondary' id='imgName'>" + res[0].imgname + "</label>\
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
                    );
                    var el = $('#lightgallery').find('img').attr('src'),
                        imN = $('#imgName').text();
                    $('#lightgallery').on('click', function() {
                        dynamic.openGallery();
                    });

                    var dynamic = lightGallery($('#lightgallery'), {
                        dynamic: true,
                        dynamicEl: [{
                            src: el,
                            thumb: el,
                            subHtml: '<h4>' + imN + '</h4>',
                        }]
                    });

                    $('#tot_match').text(res[1].count);
                    var all = parseInt($('#counts').text()),
                        comp = parseInt(res[1].count),
                        summ = all - comp;
                    $('#tot_unm').text(summ);
                    $.notify(msg, 'success');
                } else {
                    $.notify('This directory has no files', 'warn');
                }

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
            header = $('#idh').val(),
            txtname = text;

        $.ajax({
            url: link,
            type: 'post',
            dataType: 'json',
            data: {
                imgN: imgname,
                idh: header,
                sid: serial,
                stats: sts,
                txtn: txtname,
            },
            success: function(res) {
                if (res.success == 1) {
                    resetProd();
                    $('#btn-fold').attr('disabled', true);
                    $.notify(res.msg, 'success');
                    $.ajax({
                        url: '<?= base_url('prod/load') ?>',
                        type: 'post',
                        data: {
                            headerid: $('#idh').val(),
                        },
                        success: function(res) {
                            $('#load-datas').html(res);
                            if (res.length == 0) {
                                setTimeout(() => {
                                    $('#name_input').val("");
                                    $('#part_input').val("");
                                    $('#img_input').css('background-image', '');
                                    $('#smartwizard').smartWizard('goToStep', 2);
                                }, 150);
                            }
                        }
                    });
                    $.ajax({
                        url: '<?= base_url('product/single') ?>',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            header: $('#idh').val(),
                        },
                        success: function(res) {
                            $('#counts').text(res.count);
                        }
                    })
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