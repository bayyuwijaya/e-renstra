<div class="row" id="portlet-content">
    <div class="col-md-12">
        <div class="portlet light" style="position:relative">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit"></i><?=$judul?>
                </div>
            </div>
            <div class="portlet-body form" id="page-content" style="display:block">
                <form action="<?=site_url('administrator/'.$controller_dir.$controller.'/proses_edit_tahun'.'/'.$tahun->id_tahun)?>" method="post" id="<?=$controller?>" enctype="multipart/form-data" class="horizontal-form">
                    <div class="form-body">
                      <input value="<?=$tahun->id_tahun?>" type="hidden" name="id_tahun">                        
                      <div class="alert alert-danger display-hide" style="display:none;" id="error">
                          <button class="close" data-close="alert"></button>
                          <span id="error-text"></span>
                      </div>
                      <div class="tabbable-custom">
                          <ul class="nav nav-tabs">
                              <li class="active">
                                  <a href="#tahun" data-toggle="tab" aria-expanded="true">
                                  Tahun </a>
                              </li>                              
                          </ul>
                          <div class="tab-content">
                              <div class="tab-pane fade active in" id="tahun">
                                  <h3 class="form-section">Data Tahun Anggaran</h3>
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="form-group" id="form_nm_kegiatan">
                                              <label for="nm_tahun" class="control-label">Tahun Anggaran <span class="required">* </span></label>
                                              <input required type="text" id="nm_tahun" name="nm_tahun" class="form-control" placeholder="Ketik Tahun Anggaran disini" value="<?=$tahun->nm_tahun?>">
                                              <span id="error_nm_tahun" class="help-block"></span>
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
