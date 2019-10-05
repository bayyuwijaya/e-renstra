<div class="row" id="portlet-content">
    <div class="col-md-12">
        <div class="portlet light" style="position:relative">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-plus"></i><?=$judul?>
                </div>
            </div>
            <div class="portlet-body form" id="page-content" style="display:block">
                <form action="<?=site_url('administrator/'.$controller_dir.$controller.'/tambah_data_proses')?>" method="post" id="<?=$controller?>" enctype="multipart/form-data" class="horizontal-form">
                    <div class="form-body">                        
                      <div class="alert alert-danger display-hide" style="display:none;" id="error">
                          <button class="close" data-close="alert"></button>
                          <span id="error-text"></span>
                      </div>
                      <div class="tabbable-custom">
                          <ul class="nav nav-tabs">
                              <li class="active">
                                  <a href="#labelindikator" data-toggle="tab" aria-expanded="true">
                                  Indikator </a>
                              </li>                              
                          </ul>
                          <div class="tab-content">
                              <div class="tab-pane fade active in" id="form_tambah_indikator">
                                  <h3 class="form-section">Data Indikator</h3>
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group" id="form_nm_indikator">
                                              <label for="nm_indikator" class="control-label"> Nama Indikator <span class="required">* </span></label>
                                              <input required type="text" id="nm_indikator" name="nm_indikator" class="form-control" placeholder="Ketik Nama Indikator disini">
                                              <span id="error_nm_indikator" class="help-block"></span>
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group" id="form_bobot">
                                              <label for="bobot" class="control-label"> Nilai Bobot <span class="required">* </span></label>
                                              <input required type="text" id="bobot" name="bobot" class="form-control" placeholder="Ketik Nilai Bobot disini">
                                              <span id="error_bobot" class="help-block"></span>
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
