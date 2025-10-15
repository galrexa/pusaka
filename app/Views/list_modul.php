<link rel="stylesheet" href="<?=base_url('assets/css/list_modul.css')?>">
<div class="module-container">
	<div class="module-grid">
		<?php 
		if(!empty($data_layanan)) {
			foreach($data_layanan as $r1){
				$icon_app = 'default.png';
				if(file_exists($r1->icon)){
					$xicon = explode('public/assets/img/icons/apps/', $r1->icon);
					$icon_app = $xicon[1];
				}
		?>
			<a href="<?=site_url('routing/?id='.string_to($r1->id,'encode'))?>" class="module-card">
				<div class="module-icon">
					<img src="<?=base_url('assets/img/icons/apps/'.$icon_app)?>" alt="<?=$r1->name?>">
				</div>
				<div class="module-title"><?=$r1->name?></div>
			</a>
		<?php 
			}
		} else {
		?>
			<div style="grid-column: 1/-1; text-align:center; color: white; padding: 40px;">
				<h3>Tidak ada modul tersedia</h3>
			</div>
		<?php } ?>
	</div>
</div>
