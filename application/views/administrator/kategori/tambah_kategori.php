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
                      <div class="alert alert-danger display-hide" style="display:none;" id="error">
                          <button class="close" data-close="alert"></button>
                          <span id="error-text"></span>
                      </div>
                      <div class="tabbable-custom">
                          <ul class="nav nav-tabs">
                              <li class="active">
                                  <a href="#kategori" data-toggle="tab" aria-expanded="true">
                                  Kategori </a>
                              </li>                              
                          </ul>
                          <div class="tab-content">
                              <div class="tab-pane fade active in" id="kategori">
                                  <h3 class="form-section">Data Kategori</h3>
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="form-group" id="form_nm_kegiatan">
                                              <label for="nm_kategori" class="control-label"> Kategori <span class="required">* </span></label>
                                              <input required type="text" id="nm_kategori" name="nm_kategori" class="form-control" placeholder="Ketik Kategori disini">
                                              <span id="error_nm_kategori" class="help-block"></span>
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
