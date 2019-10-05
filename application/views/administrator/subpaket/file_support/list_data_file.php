<div class="row" id="portlet-content">
    <div class="col-md-12">
        <div class="portlet light" style="position:relative">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-folder"></i><?=$judul?>
                </div>
                <div class="actions" id="tombol-action" style="display:block; margin-left:5px;">
                    <a class="btn blue btn-sm" href="<?=site_url('administrator/data_renstra/file_support/print_excel/'.$paket->id_paket)?>">
                        <i class="fa fa-print"></i> Print Excel
                    </a>                 
                </div>
                <div class="actions" id="tombol-action" style="display:block; margin-right:5px;">
                    <a class="btn blue btn-sm" href="<?=site_url('administrator/'.$controller_dir.$controller.'/tambah_data')?>/<?=$paket->id_paket?>/<?=$kegiatan->id_kegiatan?>">
                        <i class="fa fa-plus"></i> Tambah Data
                    </a>
                </div>  
            </div>
            <div class="portlet-body form" id="page-content" style="display:none">
                <div class="table-responsive">
                    <table id="<?=$controller?>_table" class="table table-bordered table-striped table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th class="col-md-1">No</th>
                                <th class="col-md-2">Nama File</th>
                                <th class="col-md-3">Keterangan</th>
                                <th class="col-md-2">Path Unduh</th>
                                <th class="col-md-2">Kategori File</th>
                                <th class="col-md-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>                            
                        <?php
                          $loop = 1; 
                          $this->db->where('id_paket', $paket->id_paket);
                          foreach ($this->Content_m->select_db('erenstra_tr_file_support')->result() as $value ) {                        
                            $obj_kategorifile = $this->db->get_where('erenstra_re_kategorifile', array('id_kategorifile' => $value->id_kategorifile, 'deleted' => 0));
                            if($obj_kategorifile->num_rows() > 0) {
                              $val_nmkategorifile = $obj_kategorifile->row()->nm_kategorifile;
                            } else {
                              $val_nmkategorifile = 'Belum Dipilih';
                            }                      
                        ?>
                            <tr>
                              <td><?=$loop?></td>
                              <td><?=$value->nm_file?></td>
                              <td><?=$value->keterangan?></td>
                              <td><?=$value->path_unduh?></td>
                              <td><?=$val_nmkategorifile?></td>
                              <td>
                                <?php $unduh = anchor('administrator/data_renstra/file_support/download/'.$value->id_file_support, "<i class='fa fa-download'></i>",  array('class'=>"btn-xs btn-warning", 'data-toggle'=>"m-tooltip", 'title'=>'Unduh')); ?>
                                <?php echo $unduh; ?>
                                <?php $edit = anchor('administrator/data_renstra/file_support/edit_data/'.$paket->id_paket.'/'.$kegiatan->id_kegiatan.'/'.$value->id_file_support, "<span class='glyphicon glyphicon-edit' aria-hidden='true'></span>",  array('class'=>"tooltips btn-xs btn-warning", 'data-toggle'=>"m-tooltip", 'title'=>'Edit')); ?>
                                <?php echo $edit; ?>
                                <?php $delete = '<a class="tooltips btn-xs btn-danger" data-toggle="m-tooltip" data-placement="top" title="Hapus" onclick="viewHapusData(\''.$value->id_file_support.'\',\''.$value->nm_file.'\')" style="cursor:pointer"><i class=\'fa fa-times\'></i></a>'; ?>                                         
                                <?php echo $delete; ?>
                              </td>
                            </tr>
                        <?php 
                            $loop++;
                          } 
                        ?>                                                       
                        </tbody>
                    </table>
                </div>
            </div>
            <?php $this->load->view('administrator/include/loading');?>
        </div>
    </div>
</div>
<script>
  $(document).ready( function () {
    $('#<?=$controller?>_table').DataTable({
      "language": {
            "url": "<?=base_url('media/assets/global/plugins/datatables/media/js')?>/indonesian.json"
        },
      "columnDefs": [
        {"className": "text-center", "targets": ['_all']},
        {
          "targets": -1,
          "bSortable": false
        }
      ],
      "fnInitComplete": function(oSettings, json) {
        $('.dataTables_processing').css('display','none');
        $( "#loading-content" ).fadeOut( "fast", function() {
          $( "#page-content" ).fadeIn("fast");
          $( "#info-content" ).fadeIn("fast");
          $( "#tombol-action" ).fadeIn("fast");
        });
      }
    });
  });
</script>
<?php $this->load->view('administrator/script/hapus_data');?>