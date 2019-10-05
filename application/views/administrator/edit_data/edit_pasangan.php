<div class="row" id="portlet-content">
    <div class="col-md-12">
                <div class="portlet box blue" style="position:relative">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-tasks"></i> Paket Pekerjaan
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal form-bordered form-row-stripped" role="form">
                    <div class="form-body">

                        <div class="form-group">
                            <label class="form-control-static col-md-2">Nama Paket</label>
                            <p class="form-control-static col-md-10">
                                : Unit Desain BWS Bali-Penida   
                            </p>
                        </div>

                        <div class="form-group">
                            <label class="form-control-static col-md-2">Kode</label>                            
                            <p class="form-control-static col-md-10">
                                : A
                            </p>                            
                        </div>


                        
                        <div class="form-group">
                            <label class="form-control-static col-md-2">Tahun</label>                            
                            <p class="form-control-static col-md-10">
                                : 2020
                            </p>                            
                        </div>


                        
                    </div>
                </form>
            </div>
        </div>


            <div class="portlet-body form" id="page-content" style="display:none">
                <form action="<?=site_url('administrator/'.$controller_dir.$controller.'/edit_data_proses')?>" method="post" id="<?=$controller?>" enctype="multipart/form-data" class="horizontal-form">
                    <div style="background-color: #fff" class="form-body">
                        <input value="" type="hidden" name="id_pd">
                        <div class="alert alert-danger display-hide" style="display: none;" id="error">
                            <button class="close" data-close="alert"></button>
                            <span id="error-text"></span>
                        </div> 
                        <div class="tabbable tabbable-custom ">
                        <ul class="nav nav-tabs ">
                            <li class="active">
                                <a href="#lokasi" data-toggle="tab" aria-expanded="true">
                                Lokasi </a>
                            </li>
                            <li class="">
                                <a href="#indikator" data-toggle="tab" aria-expanded="false">
                                Indikator </a>
                            </li>
                            <li class="">
                                <a href="#target" data-toggle="tab" aria-expanded="true">
                                Rencana Pelaksanaan </a>
                            </li>
                            <li class="">
                                <a href="#file" data-toggle="tab" aria-expanded="false">
                                File Pendukung </a>
                            </li>
                        </ul>

                    
                        







                        <div style="padding-top: 20px" class="tab-content">
                            <div class="tab-pane fade active in" id="lokasi">
                                <h3 class="form-section">Data Lokasi</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="form_nm_pd">
                                            <label for="nm_pd" class="control-label">Koordinat X <span class="required">* </span></label>
                                            <input value="" type="text" id="nm_pd" name="nm_pd" class="form-control" placeholder="Nama">
                                            <label for="nm_pd" class="control-label">Koordinat Y <span class="required">* </span></label>
                                            <input value="" type="text" id="nm_pd" name="nm_pd" class="form-control" placeholder="Nama">
                                            <span id="error_nm_pd" class="help-block"></span>
                                        </div>
                                    </div>
                                    
                                </div>
                               
                            
                            </div>







                            <div class="tab-pane fade" id="indikator">
                                <h3 class="form-section">List Indikator</h3>
                                <div style="margin-left: 20px" class="row">
                                  
                                    <div class="checkbox">
                                      <label><input type="checkbox" value="">1. Mendukung Kegiatan Prioritas Nasional / Strategis Nasional</label>
                                    </div>
                                    <div class="checkbox">
                                      <label><input type="checkbox" value="">2. Kegiatan yang Bersifat Lanjutan</label>
                                    </div>
                                    <div class="checkbox disabled">
                                      <label><input type="checkbox" value="" >3. Tertuang di dalam Pola dan Rencana Pengelolaan Sumber Daya Air</label>
                                    </div>
                                    <div class="checkbox disabled">
                                      <label><input type="checkbox" value="" >4. Kesesuaian terhadap RT RW</label>
                                    </div>
                                    <div class="checkbox disabled">
                                      <label><input type="checkbox" value="" >5. Tertuang di dalam RPJM / Renstra</label>
                                    </div>
                                    <div class="checkbox disabled">
                                      <label><input type="checkbox" value="" >6. Kegiatan yang bersifat Rehabilitasi</label>
                                    </div>
                                    <div class="checkbox disabled">
                                      <label><input type="checkbox" value="" >7. Kesiapan Dokumen Desain</label>
                                    </div>
                                    <div class="checkbox disabled">
                                      <label><input type="checkbox" value="" >8. Kesiapan Dokumen Lingkungan dan Ijin Lingkungan</label>
                                    </div>
                                    <div class="checkbox disabled">
                                      <label><input type="checkbox" value="" >9. Usulan Dukungan Pemerintah Daerah</label>
                                    </div>
                                    <div class="checkbox disabled">
                                      <label><input type="checkbox" value="" >10. Kesiapan Lahan</label>
                                    </div>
                                    <div class="checkbox disabled">
                                      <label><input type="checkbox" value="" >11. Memiliki Manfaat Sosial dan fasilitas umum</label>
                                    </div>
                                   
                                </div>
                                
                            </div>
                            <div class="tab-pane fade" id="target">
                                <h3 class="form-section">PEMBANGUNAN</h3>
                                <div class="row">

                                    <div class="col-md-6">
                                        <h4 class="form-section">OUTPUT</h4>
                                        <div class="form-group" id="form_nm_pd">
                                            <label for="nm_pd" class="control-label">Satuan <span class="required">* </span></label>
                                            <input value="" type="text" id="nm_pd" name="nm_pd" class="form-control" placeholder="Input Satuan">


                                            <label for="nm_pd" class="control-label">Target <span class="required">* </span></label>
                                            <input value="" type="text" id="nm_pd" name="nm_pd" class="form-control" placeholder="input Target">
                                            <span id="error_nm_pd" class="help-block"></span>
                                        </div>
                                    </div>
                                    
                                </div>


                                <br>

                                <h3 class="form-section">SUPERVISI</h3>
                                <div class="row">

                                    <div class="col-md-6">
                                        <h4 class="form-section">OUTCOME</h4>
                                        <div class="form-group" id="form_nm_pd">
                                            <label for="nm_pd" class="control-label">Satuan <span class="required">* </span></label>
                                            <input value="" type="text" id="nm_pd" name="nm_pd" class="form-control" placeholder="Input Satuan">


                                            <label for="nm_pd" class="control-label">Target <span class="required">* </span></label>
                                            <input value="" type="text" id="nm_pd" name="nm_pd" class="form-control" placeholder="input Target">
                                            <span id="error_nm_pd" class="help-block"></span>
                                        </div>
                                    </div>
                                    
                                </div>

                                <br>
                                <h3 class="form-section">ANGGARAN</h3>
                                <div class="row">

                                    <div class="col-md-6">
                                     
                                        <div class="form-group" id="form_nm_pd">

                                            <input value="" type="text" id="nm_pd" name="nm_pd" class="form-control" placeholder="Input Anggaran">


                                        </div>
                                    </div>
                                    
                                </div>


                                

                            </div>

                            <div class="tab-pane fade" id="file">
                                <div class="table-responsive">
                                    <table style="text-align: center" id="<?=$controller?>_table" class="table table-bordered table-striped table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th><center>Nama File</center></th>
                                                <th><center> Keterangan </center></th>
                                                <th style="width: 10px">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>                            

                                            <tr>
                                              <td>1</td>
                                              <td>Dokumentasi Lapangan </td>
                                              <td>File Pendukung</td>
                                              

                                              <td><center>
                                                <a  href="<?=site_url()?>/administrator/mhs_dir/data_pasangan/edit_data/<?=$mahasiswa->id_sdm?>/"><span class="glyphicon glyphicon-download" aria-hidden="true"></span></a>
                                                <br>
                                                <a data-toggle="tooltip" data-placement="top" title="Hapus" href="<?=site_url()?>/administrator/mhs_dir/data_pasangan/del_data/
                                                    " onclick="return confirm('Are you sure?')" style="cursor:pointer">
                                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                                </a></center>
                                              </td>
                                            </tr>

                                            <tr>
                                              <td>2</td>
                                              <td>Rencana Anggran</td>
                                              <td>File Pendukung</td>

                                              <td><center>
                                                <a  href="<?=site_url()?>/administrator/mhs_dir/data_pasangan/edit_data/<?=$mahasiswa->id_sdm?>/"><span class="glyphicon glyphicon-download" aria-hidden="true"></span></a>
                                                <br>
                                                <a data-toggle="tooltip" data-placement="top" title="Hapus" href="<?=site_url()?>/administrator/mhs_dir/data_pasangan/del_data/
                                                    " onclick="return confirm('Are you sure?')" style="cursor:pointer">
                                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                                </a></center>
                                              </td>
                                            </tr>

                                           

                                            <tr>
                                              <td>3</td>
                                              <td>Survey, Pengukuran dan Koordinasi</td>
                                              <td>File Pendukung</td>

                                              <td><center>
                                                <a  href="<?=site_url()?>/administrator/mhs_dir/data_pasangan/edit_data/<?=$mahasiswa->id_sdm?>/"><span class="glyphicon glyphicon-download" aria-hidden="true"></span></a>
                                                <br>
                                                <a data-toggle="tooltip" data-placement="top" title="Hapus" href="<?=site_url()?>/administrator/mhs_dir/data_pasangan/del_data/
                                                    " onclick="return confirm('Are you sure?')" style="cursor:pointer">
                                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                                </a></center>
                                              </td>
                                            </tr>
                                       
                                       
                                                                                             
                                        </tbody>
                                    </table>
                                </div>
                                

                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="form-actions right">
                        
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
        /*-------------Datepicker-------------*/
        $('#datepicker_pd').datepicker({
            format: "yyyy-mm-dd",            
            language: 'id',
            autoclose: true,
            startView: 2,
            todayHighlight: true
        });

        $('#datepicker_ayah').datepicker({
            format: "yyyy-mm-dd",            
            language: 'id',
            autoclose: true,
            startView: 2,
            todayHighlight: true
        });

        $('#datepicker_ibu').datepicker({
            format: "yyyy-mm-dd",            
            language: 'id',
            autoclose: true,
            startView: 2,
            todayHighlight: true
        });

        $('#datepicker_wali').datepicker({
            format: "yyyy-mm-dd",            
            language: 'id',
            autoclose: true,
            startView: 2,
            todayHighlight: true
        });
        /*-------------End Datepicker-------------*/

        /*-------------Select2-------------*/
        $("#jk").select2({
          placeholder: "Jenis Kelamin",
          language: "id"
        });
        $("#jk").val("<?=$mahasiswa->jk?>").trigger('change');

        

        $( "#loading-content,#loading" ).fadeOut( "fast", function() {
          $( "#page-content" ).fadeIn("fast");
        });
    });
</script>
<?php $this->load->view('administrator/script/form_data');?>
