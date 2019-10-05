<div class="row" id="portlet-content">
    <div class="col-md-12">
        <div class="portlet light" style="position:relative">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-plus"></i><?=$judul?>
                </div>
            </div>
            <div class="portlet-body form" id="page-content" style="display:nonee">
               <form action="<?=site_url('administrator/'.$controller_dir.$controller.'/edit_data_proses')?>" method="post" id="<?=$controller?>" enctype="multipart/form-data" class="horizontal-form">
                    <div class="form-body">
                        <div class="alert alert-danger display-hide" style="display: none;" id="error">
                            <button class="close" data-close="alert"></button>
                            <span id="error-text"></span>
                        </div>

                        <input value="<?=$mahasiswa->id_sdm?>" type="hidden" name="id_sdm">
                        
                        <input value="<?=$jabatan->id_sdm_jabatan?>" type="hidden" name="id_sdm_jabatan">
                        
                        <div class="tabbable-custom ">
                           
                                <div class="tab-pane fade active in" id="biodata">
                                    
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                            <div class="form-group" id="form_jenis">
                                                <label for="jenis" class="control-label">TMT Kerja <span class="required">* </span></label>

                                                <input type="text" id="tmt" name="tmt_kerja" class="form-control" value="<?=$jabatan->tmt_kerja?>">

                                                
                                                <span id="error_tmt" class="help-block"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group" id="form_nipd">
                                                <label for="jenjang" class="control-label">No. SK <span class="required">* </span></label>
                                                <input type="text" id="no_sk" name="no_sk" class="form-control" value="<?=$jabatan->no_sk?>">
                                                <span id="error_no_sk" class="help-block"></span>
                                            </div>
                                        </div>
                                       
                                    </div>


                                    <div class="row">
                                        
                                         <div class="col-md-6">
                                            <div class="form-group" id="form_nipd">
                                                <label for="jabatan" class="control-label">Jabatan dalam kontrak kerja saat ini <span class="required">* </span></label>
                                                <input required type="text" id="jabatan" name="jabatan" class="form-control" placeholder="Jabatan saat ini" value="<?=$jabatan->jabatan?>">
                                                <span id="error_jabatan" class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="form_nipd">
                                                <label for="jenjang" class="control-label">PPK *)<span class="required">* </span></label>
                                                <input required type="text" id="nama" name="ppk" class="form-control" placeholder="PPK" value="<?=$jabatan->ppk?>">
                                                <span id="error_nipd" class="help-block"></span>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                       
                                        <div class="col-md-6">
                                            <div class="form-group" id="form_nipd">
                                                <label for="jenjang" class="control-label">SATKER *)<span class="required">* </span></label>
                                                <input required type="text" id="nama" name="satker" class="form-control" placeholder="SATKER" value="<?=$jabatan->satker?>">
                                                <span id="error_nipd" class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="form_nipd">
                                                <label for="jenjang" class="control-label">KASI / SUBAG<span class="required">* </span></label>
                                                <input required type="text" id="nama" name="kasi" class="form-control" placeholder="KASI / SUBAG" value="<?=$jabatan->kasi?>">
                                                <span id="error_nipd" class="help-block"></span>
                                            </div>
                                        </div>



                                    </div>
                                    <div class="row">
                                       
                                       <div class="col-md-6">
                                           <div class="form-group" id="form_nipd">
                                               <label for="jenjang" class="control-label">Tanggal Masuk<span class="required"></span></label>
                                               <input required type="text" id="tmt" name="tgl_msk" class="form-control" value="<?=$jabatan->tgl_msk?>" placeholder="Input Tanggal Masuk">
                                               <span id="error_tmt" class="help-block"></span>
                                           </div>
                                       </div>
                                       <div class="col-md-6">
                                           <div class="form-group" id="form_nipd">
                                               <label for="jenjang" class="control-label">Tanggal Keluar<span class="required"></span></label>
                                               <input required type="text" id="tmt" name="tgl_keluar" class="form-control" value="<?=$jabatan->tgl_keluar?>" placeholder="Input Tanggal Keluar">
                                               <span id="error_tmt" class="help-block"></span>
                                           </div>
                                       </div>



                                   </div>
                                    <div class="row">
                                       
                                        <div class="col-md-12">
                                            <div class="form-group" id="form_nipd">
                                                <label for="jenjang" class="control-label">LOKA / BALAI / BALAI BESAR<span class="required">* </span></label>
                                                <input required type="text" id="nama" name="loka" class="form-control" placeholder="LOKA / BALAI / BALAI BESAR" value="<?=$jabatan->loka?>">
                                                <span id="error_nipd" class="help-block"></span>
                                            </div>
                                        </div>
                                        

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
        /*-------------Datepicker-------------*/
        $('#datepicker_pd, #tgl_selesai').datepicker({
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
        $("#jenis").select2({
          placeholder: "Jenis Diklat",
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
