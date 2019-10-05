<script>
    $(document).ready(function(){
      $('#<?=$controller?>').submit(function(){
        var formData = new FormData(this);
        $.ajax({
          url:this.action,
          type:this.method,
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          beforeSend: function() {
              $("#loading").fadeIn('fast');
          },
          success:function(data){
            data=JSON.parse(data);

            $('#loading').fadeOut('fast',function(){
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
                function() {
                  <?php if($parent_controller==$controller) { ?>
                    document.location="<?=site_url('administrator/'.$controller_dir.$controller.'/index'.'/'.$id_kegiatan)?>";
                  <?php } else { ?>
                    document.location = '<?=$this->agent->referrer()?>';
                  <?php } ?>
                });
              }
              else if(data.status=="2")
              {
                $.each( data.detail_error, function( field, value ) {
                  if(value.error!='')
                  {
                    $('#form_'+field).removeClass('has-success');
                    $('#form_'+field).addClass('has-error');
                    $('#error_'+field).html(value.error).css('display','block');
                  }
                  else
                  {
                    $('#form_'+field).removeClass('has-error');
                    $('#form_'+field).addClass('has-success');
                    $('#error_'+field).css('display','none');
                  }
                });
                $('#error-text').html(data.message);
                $('#error').fadeIn('fast');
                $('html,body').animate({scrollTop: $('#portlet-content').offset().top-70},500);
              }
              else
              {
                swal({
                  title: data.title,
                  text: data.message,
                  type: "error",
                  showCancelButton: false,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "OK",
                  closeOnConfirm: true
                },
                function(){

                });
              }
            });
          }                      
        });
        return false;
      });
    });
</script>