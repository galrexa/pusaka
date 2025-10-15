<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=(isset($title))?$title:'Presensi'?></title>
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
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            padding-top: 0;
            overflow-x: hidden;
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

        /* Status Lokasi Card - Prominent */
        .status-card {
            position: fixed;
            top: 60px;
            left: 0;
            right: 0;
            background: white;
            z-index: 1001;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 12px 16px 16px;
        }

        .status-greeting {
            font-size: 14px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 8px;
        }

        .status-location {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            transition: all 0.3s ease;
            margin-bottom: 12px;
        }

        .status-location.in-area {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            border: 2px solid #28a745;
        }

        .status-location.out-area {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            border: 2px solid #dc3545;
        }

        .status-location.loading {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            border: 2px solid #2196f3;
        }

        .status-icon {
            font-size: 22px;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .status-text {
            flex: 1;
        }

        .status-title {
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 3px;
        }

        .status-address {
            font-size: 11px;
            opacity: 0.8;
            line-height: 1.3;
        }

        /* Info Detail Section - Responsive */
        .info-detail-section {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .detail-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 8px 12px;
            flex: 1;
            min-width: 100px;
        }

        .detail-card-label {
            font-size: 10px;
            color: #64748b;
            margin-bottom: 3px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .detail-card-value {
            font-size: 12px;
            font-weight: 600;
            color: #1e293b;
        }

        .detail-card.empty {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            font-size: 11px;
            flex: 1 1 100%;
        }

        /* Map Container - Responsive dengan Rounded untuk semua device */
        .map-container {
            position: fixed;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }

        /* Desktop: Wider map */
        @media (min-width: 769px) {
            .map-container {
                top: 250px;
                bottom: 100px;
                width: 90%;
                max-width: 900px;
            }
        }

        /* Mobile: Narrower map but still rounded */
        @media (max-width: 768px) {
            .map-container {
                top: 270px;
                bottom: 100px;
                width: 92%;
                max-width: 500px;
            }
        }

        #map, #div_map {
            width: 100%;
            height: 100%;
        }

        .map-loading {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
            text-align: center;
        }

        .spinner {
            border: 4px solid #f3f4f6;
            border-top: 4px solid #667eea;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin: 0 auto 10px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Map Controls */
        .map-controls {
            position: absolute;
            right: 12px;
            top: 12px;
            z-index: 999;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .control-btn {
            background: white;
            border: none;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            box-shadow: 0 3px 12px rgba(0,0,0,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 18px;
            color: #667eea;
        }

        .control-btn:active {
            transform: scale(0.95);
        }

        /* Bottom Action Panel - Floating Overlay */
        .action-panel {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            display: flex;
            justify-content: center;
        }

        /* Tombol Aksi - Floating Button */
        .btn-action {
            padding: 14px 28px;
            border-radius: 50px;
            border: none;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.25);
            backdrop-filter: blur(10px);
        }

        .btn-start {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .btn-start:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
        }

        .btn-start:active {
            transform: translateY(0);
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .btn-stop {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .btn-stop:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
        }

        .btn-stop:active {
            transform: translateY(0);
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        }

        .btn-action i {
            font-size: 18px;
        }

        /* Bottom Navigation - Fixed at bottom */
        .bottom-nav-container {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            z-index: 1002;
            box-shadow: 0 -4px 20px rgba(0,0,0,0.1);
            padding: 10px 16px;
            padding-bottom: calc(10px + env(safe-area-inset-bottom));
        }

        /* Bottom Navigation - Simplified */
        .bottom-nav {
            display: flex;
            justify-content: space-around;
            align-items: center;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
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

        /* Camera Modal */
        .modal-content {
            border-radius: 16px;
        }

        .modal-header {
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        video {
            width: 100%;
            height: 400px;
            object-fit: cover;
            background: #000;
            border-radius: 8px;
        }

        canvas {
            display: none;
        }

        .info-text {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            padding: 12px;
            font-size: 13px;
            color: #6c757d;
            margin-top: 12px;
        }

        .info-text b {
            display: block;
            margin-bottom: 8px;
            color: #495057;
        }

        .info-text label {
            display: block;
            margin: 8px 0;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php
        // Set timezone Indonesia
        date_default_timezone_set('Asia/Jakarta');
        $hour = (int)date('H');
        
        // Determine greeting and icon
        if ($hour >= 5 && $hour < 11) {
            $greeting = 'Pagi';
            $icon = '☀️';
        } elseif ($hour >= 11 && $hour < 15) {
            $greeting = 'Siang';
            $icon = '🌤️';
        } elseif ($hour >= 15 && $hour < 18) {
            $greeting = 'Sore';
            $icon = '🌅';
        } else {
            $greeting = 'Malam';
            $icon = '🌙';
        }
    ?>

    <!-- Custom Header - Simple & Clean -->
    <header class="presensi-header">
        <div class="header-left">
            <a href="<?=base_url()?>" class="header-brand">
                <img src="<?=base_url('assets/img/logo.png')?>" alt="Logo" class="header-logo">
                <span class="header-title">Presensi</span>
            </a>
        </div>
        <!-- <div class="header-right">
            <a href="<?=site_url('kepegawaian/profile')?>" class="header-user">
                <span class="header-name"><?=session()->get('nama')?></span>
                <img src="<?=session()->get('pegawai_foto')?>" alt="Profile" class="header-avatar">
            </a>
        </div> -->
    </header>

    <!-- Include Alert & Toast Helper -->
    <?=view('tBaseAlert')?>

    <!-- Status Lokasi Card -->
    <div class="status-card">
        <div class="status-greeting">
            <?=$icon?> Selamat <?=$greeting?>, <strong><?=session()->get('nama')?></strong>
        </div>
        
        <div class="status-location loading" id="status_location">
            <i class="fas fa-spinner fa-spin status-icon"></i>
            <div class="status-text">
                <div class="status-title" id="status_title">Mengambil lokasi...</div>
                <div class="status-address" id="status_address">Mohon tunggu sebentar</div>
            </div>
        </div>

        <!-- Info Detail Section -->
        <div class="info-detail-section">
            <?php if(!empty($data)){?>
                <div class="detail-card">
                    <div class="detail-card-label">
                        <i class="fas fa-play-circle text-success"></i>
                        Mulai
                    </div>
                    <div class="detail-card-value">
                        <?=substr($data->start, 10)?>
                    </div>
                </div>
                <?php if($data->stop<>''){?>
                <div class="detail-card">
                    <div class="detail-card-label">
                        <i class="fas fa-stop-circle text-danger"></i>
                        Selesai
                    </div>
                    <div class="detail-card-value">
                        <?=substr($data->stop, 10)?>
                    </div>
                </div>
                <?php }?>
                <div class="detail-card">
                    <div class="detail-card-label">
                        <i class="fas fa-clock text-primary"></i>
                        Durasi
                    </div>
                    <div class="detail-card-value">
                        <?=$data->total_durasi?>
                    </div>
                </div>
            <?php }else{?>
                <div class="detail-card empty">
                    <i class="fas fa-info-circle me-1"></i>
                    Belum ada presensi hari ini
                </div>
            <?php }?>
        </div>
    </div>

    <!-- Map Container -->
    <div class="map-container">
        <div class="map-loading" id="map_loading">
            <div class="spinner"></div>
            <small style="color: #6b7280;">Memuat peta...</small>
        </div>
        <div id="div_map"></div>
        
        <!-- Map Controls -->
        <div class="map-controls">
            <button class="control-btn" onclick="window.location.reload(true)" title="Refresh Lokasi">
                <i class="fas fa-sync-alt"></i>
            </button>
            <button class="control-btn" id="btnOpenCam" style="display:none" title="Buka Kamera">
                <i class="fa fa-camera"></i>
            </button>
        </div>

        <!-- Floating Action Button - Overlay di Peta -->
        <div class="action-panel">
            <div class="div_tombol_presensi">
                <button class="btn-action btn-start" onclick="presensi_start()">
                    <i class="fas fa-play-circle"></i>
                    <span>Mulai Kerja</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Bottom Navigation - Fixed -->
    <div class="bottom-nav-container">
        <div class="bottom-nav">
            <a href="<?=base_url()?>" class="nav-item">
                <i class="fas fa-home"></i>
                <span>Beranda</span>
            </a>
            <?php if(return_access_link(['presensi/index'])){?>
                <div class="nav-item active">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Presensi</span>
                </div>
            <?php }?>
            <?php if(return_access_link(['presensi/riwayat'])){?>
                <a href="<?=site_url('presensi/riwayat')?>" class="nav-item">
                    <i class="fas fa-history"></i>
                    <span>Riwayat</span>
                </a>
            <?php }?>
            <?php if(return_access_link(['presensi/harian'])){?>
                <a href="<?=site_url('presensi/harian')?>" class="nav-item">
                    <i class="fas fa-calendar-day"></i>
                    <span>Harian</span>
                </a>
            <?php }?>
        </div>
    </div>

    <!-- Modal Camera -->
    <div class="modal fade" id="modal_open_cam" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">📸 Ambil Foto & Alasan</h5>
                    <button type="button" class="btn btn-light btn-sm" onclick="switchCamera()">
                        <i class="fa fa-sync-alt"></i> Ganti Kamera
                    </button>
                </div>
                <div class="modal-body">
                    <video class="liveCam" id="video" autoplay playsinline></video>
                    <canvas class="liveCam" id="canvas"></canvas>
                    <div id="imghasil" style="display:none"></div>
                    
                    <div class="info-text" id="keterangan">
                        <b>Pilih Keterangan:</b>
                        <?php foreach (return_referensi_list('alasan_absen_luar_area') as $k) {?>
                            <label>
                                <input type="radio" name="keterangan" value="<?=$k->ref_name?>"> 
                                <?=$k->ref_name?>
                            </label>
                        <?php }?>
                        <textarea class="form-control mt-2" name="keterangan2" id="keterangan2" placeholder="Keterangan tambahan..." rows="2"></textarea>
                        <input type="hidden" name="file_foto" id="file_foto">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="capturePhoto()">
                        <i class="fas fa-check"></i> Simpan Foto
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="stopCamera()">
                        <i class="fa fa-times"></i> Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="<?=base_url('assets/vendors/leaflet/leaflet.css')?>"/>
    <script src="<?=base_url('assets/vendors/leaflet/leaflet.js')?>"></script>
    <script src="<?=base_url('assets/js/custom.js')?>"></script>
    <script type="text/javascript">
        var totalSeconds = 0;
        localStorage.setItem('open_modal_', 0)

        $(function(){
            presensi_check()
            getLocation()
            
            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'))
            var tooltipList = tooltipTriggerList.map(function (el) {
                return new bootstrap.Tooltip(el)
            })
        })

        function presensi_start() {
            var open_modal_ = localStorage.getItem('open_modal_')
            var in_area = localStorage.getItem('in_area')
            var clat = localStorage.getItem('clat')
            var clong = localStorage.getItem('clong')
            var keterangan = ''
            var keterangan2 = ''
            var file_foto = $('#file_foto').val()
            var rslt = 0
            
            if(in_area==1){
                rslt = 1
            }else{
                switch (open_modal_) {
                    case '0':
                        startCamera(1)
                        break;
                    default:
                        keterangan = $('input[name=keterangan]:checked').val()
                        keterangan2 = $('#keterangan2').val()
                        if(in_area==0 && (keterangan=='' || keterangan==undefined)) {
                            alert('Pilih keterangan terlebih dahulu')
                        }else{
                            if(keterangan=='Lainnya')
                                keterangan += ': ' + keterangan2
                            rslt = 1
                        }
                        break;
                }
            }
            
            if(rslt==1){
                $.post('<?=site_url('api/presensi/start')?>', {
                    latlong:clat+','+clong, 
                    keterangan:keterangan, 
                    file_foto:file_foto
                }, function(rs){
                    if(rs.status==true) {
                        localStorage.setItem('open_modal_', 0)
                        window.location.assign('<?=site_url('presensi/riwayat')?>')
                    }else{
                        alert(rs.message)
                    }
                })
            }
        }

        function presensi_stop(id) {
            var open_modal_ = localStorage.getItem('open_modal_')
            var cf = true
            if(open_modal_=='0')
                cf = confirm('Akhiri presensi hari ini?')
                
            if(cf===true){
                var in_area = localStorage.getItem('in_area')
                var clat = localStorage.getItem('clat')
                var clong = localStorage.getItem('clong')
                var keterangan = ''
                var keterangan2 = ''
                var file_foto = $('#file_foto').val()
                var rslt = 0
                
                if(in_area==1){
                    rslt = 1
                }else{
                    switch (open_modal_) {
                        case '0':
                            startCamera(2)
                            break;
                        default:
                            keterangan = $('input[name=keterangan]:checked').val()
                            keterangan2 = $('#keterangan2').val()
                            if(in_area==0 && (keterangan=='' || keterangan==undefined)) {
                                alert('Pilih keterangan terlebih dahulu')
                            }else{
                                if(keterangan=='Lainnya')
                                    keterangan += ': ' + keterangan2
                                rslt = 1
                            }
                            break;
                    }
                }
                
                if(rslt==1){
                    $.post('<?=site_url('api/presensi/stop')?>', {
                        id:id, 
                        latlong:clat+','+clong, 
                        keterangan:keterangan, 
                        file_foto:file_foto
                    }, function(rs){
                        if(rs.status==true) {
                            localStorage.setItem('open_modal_', 0)
                            window.location.assign('<?=site_url('presensi/riwayat')?>')
                        }else{
                            alert(rs.message)
                        }
                    })
                }
            }
        }

        function presensi_check() {
            $('#keterangan').hide().prop('required', false)
            $.get('<?=site_url('api/presensi/check')?>', function(rs){
                if(rs.status==true) {
                    localStorage.setItem('durasi_in_second', parseInt(rs.data.durasi_in_second));
                    totalSeconds = parseInt(localStorage.getItem('durasi_in_second'));
                    
                    if(rs.data.stop==null){
                        localStorage.setItem('presensi_id', rs.data.id)
                        $('.div_tombol_presensi').html(
                            '<button class="btn-action btn-stop" onclick="presensi_stop('+rs.data.id+')">'+
                            '<i class="fa fa-stop-circle"></i>'+
                            '<span>Selesai (<span class="countUpTimes"></span>)</span>'+
                            '</button>'
                        )
                        setInterval(countUpTracker, 1000);
                    }else{
                        $('.div_tombol_presensi').html(
                            '<button class="btn-action btn-start" onclick="presensi_start()">'+
                            '<i class="fa fa-play-circle"></i>'+
                            '<span>Mulai Kerja</span>'+
                            '</button>'
                        )
                        localStorage.removeItem('durasi_in_second');
                    }
                }else{
                    $('.div_tombol_presensi').html(
                        '<button class="btn-action btn-start" onclick="presensi_start()">'+
                        '<i class="fa fa-play-circle"></i>'+
                        '<span>Mulai Kerja</span>'+
                        '</button>'
                    )
                    localStorage.removeItem('durasi_in_second');
                }
            })
        }

        function countUpTracker() {
            ++totalSeconds;
            var sec_num = parseInt(totalSeconds, 10)
            var hours = Math.floor(sec_num / 3600)
            var minutes = Math.floor(sec_num / 60) % 60
            var seconds = sec_num % 60
            var durasi = [hours,minutes,seconds]
                .map(v => v < 10 ? "0" + v : v)
                .filter((v,i) => v !== "00" || i > 0)
                .join(":")
            $('.countUpTimes').html(durasi);
        }

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(saveLatLong, function(error) {
                    console.error('Geolocation error:', error)
                    $('#status_title').text('Gagal mengambil lokasi')
                    $('#status_address').text('Pastikan GPS aktif dan izinkan akses lokasi')
                    $('#status_location').removeClass('loading').addClass('out-area')
                });
            } else {
                alert("Geolocation tidak didukung browser ini");
            }
        }

        function saveLatLong(position) {
            var coord_lat = position.coords.latitude
            var coord_long = position.coords.longitude
            localStorage.setItem('clat', coord_lat)
            localStorage.setItem('clong', coord_long)
            console.log('Koordinat:', coord_lat+', '+coord_long)
            showPosition()
            check_my_location_in_areas()
            get_my_address_by_latlong()
        }

        function showPosition(clat='', clong='', deskripsi='Lokasi Anda saat ini!') {
            var presensi_area = [
                <?php foreach ($list_area as $k) {
                    echo '["'.$k->name.'", '.$k->latlong.','.$k->range.'],';
                }?>
            ]
            var coord_lat = (clat)?clat:localStorage.getItem('clat')
            var coord_long = (clong)?clong:localStorage.getItem('clong')
            
            $('#div_map').html('<div id="map"></div>')
            $('#map_loading').fadeOut()
            
            var map = L.map('map').setView([coord_lat, coord_long], 17);
            L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
                maxZoom: 20,
                subdomains:['mt0','mt1','mt2','mt3']
            }).addTo(map)
            
            var marker = L.marker([coord_lat, coord_long]).addTo(map)
                .bindPopup(deskripsi).openPopup()
        }

        function check_my_location_in_areas(clat='', clong='') {
            var coord_lat = (clat)?clat:localStorage.getItem('clat')
            var coord_long = (clong)?clong:localStorage.getItem('clong')
            
            $.get('<?=site_url('api/check_location_in_radius_absen')?>', {
                lat: coord_lat, 
                long:coord_long
            }, function(rs){
                if(rs.status==true) {
                    var status = rs.data.status
                    if(status==false) {
                        $('#status_title').html(rs.data.message)
                        $('#status_location').removeClass('loading in-area').addClass('out-area')
                        $('#status_location .status-icon').removeClass('fa-spin fa-spinner').addClass('fa-exclamation-triangle')
                        $('#keterangan').show().prop('required', true)
                        $('#btnOpenCam').show()
                        localStorage.setItem('in_area', 0)
                    }else{
                        $('#status_title').html(rs.data.message)
                        $('#status_location').removeClass('loading out-area').addClass('in-area')
                        $('#status_location .status-icon').removeClass('fa-spin fa-spinner').addClass('fa-check-circle')
                        $('#keterangan').hide().prop('required', false)
                        $('#btnOpenCam').hide()
                        localStorage.setItem('in_area', 1)
                    }
                    checkPilihKeterangan()
                }else{
                    alert(rs.message)
                }
            })
        }

        function get_my_address_by_latlong(clat='', clong='') {
            var coord_lat = (clat)?clat:localStorage.getItem('clat')
            var coord_long = (clong)?clong:localStorage.getItem('clong')
            
            $.get('<?=site_url('api/get_place')?>', {
                latlng: coord_lat+','+coord_long
            }, function(rs){
                if(rs.data && rs.data.results && rs.data.results.length > 0) {
                    var almt = rs.data.results[0].formatted_address
                    $('#status_address').html(almt)
                }
            })
        }

        // Camera Functions
        let video = document.getElementById('video');
        let canvas = document.getElementById('canvas');
        let btnOpenCam = document.getElementById('btnOpenCam');
        let stream = null;
        let currentFacingMode = 'user';

        async function startCamera(opt) {
            $('#modal_open_cam').modal('show')
            try {
                const constraints = {
                    video: { facingMode: currentFacingMode }
                };
                stream = await navigator.mediaDevices.getUserMedia(constraints);
                video.srcObject = stream;
                localStorage.setItem('opt', opt)
            } catch (err) {
                console.error('Error accessing camera:', err);
                alert('Tidak dapat mengakses kamera')
            }
        }

        function stopCamera() {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                stream = null;
                video.srcObject = null;
            }
        }

        function capturePhoto() {
            var lock = 0
            var opt = localStorage.getItem('opt')
            keterangan = $('input[name=keterangan]:checked').val()
            keterangan2 = $('#keterangan2').val()
            
            if(!keterangan) {
                alert('Pilih keterangan terlebih dahulu.')
                return
            }
            
            if(keterangan=='Lainnya' && !keterangan2) {
                alert('Isi keterangan tambahan.')
                return
            }
            
            localStorage.setItem('open_modal_', 1)
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const ctx = canvas.getContext('2d');
            ctx.drawImage(video, 0, 0);
            const dataURL = canvas.toDataURL('image/png');
            
            file_upload_form_capture_whit_query(
                dataURLToBlob(dataURL), 
                'selfi_cam', 
                '?pegawai_id=<?=session()->get('pegawai_id')?>', 
                function(result){
                    if(result.status==true) {
                        $('#file_foto').val(result.data.id)
                        $('#imghasil').show().html(`<img src="${dataURL}" class="img-thumbnail">`)
                        $('.liveCam').hide()
                        
                        if(opt==='1'){
                            presensi_start()
                        }else{
                            presensi_stop(localStorage.getItem('presensi_id'))
                        }
                    }
                }
            )
        }

        async function switchCamera() {
            currentFacingMode = currentFacingMode === 'user' ? 'environment' : 'user';
            if (stream) {
                stopCamera();
                setTimeout(() => startCamera(localStorage.getItem('opt')), 100);
            }
        }

        if(btnOpenCam) {
            btnOpenCam.addEventListener('click', () => startCamera(1));
        }

        function checkPilihKeterangan() {
            keterangan = $('input[name=keterangan]:checked').val()
            if(keterangan=='Lainnya') {
                $('#keterangan2').show().prop('required', true)
            }else{
                $('#keterangan2').hide().prop('required', false).val('')
            }
        }

        $('input[name=keterangan]').on('change', checkPilihKeterangan)

        function file_upload_form_capture_whit_query(fileBlob, firstName, urlQuery='', callback) {
            var formData = new FormData();
            formData.append('first', firstName);
            formData.append('output', 'json');
            formData.append('userfile', fileBlob);
            formData.append('<?=csrf_token()?>', '<?=csrf_hash()?>');
            
            $.ajax({
                type:'POST',
                data: formData,
                cache:false,
                processData: false,
                contentType: false,
                url: '<?=site_url('api/file/upload')?>'+urlQuery,
                success:function(data){
                    callback(data)
                }
            });
        }

        function dataURLToBlob(dataURL) {
            const arr = dataURL.split(',');
            const mime = arr[0].match(/:(.*?);/)[1];
            const bstr = atob(arr[1]);
            let n = bstr.length;
            const u8arr = new Uint8Array(n);
            while(n--) {
                u8arr[n] = bstr.charCodeAt(n);
            }
            return new Blob([u8arr], {type: mime});
        }
    </script>
</body>
</html>
