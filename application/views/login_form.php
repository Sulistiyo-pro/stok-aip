<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/bootstrap/css/bootstrap.min.css" />
        <script type="text/javascript" src="<?= base_url() ?>assets/jquery-1.12.3.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
		<title>Login CV. AIP</title>
        <link rel="shortcut icon" type="image/png/jpg" href="<?= base_url() ?>assets/logo_mini.png" />
    </head>
    <body>
        <div class="col-md-6 col-md-offset-3" style="margin-top: 10%">
            <form method="post" action="<?= site_url() ?>/login/validasi">
                <div class="panel panel-primary class">
                    <div class="panel-heading">Silahkan Login</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" />
                        </div>
                        <button type="submit" class="btn btn-success">Login</button>
                    </div>  
                    <div class="panel-footer small">
                        Aplikasi Stok - Upgrade by Sulistiyo
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>