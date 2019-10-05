<div class="row" id="portlet-content">
    <div class="col-md-12">
        <div class="portlet light" style="position:relative">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit"></i><?=$judul?>
                </div>
            </div>
            <div class="portlet-body form" id="page-content" style="display:block">
                <form action="<?=site_url('administrator/'.$controller_dir.$controller.'/proses_edit_staf'.'/'.$sdm->id_sdm)?>" method="post" id="<?=$controller?>" enctype="multipart/form-data" class="horizontal-form">
                    <div class="form-body">
                      <input value="<?=$sdm->id_sdm?>" type="hidden" name="id_sdm">                            
                      <div class="alert alert-danger display-hide" style="display:none;" id="error">
                          <button class="close" data-close="alert"></button>
                          <span id="error-text"></span>
                      </div>
                      <div class="tabbable-custom">
                          <ul class="nav nav-tabs">
                              <li class="active">
                                  <a href="#staf" data-toggle="tab" aria-expanded="true">
                                  Staf </a>
                              </li>                              
                          </ul>
                          <div class="tab-content">
                              <div class="tab-pane fade active in" id="staf">
                                  <h3 class="form-section">Data Staf E-Renstra</h3>
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group" id="form_nidn">
                                              <label for="nidn" class="control-label">NIP <span class="required">* </span></label>
                                              <input required type="text" id="nidn" name="nidn" class="form-control" placeholder="Ketik Nomor Induk Pegawai disini" value="<?=$sdm->nidn?>" />
                                              <span id="error_nidn" class="help-block"></span>
                                          </div>
                                      </div>  
                                      <div class="col-md-6">
                                          <div class="form-group" id="form_nm_sdm">
                                              <label for="nm_sdm" class="control-label">Nama Staf <span class="required">* </span></label>
                                              <input required type="text" id="nm_sdm" name="nm_sdm" class="form-control" placeholder="Ketik Nama Staf disini" value="<?=$sdm->nm_sdm?>" />
                                              <span id="error_nm_sdm" class="help-block"></span>
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
        $( "#loading-content,#loading" ).fadeOut( "fast", function() {
          $( "#page-content" ).fadeIn("fast");
        });
    });
</script>
<?php $this->load->view('administrator/script/form_data');?>
