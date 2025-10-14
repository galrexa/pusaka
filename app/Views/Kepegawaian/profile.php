<div class="profile-container">
	<div class="card" style="border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.08); border-radius: 16px; overflow: hidden;">
		<div class="card-body" style="padding: 30px; background: #f8f9fa;">
			<div class="row">
				<!-- Photo Section -->
				<div class="col-md-3 col-sm-12">
					<?php
					$foto_peg = create_file_to_base64($data->foto_pegawai);
					if($foto_peg=='')
					{
						$foto_peg = get_foto_default_pegawai((isset($data))?$data->kelamin:1);
					}
					?>
					<div class="photo-card">
						<div class="photo-card-body">
							<img src="<?=$foto_peg?>" alt="Foto Pegawai">
						</div>
						<?php if (return_roles([1,2])) {?>
							<div class="photo-card-footer" align="center">
								<form id="form-upload-foto" enctype="multipart/form-data">
			                    	<label for="foto" class="file-upload-button">
										<input type="file" name="foto" id="foto" accept="image/*">
										<i class="fa fa-upload"></i> Unggah Foto
									</label>
								</form>
							</div>
						<?php }?>
					</div>
				</div>

				<!-- Content Section -->
				<div class="col-md-9 col-sm-12">
					<!-- Modern Tabs -->
					<div class="nav modern-tabs" id="nav-tab" role="tablist">
						<div class="nav-item">
							<a class="nav-link <?php if($tab==''){echo'active';}?>" data-bs-toggle="tab" href="#nav-home">Biodata</a>
						</div>
						<?php if(return_access_link(['kepegawaian/alamat'])){?>
							<div class="nav-item">
								<a class="nav-link <?php if($tab=='alamat'){echo'active';}?>" data-bs-toggle="tab" href="#nav-profile" onclick="load_halaman_in_profile('alamat', '<?=(isset($data))?string_to($data->pegawai_id,'encode'):''?>')">Alamat</a>
							</div>
						<?php }?>
						<?php if(return_access_link(['kepegawaian/sk'])){?>
							<div class="nav-item">
								<a class="nav-link <?php if($tab=='keputusan'){echo'active';}?>" data-bs-toggle="tab" href="#nav-profile" onclick="load_halaman_in_profile('keputusan', '<?=(isset($data))?string_to($data->pegawai_id,'encode'):''?>')">Keputusan</a>
							</div>
						<?php }?>
						<?php if(return_access_link(['kepegawaian/fasilitas'])){?>
							<div class="nav-item">
								<a class="nav-link <?php if($tab=='fasilitas'){echo'active';}?>" data-bs-toggle="tab" href="#nav-profile" onclick="load_halaman_in_profile('fasilitas', '<?=(isset($data))?string_to($data->pegawai_id,'encode'):''?>')">Fasilitas</a>
							</div>
						<?php }?>
						<?php if(return_access_link(['kepegawaian/qrcode'])){?>
							<div class="nav-item">
								<a class="nav-link <?php if($tab=='qrcode'){echo'active';}?>" data-bs-toggle="tab" href="#nav-profile" onclick="load_halaman_in_profile('qrcode', '<?=(isset($data))?string_to($data->pegawai_id,'encode'):''?>')">ID-Card</a>
							</div>
						<?php }?>
						<?php if(return_access_link(['kepegawaian/files'])){?>
							<div class="nav-item">
								<a class="nav-link <?php if($tab=='files'){echo'active';}?>" data-bs-toggle="tab" href="#nav-profile" onclick="load_halaman_in_profile('files', '<?=(isset($data))?string_to($data->pegawai_id,'encode'):''?>')">Files</a>
							</div>
						<?php }?>
						<?php if(return_access_link(['kepegawaian/user/form'])){?>
							<div class="nav-item">
								<a class="nav-link <?php if($tab=='user'){echo'active';}?>" data-bs-toggle="tab" href="#nav-profile" onclick="load_halaman_in_profile('user', '<?=(isset($data))?string_to($data->pegawai_id,'encode'):''?>')">User Login</a>
							</div>
						<?php }?>
					</div>

					<!-- Tab Content -->
					<div class="tab-content modern-tab-content">
						<!-- Biodata Tab -->
						<div class="tab-pane fade <?php if($tab==''){echo'show active';}?>" id="nav-home">
							<!-- Identitas Section -->
							<div class="biodata-section">
								<div class="biodata-section-title">Identitas</div>
								<div class="biodata-row">
									<div class="biodata-label">NIP</div>
									<div class="biodata-value"><?=(isset($data))?$data->nip:''?></div>
								</div>
								<div class="biodata-row">
									<div class="biodata-label">NIK</div>
									<div class="biodata-value"><?=(isset($data))?$data->nik:''?></div>
								</div>
								<div class="biodata-row">
									<div class="biodata-label">NPWP</div>
									<div class="biodata-value"><?=(isset($data))?$data->npwp:''?></div>
								</div>
							</div>

							<!-- Data Pribadi Section -->
							<div class="biodata-section">
								<div class="biodata-section-title">Data Pribadi</div>
								<div class="biodata-row">
									<div class="biodata-label">Nama</div>
									<div class="biodata-value"><?=(isset($data))?$data->gelar_depan:''?> <?=(isset($data))?$data->nama:''?><?=(isset($data))?', '.$data->gelar_belakang:''?></div>
								</div>
								<div class="biodata-row">
									<div class="biodata-label">Tempat, Tanggal Lahir</div>
									<div class="biodata-value"><?=(isset($data))?$data->tempat_lahir:''?>, <?=tanggal((isset($data))?$data->tanggal_lahir:'',3)?></div>
								</div>
								<div class="biodata-row">
									<div class="biodata-label">Agama</div>
									<div class="biodata-value"><?=(isset($data))?$data->agama_name:''?></div>
								</div>
								<div class="biodata-row">
									<div class="biodata-label">Kelamin</div>
									<div class="biodata-value"><?=(isset($data))?$data->kelamin_name:''?></div>
								</div>
								<div class="biodata-row">
									<div class="biodata-label">Pendidikan Terakhir</div>
									<div class="biodata-value"><?=(isset($data))?$data->pendidikan_name:''?></div>
								</div>
								<div class="biodata-row">
									<div class="biodata-label">Status Perkawinan</div>
									<div class="biodata-value"><?=(isset($data))?$data->status_perkawinan_name:''?></div>
								</div>
							</div>

							<!-- Kontak Section -->
							<div class="biodata-section">
								<div class="biodata-section-title">Kontak</div>
								<div class="biodata-row">
									<div class="biodata-label">Nomor HP</div>
									<div class="biodata-value"><?=(isset($data))?$data->hp:''?></div>
								</div>
								<div class="biodata-row">
									<div class="biodata-label">Nomor Telp</div>
									<div class="biodata-value"><?=(isset($data))?$data->telp:''?></div>
								</div>
								<div class="biodata-row">
									<div class="biodata-label">Email Kantor</div>
									<div class="biodata-value"><?=(isset($data))?$data->email:''?></div>
								</div>
								<div class="biodata-row">
									<div class="biodata-label">Email Pribadi</div>
									<div class="biodata-value"><?=(isset($data))?$data->email_pribadi:''?></div>
								</div>
							</div>

							<!-- Kepegawaian Section -->
							<div class="biodata-section">
								<div class="biodata-section-title">Kepegawaian</div>
								<div class="biodata-row">
									<div class="biodata-label">Jenis Pegawai</div>
									<div class="biodata-value highlight"><?=(isset($data))?$data->status_jenis_pegawai_name:''?></div>
								</div>
								<div class="biodata-row">
									<div class="biodata-label">Unit Kerja</div>
									<div class="biodata-value"><?=(isset($data))?$data->unit_kerja_alt:''?> (<?=(isset($data))?$data->unit_kerja:''?>)</div>
								</div>
								<div class="biodata-row">
									<div class="biodata-label">Jabatan</div>
									<div class="biodata-value"><?=(isset($data))?$data->jabatan:''?></div>
								</div>
								<div class="biodata-row">
									<div class="biodata-label">Eselon/Setara</div>
									<div class="biodata-value"><?=(isset($data))?$data->eselon:''?></div>
								</div>
								<div class="biodata-row">
									<div class="biodata-label">Status PNS</div>
									<div class="biodata-value"><?=(isset($data))?$data->status_pns_name:''?></div>
								</div>
							</div>

							<?php if(in_array($data->status_pns, [1,2])){?>
							<!-- Detail PNS Section -->
							<div class="biodata-section">
								<div class="biodata-section-title">Detail PNS</div>
								<div class="biodata-row">
									<div class="biodata-label">Asal Instansi</div>
									<div class="biodata-value"><?=(isset($data))?$data->asal_instansi:''?></div>
								</div>
								<div class="biodata-row">
									<div class="biodata-label">NIP Lama/NRP</div>
									<div class="biodata-value"><?=(isset($data))?$data->nip_lama:''?></div>
								</div>
								<div class="biodata-row">
									<div class="biodata-label">Pangkat</div>
									<div class="biodata-value"><?=(isset($data))?$data->pangkat:''?></div>
								</div>
								<div class="biodata-row">
									<div class="biodata-label">Golongan</div>
									<div class="biodata-value"><?=(isset($data))?$data->gol:''?></div>
								</div>
								<div class="biodata-row">
									<div class="biodata-label">TMT</div>
									<div class="biodata-value"><?=(isset($data))?$data->tmt_pang_gol:''?></div>
								</div>
							</div>
							<?php }?>

							<?php if(in_array($data->status_jenis_pegawai, [5])){?>
							<!-- Detail Mahasiswa Section -->
							<div class="biodata-section">
								<div class="biodata-section-title">Detail Mahasiswa</div>
								<div class="biodata-row">
									<div class="biodata-label">Asal Universitas</div>
									<div class="biodata-value"><?=(isset($data))?$data->universitas_name:''?></div>
								</div>
							</div>
							<?php }?>

							<?php if(in_array($data->jabatan_id, [42])){?>
							<!-- Gugus Tugas Section -->
							<div class="biodata-section">
								<div class="biodata-section-title">Gugus Tugas</div>
								<div class="biodata-row">
									<div class="biodata-label">Tim Gugus Tugas</div>
									<div class="biodata-value"><?=(isset($data))?$data->gugustugas_name:''?></div>
								</div>
							</div>
							<?php }?>

							<!-- Rekening Section -->
							<div class="biodata-section">
								<div class="biodata-section-title">Rekening</div>
								<div class="biodata-row">
									<div class="biodata-label">Bank</div>
									<div class="biodata-value"><?=(isset($data))?$data->bank_name:''?>, <?=(isset($data))?$data->bank_region:''?></div>
								</div>
								<div class="biodata-row">
									<div class="biodata-label">Rekening</div>
									<div class="biodata-value"><?=(isset($data))?$data->bank_account:''?>, AN. <?=(isset($data))?$data->bank_account_name:''?></div>
								</div>
							</div>

							<!-- Status & Actions -->
							<div class="biodata-section">
								<div class="biodata-row">
									<div class="biodata-label">Status Kepegawaian</div>
									<div class="biodata-value highlight"><?=(isset($data))?$data->status_name:''?></div>
								</div>
								
								<?php if(return_access_link(['kepegawaian/form'])){?>
									<div class="action-buttons">
										<a href="<?=site_url('kepegawaian/form?id='.string_to($data->pegawai_id, 'encode'))?>" class="btn-modern-primary" title="Edit data">
											<i class="fa fa-edit"></i> Edit Data
										</a>
									</div>
								<?php }?>
							</div>
						</div>

						<!-- Other Tabs Content -->
						<div class="tab-pane fade <?php if(in_array($tab, ['alamat','keputusan','fasilitas','qrcode','files','user'])){echo'show active';}?>" id="nav-profile">
							<div style="text-align: center; padding: 40px; color: #95a5a6;">
								<i class="fa fa-spinner fa-spin" style="font-size: 32px; margin-bottom: 16px;"></i>
								<p>Loading...</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(function(){
		<?php if($tab<>''){?>
			load_halaman_in_profile('<?=$tab?>', '<?=string_to($data->pegawai_id, 'encode')?>')
		<?php }?>
	})

	<?php if (return_roles([1,2])) {?>
		$('#foto').on('change', function(e){
			var file = e.target.files[0];
			
			if(!file) {
				return;
			}
			
			// Validasi tipe file
			if(!file.type.match('image.*')) {
				alert('File harus berupa gambar!');
				$(this).val('');
				return;
			}
			
			// Validasi ukuran file (max 2MB sesuai validation di controller)
			if(file.size > 2 * 1024 * 1024) {
				alert('Ukuran file maksimal 2MB!');
				$(this).val('');
				return;
			}
			
			// Tampilkan loading
			$('.file-upload-button').html('<i class="fa fa-spinner fa-spin"></i> Mengupload...');
			
			// Buat FormData sesuai format yang diharapkan controller
			var formData = new FormData();
			formData.append('userfile', file);  // PENTING: harus 'userfile' bukan 'foto'
			formData.append('first', 'foto_');   // prefix untuk nama file
			formData.append('output', 'json');   // format output
			formData.append('<?=csrf_token()?>', '<?=csrf_hash()?>'); // CSRF token
			
			// Upload menggunakan AJAX ke endpoint yang benar
			$.ajax({
				url: '<?=site_url('api/file/upload')?>?pegawai_id=<?=$data->pegawai_id?>',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function(response){
					console.log('Upload response:', response);
					
					// Update CSRF token
					if(response.csrf) {
						$('input[name=<?=csrf_token()?>]').val(response.csrf);
					}
					
					if(response.status === true) {
						alert('Foto berhasil diupload!');
						// Reload halaman untuk menampilkan foto baru
						setTimeout(() => window.location.reload(), 500);
					} else {
						alert('Gagal upload foto: ' + response.message);
						$('.file-upload-button').html('<i class="fa fa-upload"></i> Unggah Foto');
					}
					
					// Reset input file
					$('#foto').val('');
				},
				error: function(xhr, status, error){
					console.error('Upload error:', error);
					console.error('Response:', xhr.responseText);
					alert('Gagal upload foto: ' + error);
					$('.file-upload-button').html('<i class="fa fa-upload"></i> Unggah Foto');
					$('#foto').val('');
				}
			});
		});
	<?php }?>

	function load_halaman_in_profile(page, id)
	{
		$('#nav-profile').html('<div style="text-align: center; padding: 40px; color: #95a5a6;"><i class="fa fa-spinner fa-spin" style="font-size: 32px; margin-bottom: 16px;"></i><p>Memuat data...</p></div>')
		var url = '<?=site_url('kepegawaian/qrcode?id=')?>'+id;
		switch(page){
			case 'alamat':
				url = '<?=site_url('kepegawaian/alamat?id=')?>'+id;
				break
			case 'keputusan':
				url = '<?=site_url('kepegawaian/sk?id=')?>'+id;
				break
			case 'fasilitas':
				url = '<?=site_url('kepegawaian/fasilitas?id=')?>'+id;
				break
			case 'files':
				url = '<?=site_url('kepegawaian/files?id=')?>'+id;
				break
			case 'user':
				url = '<?=site_url('kepegawaian/user/form?id=')?>'+id;
				break
		}
		$.get(url, function(rs){
			$('#nav-profile').html(rs)
		})
	}
</script>
