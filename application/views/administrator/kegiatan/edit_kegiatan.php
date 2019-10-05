<div class="row" id="portlet-content">
    <div class="col-md-12">
        <div class="portlet light" style="position:relative">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit"></i><?=$judul?>
                </div>
            </div>
            <div class="portlet-body form" id="page-content" style="display:block">
                <form action="<?=site_url('administrator/'.$controller_dir.$controller.'/proses_edit_kegiatan'.'/'.$kegiatan->id_kegiatan)?>" method="post" id="<?=$controller?>" enctype="multipart/form-data" class="horizontal-form">
                    <div class="form-body">
                        <input value="<?=$kegiatan->id_kegiatan?>" type="hidden" name="id_kegiatan">  
                        <div class="alert alert-danger display-hide" style="display: none;" id="error">
                            <button class="close" data-close="alert"></button>
                            <span id="error-text"></span>
                        </div>
                        <div class="tabbable-custom ">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#kegiatan" data-toggle="tab" aria-expanded="true">
                                    Kegiatan </a>
                                </li>                             
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="biodata">
                                    <h3 class="form-section"> Data Kegiatan</h3>
                                    <div class="row">                                                                      
                                        <div class="col-md-6">
                                          <div class="form-group" id="form_id_kategori">
                                            <label for="id_kategori" class="control-label">Kategori <span class="required">* </span></label>
                                            <select id="id_kategori" name="id_kategori" class="form-control" style="width:100%">
                                              <option value=""></option>
                                            </select>																																			  																									
                                            <span id="error_id_kategori" class="help-block"></span>
                                          </div>
                                        </div> 																		

                                        <div class="col-md-6">
                                          <div class="form-group" id="form_provinsi">
                                            <label for="provinsi" class="control-label">Provinsi <span class="required">* </span></label>
                                            <input required type="text" id="provinsi" name="provinsi" class="form-control" placeholder="Provinsi" value="<?=$kegiatan->provinsi?>">
                                            <span id="error_provinsi" class="help-block"></span>
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
  $(document).ready(function() {   

		$("#id_kategori").select2({
			placeholder: "Pilih Kategori",
			language: "id",
			data: <?=$kategori?>
		});
		$("#id_kategori").val("<?=$kegiatan->id_kategori?>").trigger('change');

    $("#id_nmkegiatan").select2({
      placeholder: "Pilih Nama Kegiatan",
      language: "id",
      data: <?=$nmkegiatan?>
    });
    $("#id_nmkegiatan").val("<?=$kegiatan->id_nmkegiatan?>").trigger('change');

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
          $("#form_id_nmkegiatan .select2-container").css("width","100%");
        }
      });
    });

    $("#loading-content,#loading" ).fadeOut( "fast", function() {
      $( "#page-content" ).fadeIn("fast");
    });

  });
</script>
<?php $this->load->view('administrator/script/form_data');?>
