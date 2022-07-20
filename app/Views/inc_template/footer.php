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
        })
    });
</script>