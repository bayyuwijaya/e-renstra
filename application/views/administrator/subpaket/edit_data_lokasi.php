<div class="row" id="portlet-content">
    <div class="col-md-12">
        <div class="portlet light" style="position:relative">
            <div class="portlet-title">
							<div class="caption">
								<i class="fa fa-edit"></i><?=$judul?>
							</div>
            </div>
            <div class="portlet-body form" id="page-content">
						<form action="<?=site_url('administrator/'.$controller_dir.$controller.'/proses_data'.'/'.$paket->id_paket.'/'.$kegiatan->id_kegiatan)?>" method="post" id="<?=$controller?>" enctype="multipart/form-data" class="horizontal-form">
							<div class="row">
									<div class="col-md-12">
										<div class="form-group" id="form_lokasi">
											<label for="latitude" class="control-label">Koordinat X (Latitude) <span class="required">* </span></label>
											<input type="text" id="latitude" name="latitude" class="form-control" placeholder="Koordinat Garis Lintang" value="<?=$latitude?>">
											<span id="error_latitude" class="help-block"></span>

											<label for="longitude" class="control-label">Koordinat Y (Longitude) <span class="required">* </span></label>
											<input type="text" id="longitude" name="longitude" class="form-control" placeholder="Koordinat Garis Bujur" value="<?=$longitude?>">
											<span id="error_longitude" class="help-block"></span>
										
											<label for="kab_kota" class="control-label">Kabupaten / Kota <span class="required">* </span></label>
											<input type="text" id="kab_kota" name="kab_kota" class="form-control" placeholder="Kabupaten / Kota" value="<?=$kab_kota?>">
											<span id="error_kab_kota" class="help-block"></span>

											<label for="kecamatan" class="control-label">Kecamatan <span class="required">* </span></label>
											<input type="text" id="kecamatan" name="kecamatan" class="form-control" placeholder="Kecamatan" value="<?=$kecamatan?>">
											<span id="error_kecamatan" class="help-block"></span>

											<label for="desa" class="control-label">Desa <span class="required">* </span></label>
											<input type="text" id="desa" name="desa" class="form-control" placeholder="Desa" value="<?=$desa?>">
											<span id="error_desa" class="help-block"></span>
										</div>	
									</div>
							</div>
							<div class="form-actions right" style="background-color:#ffffff;">                        
									<button type="submit" class="btn blue"><i class="fa fa-check"></i> Simpan</button>
							</div>                                      
						</form>	
            </div>
            <?php $this->load->view('administrator/include/loading');?>
        </div>
    </div>
</div>
<script>
	$(document).ready( function () {
			$( "#loading-content,#loading" ).fadeOut( "fast", function() {
				$( "#page-content" ).fadeIn("fast");
			});
	});
</script>
<?php $this->load->view('administrator/script/form_data');?>