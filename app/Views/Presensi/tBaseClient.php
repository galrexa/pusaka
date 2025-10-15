<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=isset($title)?$title:'Page'?></title>
    <link href="<?=base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/vendors/fontawesome/css/all.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/css/main.css')?>" rel="stylesheet">
    <script src="<?=base_url('assets/js/jquery-3.7.1.min.js')?>"></script>
    <script src="<?=base_url('assets/js/bootstrap.bundle.min.js')?>"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers:{
                "Key": "<?=session()->get('key')?>",
                "User": '<?=session()->get('id')?>',
                "Token": '<?=session()->get('token')?>',
            }
        });
    </script>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            padding-top: 60px;
            padding-bottom: 70px;
            overflow-x: hidden;
            background: #f8f9fa;
        }

        /* Custom Header - Simple & Clean */
        .presensi-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;
            z-index: 1002;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            padding: 0 16px;
            justify-content: space-between;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .header-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .header-logo {
            width: 38px;
            height: 38px;
            object-fit: contain;
        }

        .header-title {
            color: white;
            font-weight: 700;
            font-size: 18px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .header-user {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.15);
            padding: 6px 12px;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            color: white;
        }

        .header-user:hover {
            background: rgba(255, 255, 255, 0.25);
            text-decoration: none;
            color: white;
        }

        .header-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
        }

        .header-name {
            font-size: 14px;
            font-weight: 600;
            display: none;
        }

        @media (min-width: 480px) {
            .header-name {
                display: block;
            }
        }

        /* Shift Info Card */
        .shift-info {
            background: white;
            padding: 16px;
            margin: 0 0 16px 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border-radius: 12px;
        }

        .shift-info .greeting {
            font-size: 15px;
            color: #334155;
            margin-bottom: 4px;
        }

        .shift-info .greeting strong {
            color: #1e293b;
        }

        .shift-info .page-title {
            font-size: 20px;
            font-weight: 700;
            color: #667eea;
            margin-top: 4px;
        }

        /* Main Content */
        .container-fluid {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Bottom Navigation */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            border-top: 1px solid #e9ecef;
            padding: 10px 16px;
            padding-bottom: calc(10px + env(safe-area-inset-bottom));
            z-index: 1002;
            box-shadow: 0 -4px 20px rgba(0,0,0,0.1);
        }

        .nav-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            max-width: 600px;
            margin: 0 auto;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: #9ca3af;
            padding: 4px 12px;
            border-radius: 10px;
            transition: all 0.3s ease;
            cursor: pointer;
            flex: 1;
            max-width: 80px;
        }

        .nav-item.active {
            color: #667eea;
            background: rgba(102, 126, 234, 0.1);
        }

        .nav-item:hover {
            color: #667eea;
            text-decoration: none;
        }

        .nav-item i {
            font-size: 22px;
            margin-bottom: 4px;
        }

        .nav-item span {
            font-size: 10px;
            font-weight: 600;
        }

        /* Alert Styles */
        .alert {
            border-radius: 10px;
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .alert-warning {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            color: #92400e;
        }

        /* Cards & Sections */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-bottom: 16px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container-fluid {
                padding: 0 12px;
            }
        }
    </style>
</head>
<body>
    <!-- Custom Header - Simple & Clean -->
    <header class="presensi-header">
        <div class="header-left">
            <a href="<?=base_url()?>" class="header-brand">
                <img src="<?=base_url('assets/img/logo.png')?>" alt="Logo" class="header-logo">
                <span class="header-title">Presensi</span>
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container-fluid">
        <?php if(session()->get('message')){?>
            <!-- ALERT FLASHDATA -->
            <div class="alert alert-warning" id="flashdata_message">
                <i class="fa fa-exclamation-circle"></i> <?=session()->get('message')?>
            </div>
        <?php }?>
        <?php 
            // LOAD VIEW PAGE
            if(isset($page) && file_exists(APPPATH.'Views/'.$page.'.php'))
            {
                echo view($page);
            }else{
                echo '<h3 class="text-warning"><i class="fa fa-exclamation-circle"></i> Page not found</h3>';
            }
        ?>
    </div>

    <!-- Bottom Navigation -->
    <div class="bottom-nav">
        <div class="nav-container">
            <a href="<?=base_url()?>" class="nav-item" title="Beranda">
                <i class="fas fa-home"></i>
                <span>Beranda</span>
            </a>
            <?php if(return_access_link(['presensi/index'])){?>
                <a href="<?=site_url('presensi/index')?>" class="nav-item <?php if(check_link_module(['presensi/index'])){echo 'active';}?>" title="Halaman Presensi">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Presensi</span>
                </a>
            <?php }?>
            <?php if(return_access_link(['presensi/riwayat'])){?>
                <a href="<?=site_url('presensi/riwayat')?>" class="nav-item <?php if(check_link_module(['presensi/riwayat','presensi/laporan/kegiatan'])){echo 'active';}?>" title="Riwayat Presensi">
                    <i class="fas fa-history"></i>
                    <span>Riwayat</span>
                </a>
            <?php }?>
            <?php if(return_access_link(['presensi/harian'])){?>
                <a href="<?=site_url('presensi/harian')?>" class="nav-item <?php if(check_link_module(['presensi/harian'])){echo 'active';}?>" title="Presensi Harian Pegawai">
                    <i class="fas fa-calendar-day"></i>
                    <span>Harian</span>
                </a>
            <?php }?>
            <?php if(return_access_link(['presensi/bulanan'])){?>
                <a href="<?=site_url('presensi/bulanan')?>" class="nav-item <?php if(check_link_module(['presensi/bulanan'])){echo 'active';}?>" title="Resume Presensi Bulanan">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Bulanan</span>
                </a>
            <?php }?>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script>
        $(document).ready(function() {
            // Aktivasi tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })

            // Auto-hide flashdata
            const flashdata = document.getElementById('flashdata_message');
            if(flashdata) {
                setTimeout(function() {
                    flashdata.style.transition = 'opacity 0.5s ease';
                    flashdata.style.opacity = '0';
                    setTimeout(function() {
                        flashdata.remove();
                    }, 500);
                }, 5000);
            }
        });
    </script>
    
    <!-- JAVASCRIPT -->
    <?=view('tBaseJavascript')?>
</body>
</html>
