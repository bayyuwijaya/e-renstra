<div class="page-sidebar-wrapper">
	<div class="page-sidebar navbar-collapse collapse">
		<ul class="page-sidebar-menu page-sidebar-menu-compact" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
		
			<li <?=$controller=='dashboard'?'class="active"':''?>>
				<a href="<?=site_url('administrator/dashboard')?>">
					<i class="fa fa-dashboard"></i>
					<span class="title">Dashboard</span>
					<?=$active=='dashboard'?'<span class="selected"></span>':''?>
				</a>
			</li>

			<li <?=$active=='kegiatan'?'class="active"':''?>>
				<a href="<?=site_url('administrator/data_renstra/kegiatan')?>">
					<i class="fa fa-book"></i>
					<span class="title">Data Renstra</span>
					<?=$active=='kegiatan'?'<span class="selected"></span>':''?>
				</a>
			</li>

			<?php if (in_array(1, $this->session->userdata('id_global_hakakses'))) { ?>
			<li <?=@$sub_menu=='setting'?'class="active open"':''?> >
				<a>
					<i class="fa fa-cogs"></i>
					<span class="title">Setting</span>
					<?=@$sub_menu=='setting'?'<span class="selected"></span>':''?>
					<span class="arrow <?=@$sub_menu=='setting'?'open':''?>"></span>
				</a>
				<ul class="sub-menu" <?=@$sub_menu=='setting'?'style="display:block"':''?>>

					<li <?=$active=='kategori'?'class="active"':''?>>
						<a href="<?=site_url('administrator/setting/kategori')?>">
						<i class="fa fa-list"></i>
						Kategori</a>
					</li>

					<li <?=$active=='tahun'?'class="active"':''?>>
						<a href="<?=site_url('administrator/setting/tahun')?>">
						<i class="fa fa-calendar-check-o"></i>
						Tahun Anggaran</a>
					</li>

					<li <?=$active=='indikator'?'class="active"':''?>>
						<a href="<?=site_url('administrator/setting/indikator')?>">
						<i class="fa fa-bookmark"></i>
						Indikator</a>
					</li>

					<li <?=@$sub_menu_child=='default_indikator'?'class="active open"':''?> >
						<a>
							<i class="fa fa-folder"></i>
							<span class="title">Standar Indikator</span>
							<?=@$sub_menu_child=='default_indikator'?'<span class="selected"></span>':''?>
							<span class="arrow <?=@$sub_menu_child=='default_indikator'?'open':''?>"></span>
						</a>
						<ul class="sub-menu" <?=@$sub_menu_child=='default_indikator'?'style="display:block"':''?>>
							<?php foreach($this->db->get('erenstra_tr_kategori')->result() as $obj_kat) { ?>
								<li <?=$active == $obj_kat->id_kategori ? 'class="active"' : ''?>>
									<a href="<?=site_url('administrator/setting/default_indikator/index/'.$obj_kat->id_kategori)?>">
									<i class="fa fa-sticky-note"></i>
									<?=$obj_kat->nm_kategori?></a>
								</li>
							<?php } ?>						
						</ul>
					</li>

					<li <?=$active=='kategorifile'?'class="active"':''?>>
						<a href="<?=site_url('administrator/setting/kategorifile')?>">
						<i class="fa fa-file"></i>
						Kategori File</a>
					</li>

					<li <?=$active=='nmkegiatan'?'class="active"':''?>>
						<a href="<?=site_url('administrator/setting/nmkegiatan')?>">
						<i class="fa fa-folder"></i>
						Nama Kegiatan</a>
					</li>

					<li <?=$active=='satuan'?'class="active"':''?>>
						<a href="<?=site_url('administrator/setting/satuan')?>">
						<i class="fa fa-bookmark"></i>
						Satuan </a>
					</li>

					<li <?=$active=='staf'?'class="active"':''?>>
						<a href="<?=site_url('administrator/setting/staf')?>">
						<i class="fa fa-user-secret"></i>
						Staf</a>
					</li>

					<?php if (in_array(1, $this->session->userdata('id_global_hakakses'))) { ?>
						<li <?=$active=='atur_hakakses'?'class="active"':''?>>
							<a href="<?=site_url('administrator/setting/atur_hakakses')?>">
							<i class="fa fa-unlock"></i>
							Atur Hakakses</a>
						</li>
					<?php } ?>
					
				</ul>
			</li>
			<?php } ?>

			<li <?=@$sub_menu=='laporan'?'class="active open"':''?> >
				<a>
					<i class="fa fa-print"></i>
					<span class="title">Laporan</span>
					<?=@$sub_menu=='laporan'?'<span class="selected"></span>':''?>
					<span class="arrow <?=@$sub_menu=='laporan'?'open':''?>"></span>
				</a>
				<ul class="sub-menu" <?=@$sub_menu=='laporan'?'style="display:block"':''?>>

					<li <?=$active=='export'?'class="active"':''?>>
						<a href="<?=site_url('administrator/laporan/export')?>">
						<i class="fa fa-download"></i>
						Export</a>
					</li>

					<li <?=$active=='import'?'class="active"':''?>>
						<a href="<?=site_url('administrator/laporan/import')?>">
						<i class="fa fa-upload"></i>
						Import</a>
					</li>

				</ul>
			</li>

		</ul>
	</div>
</div>