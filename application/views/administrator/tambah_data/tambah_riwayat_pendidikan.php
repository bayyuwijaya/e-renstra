<div class="row" id="info-content" style="display:none">
    <div class="col-md-12">
        <div class="portlet box blue" style="position:relative">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-user"></i> Informasi Mahasiswa
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal form-bordered form-row-stripped" role="form">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="form-control-static col-md-2">Nama</label>
                            <p class="form-control-static col-md-10">
                                : <?=$mahasiswa->nm_sdm?>
                            </p>
                        </div>
                        <div class="form-group">
                            <label class="form-control-static col-md-2">Tempat Lahir</label>                            
                            <p class="form-control-static col-md-10">
                                : <?=$mahasiswa->tmpt_lahir?>
                            </p>                            
                        </div>
                        <div class="form-group">
                            <label class="form-control-static col-md-2">Tanggal Lahir</label>                            
                            <p class="form-control-static col-md-10">
                                : <?php setlocale(LC_ALL, 'IND');echo strftime("%d %B %Y", strtotime($mahasiswa->tgl_lahir));?>
                            </p>                            
                        </div>
                        <div class="form-group">
                            <label class="form-control-static col-md-2">Jenis Kelamin</label>                            
                            <p class="form-control-static col-md-10">
                                : <?=$mahasiswa->jk=='L'?'Laki-laki':'Perempuan'?>
                            </p>                            
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row" id="portlet-content">
    <div class="col-md-12">
        <div class="portlet light" style="position:relative">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-plus"></i><?=$judul?>
                </div>
            </div>
            <div class="portlet-body form" id="page-content" style="display:none">
                <form action="<?=site_url('administrator/'.$controller_dir.$controller.'/tambah_data_proses')?>" method="post" id="<?=$controller?>" enctype="multipart/form-data" class="horizontal-form">
                    <div class="form-body">
                        <input value="<?=$mahasiswa->id_sdm?>" type="hidden" name="id_sdm">
                        <div class="alert alert-danger display-hide" style="display: none;" id="error">
                            <button class="close" data-close="alert"></button>
                            <span id="error-text"></span>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" id="form_nipd">
                                    <label for="jenjang" class="control-label">Jenjang <span class="required">* </span></label>
                                    <input required type="text" id="jenjang" name="jenjang" class="form-control" placeholder="Jenjang">
                                    <span id="error_nipd" class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="form_nipd">
                                    <label for="nipd" class="control-label">Jurusan </label>
                                    <input required type="text" id="nipd" name="jurusan" class="form-control" placeholder="Jurusan">
                                    <span id="error_nipd" class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="form_nipd">
                                    <label for="nipd" class="control-label">Sekolah/Universitas <span class="required">* </span></label>
                                    <input required type="text" id="nipd" name="institusi" class="form-control" placeholder="Sekolah/Universitas">
                                    <span id="error_nipd" class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="form_nipd">
                                    <label for="nipd" class="control-label">Tahun Lulus<span class="required">* </span></label>
                                    <input required type="text" id="nipd" name="thn_lulus" class="form-control" placeholder="Tahun Lulus">
                                    <span id="error_nipd" class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="form_nipd">
                                    <label for="nipd" class="control-label">No Ijasah<span class="required">* </span></label>
                                    <input required type="text" id="nipd" name="no_ijasah" class="form-control" placeholder="Tahun Lulus">
                                    <span id="error_nipd" class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-actions right">
                        <a type="button" class="btn default" href="<?=site_url('administrator/'.$controller_dir.$controller)?>/view/<?=$mahasiswa->id_sdm?>">Kembali</a>
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
        $('#datepicker_pd').datepicker({
            format: "dd-mm-yyyy",
            clearBtn: true,
            language: 'id',
            autoclose: true,
            todayHighlight: true
        });

        /*-------------Select2-------------*/
    

      

      
        $( "#loading-content,#loading" ).fadeOut( "fast", function() {
          $( "#page-content" ).fadeIn("fast");
          $( "#info-content" ).fadeIn("fast");
        });
    });
</script>
<?php $this->load->view('administrator/script/form_data');?>