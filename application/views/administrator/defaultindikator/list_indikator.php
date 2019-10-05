<div class="row" id="portlet-content">
    <div class="col-md-12">
        <div class="portlet light" style="position:relative">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-bookmark"></i>Pilih <?=$judul?>
                </div>
                <div class="actions" id="tombol-action" style="display:block; margin-left:5px;">
                    <a class="btn blue btn-sm" href="<?=site_url('administrator/setting/default_indikator/print_excel/'.$kategori->id_kategori)?>">
                        <i class="fa fa-print"></i> Print Excel
                    </a>                 
                </div>
            </div>
            <div class="portlet-body form" id="page-content">
              <form action="<?=site_url('administrator/'.$controller_dir.$controller.'/proses_data'.'/'.$kategori->id_kategori)?>" method="post" id="<?=$controller?>" enctype="multipart/form-data" class="horizontal-form">
                <?php
                  $array_a = array();
                  if(isset($val_indikator)) {
                    foreach($val_indikator as $data) {
                      $selected_value = $data->id_indikator;
                      array_push($array_a, $selected_value);
                    }
                  }								
                ?>
            
                <div style="margin-left: 20px" class="row">
                  <?php $i=1; foreach($indikator as $value) { ?>	                     
                    <div class="checkbox" style="margin-left:30px; margin-right:30px;">
                      <label>
                        <input name="id_indikator[]" type="checkbox" <?=in_array($value->id_indikator, $array_a)?'checked':''?>  value="<?=$value->id_indikator?>" > 
                        <?php echo $i.'. '.$value->nm_indikator; ?> 
                      </label>
                    </div> 
                  <?php $i++; } ?>                                   
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
