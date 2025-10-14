<div class="module-grid-app">
	<?php foreach($data_layanan as $r1){
		$icon_app = 'default.png';
		if(file_exists($r1->icon)){
			$xicon = explode('public/assets/img/icons/apps/', $r1->icon);
			$icon_app = $xicon[1];
		}
		
		$is_admin = (session()->get('role') == 'admin' || session()->get('role') == 'superadmin');
		$badge_class = ($r1->status == 1) ? 'badge-active' : 'badge-inactive';
		$badge_text = ($r1->status == 1) ? 'Active' : 'Inactive';
	?>
		<div class="app-card" data-description="<?=htmlspecialchars($r1->description ?? 'Tidak ada deskripsi')?>">
			<a href="<?=site_url('routing/?id='.string_to($r1->id,'encode'))?>" class="app-card-link">
				<div class="app-card-main">
					<div class="app-icon">
						<img src="<?=base_url('assets/img/icons/apps/'.$icon_app)?>" alt="<?=$r1->name?>">
					</div>
					<div class="app-info">
						<h3 class="app-name"><?=$r1->name?></h3>
						<span class="app-badge <?=$badge_class?>"><?=$badge_text?></span>
					</div>
				</div>
			</a>
			
			<?php if($is_admin): ?>
			<button class="btn-edit-app" onclick="openEditModal(event, <?=$r1->id?>, '<?=addslashes($r1->name)?>', '<?=addslashes($r1->path)?>', '<?=$icon_app?>')">
				<i class="fas fa-edit"></i> Edit
			</button>
			<?php endif; ?>
			
			<div class="app-description">
				<p><?=$r1->description ?? 'Tidak ada deskripsi'?></p>
			</div>
		</div>
	<?php }?>
</div>

<!-- Modal Edit App -->
<div class="modal fade" id="modalEditApp" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Aplikasi</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<form id="formEditApp" enctype="multipart/form-data">
				<div class="modal-body">
					<input type="hidden" id="edit_app_id" name="id">
					
					<div class="mb-3">
						<label class="form-label">Nama Aplikasi</label>
						<input type="text" class="form-control" id="edit_app_name" name="name" readonly>
					</div>
					
					<div class="mb-3">
						<label class="form-label">Link/Path</label>
						<input type="text" class="form-control" id="edit_app_path" name="path" required>
						<small class="text-muted">Contoh: kepegawaian/profile atau https://example.com</small>
					</div>
					
					<div class="mb-3">
						<label class="form-label">Logo Saat Ini</label>
						<div class="current-logo mb-2">
							<img id="current_logo_preview" src="" alt="Current Logo" style="max-width: 100px; border: 1px solid #ddd; padding: 5px; border-radius: 8px;">
						</div>
						<label class="form-label">Ganti Logo (opsional)</label>
						<input type="file" class="form-control" id="edit_app_logo" name="logo" accept="image/png,image/jpeg,image/jpg,image/svg+xml">
						<small class="text-muted">Format: PNG, JPG, SVG. Max 2MB</small>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary">
						<i class="fas fa-save"></i> Simpan Perubahan
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
