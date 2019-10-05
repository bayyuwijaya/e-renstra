<div class="row" id="portlet-content">
    <div class="col-md-12">
        <div class="portlet light" style="position:relative">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit"></i><?=$judul?>
                </div>
            </div>
            <div class="portlet-body form" id="page-content" style="display:block">
                <?=form_open_multipart('administrator/data_renstra/file_support/edit_data_proses', array("id"=>"file_support", "method"=>"post", "class"=>"horizontal-form") );?>
                    <div class="form-body">
                        <div class="alert alert-danger display-hide" style="display: none;" id="error">
                          <button class="close" data-close="alert"></button>
                          <span id="error-text"></span>
                        </div>
                        <div class="tabbable-custom ">
                          <ul class="nav nav-tabs">
                              <li class="active">
                                  <a href="#file_support" data-toggle="tab" aria-expanded="true">
                                  File Pendukung </a>
                              </li>                             
                          </ul>
                          <div class="tab-content">
                            <div class="tab-pane fade active in" id="file_support">
                                <h3 class="form-section">Data File Pendukung</h3>
                                <div class="row">

                                  <input type="hidden" name="id_paket" value="<?=$paket->id_paket?>">
                                  <input type="hidden" name="id_kegiatan" value="<?=$kegiatan->id_kegiatan?>">
                                  <input type="hidden" name="id_file_support" value="<?=$file_support->id_file_support?>">

                                  <div class="col-md-6">
                                    <div class="form-group" id="form_nm_file">
                                      <label for="nm_file" class="control-label">Nama File <span class="required">* </span></label>
                                      <input required type="text" id="nm_file" name="nm_file" class="form-control" placeholder="Ketik Nama File disini" value="<?=$file_support->nm_file?>">
                                      <span id="error_nm_file" class="help-block"></span>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-group" id="form_berkas">
                                      <label for="berkas" class="control-label">File Upload <span class="required">* </span></label>
                                      <input type="file" accept=".xls,.xlsx, .pdf" id="berkas" name="berkas" class="form-control" placeholder="Piih File Upload disini" required />
                                      <span id="error_berkas" class="help-block"></span>
                                    </div>
                                  </div>

                                </div>    
                                <div class="row">

                                  <div class="col-md-6">
                                    <div class="form-group" id="form_keterangan">
                                      <label for="keterangan" class="control-label">Keterangan <span class="required">* </span></label>
                                      <textarea required id="keterangan" name="keterangan" class="form-control" placeholder="Ketik Keterangan disini"> <?=$file_support->keterangan?> </textarea>
                                      <span id="error_keterangan" class="help-block"></span>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-group" id="form_id_kategorifile">
                                      <label for="id_kategorifile" class="control-label">Kategori File <span class="required">* </span></label>
                                      <select id="id_kategorifile" name="id_kategorifile" class="form-control" style="width:100%" required>
                                        <option value=""></option>
                                      </select>  
                                      <span id="error_id_kategorifile" class="help-block"></span>
                                    </div>
                                  </div>

                                </div>                                                                  
                            </div>                              
                          </div>
                        </div>
                    </div>
                    <div class="form-actions right">
                        <a type="button" class="btn default" href="<?=site_url('administrator/'.$controller_dir.$controller)?>/index/<?=$paket->id_paket?>/<?=$kegiatan->id_kegiatan?>">Kembali</a>
                        <button type="submit" class="btn blue"><i class="fa fa-check"></i> Simpan</button>
                    </div>
                <?=form_close();?>
            </div>
            <?php $this->load->view('administrator/include/loading');?>
        </div>
    </div>
</div>
<script>
  $(document).ready(function() {
    $("#id_kategorifile").select2({
      placeholder: "Pilih Kategori File ",
      language: "id",
      data: <?=$kategorifile?>
    });
    $("#id_kategorifile").val("<?=$file_support->id_kategorifile?>").trigger('change');

    $("#loading-content,#loading").fadeOut("fast",function() {
      $( "#page-content" ).fadeIn("fast");
    });
  });
</script>

