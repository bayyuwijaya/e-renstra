<div class="row" id="portlet-content">
    <div class="col-md-12">
        <div class="portlet light" style="position:relative">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-bar-chart"></i><?=$judul?>
                </div>
                <div class="actions" id="tombol-action" style="display:block; margin-left:5px;">
                    <a class="btn blue btn-sm" href="<?=site_url('administrator/data_renstra/rencana/print_excel/'.$paket->id_paket)?>">
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
                                <th class="col-md-2">Sub Komponen</th>
                                <th class="col-md-2">Target Output</th>
                                <th class="col-md-2">Satuan Output</th>
                                <th class="col-md-2">Target Outcome</th>
                                <th class="col-md-2">Satuan Outcome</th>                               
                                <th class="col-md-2">Anggaran</th>
                                <th class="col-md-1">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>                            
                        <?php 
                          $this->db->where('id_paket', $paket->id_paket);
                          foreach ($this->Content_m->select_db('erenstra_tr_rencana_pelaksanaan')->result() as $value ) { 
                            
                            $obj_satuanoutput = $this->db->get_where('erenstra_re_satuan', array('id_satuan' => $value->output_satuan));
                            if($obj_satuanoutput->num_rows() > 0) {
                              $val_nmsatuanoutput = $obj_satuanoutput->row()->nm_satuan;
                            } else {
                              $val_nmsatuanoutput = 'Belum Dipilih';
                            } 

                            $obj_satuanoutcome = $this->db->get_where('erenstra_re_satuan', array('id_satuan' => $value->outcome_satuan));
                            if($obj_satuanoutcome->num_rows() > 0) {
                              $val_nmsatuanoutcome = $obj_satuanoutcome->row()->nm_satuan;
                            } else {
                              $val_nmsatuanoutcome = 'Belum Dipilih';
                            } 
                        ?>
                            <tr>
                              <td><?=$value->sub_komponen?></td>
                              <td>
                                <?php
                                  $obj_output_target = $value->output_target; 
                                  if(preg_match('/^\d+\.\d+$/', $obj_output_target)) {
                                      echo $obj_output_target;
                                  } else {
                                      echo $obj_output_target.'.00';
                                  }
                                ?>
                              </td>
                              <td><?=$val_nmsatuanoutput?></td>
                              <td>
                                <?php
                                  $obj_outcome_target = $value->outcome_target; 
                                  if(preg_match('/^\d+\.\d+$/', $obj_outcome_target)) {
                                      echo $obj_outcome_target;
                                  } else {
                                      echo $obj_outcome_target.'.00';
                                  }
                                ?>
                              </td>
                              <td><?=$val_nmsatuanoutcome?></td>
                              <td><?= $this->Content_m->currency($value->anggaran); ?></td>
                              <td>
                                <?php $edit = anchor('administrator/data_renstra/rencana/edit_data/'.$paket->id_paket.'/'.$kegiatan->id_kegiatan.'/'.$value->id_rencana, "<span class='glyphicon glyphicon-edit' aria-hidden='true'></span>",  array('class'=>"tooltips btn-xs btn-warning", 'data-toggle'=>"m-tooltip", 'title'=>'Edit')); ?>
                                <?php echo $edit; ?>
                                <?php $delete = '<a class="tooltips btn-xs btn-danger" data-toggle="m-tooltip" data-placement="top" title="Hapus" onclick="viewHapusData(\''.$value->id_rencana.'\',\''.$value->sub_komponen.'\')" style="cursor:pointer"><i class=\'fa fa-times\'></i></a>'; ?>                                         
                                <?php echo $delete; ?>
                              </td>
                            </tr>
                        <?php 
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