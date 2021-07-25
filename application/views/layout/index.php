<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{title}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="<?= assets() ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= assets() ?>bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= assets() ?>bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= assets() ?>dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?= assets() ?>dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?= assets() ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?= assets() ?>plugins/icomoon/styles.css">
    <style>
        .status {
            display: block;
            font-size: .9em;
            line-height: 22px;
            border: 2px solid #ccc;
            border-radius: 3px;
            background-color: #fff;
            color: #333;
        }

        .status-label {
            font-size: 14px;
        }

        .status-pending {
            color: #d9534f
        }

        .status-accepted {
            color: #498302
        }

        .status-suspended {
            color: #f0ad4e
        }
    </style>
    <!-- Google Font -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->

    <script src="<?= assets() ?>bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?= assets() ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= assets() ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?= assets() ?>bower_components/fastclick/lib/fastclick.js"></script>
    <script src="<?= assets() ?>dist/js/adminlte.min.js"></script>
    <script src="<?= assets() ?>dist/js/demo.js"></script>
    <script src="<?= assets() ?>plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="<?= assets() ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= assets() ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script>
        var BASE_URL = "<?= base_url(); ?>";
    </script>
</head>

<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">

        <?php $this->load->view('layout/header') ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>{title}</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="<?= site_url('welcome') ?>"><i class="fa fa-dashboard"></i> Home</a>
                    </li>
                    {links}
                </ol>
            </section>
            <section class="content">
                {content}
            </section>
        </div>
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0
            </div>
            <strong>Copyright &copy; 2021 <a href="#">CV. Flazz Technologies</a>.</strong> All rights
            reserved.
        </footer>
    </div>
</body>

</html>