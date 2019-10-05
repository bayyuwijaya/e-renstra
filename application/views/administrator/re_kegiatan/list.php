<div class="row" id="portlet-content">
    <div class="col-md-12">
        <div class="portlet light" style="position:relative">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-folder"></i>Data <?=$judul?>
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
                          <th class="text-center"> ID Nama Kegiatan </th>
                          <th class="text-center"> Kategori </th>
                          <th class="text-center"> Nama Kegiatan </th>
                          <th class="text-center"> Aksi </th>
                      </tr>
                    </thead>
                        <tbody>
                          <?php foreach ($query->result() as $key) { ?>
                            <?php                        
                              $del = '<a class="tooltips btn-xs btn-danger" data-toggle="m-tooltip" data-placement="top" title="Hapus" onclick="viewHapusData(\''.$key->id_nmkegiatan.'\',\''.$key->nm_kegiatan.'\')" style="cursor:pointer"><i class=\'fa fa-times\'></i></a>';                       
                              $edit = anchor('administrator/setting/nmkegiatan/edit_nmkegiatan/'.$key->id_nmkegiatan, "<span class='glyphicon glyphicon-edit' aria-hidden='true'></span>",  array('class'=>"tooltips btn-xs btn-warning", 'data-toggle'=>"m-tooltip", 'title'=>'Edit'));
                            ?>
                            <?php 
                              $query = $this->db->get_where('erenstra_tr_kategori', array('id_kategori' => $key->id_kategori, 'deleted'=>0));
                              if($query->num_rows() > 0) {
                                $val_kat = $query->row()->nm_kategori;
                              } else {
                                $val_kat = 'Belum Dipilih';
                              }
                            ?>
                            <tr>
                              <td class="col-md-2" align="center"><?=str_replace("nmk-","",$key->id_nmkegiatan)?></td>
                              <td class="col-md-2" align="center"><?=$val_kat ?></td>
                              <td style="padding: 15px 20px 15px 20px;" align="left"><?=$key->nm_kegiatan?></td>                      
                              <td class="col-md-1" align="center"> <?=$edit?> <?=$del?> </td>
                            </tr>
                          <?php } ?>                      
                        </tbody>     
                        <tfoot>
                            <tr>
                              <th class="text-center">ID Nama Kegiatan</th>
                              <th class="text-center"> Kategori </th>
                              <th class="text-center">Nama Kegiatan</th>
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