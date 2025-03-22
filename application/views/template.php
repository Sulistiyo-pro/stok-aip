<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/datatables/dataTables.bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/sweetalert/sweetalert.css" />
        <script type="text/javascript" src="<?= base_url() ?>assets/jquery-1.12.3.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/datatables/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/datatables/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/sweetalert/sweetalert.min.js"></script>
        <title>Aplikasi Stok</title>
        <link rel="shortcut icon" type="image/png/jpg" href="<?= base_url() ?>assets/logo_mini.png" />
        <link rel="background-image" type="image/png/jpg" href="<?= base_url() ?>assets/logo_mini.png" />
    </head>
    <body>
        <nav class="navbar navbar-info bg-info navbar-fixed-top">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?= site_url() ?>"><strong>CV. Ardhana Indo Putra</strong></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="<?= site_url() ?>/penjualan/pesan">Penjualan</a></li>
                        <!--<li><a href="<?= site_url() ?>/penjualan/bayar">Bayar</a></li>-->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Stok<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= site_url() ?>/stok_awal">Stok Awal</a></li>
                                <li><a href="<?= site_url() ?>/stok_masuk">Stok Masuk</a></li>
                                <li><a href="<?= site_url() ?>/stok_keluar">Stok Keluar</a></li>
                                <li><a href="<?= site_url() ?>/laporan_stok/posisi_stok1">Laporan Stok</a></li>
                            </ul>
                        </li>
						<!--
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Kas<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= site_url() ?>/kas_awal">Kas Awal</a></li>
                                <li><a href="<?= site_url() ?>/kas_masuk">Kas Masuk</a></li>
                                <li><a href="<?= site_url() ?>/kas_keluar">Kas Keluar</a></li>
                                <li><a href="<?= site_url() ?>/kas_mutasi">Mutasi Kas</a></li>
                            </ul>
                        </li>
						-->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Master <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= site_url() ?>/stok">Barang</a></li>
								<li><a href="<?= site_url() ?>/user">Pengguna Aplikasi</a></li>
								<!--
								<li><a href="<?= site_url() ?>/menu">Menu Restoran</a></li>
                                <li><a href="<?= site_url() ?>/kas">Kas</a></li>
                                <li><a href="<?= site_url() ?>/user">Pengguna Aplikasi</a></li>
								-->
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Laporan <span class="caret"></span></a>
                            <ul class="dropdown-menu">
								<li><a href="<?= site_url() ?>/laporan/posisi_stok">Posisi Stok Harian</a></li>
                                <!--<li><a href="<?= site_url() ?>/laporan/rekap_penjualan_harian">Rekap Penjualan Harian</a></li>-->
                                <li><a href="<?= site_url() ?>/laporan/penjualan_harian">Detail Penjualan Harian</a></li>
                                <!--<li><a href="<?= site_url() ?>/laporan/posisi_kas">Posisi Kas Harian</a></li>-->
								
                            </ul>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">User <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= site_url() ?>/login/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <br />
        <br />
        <br />
        <div class="container">
            <?= $content ?>
        </div>
        <script>
            $(".dataTable").DataTable({
                initComplete: function (settings, json) {
                    $('.dataTable').wrap('<div class="table-responsive"></div>');
                },
                language: {
                    "sProcessing": "Sedang memproses...",
                    "sLengthMenu": "Tampilkan _MENU_ entri",
                    "sZeroRecords": "Tidak ditemukan data yang sesuai",
                    "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                    "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                    "sInfoPostFix": "",
                    "sSearch": "Cari:"
                },
                "pagingType": "full_numbers"
            });
            
            $(document).on('click', '.del', function() {
                var href = $(this).attr('rel');
                swal({
                    title: "Anda yakin?",
                    text: "Data yang telah dihapus tidak dapat dikembalikan!",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "Batalkan",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Ya, Saya yakin!",
                    closeOnConfirm: false
                },
                        function () {
                            swal({
                                title: "Terhapus!",
                                text: "Data yang Anda maksud telah berhasil dihapus.",
                                type: "success"
                            },
                                    function () {
                                        window.location = href;
                                    });
                        });

                return false;
            });
        </script>
    </body>
</html>
