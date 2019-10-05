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
                                    Biodata </a>
                                </li>
                              
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="biodata">
                                    <h3 class="form-section">Data Diri</h3>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group" id="form_nm_pd">
                                                <label for="nm_pd" class="control-label">Nama <span class="required">* </span></label>
                                                <input required type="text" id="nm_pd" name="nm_sdm" class="form-control" placeholder="Nama">
                                                <span id="error_nm_pd" class="help-block"></span>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group" id="form_tmpt_lahir">
                                                <label for="tmpt_lahir" class="control-label">Tempat Lahir <span class="required">* </span></label>
                                                <input required type="text" id="tmpt_lahir" name="tmpt_lahir" class="form-control" placeholder="Tempat Lahir">
                                                <span id="error_tmpt_lahir" class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="form_tgl_lahir">
                                                <label for="tgl_lahir" class="control-label">Tanggal Lahir <span class="required">* </span></label>
                                                <div class="input-group date" id="datepicker_pd">
                                                    <span class="input-group-btn">
                                                        <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                                    </span>
                                                    <input required type="text" id="tgl_lahir" name="tgl_lahir" class="form-control" placeholder="Tanggal Lahir" value="01-01-1990" readonly>
                                                </div>
                                                <span id="error_tgl_lahir" class="help-block"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group" id="form_jk">
                                                <label for="jk" class="control-label">Jenis Kelamin <span class="required">* </span></label>
                                                <select required style="width:100%" id="jk" name="jk" class="form-control">
                                                    <option value=""></option>
                                                    <option value="L">Laki-laki</option>
                                                    <option value="P">Perempuan</option>
                                                </select>
                                                <span id="error_jk" class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="form_nik">
                                                <label for="nik" class="control-label">NIK <span class="required">* </span></label>
                                                <input required type="text" id="nik" name="nik" class="form-control" placeholder="Nomor Induk Kependudukan (KTP)">
                                                <span id="error_nik" class="help-block"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group" id="form_nisn">
                                                <label for="nisn" class="control-label">NRP</label>
                                                <input type="text" id="nisn" name="nrp" class="form-control" placeholder="No NRP">
                                                <span id="error_nisn" class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="form_npwp">
                                                <label for="npwp" class="control-label">NPWP</label>
                                                <input type="text" id="npwp" name="npwp" class="form-control" placeholder="Nomor Pokok Wajib Pajak">
                                                <span id="error_npwp" class="help-block"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group" id="form_npwp">
                                                <label for="npwp" class="control-label">No. BPJS</label>
                                                <input type="text" id="npwp" name="bpjs" class="form-control" placeholder="No BPJS">
                                                <span id="error_npwp" class="help-block"></span>
                                            </div>
                                        </div>

                                         <div class="col-md-6">
                                           
                                            <div class="form-group" id="form_id_agama">
                                                <label for="id_agama" class="control-label">Agama <span class="required">* </span></label>
                                               
                                                <select id="id_agama" name="id_agama" class="form-control">
                                                    <option value=""></option>
                                                    <?php foreach ($this->Content_m->select_db('pddikti_re_agama')->result() as $key ) { ?>
                                                        <option value="<?=$key->id_agama?>"><?=$key->nm_agama?></option>
                                                    <?php }?>
                                                    
                                                </select>
                                                <span id="error_id_agama" class="help-block"></span>
                                            </div>
                                      
                                            
                                        </div>
                                        
                                    </div>
                                    <h3 class="form-section">Alamat</h3>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group" id="form_jln">
                                                <label for="jln" class="control-label">Alamat</label>
                                                <input type="text" id="jln" name="jln" class="form-control" placeholder="Alamat">
                                                <span id="error_jln" class="help-block"></span>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group" id="form_kode_pos">
                                                <label for="kode_pos" class="control-label">Kode Pos </label>
                                                <input type="text" id="kode_pos" name="kode_pos" class="form-control" placeholder="Kode Pos">
                                                <span id="error_kode_pos" class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="form_kewarganegaraan">
                                                <label for="kewarganegaraan" class="control-label">Kewarganegaraan <span class="required">* </span></label>
                                                <select required style="width:100%" id="kewarganegaraan" name="kewarganegaraan" class="form-control">
                                                    <option value=""></option>
                                                </select>
                                                <span id="error_kewarganegaraan" class="help-block"></span>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <h3 class="form-section">Kontak</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group" id="form_email">
                                                <label for="email" class="control-label">Email</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                    </span>
                                                    <input type="text" id="email" name="email" class="form-control" placeholder="Email">
                                                </div>
                                                <span id="error_email" class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group" id="form_no_tel_rmh">
                                                <label for="no_tel_rmh" class="control-label">Telepon</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-phone"></i>
                                                    </span>
                                                    <input type="text" id="no_tel_rmh" name="no_tlp" class="form-control" placeholder="No. Telepon">
                                                </div>
                                                <span id="error_no_tel_rmh" class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group" id="form_no_hp">
                                                <label for="no_hp" class="control-label">HP</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-mobile fa-lg"></i>
                                                    </span>
                                                    <input type="text" id="no_hp" name="no_hp" class="form-control" placeholder="No. HP">
                                                </div>
                                                <span id="error_no_hp" class="help-block"></span>
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
        /*-------------Datepicker-------------*/
        $('#datepicker_pd').datepicker({
            format: "dd-mm-yyyy",            
            language: 'id',
            autoclose: true,
            startView: 2,
            todayHighlight: true
        });

        $('#datepicker_ayah').datepicker({
            format: "dd-mm-yyyy",            
            language: 'id',
            autoclose: true,
            startView: 2,
            todayHighlight: true
        });

        $('#datepicker_ibu').datepicker({
            format: "dd-mm-yyyy",            
            language: 'id',
            autoclose: true,
            startView: 2,
            todayHighlight: true
        });

        $('#datepicker_wali').datepicker({
            format: "dd-mm-yyyy",            
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
         $("#id_agama").select2({
          placeholder: "Agama",
          language: "id"
        });

        $("#a_terima_kps").select2({
          placeholder: "Penerima Kartu Perlindungan Sosial (KPS)?",
          language: "id"
        });

        $('#a_terima_kps').on('select2:select', function (evt) {
          if($('#a_terima_kps').val()=='0')
            $('#no_kps').prop("disabled", true);
          else
            $('#no_kps').removeAttr("disabled");
        });

       

        $("#id_wil").select2({
          placeholder: "Kecamatan",
          language: "id",
          ajax: {
            url: "<?=site_url('administrator/ajax/select2_wilayah')?>",
            dataType: 'json',
            delay:500,
            type:"POST",
            data: function(params) {
                return {
                    term: params.term || '',
                    page: params.page || 1
                }
            }
          },
          escapeMarkup: function (markup) {return markup;},
          minimumInputLength: 1,
          templateResult: function(repo){
            if(repo.loading)
                return repo.text;
            return repo.value;
          },
          templateSelection: function(repo){return repo.value || repo.text;}
        });

        $("#kewarganegaraan").select2({
          placeholder: "Kewarganegaraan",
          language: "id",
          ajax: {
            url: "<?=site_url('administrator/ajax/select2_kewarganegaraan')?>",
            dataType: 'json',
            delay:500,
            type:"POST",
            data: function(params) {
                return {
                    term: params.term || '',
                    page: params.page || 1
                }
            }
          },
          escapeMarkup: function (markup) {return markup;},
          minimumInputLength: 1,
          templateResult: function(repo){
            if(repo.loading)
                return repo.text;
            return repo.value;
          },
          templateSelection: function(repo){return repo.value || repo.text;}
        });
         /*-------------End Select2-------------*/

        

        $( "#loading-content,#loading" ).fadeOut( "fast", function() {
          $( "#page-content" ).fadeIn("fast");
        });
    });
</script>
<?php $this->load->view('administrator/script/form_data');?>
