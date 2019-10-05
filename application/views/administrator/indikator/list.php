<div class="row" id="portlet-content">
    <div class="col-md-12">
        <div class="portlet light" style="position:relative">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-bookmark"></i>Data <?=$judul?>
                </div>
                <div class="actions" id="tombol-action" style="display:none">
                    <a class="btn blue btn-sm" href="<?=site_url('administrator/'.$controller_dir.$controller.'/tambah_data')?>">
                        <i class="fa fa-plus"></i> Tambah Data
                    </a>
                </div>
            </div>
            <div class="portlet-body" id="page-content" style="display:none">
                <div class="table-responsive">
                    <table id="<?=$controller?>_table" class="table table-bordered table-striped table-hover" style="width:100%">
                    <thead>
                            <tr>
                                <th class="text-center">ID Indikator</th>
                                <th class="text-center">Nama Indikator</th>
                                <th class="text-center">Nilai Bobot</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($query->result() as $key) { ?>
                          <?php                        
                            $del = '<a class="tooltips btn-xs btn-danger" data-toggle="m-tooltip" data-placement="top" title="Hapus" onclick="viewHapusData(\''.$key->id_indikator.'\',\''.$key->nm_indikator.'\')" style="cursor:pointer"><i class=\'fa fa-times\'></i></a>';                       
                            $edit = anchor('administrator/setting/indikator/edit_indikator/'.$key->id_indikator, "<span class='glyphicon glyphicon-edit' aria-hidden='true'></span>",  array('class'=>"tooltips btn-xs btn-warning", 'data-toggle'=>"m-tooltip", 'title'=>'Edit'));
                          ?>  
                          <tr align="center">
                            <td class="col-md-2"><?=str_replace("idt-","",$key->id_indikator)?></td>
                            <td class="col-md-5"><?=$key->nm_indikator?></td>
                            <td class="col-md-3"><?=$key->bobot?></td>                      
                            <td class="col-md-2">
                              <?=$edit?>
                              <?=$del?>
                            </td>
                          </tr>
                        <?php } ?>                      
                        </tbody>     
                        <tfoot>
                            <tr>
                              <th class="text-center">ID Indikator</th>
                              <th class="text-center">Nama Indikator</th>
                              <th class="text-center">Nilai Bobot</th>
                              <th class="text-center">Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <?php $this->load->view('administrator/include/loading');?>
        </div>
    </div>
</div>
<script>
  $(document).ready( function () {
    var table=$('#<?=$controller?>_table').DataTable({
      "order": [[ 0, 'asc' ]],
      "processing": false,
      "serverSide": false,
      "searching": true,
      "language": {
            "url": "<?=base_url('media/assets/global/plugins/datatables/media/js')?>/indonesian.json"
       },
      "columnDefs": [
     
       // {"targets": [0],"bSortable": false}
      ],
    
      "fnInitComplete": function(oSettings, json) {
        $('.dataTables_processing').css('display','none');
        $( "#loading-content" ).fadeOut( "fast", function() {
          $( "#tombol-action" ).fadeIn("fast");
          $( "#page-content" ).fadeIn("fast");
        });
      }
    });

  });

  $('.hapusdata').click(function(){
    if(confirm("Apakah kamu yakin menghapus entry ini?")){
      return true;
    }
    else{
      return false;
    }
  });
</script>
<?php $this->load->view('administrator/script/hapus_data');?>