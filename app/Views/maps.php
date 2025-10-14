<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=(isset($title))?$title:'Lokasi Presensi'?></title>
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
        body {
            background: var(--background-light);
            padding-bottom: 20px;
        }

        /* Header Info Card */
        .location-header {
            background: var(--background-white);
            margin: 16px;
            margin-top: 80px;
            padding: 20px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-card);
        }

        .location-title {
            color: var(--text-dark);
            font-size: 18px;
            font-weight: var(--font-bold);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .location-subtitle {
            color: var(--text-medium);
            font-size: 14px;
            margin-bottom: 0;
        }

        /* Map Container dengan info card */
        .map-wrapper {
            margin: 0 16px 16px;
        }

        .map-info-card {
            background: var(--background-white);
            padding: 16px;
            border-radius: var(--radius-lg) var(--radius-lg) 0 0;
            box-shadow: var(--shadow-card);
            border-bottom: 2px solid var(--border-color);
        }

        .map-info-title {
            font-size: 14px;
            font-weight: var(--font-semibold);
            color: var(--text-dark);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .map-info-address {
            font-size: 13px;
            color: var(--text-medium);
            line-height: 1.5;
            display: flex;
            align-items: start;
            gap: 8px;
        }

        .map-info-address i {
            color: var(--primary-color-modern);
            margin-top: 3px;
        }

        .map-container {
            position: relative;
            height: 450px;
            min-height: 450px;
            border-radius: 0 0 var(--radius-lg) var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-card);
            background: #f0f0f0;
        }

        #map, #div_map {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* Loading overlay */
        .map-loading {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 999;
            flex-direction: column;
            gap: 12px;
        }

        .map-loading i {
            font-size: 32px;
            color: var(--primary-color-modern);
            animation: pulse 1.5s ease-in-out infinite;
        }

        /* Legend Card */
        .legend-card {
            background: var(--background-white);
            margin: 16px;
            padding: 16px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
        }

        .legend-title {
            font-size: 14px;
            font-weight: var(--font-semibold);
            color: var(--text-dark);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 0;
            font-size: 13px;
            color: var(--text-medium);
        }

        .legend-icon {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--radius-sm);
        }

        .legend-icon.marker {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .legend-icon.radius {
            background: rgba(231, 76, 60, 0.1);
            color: var(--error-color);
            border: 2px solid var(--error-color);
        }

        /* Action Button */
        .action-button {
            margin: 0 16px 16px;
        }

        .btn-back {
            background: var(--primary-gradient);
            border: none;
            padding: 14px 24px;
            border-radius: var(--radius-lg);
            font-weight: var(--font-semibold);
            color: white;
            width: 100%;
            cursor: pointer;
            transition: var(--transition-base);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: var(--shadow-button-primary);
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 28px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .btn-back:active {
            transform: translateY(0);
        }

        /* Coordinates Badge */
        .coordinates-badge {
            background: var(--background-light);
            padding: 8px 12px;
            border-radius: var(--radius-sm);
            font-size: 12px;
            color: var(--text-medium);
            font-family: monospace;
            margin-top: 8px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .coordinates-badge i {
            color: var(--primary-color-modern);
        }

        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: var(--radius-sm);
            font-size: 12px;
            font-weight: var(--font-semibold);
        }

        .status-badge.success {
            background: rgba(39, 174, 96, 0.1);
            color: #27ae60;
        }

        .status-badge.warning {
            background: rgba(243, 156, 18, 0.1);
            color: #f39c12;
        }

        /* Pulse animation */
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
                transform: scale(1);
            }
            50% {
                opacity: 0.7;
                transform: scale(1.05);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .location-header {
                margin: 12px;
                margin-top: 70px;
                padding: 16px;
            }

            .location-title {
                font-size: 16px;
            }

            .map-wrapper {
                margin: 0 12px 12px;
            }

            .map-container {
                height: 350px;
                min-height: 350px;
            }

            .legend-card {
                margin: 12px;
                padding: 12px;
            }

            .action-button {
                margin: 0 12px 12px;
            }
        }

        @media (min-width: 769px) {
            .location-header,
            .map-wrapper,
            .legend-card,
            .action-button {
                max-width: 1200px;
                margin-left: auto;
                margin-right: auto;
            }

            .map-container {
                height: 500px;
                min-height: 500px;
            }
        }
    </style>
</head>
<body>

    <!-- NAVBAR HEADER - Using tBaseHeader for consistency -->
    <?=view('tBaseHeader')?>

    <!-- Location Header Info -->
    <div class="location-header">
        <div class="location-title">
            <i class="fas fa-map-marker-alt" style="color: var(--primary-color-modern);"></i>
            <?=$title_name?>
        </div>
        <div class="location-subtitle">
            Detail lokasi presensi yang tercatat
        </div>
    </div>

    <!-- Map Wrapper with Info Card -->
    <div class="map-wrapper">
        <!-- Map Info Card -->
        <div class="map-info-card">
            <div class="map-info-title">
                <i class="fas fa-info-circle" style="color: var(--primary-color-modern);"></i>
                Informasi Lokasi
            </div>
            <div class="map-info-address" id="address-container">
                <i class="fas fa-spinner fa-spin"></i>
                <span>Memuat alamat lokasi...</span>
            </div>
            <div class="coordinates-badge">
                <i class="fas fa-globe"></i>
                <span>Koordinat: <?=$latlng[0]?>, <?=$latlng[1]?></span>
            </div>
        </div>

        <!-- Map Container -->
        <div class="map-container">
            <div class="map-loading" id="mapLoading">
                <i class="fas fa-map-marked-alt"></i>
                <span style="color: var(--text-medium); font-size: 14px;">Memuat peta...</span>
            </div>
            <div id="div_map"></div>
        </div>
    </div>

    <!-- Legend Card -->
    <div class="legend-card">
        <div class="legend-title">
            <i class="fas fa-layer-group"></i>
            Keterangan Peta
        </div>
        <div class="legend-item">
            <div class="legend-icon marker">
                <i class="fas fa-map-marker-alt"></i>
            </div>
            <div>
                <strong>Marker Biru</strong>
                <div style="font-size: 12px; color: var(--text-light);">Lokasi titik presensi</div>
            </div>
        </div>
        <div class="legend-item">
            <div class="legend-icon radius">
                <i class="fas fa-circle"></i>
            </div>
            <div>
                <strong>Lingkaran Merah</strong>
                <div style="font-size: 12px; color: var(--text-light);">Radius area presensi (30 meter)</div>
            </div>
        </div>
    </div>

    <!-- Action Button -->
    <div class="action-button">
        <button class="btn-back" onclick="window.history.back()">
            <i class="fas fa-arrow-left"></i>
            <span>Kembali</span>
        </button>
    </div>

    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="<?=base_url('assets/vendors/leaflet/leaflet.css')?>"/>
    <script src="<?=base_url('assets/vendors/leaflet/leaflet.js')?>"></script>
    <script src="<?=base_url('assets/js/custom.js')?>"></script>
    
    <script type="text/javascript">
        $(function(){
            // Hide sidebar on location view page
            $('#sidebar').hide();
            $('#sidebarToggle').hide();

            // Initialize map and get address
            setTimeout(function() {
                showPosition(<?=$latlng[0]?>, <?=$latlng[1]?>);
                get_my_address_by_latlong(<?=$latlng[0]?>, <?=$latlng[1]?>);
            }, 300);

            // Initialize tooltips
            initTooltips();
        });

        function initTooltips() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }

        function showPosition(clat='', clong='', deskripsi='Lokasi Presensi')
        {
            var presensi_area = [
                <?php /* foreach ($list_area as $k) {
                    echo '["'.$k->name.'", '.$k->latlong.','.$k->range.'],';
                } */ ?>
            ];

            var coord_lat = (clat) ? clat : localStorage.getItem('clat');
            var coord_long = (clong) ? clong : localStorage.getItem('clong');
            
            $('#div_map').html('<div id="map"></div>');
            
            var map = L.map('map').setView([coord_lat, coord_long], 17);
            
            // Use Google Maps tiles
            L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
                maxZoom: 20,
                subdomains:['mt0','mt1','mt2','mt3']
            }).addTo(map);

            // Custom marker icon with gradient
            var customIcon = L.divIcon({
                className: 'custom-marker',
                html: '<div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); width: 30px; height: 30px; border-radius: 50% 50% 50% 0; transform: rotate(-45deg); border: 3px solid white; box-shadow: 0 4px 12px rgba(0,0,0,0.3);"></div>',
                iconSize: [30, 30],
                iconAnchor: [15, 30]
            });

            // Add marker
            var marker = L.marker([coord_lat, coord_long], {icon: customIcon})
                .addTo(map)
                .bindPopup('<div style="text-align: center; padding: 8px;"><strong style="color: var(--primary-color-modern);">📍 ' + deskripsi + '</strong><br><small style="color: var(--text-medium);">Lat: ' + coord_lat.toFixed(6) + '<br>Long: ' + coord_long.toFixed(6) + '</small></div>')
                .openPopup();

            // Add circle radius
            var circle = L.circle([clat, clong], {
                color: '#e74c3c',
                fillColor: '#e74c3c',
                fillOpacity: 0.15,
                radius: 30,
                weight: 2
            }).addTo(map).bindPopup('<div style="text-align: center; padding: 8px;"><strong style="color: #e74c3c;">🔴 Radius Area Presensi</strong><br><small>30 meter dari titik</small></div>');

            // Add area presensi from database (if any)
            for (var i = 0; i < presensi_area.length; i++) {
                L.circle([presensi_area[i][1], presensi_area[i][2]], {
                    color: '#27ae60',
                    fillColor: '#27ae60',
                    fillOpacity: 0.15,
                    radius: presensi_area[i][3],
                    weight: 2
                }).addTo(map).bindPopup('<div style="text-align: center; padding: 8px;"><strong style="color: #27ae60;">🟢 Area Presensi</strong><br>' + presensi_area[i][0] + '</div>');
            }

            // Hide loading overlay
            $('#mapLoading').fadeOut(500);
        }

        function get_my_address_by_latlong(clat='', clong='')
        {
            var coord_lat = (clat) ? clat : localStorage.getItem('clat');
            var coord_long = (clong) ? clong : localStorage.getItem('clong');
            
            $.get('<?=site_url('api/get_place')?>', {
                latlng: coord_lat + ',' + coord_long
            }, function(rs){
                console.log('Address API Response:', rs.data);
                
                if(rs.data && rs.data.results && rs.data.results.length > 0) {
                    var almt = rs.data.results[0].formatted_address;
                    
                    // Update address display
                    $('#address-container').html(
                        '<i class="fas fa-map-marker-alt" style="color: var(--success-color);"></i>' +
                        '<span>' + almt + '</span>'
                    );

                    // Add status badge
                    var statusBadge = '<div class="status-badge success" style="margin-top: 8px;">' +
                        '<i class="fas fa-check-circle"></i>' +
                        '<span>Lokasi terverifikasi</span>' +
                    '</div>';
                    $('#address-container').append(statusBadge);
                } else {
                    $('#address-container').html(
                        '<i class="fas fa-exclamation-triangle" style="color: var(--warning-color);"></i>' +
                        '<span>Alamat tidak dapat dimuat</span>'
                    );
                }
            }).fail(function() {
                $('#address-container').html(
                    '<i class="fas fa-times-circle" style="color: var(--error-color);"></i>' +
                    '<span>Gagal memuat alamat lokasi</span>'
                );
            });
        }
    </script>
</body>
</html>
