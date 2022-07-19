<?= $this->include('inc_template/header') ?>
<?= $this->include('inc_template/sidebar') ?>
<?= $this->include('inc_template/navbar') ?>

<div class="main-panel">
    <div class="content-wrapper pb-0">
        <div class="progress-container d-flex justify-content-center" id="contents" style="display: none;">
            <?= $this->include('master/produksi/v_step') ?>
        </div>
    </div>
</div>

<?= $this->include('inc_template/footer') ?>
<script>
    $(document).ready(function() {

    });
</script>