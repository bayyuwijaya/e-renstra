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
                                    <label for="nipd" class="control-label">Periode Penilain</label>
                                    <input required type="text" id="nipd" name="periode_penilaian" class="form-control" placeholder="TRIWULAN III">
                                    <span id="error_nipd" class="help-block"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                
                                <div class="form-group" id="form_nipd">
                                    <label for="jenjang" class="control-label">Jabatan</label>
                                    <input required type="text" id="jenjang" name="jabatan" class="form-control" placeholder="Pengadministrasi Umum">
                                    <span id="error_nipd" class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="form_nipd">
                                    <label for="nipd" class="control-label">Kelas Jabatan</label>
                                    <input required type="text" id="nipd" name="kelas_jabatan" class="form-control" placeholder="5">
                                    <span id="error_nipd" class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="form_nipd">
                                    <label for="nipd" class="control-label">Tanggal Mulai Kerja</label>
                                    <input required type="text" id="datepicker_pd" name="tgl_mulai_kerja" class="form-control" placeholder="2 Januari 2019">
                                    <span id="error_nipd" class="help-block"></span>
                                </div>
                            </div>
                            
                            
                        </div>

                        <h3 class="form-section">Apek Tenkis Pekerjaan</h3>
                        <div class="row">
                            
                            <div class="col-md-12">
                                
                                <div class="form-group" id="form_nipd">
                                    <label for="jenjang" class="control-label">Pemahaman Terhadap Pekerjaan </label>
                                    <input required type="text" id="jenjang" name="pemahaman_terhadap_pekerjaan" class="form-control" placeholder="Beri Nilai 1-4">
                                    <span id="error_nipd" class="help-block"></span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group" id="form_nipd">
                                    <label for="nipd" class="control-label">Ketepatan Waktu Dalam Menyelesaikan Tugas </label>
                                    <input required type="text" id="nipd" name="ketepatan_waktu_dalam_menyelesaikan_tugas" class="form-control" placeholder="Beri Nilai 1-4">
                                    <span id="error_nipd" class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" id="form_nipd">
                                    <label for="nipd" class="control-label">Kesesuaian Hasil Kerja Dengan Yang Diharapkan </label>
                                    <input required type="text" id="nipd" name="kesesuaian_hasil_kerja_dengan_yang_diharapkan" class="form-control" placeholder="Beri Nilai 1-4">
                                    <span id="error_nipd" class="help-block"></span>
                                </div>
                            </div>
                            
                        </div>

                        <h3 class="form-section">Apek Non Tenkis Pekerjaan</h3>
                        <div class="row">
                            
                            <div class="col-md-12">
                                

                                <div class="form-group" id="form_nipd">
                                    <label for="jenjang" class="control-label">Kerapian Pengadministrasian Pekerjaan </label>
                                    <input required type="text" id="kerapian_pengadministrasian_pekerjaan" name="kerapian_pengadministrasian_pekerjaan" class="form-control" placeholder="Beri Nilai 1-4">
                                    <span id="error_nipd" class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" id="form_nipd">
                                    <label for="nipd" class="control-label">Inisiatif</label>
                                    <input required type="text" id="nipd" name="inisiatif" class="form-control" placeholder="Beri Nilai 1-4">
                                    <span id="error_nipd" class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" id="form_nipd">
                                    <label for="nipd" class="control-label">Kerjasama</label>
                                    <input required type="text" id="nipd" name="kerjasama" class="form-control" placeholder="Beri Nilai 1-4">
                                    <span id="error_nipd" class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" id="form_nipd">
                                    <label for="nipd" class="control-label">Kesopanan dan Keluwesan Komunikasi</label>
                                    <input required type="text" id="nipd" name="kesopanan_dan_keluwesan_komunikasi" class="form-control" placeholder="Beri Nilai 1-4">
                                    <span id="error_nipd" class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" id="form_nipd">
                                    <label for="nipd" class="control-label">Ketanggapan dan Ketangkasan Dalam Melayani</label>
                                    <input required type="text" id="nipd" name="ketanggapan_dan_ketangkasan_dalam_melayani" class="form-control" placeholder="Beri Nilai 1-4">
                                    <span id="error_nipd" class="help-block"></span>
                                </div>
                            </div>
                    
                            
                        </div>

                         


                        <h3 class="form-section">Apek Kepribadian</h3>
                        <div class="row">
                                
                            <div class="col-md-12">
                                <div class="form-group" id="form_nipd">
                                    <label for="nipd" class="control-label">Perilaku</label>
                                    <input required type="text" id="nipd" name="prilaku" class="form-control" placeholder="Beri Nilai 1-4">
                                    <span id="error_nipd" class="help-block"></span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group" id="form_nipd">
                                    <label for="nipd" class="control-label">Kedisiplinan</label>
                                    <input required type="text" id="nipd" name="kedisiplinan" class="form-control" placeholder="Beri Nilai 1-4">
                                    <span id="error_nipd" class="help-block"></span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group" id="form_nipd">
                                    <label for="nipd" class="control-label">Tanggung Jawab</label>
                                    <input required type="text" id="nipd" name="tanggung_jawab" class="form-control" placeholder="Beri Nilai 1-4">
                                    <span id="error_nipd" class="help-block"></span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group" id="form_nipd">
                                    <label for="nipd" class="control-label">Loyalitas</label>
                                    <input required type="text" id="nipd" name="loyalitas" class="form-control" placeholder="Beri Nilai 1-4">
                                    <span id="error_nipd" class="help-block"></span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group" id="form_nipd">
                                    <label for="nipd" class="control-label">Ketaatan Terhadap Instruksi Kerja Atasan</label>
                                    <input required type="text" id="nipd" name="ketaatan_terhadap_instruksi_kerja_atasan" class="form-control" placeholder="Beri Nilai 1-4">
                                    <span id="error_nipd" class="help-block"></span>
                                </div>
                            </div>   

                        </div>
                   

                        <!--
                   <h3 class="form-section">TOTAL KINERJA</h3>
                        <div class="row">
                            
                            <div class="col-md-12">
                                
                                <div class="form-group" id="form_nipd">
                                    <label for="jenjang" class="control-label">Total Kinerja Keseluruhan </label>
                                    <input disabled type="text" id="jenjang" name="total_kinerja_keseluruhan" class="form-control" placeholder="43">
                                    <span id="error_nipd" class="help-block"></span>
                                </div>
                            </div>
                            
                            
                        </div>
                        -->

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