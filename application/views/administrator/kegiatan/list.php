<div class="row" id="portlet-content">
    <div class="col-md-12">
        <div class="portlet light" style="position:relative">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-book"></i>Data <?=$judul?>
                </div>
                <div class="actions" id="tombol-action" style="display:none">
                  <?php if(isset($id_kategori)) { ?>
                    <a class="btn blue btn-sm" href="<?=site_url('administrator/'.$controller_dir.$controller.'/tambah_data'.'/'.$id_kategori)?>">
                  <?php } else { ?>
                    <a class="btn blue btn-sm" href="<?=site_url('administrator/'.$controller_dir.$controller.'/tambah_data')?>">                    
                  <?php } ?> 
                      <i class="fa fa-plus"></i> Tambah Data
                    </a>
                </div>
            </div>
            <div class="portlet-body" id="page-content" style="display:none">
                <div class="table-responsive">
                    <table id="<?=$controller?>_table" class="table table-bordered table-striped table-hover" style="width:100%">
                    <thead>
                            <tr>
                              <th class="text-center">No</th>
                              <th class="text-center">Kategori</th>
                              <th class="text-center"><center>Satker/ Program/ Kegiatan/ Output/ Komponen/ Sub Komponen</center></th>
                              <th class="text-center">Provinsi</th>
                              <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php $i=1; foreach ($query->result() as $key) { ?>
                          <?php
                            $obj_nm_kegiatan = $this->db->get_where('erenstra_re_nmkegiatan', array('id_nmkegiatan' => $key->id_nmkegiatan, 'deleted' => 0));
                            if($obj_nm_kegiatan->num_rows() > 0) {
                              $val_nmkegiatan = $obj_nm_kegiatan->row()->nm_kegiatan;
                            } else {
                              $val_nmkegiatan = 'Nama Kegiatan Belum Dipilih';
                            }

                            $detail = anchor('administrator/data_renstra/paket/index/'.$key->id_kegiatan, "<span class='glyphicon glyphicon-folder-open' aria-hidden='true'></span>",  array('class'=>"tooltips btn-xs btn-primary", 'data-toggle'=>"m-tooltip", 'title'=>'Detail'));                        
                            $delete = '<a class="tooltips btn-xs btn-danger" data-toggle="m-tooltip" data-placement="top" title="Hapus" onclick="viewHapusData(\''.$key->id_kegiatan.'\',\''.$val_nmkegiatan.'\')" style="cursor:pointer"><i class=\'fa fa-times\'></i></a>';                       
                            if(isset($id_kategori)) {
                              $edit = anchor('administrator/data_renstra/kegiatan/edit_kegiatan/'.$key->id_kegiatan.'/'.$id_kategori, "<span class='glyphicon glyphicon-edit' aria-hidden='true'></span>",  array('class'=>"tooltips btn-xs btn-warning", 'data-toggle'=>"m-tooltip", 'title'=>'Edit'));
                            } else {
                              $edit = anchor('administrator/data_renstra/kegiatan/edit_kegiatan/'.$key->id_kegiatan, "<span class='glyphicon glyphicon-edit' aria-hidden='true'></span>",  array('class'=>"tooltips btn-xs btn-warning", 'data-toggle'=>"m-tooltip", 'title'=>'Edit'));
                            }

                            $obj_nm_kegiatan = $this->db->get_where('erenstra_re_nmkegiatan', array('id_nmkegiatan' => $key->id_nmkegiatan, 'deleted' => 0));
                            if($obj_nm_kegiatan->num_rows() > 0) {
                              $kategori = $obj_nm_kegiatan->row();
                              $obj_kategori = $this->db->get_where('erenstra_tr_kategori', array('id_kategori' => $kategori->id_kategori, 'deleted' => 0));
                              $val_kat = $obj_kategori->row()->nm_kategori;
                            } else {
                              $val_kat = 'Kategori Belum Dipilih';
                            }
                           
                          ?>  
                          <tr align="center">   
                            <td class="col-md-1"><?=$i;?></td>
                            <td class="col-md-2"><?=$val_kat ?></td>
                            <td class="col-md-5"><?=$val_nmkegiatan ?></td>
                            <td class="col-md-2"><?=$key->provinsi;?></td>
                            <td class="col-md-2">
                              <?=$detail; ?> 
                              <?=$edit; ?>
                              <?=$delete; ?>
                            </td>
                          </tr>
                        <?php $i++; } ?>                      
                        </tbody>  
                          <tfoot>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center"><center>Satker/ Program/ Kegiatan/ Output/ Komponen/ Sub Komponen</center></th>
                                <th class="text-center">Provinsi</th>
                                <th class="text-center" >Aksi</th>
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
     
        {"targets": [0],"bSortable": false}
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