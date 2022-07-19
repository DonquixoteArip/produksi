</div>
</body>

</html>
<script>
    $(document).ready(function() {
        $('#smartwizard').smartWizard({
            theme: 'dots',
            justified: true,
            anchor: {
                anchorClickable: true,
                enableNavigationAlways: true,
            }
        });
        $("#smartwizard").on("showStep", function(e, anchorObject, stepIndex, stepDirection, stepPosition) {
            console.log(anchorObject);
        });
        $('#btn-sideslide').on('click', function() {
            $('.icon-chevron').toggleClass('rotateIcon');
        });
        $('#btn-side-collapse').on('click', function() {
            $('.icon-sidebar').toggleClass('iconSide');
        })
    });
</script>