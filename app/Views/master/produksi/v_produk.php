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
                        <span class="fw-light text-white" id="counts"></span>
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
                    <img id="load-img">
                    <span class="text-primary fw-semibold">Hasil Kamera</span>
                    <hr>
                    <form method="POST" id="formProd">
                        <div class="form-inline d-flex justify-content-center">
                            <button type="button" id="btn-prod" class="btn btn-primary btn-sm w-100" style="height: 45px;"><span class="fw-semibold fs-7">Scan</span></button>
                        </div>
                    </form>
                    <hr>
                    <div class="row mt-2" id="filProd">

                    </div>
                    <div class="w-100 d-flex justify-content-end">
                        <button class="btn btn-success" id="btn-fold">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#load-datas').load('<?= base_url('prod/load') ?>');
    $('#counts').load('<?= base_url('prod/count') ?>');

    $('#btn-prod').on('click', function() {
        var link = '<?= base_url('prod/compare') ?>',
            num = '';

        $.ajax({
            url: link,
            type: 'post',
            dataType: 'json',
            success: function(res) {
                console.log(res.data);
                // if (res.length == '') {
                //     $.notify('File not found', 'warn');
                // } else {
                //     for (var i = 0; i < res.length; i++) {
                //         $('.elem_compare').each(function() {
                //             num = res[i].data[0].serialnumber;
                //             if ($(this).attr('id') == num) {
                //                 $(this).removeClass('bg-secondary');
                //                 $(this).addClass('bg-success');
                //                 $('#filProd').html(
                //                     "\
                //                     <div class='col-lg-12 text-center'>\
                //                         <div class='row d-flex justify-content-center'>\
                //                             <div class='col-lg-6'>\
                //                                 <div class='card bg-success bg-opacity-75'>\
                //                                     <a href='#' class='text-decoration-none text-secondary'>\
                //                                         <div class='card-body'>\
                //                                             <span class='fs-7 text-white'>" + res[i].data[0].serialnumber + "</span>\
                //                                         </div>\
                //                                     </a>\
                //                                 </div>\
                //                                 <label class='fs-7set fw-semibold text-secondary'>" + res[i].data[0].ordernumber + "</label>\
                //                             </div>\
                //                             <div class='col-lg-6'>\
                //                                 <div class='card bg-secondary bg-opacity-75'>\
                //                                     <a href='#' class='text-decoration-none text-secondary'>\
                //                                         <div class='card-body'>\
                //                                             <span class='fs-7 text-white'>Samlekom</span>\
                //                                         </div>\
                //                                     </a>\
                //                                 </div>\
                //                             </div>\
                //                         </div>\
                //                     </div>\
                //                     "
                //                 );
                //             }
                //         });
                //     }
                //     $.notify('Resulting ' + res.length + ' data compared', 'success');
                //     $('#tot_match').text(res.length);
                //     var all = parseInt($('#counts').text()),
                //         comp = parseInt(res.length),
                //         summ = all - comp;
                //     $('#tot_unm').text(summ);
                // }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $.notify(thrownError, 'error');
            }
        })

    });

    $('#btn-fold').on('click', function() {
        $.ajax({
            url: '<?= base_url('prod/folder') ?>',
            type: 'post',
            success: function(res) {
                console.log(res);
            }
        })
    })
</script>