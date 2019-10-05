<script>
function viewHapusData(id,nama)
  {
    swal({
      title: "Hapus Data",
      text: "Hapus Data ini? ("+nama+")",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "OK",
      closeOnConfirm: false
    },
    function(){
      $.ajax({
        url:"<?=site_url('administrator/'.$controller_dir.$controller.'/hapus_data_proses/')?>",
        type:"POST",
        data:{'id':id},
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
              if($('#<?=$controller?>_table').DataTable().ajax.url()==''||$('#<?=$controller?>_table').DataTable().ajax.url()==null)
                location.reload();
              else
                $('#<?=$controller?>_table').DataTable().ajax.reload();
            });
          }
          else if(data.status=="2")
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
              //document.location = '<?=site_url("administrator/".$controller);?>';
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
              //document.location = '<?=site_url("administrator/".$controller);?>';
            });
          }
        }                      
      });
    });
  }
</script>