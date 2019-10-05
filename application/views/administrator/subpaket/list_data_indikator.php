<div class="row" id="portlet-content">
    <div class="col-md-12">
        <div class="portlet light" style="position:relative">
            <div class="portlet-title">
							<div class="caption">
									<i class="fa fa-book"></i><?=$judul?>
							</div>
							<?php if (in_array(1, $this->session->userdata('id_global_hakakses'))) { ?>
								<h3 class="form-section">
									<a style="display:block; float:right;" class="btn blue btn-sm" href="<?=site_url('administrator/setting/indikator')?>">
										<i class="fa fa-folder"></i> Kelola Indikator
									</a>
								</h3>
							<?php } ?>
            </div>
            <div class="portlet-body form" id="page-content">
						<form action="<?=site_url('administrator/'.$controller_dir.$controller.'/proses_data'.'/'.$paket->id_paket.'/'.$kegiatan->id_kegiatan)?>" method="post" id="<?=$controller?>" enctype="multipart/form-data" class="horizontal-form">
							<?php
								$array_a = array();
								$array_b = array();
								if(isset($val_indikator)) {
									foreach($val_indikator as $data) {
										$selected_value = $data->id_indikator;
										array_push($array_a, $selected_value);
									}
								}
								if(isset($val_indikator2)) {
									if($val_indikator2 != '') {
										foreach($val_indikator2 as $data2) {
												$selected_value2 = $data2->id_indikator;
												array_push($array_b, $selected_value2);
										}
									} else {
										$val_indikator2 = '';
										array_push($array_b, $val_indikator2);
									} 
								} 						
								// var_dump($array_a);
								// if($nm_kategori == 'Desain') {
								// 	$val_indikator = array('idt-3','idt-2','idt-1');
								// 	//$val_indikator = $indikator->result_array();
								// 	foreach($val_indikator as $data) {
								// 		$selected_value = $data;
								// 		array_push($array_a, $selected_value);
								// 	}
								// }		
							?>
           
							<div style="margin-left: 20px" class="row">
								<?php 
									if(!empty($indikator)) {
										$i=1; 
										foreach($indikator as $value) { ?>	                     
											<div class="checkbox">
												<label>											
													<?php if(in_array($value->id_indikator, $array_b)) { ?>
													<input name="id_indikator[]" type="checkbox" <?=in_array($value->id_indikator, $array_b)?'checked':''?>  disabled value="<?=$value->id_indikator?>" > 
													<input name="id_indikator[]" type="hidden" value="<?=$value->id_indikator?>">
													<?php } else { ?>
													<input name="id_indikator[]" type="checkbox" <?=in_array($value->id_indikator, $array_a)?'checked':''?>   value="<?=$value->id_indikator?>" > 
													<?php } ?>
													<?php echo $i.'. '.$value->nm_indikator; ?> 
												</label>
											</div> 
								<?php 
											$i++; 
										} 
									} else {
										echo "<span style=\"color:red;\"><b>Indikator Belum ada yang Dibuat <br> Silahkan Membuat Indikator yang akan di tampilkan di Menu \"Setting\" >> \"Indikator\" </b><span>";
									}
								?>                                   
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

