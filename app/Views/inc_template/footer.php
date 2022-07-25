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
    function editData(id, btntxt, link) {
        $('#btn-sub').html(btntxt);
        $.ajax({
            url: link,
            type: 'post',
            dataType: 'json',
            data: {
                id: id,
            },
            success: function(res) {
                $('#idp').val(res.pid);
                $('#prod').val(res.productname);
                $('#partnum').val(res.partnum);
                $('#serialnum').val(res.serialnum);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $.notify(thrownError, "error");
            }
        })
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

    $('#btn-sub').on('click', function() {
        var link = '<?= base_url('prod/data') ?>',
            data = $('#formproduct').serialize();

        $.ajax({
            url: link,
            type: 'post',
            dataType: 'json',
            data: data,
            success: function(res) {
                if (res.success == 1) {
                    $.notify(res.msg, "success");
                } else {
                    $.notify(res.msg, "error");
                }
                table.ajax.reload();
                $('#formproduct')[0].reset();
                $('#btn-sub').html('Add');
                $('#idp').val('');
            }
        })
    });

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

    $('#smartwizard').smartWizard({
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