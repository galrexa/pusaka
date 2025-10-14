<div class="card modern-card">
    <div class="card-header modern-card-header d-flex">
        <div class="flex-grow-1">
            <h5><i class="fas fa-users"></i> <?=$title?></h5>
        </div>
        <?php if(return_access_link(['kepegawaian/form'])){?>
            <a href="<?=site_url('kepegawaian/form')?>" class="btn btn-sm btn-modern-success" title="Tambah pegawai">
                <i class="fa fa-plus-circle"></i> Tambah
            </a>
        <?php }?>
    </div>
    <div class="card-body modern-card-body">
        <!-- Filter Section -->
        <div class="form-section mb-3">
            <div class="form-section-title">
                <i class="fas fa-filter"></i> Filter Data Pegawai
            </div>
            
            <div class="row mb-2">
                <div class="col-md-2 col-sm-12">
                    <label class="modern-label">Unit Kerja:</label>
                </div>
                <div class="col-md-10 col-sm-12">
                    <select name="input_unit_kerja[]" id="input_unit_kerja" class="form-control form-control-sm modern-select" multiple onchange="load_data()"></select>
                </div>
            </div>
            
            <div class="row mb-2">
                <div class="col-md-2 col-sm-12">
                    <label class="modern-label">Jabatan:</label>
                </div>
                <div class="col-md-10 col-sm-12">
                    <select name="input_jabatan[]" id="input_jabatan" class="form-control form-control-sm modern-select" multiple onchange="load_data()"></select>
                </div>
            </div>
            
            <div class="row mb-2">
                <div class="col-md-2 col-sm-12">
                    <label class="modern-label">Jenis Kelamin:</label>
                </div>
                <div class="col-md-10 col-sm-12">
                    <select name="input_kelamin[]" id="input_kelamin" class="form-control form-control-sm modern-select" multiple onchange="load_data()"></select>
                </div>
            </div>
            
            <div class="row mb-2">
                <div class="col-md-2 col-sm-12">
                    <label class="modern-label">Status PNS:</label>
                </div>
                <div class="col-md-10 col-sm-12">
                    <select name="input_status_pns[]" id="input_status_pns" class="form-control form-control-sm modern-select" multiple onchange="load_data()"></select>
                </div>
            </div>
            
            <div class="row mb-2">
                <div class="col-sm-12 col-md-2">
                    <label class="modern-label">Pencarian:</label>
                </div>
                <div class="col-sm-12 col-md-10">
                    <div class="input-group-modern">
                        <i class="fas fa-search input-icon"></i>
                        <input type="text" name="search" id="search" class="form-control modern-input with-icon" placeholder="Nama Pegawai" oninput="load_data()">
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Table Section -->
        <div class="table-section">
            <div class="table-responsive">
                <table id="example1" class="table table-striped table-hover modern-table">
                    <thead class="modern-table-header">
                        <tr>
                            <!-- <th width="5%">#</th> -->
                            <th width="">NIK</th>
                            <th width="">Nama</th>
                            <th width="">TTL</th>
                            <th width="">Agama</th>
                            <th width="">Jenis Kelamin</th>
                            <th width="">Status Perkawinan</th>
                            <th width="">Pendidikan</th>
                            <th width="">Jabatan</th>
                            <th width="">Unit Kerja</th>
                            <th width="">No HP</th>
                            <th width="">No Telepon</th>
                            <th width="">Email Dinas</th>
                            <th width="">Email Pribadi</th>
                        </tr>
                    </thead>
                    <tbody style="vertical-align: top;"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<link href="<?=base_url()?>assets/css/datatables.css" rel="stylesheet" />
<script src="<?=base_url()?>assets/js/datatables.min.js"></script>
<link href="<?=base_url('assets/')?>css/select2.min.css" rel="stylesheet" />
<script src="<?=base_url('assets/')?>js/select2.full.min.js"></script>

<script type="text/javascript">
	$(function(){
		load_data()
        select2_unit_kerja('#input_unit_kerja')
        select2_jabatan('#input_jabatan', '<?=$unit?>')
        select2_referensi('#input_kelamin', 'gender')
        select2_referensi('#input_status_pns', 'pegawai_status_pns')
        
        // Initialize tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();
	})
    var array_pegawai = []

    function load_data()
    {
        var t = $('#example1').DataTable({
            bDestroy: true,
            bPaginate: true,
            bLengthChange: true,
            bFilter: false,
            bInfo: true,
            bAutoWidth: false,
            processing: true,
            serverSide: true,
            pageLength: 100,
            layout: {
                topEnd: {
                    search: {
                        placeholder: 'NIK, NIP, Nama, HP & Tempat Lahir'
                    }
                }
            },
            ajax: {
                url: '<?=site_url('api/kepegawaian/aktif?id='.$unit)?>',
                type: 'POST',
                data: {
                    unit_kerja: $('#input_unit_kerja').val(),
                    jabatan: $('#input_jabatan').val(),
                    kelamin: $('#input_kelamin').val(),
                    status_pns: $('#input_status_pns').val(),
                    search: $('#search').val(),
                }
            },
            columns: [
                // {
                //     data: 'pegawai_id',
                //     className: 'fw-bold',
                //     orderable: false,
                //     render: function(data, type, row, index){
                //         var txt_view = ''
                //         <?php if(return_access_link(['kepegawaian/profile'])){?>
                //             array_pegawai.push({ID: data, NAMA: row.nama})
                //             txt_view += '<a style="font-size:14pt" class="m-1 text-primary modern-action-btn" href="<?=site_url('kepegawaian/profile?id=')?>'+data+'" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Detail data" id="foto'+data+'"><i class="fas fa-spinner fa-spin"></i></a>'
                //         <?php }?>
                //         return txt_view
                //     }
                // },
                {
                    data: 'nik',
                    className: '',
                    orderable: true,
                    render: function(data, type, row){
                        var txt_view = data
                        return txt_view
                    }
                },
                {
                    data: 'nama',
                    className: '',
                    orderable: true,
                    render: function(data, type, row, index){
                        return data
                    }
                },
                {
                    data: 'tanggal_lahir',
                    className: '',
                    orderable: true,
                    render: function(data, type, row, index){
                        return row.tempat_lahir +', '+ data
                    }
                },
                {
                    data: 'agama',
                    className: '',
                    orderable: true,
                    render: function(data, type, row){
                        return row.agama_name
                    }
                },
                {
                    data: 'kelamin_name',
                    className: '',
                    orderable: true,
                    render: function(data, type, row){
                        return data
                    }
                },
                {
                    data: 'status_perkawinan_name',
                    className: '',
                    orderable: true,
                    render: function(data, type, row){
                        return data
                    }
                },
                {
                    data: 'pendidikan',
                    className: '',
                    orderable: true,
                    render: function(data, type, row){
                        return row.pendidikan_name
                    }
                },
                {
                    data: 'jabatan',
                    className: '',
                    orderable: true,
                    render: function(data, type, row){
                        return data
                    }
                },
                {
                    data: 'unit_kerja',
                    className: '',
                    orderable: true,
                    render: function(data, type, row){
                        return data
                    }
                },
                {
                    data: 'hp',
                    className: '',
                    orderable: true,
                    render: function(data, type, row){
                        return data
                    }
                },
                {
                    data: 'telp',
                    className: '',
                    orderable: false,
                    render: function(data, type, row, index){
                        return data
                    }
                },
                {
                    data: 'email',
                    className: '',
                    orderable: true,
                    render: function(data, type, row){
                        return data
                    }
                },
                {
                    data: 'email_pribadi',
                    className: '',
                    orderable: true,
                    render: function(data, type, row){
                        return data
                    }
                },
            ],
            order: [[ 0, 'asc' ]]
        })
    }


    var unit_kerja_internal = ''
    <?php $ck=0; foreach(session()->get('units') as $k) if($k->unit_kerja_id==$unit) {$ck+=1;?>
        unit_kerja_internal += '<option value="<?=$k->unit_kerja_id?>" selected="selected"><?=$k->unit_kerja_name?></option>'
    <?php } ?>
    $('#input_unit_kerja').append(unit_kerja_internal).trigger('change')
    <?php if($unit<>''){?>
        <?php if($ck>0){?>
            .prop('disabled', true)
        <?php }else{?>
            // .append('<option value="" selected="selected"><?=$unit?></option>').trigger('change')
        <?php }?>
    <?php }?>

    $(function(){
        console.log('log:', array_pegawai)
        $.each(array_pegawai, function(i, row){
            console.log('__ID__',i, row)
            load_foto_pegawai(row.ID, 1)
        })
        array_pegawai.forEach(({ID, NAMA}, index)=>{
            console.log('_ID_',ID,NAMA)
        })
    })

    function load_foto_pegawai(pegawai_id, thumbnail=1)
    {
        $('#foto'+pegawai_id).html('<i class="fas fa-spinner fa-spin"></i>')
        $.get('<?=site_url('foto')?>', {id:pegawai_id, thumbnail:1}, function(rs){
            var dataEncode = rs.data
            var img = '<img src="'+dataEncode+'" width="50" class="modern-avatar" alt="Foto Pegawai">'
            $('#foto'+pegawai_id).fadeOut(200, function(){
                $(this).html(img).fadeIn(200)
            })
        })
    }
    
    // Enhanced Features
    $(document).ready(function(){
        // Smooth scroll animation for table
        $('.table-responsive').on('scroll', function() {
            var scrollTop = $(this).scrollTop();
            if (scrollTop > 50) {
                $('.modern-table-header').css('box-shadow', '0 4px 6px rgba(0,0,0,0.1)');
            } else {
                $('.modern-table-header').css('box-shadow', 'none');
            }
        });
    });
</script>
