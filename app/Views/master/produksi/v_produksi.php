<?= $this->include('inc_template/header') ?>
<?= $this->include('inc_template/sidebar') ?>
<?= $this->include('inc_template/navbar') ?>

<div class="main-panel">
    <div class="content-wrapper pb-0">
        <div class="progress-container d-flex justify-content-center">
            <?= $this->include('master/produksi/v_step') ?>
        </div>
        <div class="container bg-white shadow-sm rounded border-0 mt-2" style="height: max-content;">
            <div class="content p-4 px-2" id="prodcontent">
                <?= $this->include('master/produksi/v_form') ?>
            </div>
        </div>
    </div>
</div>

<?= $this->include('inc_template/footer') ?>
<script>
    $(document).ready(function() {
        $('.btn-tabs').each(function() {
            $(this).on('click', function() {
                var link = $(this).attr('urls');

                $.ajax({
                    url: link,
                    type: 'post',
                    dataType: 'json',
                    success: function(res) {
                        $('#prodcontent').fadeIn('slow', function() {
                            $('#prodcontent').html(res.view);
                        })
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.notify(thrownError, 'error');
                    },
                })
            })
        });
    });
</script>