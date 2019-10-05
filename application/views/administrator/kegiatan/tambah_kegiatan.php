<div class="row" id="portlet-content">
    <div class="col-md-12">
        <div class="portlet light" style="position:relative">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-plus"></i><?=$judul?>
                </div>
            </div>
            <div class="portlet-body form" id="page-content" style="display:nonee">
                <form action="<?=site_url('administrator/'.$controller_dir.$controller.'/tambah_data_proses')?>" method="post" id="<?=$controller?>" enctype="multipart/form-data" class="horizontal-form">
                    <div class="form-body">
                        
                        <div class="alert alert-danger display-hide" style="display: none;" id="error">
                            <button class="close" data-close="alert"></button>
                            <span id="error-text"></span>
                        </div>
                        <div class="tabbable-custom ">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#biodata" data-toggle="tab" aria-expanded="true">
                                    Kegiatan </a>
                                </li>
                              
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="biodata">
                                    <h3 class="form-section">Data Kegiatan</h3>

																			<?php if(isset($idkategori)) { ?>

																				<div class="row">
																					<div class="col-md-6">
																						<div class="form-group" id="form_id_kategori">
																							<label for="idkategori" class="control-label">Kategori <span class="required">* </span></label>
																							<select id="idkategori" class="form-control" style="width:100%" disabled>
																								<option value=""></option>
																							</select>
																							<input type="hidden" id="id_kategori" name="id_kategori" value="<?php echo $idkategori; ?>" >   																																													  																									
																							<span id="error_id_kategori" class="help-block"></span>
																						</div>
																					</div> 
																				</div>

																				<div class="row">
																					<div class="col-md-12">
																						<div class="form-group" id="form_id_nmkegiatan">
																							<label for="id_nmkegiatan" class="control-label">Nama Satker / Program / Kegiatan / Output / Komponen / Sub Komponen<span class="required">* </span></label>            
																							<select id="id_nmkegiatan" name="id_nmkegiatan" class="form-control" style="width:100%" required>
																								<option value=""></option>
																							</select>  
																							<span id="error_id_nmkegiatan" class="help-block"></span>
																						</div>
																					</div>                                       
																				</div>

																			<?php } else { ?>

																				<div class="row">
																					<div class="col-md-6">
																						<div class="form-group" id="form_id_kategori">
																							<label for="id_kategori" class="control-label">Kategori <span class="required">* </span></label>
																							<select id="id_kategori" name="id_kategori" class="form-control" style="width:100%">
																								<option value=""> -- Pilih Kategori -- </option>
																								<?php foreach ($kategori->result() as $key) { ?>
																										<option value="<?=$key->id?>"><?=$key->text?></option>
																								<?php } ?>
																							</select>																																			  																									
																							<span id="error_id_kategori" class="help-block"></span>
																						</div>
																					</div> 
																				</div>

																				<div class="row asd" style="display:none">
																					<div class="col-md-12">
																						<div class="form-group" id="form_id_nmkegiatan">
																							<label for="id_nmkegiatan" class="control-label">Nama Satker / Program / Kegiatan / Output / Komponen / Sub Komponen<span class="required">* </span></label>            
																							<select id="id_nmkegiatan" name="id_nmkegiatan" class="form-control" style="width:100%" required>
																								<option value=""></option>
																							</select>  
																							<span id="error_id_nmkegiatan" class="help-block"></span>
																						</div>
																					</div>                                       
																				</div>

																			<?php } ?>												

                                    <div class="row">   
                                        <div class="col-md-6">
                                            <div class="form-group" id="form_provinsi">
                                                <label for="provinsi" class="control-label">Provinsi <span class="required">* </span></label>
                                                <input required type="text" id="provinsi" name="provinsi" class="form-control" placeholder="Provinsi">
                                                <span id="error_provinsi" class="help-block"></span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>                               
                            </div>
                        </div>
                    </div>
                    <div class="form-actions right">
                        <a type="button" class="btn default" href="<?=site_url('administrator/'.$controller_dir.$controller)?>">Kembali</a>
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
		<?php if(isset($idkategori)) { ?>

			$("#idkategori").select2({
				placeholder: "Pilih Kategori",
				language: "id",
				data: <?=$kategori?>
			});
			$("#idkategori").val("<?=$idkategori?>").trigger('change');

			$("#id_nmkegiatan").select2({
				placeholder: "Pilih Nama Kegiatan",
				language: "id",
				data: <?=$nmkegiatan?>
			});
		
		<?php } else { ?>

			$('#id_kategori').on('change', function (evt) {
				$.ajax({
					url:"<?=site_url('administrator/data_renstra/kegiatan/get_option_nmkegiatan/')?>",
					type:'POST',
					data:{"id_kategori":$(this).val()},
					success:function(data) {
							$("#id_nmkegiatan").select2("destroy").empty().select2({
									placeholder: "Semua Kegiatan yang terkait",
									language: "id",
									data: JSON.parse(data)
								});
							$(".asd").css("display", "block"); 							
							$("#form_id_nmkegiatan .select2-container").css("width","100%");
					}
				});
			});

			$("#id_nmkegiatan").select2({
				placeholder: "Pilih Nama Kegiatan",
				closeOnSelect: false,
				language: "id"
			});
		 
		<?php } ?>

		$( "#loading-content, #loading" ).fadeOut( "fast", function() {
			$( "#page-content" ).fadeIn("fast");
		});

	});
</script>
<?php $this->load->view('administrator/script/form_data');?>
