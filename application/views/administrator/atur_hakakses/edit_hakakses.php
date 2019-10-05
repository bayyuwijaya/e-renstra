<div class="row" id="portlet-content">
    <div class="col-md-12">
        <div class="portlet light" style="position:relative;">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-calendar"></i><?=$judul?>
                </div>
            </div>
            <div class="portlet-body form" id="page-content" style="display:none">
                <form action="<?=site_url('administrator/setting/atur_hakakses/edit_prefillage')?>" method="post" id="<?=$controller?>" class="form-horizontal">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="form-group" id="form_id_global_hakakses">
                                    <label for="id_global_hakakses" class="control-label col-md-3">Level Hak Akses</label>
                                    <div class="col-md-6">
                                        <select id="id_global_hakakses" name="id_global_hakakses" class="form-control" style="width:100%" required>
                                            <option value=""></option>
                                        </select> 
                                        <input type="hidden" value="<?= $id_global_user ?>" name="id_global_user">
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn blue"><i class="fa fa-check"></i> Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php $this->load->view('administrator/include/loading');?>
        </div>
    </div>
</div>
<script>
    $(document).ready( function () {
        $('#<?=$controller?>').submit(function(){
            swal({
              title: "Atur Hak Akses ",
              text: "Anda yakin akan mengubah Hak Akses?",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "OK",
              closeOnConfirm: false
            },
            function(){
              $.ajax({
                url:"<?=site_url('administrator/setting/atur_hakakses/edit_prefillage')?>",
                type:"POST",
                data:$('#<?=$controller?>').serialize(),
                beforeSend: function() {
                  $("#loading").fadeIn('fast');
                },
                success:function(data){
                  $("#loading").fadeOut('fast');
                  data=JSON.parse(data);
                  if(data.status=="1")
                  {
                    swal({
                      title: data.title,
                      text: data.message,
                      type: "success",
                      showCancelButton: false,
                      confirmButtonClass: "btn-success",
                      confirmButtonText: "OK",
                      closeOnConfirm: true
                    },
                    function(){
                      document.location = '<?=site_url("administrator/setting/atur_hakakses/");?>';
                    });
                  }
                  else
                  {
                    swal({
                      title: data.title,
                      text: data.message,
                      type: "danger",
                      showCancelButton: false,
                      confirmButtonClass: "btn-danger",
                      confirmButtonText: "OK",
                      closeOnConfirm: true
                    },
                    function(){
                      //document.location = '<?=site_url("administrator/setting");?>';
                    });
                  }
                }
              });
            });
            return false;
        });

        $("#id_global_hakakses").select2({
          placeholder: "Pilih Hak Akses",
          language: "id",
          data: <?=$level?>
        });
        var id_global_user = "<?=$id_global_user ?>";
        if(id_global_user != '0' ) {
          $("#id_global_hakakses").val("<?=$user_hakakses->id_global_hakakses?>").trigger('change');
        }

        $( "#loading-content,#loading" ).fadeOut( "fast", function() {
          $( "#page-content" ).fadeIn("fast");
          $('.light').css("min-height","400px");
        });
    });
</script>