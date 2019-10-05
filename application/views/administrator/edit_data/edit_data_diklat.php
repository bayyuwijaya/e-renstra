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
                        <div class="tabbable-custom ">
                           
                                <div class="tab-pane fade active in" id="biodata">
                                    
                                    <input value="<?=$mahasiswa->id_sdm?>" type="hidden" name="id_sdm">
                                    <input value="<?=$diklat->id_sdm_diklat?>" type="hidden" name="id_sdm_diklat">
                                    <div class="row">
                                        


                                        <div class="col-md-6">
                                            <div class="form-group" id="form_jenis">
                                                <label for="jenis" class="control-label">Jenis Diklat <span class="required">* </span></label>

                                                <input required type="text" id="jenis" name="jenis_diklat" class="form-control" value="<?=$diklat->jenis_diklat?>">

                                                
                                                <span id="error_jenis" class="help-block"></span>
                                            </div>
                                        </div>





                                        <div class="col-md-6">
                                            <div class="form-group" id="form_nipd">
                                                <label for="jenjang" class="control-label">Tempat Diklat <span class="required">* </span></label>
                                                <input required type="text" id="nama" name="tmpt_diklat" class="form-control" placeholder="Tempat Diklat" value="<?=$diklat->tmpt_diklat?>">
                                                <span id="error_nipd" class="help-block"></span>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                       
                                        <div class="col-md-6">
                                            <div class="form-group" id="form_tgl_lahir">
                                                <label for="tgl_lahir" class="control-label">Tanggal Mulai <span class="required">* </span></label>
                                                <div class="input-group date" id="datepicker_pd">
                                                    <span class="input-group-btn">
                                                        <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                                    </span>
                                                    <input required type="text" id="tgl_lahir" name="tgl_mulai" class="form-control" placeholder="Tanggal Mulai" value="<?=$diklat->tgl_mulai?>" readonly>
                                                </div>
                                                <span id="error_tgl_lahir" class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="form_tgl_lahir">
                                                <label for="tgl_lahir" class="control-label">Tanggal Selesai <span class="required">* </span></label>
                                                <div class="input-group date" id="datepicker_pd">
                                                    <span class="input-group-btn">
                                                        <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                                    </span>
                                                    <input required type="text" id="tgl_selesai" name="tgl_selesai" class="form-control" placeholder="Tanggal Selesai" value="<?=$diklat->tgl_selesai?>" readonly>
                                                </div>
                                                <span id="error_tgl_lahir" class="help-block"></span>
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
