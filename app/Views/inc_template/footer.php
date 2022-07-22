</div>
</body>

</html>
<script>
    $(document).ready(function() {
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
            transition: {
                animation: 'fade',
                speed: '200',
            },
        });
        $('#btn-sideslide').on('click', function() {
            $('.icon-chevron').toggleClass('rotateIcon');
        });
        $('#btn-side-collapse').on('click', function() {
            $('.icon-sidebar').toggleClass('iconSide');
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
    });
</script>