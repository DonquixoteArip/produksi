<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Page</title>
    <style>

    </style>
    <?= $this->include('inc_template/v_script') ?>
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div id="alert-msg" class="position-absolute m-3 end-0" style="height: max-content; width: 350px;">

            </div>
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light shadow text-left rounded p-5" style="transition: 0.2s ease-in-out;">
                            <h4 class="fw-bolder text-dark fs-5">Let's get started</h4>
                            <h5 class="fw-bold mt-3 text-primary">Log in to Continue</h5>
                            <form class="pt-3" id="formlogin">
                                <div class="form-group">
                                    <label id="labelUname" class="text-secondary fw-semibold fs-7" for="uname">Username</label>
                                    <input type="text" name="uname" id="uname" class="form-control form-control rounded fs-7" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label id="labelPass" class="text-secondary fw-semibold fs-7" for="pass">Password</label>
                                    <input type="password" name="pass" id="pass" class="form-control rounded fs-7" placeholder="Password">
                                </div>
                                <div class="pt-4 text-end">
                                    <button type="button" class="btn btn-lg w-100 btn-primary" id="btn_login" style="border-radius: 50px;"><span class="fw-bold fs-6">Log In</span></button>
                                </div>
                                <div class="text-center mt-4 fs-7 fw-normal"> Don't have an account? <a href="#" class="text-primary">Create</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    $(document).ready(function() {
        $('#btn_login').on('click', function() {
            var link = '<?= base_url('login/auth') ?>',
                data = $('#formlogin').serialize();

            $.ajax({
                url: link,
                type: 'post',
                data: data,
                dataType: 'json',
                success: function(res) {
                    if (res.success == 1) {
                        $("#alert-msg").removeClass("alert alert-fill-danger");
                        $("#alert-msg").addClass("alert alert-fill-success").html(res.msg);
                        setTimeout(() => {
                            window.location.href = '<?= base_url('product') ?>';
                        }, 1000);
                    } else {
                        $("#alert-msg")
                            .removeClass("alert alert-fill-success")
                            .addClass("alert alert-fill-danger")
                            .html(res.msg);
                    }
                    $('#formlogin')[0].reset();
                    $("#alert-msg").fadeIn('slow');
                    setTimeout(() => {
                        $("#alert-msg").fadeOut('slow');
                    }, 850);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError);
                },
            });
        });
    });
</script>