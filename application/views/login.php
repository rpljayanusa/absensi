<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login | CV. Flazz Technologies</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?= assets() ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= assets() ?>bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= assets() ?>bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= assets() ?>dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?= assets() ?>plugins/iCheck/square/blue.css">
    <link rel="stylesheet" href="<?= assets() ?>bower_components/source-sans/source-sans-pro.css">
    <link rel="stylesheet" href="<?= assets() ?>css/style.css">

    <script src="<?= assets() ?>bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?= assets() ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= assets() ?>plugins/iCheck/icheck.min.js"></script>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <div style="width: 100%;">
                <img src="<?= assets() ?>image/logo.png" height="100px">
            </div>
            <a href="" style="font-size: 28px;">
                <b>CV. Flazz Technologies</b>
            </a>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">Masuk ke akun Anda</p>
            <?= form_open('login/signin', ['id' => 'form_signin', 'name' => 'form_signin']) ?>
            <div class="form-group has-feedback">
                <input type="text" name="username" class="form-control" placeholder="Username" autofocus>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                <span id="username_error" class="text-red"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <span id="password_error" class="text-red"></span>
            </div>
            <button type="submit" class="login btn btn-primary btn-block btn_signin" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Loading...">Masuk</button>
            <?= form_close() ?>
        </div>
    </div>

    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });
        });
        $(document).ready(function() {
            $('#form_signin').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: "POST",
                    data: $(this).serialize(),
                    dataType: "json",
                    beforeSend: function() {
                        $('.btn_signin').button('loading');
                    },
                    success: function(data) {
                        if (data.status == false) {
                            if (data.username_error != '') {
                                $('#username_error').html(data.username_error);
                            } else {
                                $('#username_error').html('');
                            }
                            if (data.password_error != '') {
                                $('#password_error').html(data.password_error);
                            } else {
                                $('#password_error').html('');
                            }
                        } else {
                            window.location.href = "<?= site_url('welcome') ?>";
                        }
                        $('.btn_signin').button('reset');
                    }
                })
            });
        });
    </script>
</body>

</html>