<?= $this->include('inc_template/header') ?>
<?= $this->include('inc_template/sidebar') ?>
<?= $this->include('inc_template/navbar') ?>

<div class="main-panel">
    <div class="content-wrapper pb-4 overflow-auto">
        <div class="progress-container d-flex justify-content-center">
            <?= $this->include('master/produksi/v_step') ?>
        </div>
    </div>
</div>

<?= $this->include('inc_template/footer') ?>