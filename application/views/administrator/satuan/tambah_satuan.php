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
                                  <a href="#satuan" data-toggle="tab" aria-expanded="true">
                                   Satuan </a>
                              </li>                              
                          </ul>
                          <div class="tab-content">
                              <div class="tab-pane fade active in" id="satuan">
                                  <h3 class="form-section">Data Satuan</h3>
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group" id="form_nm_satuan">
                                              <label for="nm_satuan" class="control-label"> Nama Satuan <span class="required">* </span></label>
                                              <input required type="text" id="nm_satuan" name="nm_satuan" class="form-control" placeholder="Ketik Nama Satuan disini">
                                              <span id="error_nm_satuan" class="help-block"></span>
                                          </div>
                                      </div>   
                                      <div class="col-md-6">
                                          <div class="form-group" id="form_jns_satuan">
                                              <label for="jns_satuan" class="control-label"> Jenis Satuan <span class="required">* </span></label>
                                              <input required type="text" id="jns_satuan" name="jns_satuan" class="form-control" placeholder="Ketik Jenis Satuan disini">
                                              <span id="error_jns_satuan" class="help-block"></span>
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
