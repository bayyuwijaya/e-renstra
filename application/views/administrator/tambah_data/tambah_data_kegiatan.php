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
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group" id="form_nm_kegiatan">
                                                <label for="nm_kegiatan" class="control-label">Nama Satker / Program / Kegiatan / Output / Komponen / Sub Komponen<span class="required">* </span></label>
                                                <input required type="text" id="nm_kegiatan" name="nm_kegiatan" class="form-control" placeholder="Nama Satker / Program / Kegiatan / Output / Komponen / Sub Komponen">
                                                <span id="error_nm_kegiatan" class="help-block"></span>
                                            </div>
                                        </div>                                       
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group" id="form_kode">
                                                <label for="kode" class="control-label">Kode <span class="required">* </span></label>
                                                <input required type="text" id="kode" name="kode" class="form-control" placeholder="Kode">
                                                <span id="error_kode" class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" id="form_provinsi">
                                                <label for="provinsi" class="control-label">Provinsi <span class="required">* </span></label>
                                                <input required type="text" id="provinsi" name="provinsi" class="form-control" placeholder="Provinsi">
                                                <span id="error_provinsi" class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" id="form_kab_kota">
                                                <label for="kab_kota" class="control-label">Kabupaten / Kota <span class="required">* </span></label>
                                                <input required type="text" id="kab_kota" name="kab_kota" class="form-control" placeholder="Kabupaten / Kota">
                                                <span id="error_kab_kota" class="help-block"></span>
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
