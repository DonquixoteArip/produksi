<div class="modal fade" id="delmodal" style="margin-top: -75px;">
    <div class="modal-dialog" role="document" id="delmodalsize">
        <div class="modal-content p-3">
            <input type="hidden" name="delid" id="delid">
            <input type="hidden" name="delink" id="delink">
            <div class="d-flex justify-content-between">
                <span class="modal-title fw-bolder text-secondary" id="deltitle"></span>
                <button class="btn-sm btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="mt-2">
                <span class="fw-semibold fs-7 text-secondary" id="delmsg"></span>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <button type="button" class="btn btn-inverse-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-inverse-primary" id="delbtn"></button>
            </div>
        </div>
    </div>
</div>
</div>
</body>

</html>
<script>
    var tbl = document.getElementById('tbl_body');

    function editDt(id, link, btntxt) {
        $('#smartwizard').smartWizard('goToStep', 0);
        $('#sub_all').html(btntxt);
        $.ajax({
            url: link,
            type: 'post',
            dataType: 'json',
            data: {
                id: id,
            },
            success: function(res) {
                $('#idp').val(id);
                $('#ordernum').val(res.ordernum);
                $('#mater').val(res.pid);
                $('#batch').val(res.batch);
                $('#loc').val(res.loc);
                $('#profcenter').val(res.profcenter);
                var d = new Date(res.orderdate);
                var format = d.getFullYear() + '-' + ("0" + (d.getMonth() + 1)).slice(-2) + '-' + ("0" + d.getDate()).slice(-2);
                $('#orderdate').val(format);

                for (var i = 0; i <= res.serialnum.length; i++) {
                    $('#tbl_body').append(
                        '<tr>\
                            <td>' + (i + 1) + '</td>\
                            <td>' + res.serialnum[i].serialnumber + '</td>\
                            <td><button class="btn btn-sm btn-danger btndel" idt=' + (tbl.rows.length) + '><i class="fas fa-close fs-7"></i></button></td>\
                        </tr>\
                        '
                    );
                }
                $('.btndel').each(function() {
                    $(this).on('click', function() {
                        $(this).closest('tr').remove();
                    })
                });
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $.notify(thrownError, 'error');
            }
        });

    }

    function hapusModal(title, msg, id, size, link, btntxt) {
        $('#deltitle').text(title);
        $('#delmsg').text(msg);
        $('#delid').val(id);
        $('#delmodalsize').addClass(size);
        $('#delink').val(link);
        $('#delbtn').html(btntxt);
        $('#delmodal').modal('toggle');
    }

    $('#delbtn').on('click', function() {
        var id = $('#delid').val(),
            link = $('#delink').val();

        $.ajax({
            url: link,
            type: 'post',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(res) {
                if (res.success == 1) {
                    $.notify(res.msg, 'success');
                } else {
                    $.notify(res.msg, 'warn');
                }
                table.ajax.reload();
                $('#delmodal').modal('toggle')
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $.notify(thrownError, "error");
            }
        })
    });

    // V_produk
    $('#btn-prod').on('click', function() {
        var link = '<?= base_url('product/process') ?>',
            direct = $('#directory').val();

        if (direct != '') {
            $.ajax({
                url: link,
                type: 'post',
                data: {
                    direct: direct
                },
                success: function(res) {
                    $('#filProd').html(res);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $.notify(thrownError, "error");
                }
            })
        } else {
            $.notify('Directory Not Found');
        }
    })

    var wizard = $('#smartwizard').smartWizard({
        theme: 'dots',
        justified: true,
        keyboard: {
            keyNavigation: false,
        },
        anchor: {
            anchorClickable: true,
            enableNavigationAlways: true,
        },
    });
    $('#btn-sideslide').on('click', function() {
        $('.icon-chevron').toggleClass('rotateIcon');
    });
    $('#btn-side-collapse').on('click', function() {
        $('.icon-sidebar').toggleClass('iconSide');
    });
</script>