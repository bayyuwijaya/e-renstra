<div class="row" id="info-content" style="display:none">
    <div class="col-md-12">
        <div class="portlet box blue" style="position:relative">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-user"></i> Informasi Pegawai
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
                <form action="<?=site_url('administrator/'.$controller_dir.$controller.'/edit_data_proses')?>" method="post" id="<?=$controller?>" enctype="multipart/form-data" class="horizontal-form">
                    <div class="form-body">
                        <input value="<?=$mahasiswa->id_sdm?>" type="hidden" name="id_sdm">
                        <input value="<?=$cuti->id_cuti?>" type="hidden" name="id_cuti">
                        <div class="alert alert-danger display-hide" style="display: none;" id="error">
                            <button class="close" data-close="alert"></button>
                            <span id="error-text"></span>
                        </div>
                        <h3 class="form-section">Data Cuti Tahunan</h3>
                        <div class="row">
                            
                            <div class="col-md-12">
                                <!--bisa pilih tahun-->
                                <div class="form-group" id="form_nipd">
                                    <label for="jenjang" class="control-label">Tahun</label>
                                    <input required type="text" id="jenjang" name="tahun" class="form-control" placeholder="2019" value="<?=$cuti->tahun?>">
                                    <span id="error_nipd" class="help-block"></span>
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group" id="form_nipd">
                                    <label for="nipd" class="control-label">Tanggal Awal Cuti</label>
                                    <input required type="text" id="tgl_awal" name="tgl_awal_cuti" class="form-control" placeholder="Tanggal Awal Cuti" value="<?=$cuti->tgl_awal_cuti?>">
                                    <span id="error_nipd" class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="form_nipd">
                                    <label for="nipd" class="control-label">Tanggal Akhir Cuti</label>
                                    <input required type="text" id="tgl_akhir" name="tgl_akhir_cuti" class="form-control" placeholder="Tanggal Akhir Cuti" value="<?=$cuti->tgl_akhir_cuti?>">
                                    <span id="error_nipd" class="help-block"></span>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group" id="form_nipd">
                                    <label for="nipd" class="control-label">Cuti Sakit </label>
                                    <input required type="text" id="nipd" name="cuti_sakit" class="form-control" placeholder="Total Cuti" value="<?=$cuti->cuti_sakit?>">
                                    <span id="error_nipd" class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="form_nipd">
                                    <label for="nipd" class="control-label">Cuti Alasan Penting</label>
                                    <input required type="text" id="nipd" name="cuti_alasan_penting" class="form-control" placeholder="Total Cuti" value="<?=$cuti->cuti_alasan_penting?>">
                                    <span id="error_nipd" class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="form_nipd">
                                    <label for="nipd" class="control-label">Cuti Tahunan</label>
                                    <input required type="text" id="nipd" name="cuti_tahunan" class="form-control" placeholder="Total Cuti" value="<?=$cuti->cuti_tahunan?>">
                                    <span id="error_nipd" class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="form_nipd">
                                    <label for="nipd" class="control-label">Cuti Besar</label>
                                    <input required type="text" id="nipd" name="cuti_besar" class="form-control" placeholder="Total Cuti" value="<?=$cuti->cuti_besar?>">
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
          $('#datepicker_pd, #tgl_awal, #tgl_akhir').datepicker({
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