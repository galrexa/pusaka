<div class="card" style="background: var(--background-white); border-radius: var(--radius-base); box-shadow: var(--shadow-card); border: none;">
    <div class="card-body" style="padding: var(--space-2xl);">
        <!-- Info Pegawai Section -->
        <div class="row mb-4">
            <div class="col-sm-12 col-md-12">
                <div class="row mb-3">
                    <div class="col-sm-12 col-md-2 fw-bold" style="color: var(--text-dark); font-size: var(--font-base);">
                        Nama:
                    </div>
                    <div class="col-sm-12 col-md-10" style="color: var(--text-medium); font-size: var(--font-base);">
                        <?=$data_pegawai->nama?>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12 col-md-2 fw-bold" style="color: var(--text-dark); font-size: var(--font-base);">
                        Jabatan:
                    </div>
                    <div class="col-sm-12 col-md-10" style="color: var(--text-medium); font-size: var(--font-base);">
                        <?=$data_pegawai->jabatan?>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12 col-md-2 fw-bold" style="color: var(--text-dark); font-size: var(--font-base);">
                        Unit Kerja:
                    </div>
                    <div class="col-sm-12 col-md-10" style="color: var(--text-medium); font-size: var(--font-base);">
                        <?=$data_pegawai->unit_kerja_alt?> (<?=$data_pegawai->unit_kerja?>)
                    </div>
                </div>
                
                <!-- Filter Periode -->
                <div class="row mb-4">
                    <div class="col-sm-12 col-md-2 fw-bold" style="color: var(--text-dark); font-size: var(--font-base);">
                        Periode:
                    </div>
                    <div class="col-sm-12 col-md-10">
                        <div class="input-group" style="gap: var(--gap-sm);">
                            <select name="tahun" id="tahun" class="form-select" onchange="load_data()" 
                                    style="border: 2px solid var(--border-color); 
                                           border-radius: var(--radius-sm); 
                                           padding: var(--space-sm) var(--space-lg);
                                           transition: all 0.3s ease;
                                           font-size: var(--font-base);">
                                <?php $arrayTahun =[]; foreach ($list_tahun as $key) {array_push($arrayTahun, $key->tahun);}?>
                                <?php if(!array_keys($arrayTahun, $tahun) or empty($arrayTahun)){?>
                                    <option value="<?=$tahun?>" selected><?=$tahun?></option>
                                <?php }?>
                                <?php foreach ($list_tahun as $key) {?>
                                    <option value="<?=$key->tahun?>" <?php if($key->tahun==$tahun){echo'selected';}?>><?=$key->tahun?></option>
                                <?php }?>
                            </select>
                            <select name="bulan" id="bulan" class="form-select" onchange="load_data()"
                                    style="border: 2px solid var(--border-color); 
                                           border-radius: var(--radius-sm); 
                                           padding: var(--space-sm) var(--space-lg);
                                           transition: all 0.3s ease;
                                           font-size: var(--font-base);">
                                <?php foreach (array_bulan() as $key=>$value) {?>
                                    <option value="<?=$key?>" <?php if($key==$bulan){echo'selected';}?>><?=$value?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="row">
                    <div class="col-sm-12 col-md-2"></div>
                    <div class="col-sm-12 col-md-10">
                        <div class="d-flex gap-2 flex-wrap">
                            <!-- Info Button -->
                            <button class="btn" data-bs-toggle="modal" data-bs-target="#modal_tte"
                                    style="background: var(--primary-color-modern); 
                                           color: white; 
                                           border: none;
                                           padding: var(--space-sm) var(--space-lg);
                                           border-radius: var(--radius-sm);
                                           font-weight: var(--font-semibold);
                                           transition: all 0.3s ease;
                                           box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);">
                                <i class="fa fa-exclamation-circle"></i>
                            </button>
                            
                            <?php if(return_access_link(['presensi/riwayat/unduh'])){?>
                                <!-- Excel Button -->
                                <a href="#" onclick="window.open('<?=site_url('presensi/riwayat/unduh?id='.$pegawai_id.'&periode=')?>'+$('#tahun').val()+'-'+$('#bulan').val())" 
                                   class="btn" 
                                   data-bs-toggle="tooltip" 
                                   data-bs-placement="bottom" 
                                   title="Unduh data dalam bentuk file excel"
                                   style="background: var(--success-color-modern); 
                                          color: white; 
                                          border: none;
                                          padding: var(--space-sm) var(--space-lg);
                                          border-radius: var(--radius-sm);
                                          font-weight: var(--font-semibold);
                                          transition: all 0.3s ease;
                                          text-decoration: none;
                                          box-shadow: 0 6px 20px rgba(17, 153, 142, 0.3);">
                                    <i class="fa fa-file-excel"></i>
                                </a>
                                
                                <!-- Print Button -->
                                <a href="#" onclick="window.open('<?=site_url('presensi/riwayat/unduh?id='.$pegawai_id.'&periode=')?>'+$('#tahun').val()+'-'+$('#bulan').val()+'&file=print')" 
                                   class="btn" 
                                   data-bs-toggle="tooltip" 
                                   data-bs-placement="bottom" 
                                   title="Print data"
                                   style="background: var(--success-color-modern); 
                                          color: white; 
                                          border: none;
                                          padding: var(--space-sm) var(--space-lg);
                                          border-radius: var(--radius-sm);
                                          font-weight: var(--font-semibold);
                                          transition: all 0.3s ease;
                                          text-decoration: none;
                                          box-shadow: 0 6px 20px rgba(17, 153, 142, 0.3);">
                                    <i class="fa fa-print"></i>
                                </a>
                                
                                <!-- PDF Button -->
                                <a href="#" onclick="window.open('<?=site_url('presensi/riwayat/unduh?id='.$pegawai_id.'&periode=')?>'+$('#tahun').val()+'-'+$('#bulan').val()+'&file=pdf')" 
                                   class="btn" 
                                   data-bs-toggle="tooltip" 
                                   data-bs-placement="bottom" 
                                   title="Pdf data"
                                   style="background: var(--success-color-modern); 
                                          color: white; 
                                          border: none;
                                          padding: var(--space-sm) var(--space-lg);
                                          border-radius: var(--radius-sm);
                                          font-weight: var(--font-semibold);
                                          transition: all 0.3s ease;
                                          text-decoration: none;
                                          box-shadow: 0 6px 20px rgba(17, 153, 142, 0.3);">
                                    <i class="fa fa-file-pdf"></i>
                                </a>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Table Section -->
        <div class="row">
            <div class="col table-responsive">
                <table id="example1" class="table table-striped table-hover table-bordered modern-table" 
                       style="border-radius: var(--radius-sm); overflow: hidden;">
                    <thead class="modern-table-header">
                        <tr>
                            <th class="text-center text-light" rowspan="2" 
                                style="vertical-align: middle; 
                                       background: #667eea !important; 
                                       color: white !important; 
                                       font-weight: 600 !important;
                                       padding: 12px 16px !important;
                                       border: none !important;">
                                <i class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail presensi"></i>
                            </th>
                            <th class="text-center text-light" rowspan="2" 
                                style="vertical-align: middle; 
                                       background: #667eea !important; 
                                       color: white !important; 
                                       font-weight: 600 !important;
                                       padding: 12px 16px !important;
                                       border: none !important;">
                                <i class="fa fa-pencil-alt" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Form laporan kegiatan harian"></i>
                            </th>
                            <th class="text-center text-light" rowspan="2" 
                                style="vertical-align: middle; 
                                       background: #667eea !important; 
                                       color: white !important; 
                                       font-weight: 600 !important;
                                       padding: 12px 16px !important;
                                       border: none !important;">
                                Tanggal
                            </th>
                            <th class="text-center text-light" colspan="6" 
                                style="background: #667eea !important; 
                                       color: white !important; 
                                       font-weight: 600 !important;
                                       padding: 12px 16px !important;
                                       border: none !important;">
                                Presensi
                            </th>
                            <th class="text-center text-light" rowspan="2" 
                                style="vertical-align: middle; 
                                       background: #667eea !important; 
                                       color: white !important; 
                                       font-weight: 600 !important;
                                       padding: 12px 16px !important;
                                       border: none !important;">
                                Keterangan
                            </th>
                        </tr>
                        <tr>
                            <th class="text-center text-light" 
                                style="background: #667eea !important; 
                                       color: white !important; 
                                       font-weight: 600 !important;
                                       padding: 12px 16px !important;
                                       border: none !important;">Masuk</th>
                            <th class="text-center text-light" 
                                style="background: #667eea !important; 
                                       color: white !important; 
                                       font-weight: 600 !important;
                                       padding: 12px 16px !important;
                                       border: none !important;">FLEXI</th>
                            <th class="text-center text-light" 
                                style="background: #667eea !important; 
                                       color: white !important; 
                                       font-weight: 600 !important;
                                       padding: 12px 16px !important;
                                       border: none !important;">Terlambat</th>
                            <th class="text-center text-light" 
                                style="background: #667eea !important; 
                                       color: white !important; 
                                       font-weight: 600 !important;
                                       padding: 12px 16px !important;
                                       border: none !important;">Pulang</th>
                            <th class="text-center text-light" 
                                style="background: #667eea !important; 
                                       color: white !important; 
                                       font-weight: 600 !important;
                                       padding: 12px 16px !important;
                                       border: none !important;">Pulang Cepat</th>
                            <th class="text-center text-light" 
                                style="background: #667eea !important; 
                                       color: white !important; 
                                       font-weight: 600 !important;
                                       padding: 12px 16px !important;
                                       border: none !important;">Total</th>
                        </tr>
                    </thead>
                    <tbody style="vertical-align: top;"></tbody>
                </table>
            </div>
        </div>
        
        <br><br><br>
        
        <!-- Modal Informasi Kode -->
        <div class="modal modal-lg" tabindex="-1" id="modal_tte" data-bs-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content" style="border-radius: var(--radius-base); border: none; box-shadow: var(--shadow-card);">
                    <div class="modal-header" id="modal_tte_header"
                         style="background: var(--primary-gradient); 
                                color: white; 
                                border-radius: var(--radius-base) var(--radius-base) 0 0;
                                border: none;">
                        <h5 class="modal-title fw-bold">
                            <i class="fa fa-info-circle me-2"></i>Informasi Kode
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modal_tte_body" style="padding: var(--space-2xl);">
                        <div class="row">
                            <div class="col-sm-12 col-md-6" style="font-size: var(--font-sm);">
                                <div class="p-3 mb-3" style="background: var(--background-light); border-radius: var(--radius-sm); border-left: 4px solid var(--primary-color-modern);">
                                    <b class="d-block mb-2" style="color: var(--text-dark); font-size: var(--font-base);">Presensi:</b>
                                    <ul class="mb-0">
                                        <?php foreach(return_referensi_list('absen') as $k){?>
                                            <li style="color: var(--text-medium); margin-bottom: var(--space-xs);">
                                                <b><?=$k->ref_name?></b>: <?=$k->ref_description?>
                                            </li>
                                        <?php }?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6" style="font-size: var(--font-sm);">
                                <div class="p-3 mb-3" style="background: var(--background-light); border-radius: var(--radius-sm); border-left: 4px solid var(--success-color-modern);">
                                    <b class="d-block mb-2" style="color: var(--text-dark); font-size: var(--font-base);">Cuti & Dinas:</b>
                                    <ul class="mb-0">
                                        <?php foreach(return_referensi_list('cuti') as $k){?>
                                            <li style="color: var(--text-medium); margin-bottom: var(--space-xs);">
                                                <b><?=$k->ref_name?></b>: <?=$k->ref_description?>
                                            </li>
                                        <?php }?>
                                        <?php foreach(return_referensi_list('dinas') as $k){?>
                                            <li style="color: var(--text-medium); margin-bottom: var(--space-xs);">
                                                <b><?=$k->ref_name?></b>: <?=$k->ref_description?>
                                            </li>
                                        <?php }?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12" style="font-size: var(--font-sm);">
                                <div class="p-3" style="background: var(--background-light); border-radius: var(--radius-sm); border-left: 4px solid var(--warning-color);">
                                    <b class="d-block mb-2" style="color: var(--text-dark); font-size: var(--font-base);">Pelanggaran:</b>
                                    <ul class="mb-0">
                                        <?php foreach(return_referensi_list('pelanggaran') as $k){?>
                                            <li style="color: var(--text-medium); margin-bottom: var(--space-xs);">
                                                <b><?=$k->ref_name?></b>: <?=$k->ref_description?>
                                            </li>
                                        <?php }?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS & JS Dependencies -->
<link href="<?=base_url()?>assets/css/datatables.min.css" rel="stylesheet" />
<script src="<?=base_url()?>assets/js/datatables.min.js"></script>
<link href="<?=base_url('assets/')?>css/select2.min.css" rel="stylesheet" />
<script src="<?=base_url('assets/')?>js/select2.full.min.js"></script>
<script src="<?=base_url('assets/js/custom.js')?>"></script>

<style>
/* Custom Hover Effects */
.form-select:focus {
    border-color: var(--primary-color-modern) !important;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15) !important;
    outline: none !important;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15) !important;
}

/* Modern Table Styling - CRITICAL FIX */
#example1 thead th {
    background: #667eea !important;
    color: white !important;
    font-weight: 600 !important;
    padding: 12px 16px !important;
    border: none !important;
    text-align: center;
    vertical-align: middle;
}

#example1 thead {
    background: #667eea !important;
}

.modern-table-header {
    background: #667eea !important;
}

.modern-table-header th {
    background: #667eea !important;
    color: white !important;
    font-weight: 600 !important;
    font-size: 14px !important;
}

/* Modern Table Row Hover */
.modern-table tbody tr:hover {
    background-color: rgba(102, 126, 234, 0.05) !important;
    transform: scale(1.005);
}

.modern-table tbody td {
    padding: var(--space-md) var(--space-lg) !important;
    font-size: var(--font-base) !important;
    color: var(--text-medium);
    border-color: var(--border-color) !important;
}

/* Action Button Styles */
.modern-action-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: var(--background-light);
    transition: all 0.3s ease;
    text-decoration: none !important;
    color: var(--primary-color-modern);
    margin: 0 2px;
}

.modern-action-btn:hover {
    background: var(--primary-color-modern);
    color: white !important;
    transform: scale(1.1);
}

/* Tooltip Styling */
.tooltip-inner {
    background: var(--text-dark);
    border-radius: var(--radius-sm);
    padding: var(--space-sm) var(--space-md);
    font-size: var(--font-sm);
}

/* DataTables Override untuk Header */
table.dataTable thead th,
table.dataTable thead td {
    background: #667eea !important;
    color: white !important;
    border: none !important;
}
</style>

<script type="text/javascript">
$(function(){
    load_data()
})

function load_data()
{
    var t = $('#example1').DataTable({
        bDestroy: true,
        bPaginate: false,
        bLengthChange: false,
        bFilter: false,
        bInfo: false,
        bAutoWidth: false,
        processing: true,
        serverSide: true,
        pageLength: 25,
        layout: {
            topEnd: {
                search: {
                    placeholder: 'NIK, NIP, Nama, HP & Tempat Lahir'
                }
            }
        },
        ajax: {
            url: '<?=site_url('api/presensi/riwayat?'.$_SERVER['QUERY_STRING'])?>',
            type: 'POST',
            data: {
                pegawai_id: '<?=$pegawai_id?>',
                periode: $('#tahun').val()+'-'+$('#bulan').val(),
            }
        },
        columns: [
            {
                data: 'pegawai_id',
                className: 'text-center fw-bold',
                orderable: false,
                render: function(data, type, row, index){
                    var txt_view = ''
                    if(row.start!='-'){
                        <?php if(return_access_link(['presensi', 'laporan/kegiatan/view'])){?>
                            txt_view += '<a class="modern-action-btn" href="<?=site_url('presensi/laporan/kegiatan/view?id=')?>'+row.pegawai_id_hash+'&tanggal='+row.tanggal+'&link=riwayat" title="Detail & Laporan Kegiatan"><i class="fa fa-info-circle"></i></a> '
                        <?php }?>
                    }
                    return txt_view
                }
            },
            {
                data: 'pegawai_id',
                className: 'text-center fw-bold',
                orderable: false,
                render: function(data, type, row, index){
                    var txt_view = ''
                    var title_ = 'Tambah laporan kegiatan'
                    var icon_lap = 'far fa-comment-alt'
                    if(row.laporan==1){
                        title_ = 'Edit atau lihat laporan kegiatan'
                        icon_lap = 'fas fa-comment-alt'
                    }
                    if(row.start!='-'){
                        <?php if(return_access_link(['presensi', 'laporan/kegiatan'])){?>
                            txt_view += '<a class="modern-action-btn" href="<?=site_url('presensi/laporan/kegiatan?tanggal=')?>'+row.tanggal+'" title="'+title_+'"><i class="'+icon_lap+'"></i></a> '
                        <?php }?>
                    }
                    return txt_view
                }
            },
            {
                data: 'tanggal',
                className: 'text-center fw-bold',
                orderable: true,
                render: function(data, type, row){
                    var txt_view = data
                    return txt_view
                }
            },
            {
                data: 'start',
                className: 'text-center',
                orderable: false,
                render: function(data, type, row, index){
                    var txt_view = data.substring(10)
                    if(row.start!='-')
                        txt_view += '<span class="d-block" style="font-size: var(--font-sm); color: var(--text-light);">(<a href="#" onclick="window.open(\'<?=site_url('service/maps')?>?latlng='+row.start_latlong+'&title=Lokasi absen mulai `<?=$data_pegawai->nama?>`, pada '+row.start+'\', \'\', \'top=100,left=300,width=700,height=639\')" style="color: var(--primary-color-modern); text-decoration: none;">'+row.start_log+'</a>)</span>'
                    return txt_view
                }
            },
            {
                data: 'durasi_flexi',
                className: 'text-center',
                orderable: false,
                render: function(data, type, row, index){
                    var txt_view = '-'
                    if(row.flexi==1)
                        txt_view = data
                    return txt_view
                },
                visible: false
            },
            {
                data: 'durasi_terlambat',
                className: 'text-center',
                orderable: false,
                render: function(data, type, row, index){
                    var txt_view = '-'
                    if(row.terlambat==1)
                        txt_view = data
                    return txt_view
                }
            },
            {
                data: 'stop',
                className: 'text-center',
                orderable: false,
                render: function(data, type, row, index){
                    var txt_view = ''
                    if(data===null || data=='-'){}else{
                        txt_view = data.substring(10)
                        if(row.stop)
                            txt_view += '<span class="d-block" style="font-size: var(--font-sm); color: var(--text-light);">(<a href="#" onclick="window.open(\'<?=site_url('service/maps')?>?latlng='+row.stop_latlong+'&title=Lokasi absen selesai `<?=$data_pegawai->nama?>` pada '+row.start+'\', \'\', \'top=100,left=300,width=700,height=639\')" style="color: var(--primary-color-modern); text-decoration: none;">'+row.stop_log+'</a>)</span>'
                    }
                    return txt_view
                }
            },
            {
                data: 'durasi_mendahului',
                className: 'text-center',
                orderable: false,
                render: function(data, type, row, index){
                    var txt_view = '-'
                    if(row.mendahului==1)
                        txt_view = data
                    return txt_view
                }
            },
            {
                data: 'total_durasi',
                className: 'text-center',
                orderable: false,
                render: function(data, type, row, index){
                    var txt_view = data
                    return txt_view
                }
            },
            {
                data: 'keterangan',
                className: '',
                orderable: false,
                render: function(data, type, row){
                    var txt_view = data
                    return txt_view
                }
            }
        ],
        "createdRow": function( row, data, dataIndex){
            if( data.libur ==  1){
                $(row).addClass('fw-bold');
                $('td', row).css('color', 'red');
            }
        },
        order: [[ 0, '<?=$order?>' ]]
    })
}
</script>
