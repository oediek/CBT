<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sistem Ujian DARING</title>
    <!-- Favicon-->
    <link rel="icon" href="<?=base_url('theme/adminbsb/')?>favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="<?=base_url('theme/adminbsb/')?>css/roboto.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url('theme/adminbsb/')?>css/icon.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?=base_url('theme/adminbsb/')?>plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?=base_url('theme/adminbsb/')?>plugins/node-waves/waves.min.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?=base_url('theme/adminbsb/')?>plugins/animate-css/animate.min.css" rel="stylesheet" />

    <!-- Waitme CSS -->
    <link href="<?=base_url('theme/adminbsb/')?>plugins/waitme/waitMe.min.css" rel="stylesheet" />
    
    <!-- Sweetalert CSS -->
    <link href="<?=base_url('theme/adminbsb/')?>plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="<?=base_url('theme/adminbsb/')?>plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?=base_url('theme/adminbsb/')?>css/style.min.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?=base_url('theme/adminbsb/')?>css/themes/all-themes.min.css" rel="stylesheet" />
</head>

<body class="<?=get_app_config('THEME_COLOR')?>">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="javascript:void(0)"> Computer Based Test (CBT) - <?=get_app_config('NAMA_SEKOLAH')?> </a>
            </div>
            <!--
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                </ul>
            </div>
            -->
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="images/<?=get_app_config('LOGO_SEKOLAH')?>" alt="Logo" width="100" height="100">
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$this->session->nama?></div>
                    <div class="email">NIS : <?=$this->session->nis?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#" class="tombol_logout"><i class="material-icons">input</i>Selesai</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">NAVIGASI UTAMA</li>
                    <?php if($status_peserta == '1'): ?>
                        <li>
                            <a href="../../index.html">
                                <i class="material-icons">person</i>
                                <span>Edit Profil</span>
                            </a>
                        </li>                        
                    <?php elseif($status_peserta == '2'):?>
                        <li>
                            <a href="<?=site_url('?d=siswa&c=ujian')?>">
                                <i class="material-icons">done_all</i>
                                <span>Kerjakan Soal</span>
                            </a>
                        </li>
                    <?php elseif($status_peserta == '3'):?>
                        <li>
                            <a href="../../index.html">
                                <i class="material-icons">trending_up</i>
                                <span>Periksa Nilai</span>
                            </a>
                        </li>
                    <?php endif?>

                    <li class="header">LABELS</li>
                    <li>
                        <a href="#" class="tombol_logout">
                            <i class="material-icons col-red">input</i>
                            <span>Selesai</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="javascript:void(0);">Dinas Pendidikan Kota Probolinggo - Material Design</a>.
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>