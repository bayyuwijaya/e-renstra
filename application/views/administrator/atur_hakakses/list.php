<div class="row" id="portlet-content">
    <div class="col-md-12">
        <div class="portlet light" style="position:relative">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-unlock"></i>Hak Akses Pegawai
                </div>               
            </div>
            <div class="portlet-body" id="page-content">
                <div class="table-responsive">
                     <table id="myTable" class="table table-bordered table-striped table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <td class="col-md-1">No</td>
                                <td class="col-md-4">Nama</td>
                                <td class="col-md-1">Aktifitas</td>
                                <td class="col-md-2">Level</td>
                                <td class="col-md-2">Jumlah Hak Akses</td>
                                <td class="col-md-2">Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(in_array(1, $this->session->userdata('id_global_hakakses'))) { ?>
                            <?php $query = $this->Content_m->get_all_akun_non_admin();?>
                            <?php } else { ?>
                            <?php $query = $this->Content_m->get_akun_non_admin($this->session->userdata('userid'))?>
                            <?php } ?>
                            <?php 
                              $i=1; foreach ($query->result() as $key) { ?>
                            <tr>
                                <td><?=$i?></td>
                                <td><?=$key->nm_sdm?></td>
                                <td>Pegawai</td>
                                <td>
                                  <?php 
                                    $global_user = $this->Content_m->get_row_custom('global_user','id_user',$key->id_sdm);
                                      if(count($global_user) > 0) {
                                        $global_user_hakakses = $this->Content_m->select_db('global_user_hakakses','id_global_user', $global_user->id_global_user)->row();
                                        $global_hakakses = $this->Content_m->select_db('global_hakakses', 'id_global_hakakses', $global_user_hakakses->id_global_hakakses)->row();  
                                         if(count($global_hakakses) > 0) { 
                                            echo $global_hakakses->jenis_hakakses;
                                         } else { 
                                            echo "-";
                                         }   
                                      } else {
                                        echo "-";
                                      }
                                  ?>
                                </td>
                                <td>
                                    <?php $global_user = $this->Content_m->get_row_custom('global_user','id_user',$key->id_sdm); ?>
                                    <?php $id_global_user = 0; ?>
                                    <?php if(count($global_user) > 0) { ?>
                                        <?php $id_global_user = $global_user->id_global_user?>
                                        <!-- <a href=" //echo site_url()?>/administrator/setting/atur_hakakses/lihat_hakakses/$global_user->id_global_user?>" style="color:blue; text-decoration:underline"> -->
                                          <?=count($this->Content_m->select_db('global_user_hakakses','id_global_user', $global_user->id_global_user )->result())?>
                                        <!-- </a> -->
                                    <?php } else { ?>
                                        -
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if(count($global_user) != 0) { ?>
                                    <a style="text-decoration:underline; color:blue;" href="<?php echo site_url()?>/administrator/setting/atur_hakakses/atur_akun/<?=$key->id_sdm?>/staff">
                                      Edit
                                    </a>&nbsp;
                                    <?php } ?>
                                    <?php if (in_array(1, $this->session->userdata('id_global_hakakses'))) { ?>
                                    <a style="text-decoration:underline; color:blue;" href="<?php echo site_url()?>/administrator/setting/atur_hakakses/add_prefillage/<?=$id_global_user?>/<?=$key->id_sdm?>">
                                      Update Prefilage
                                    </a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php $i++; } ?>     
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript" language="JavaScript">
  function konfirmasi() {
    tanya = confirm("Anda Yakin Akan Menghapus Data ?");
    if (tanya == true) return true;
    else return false;
  }

  $(document).ready(function() {
    $("#myTable,#myTable2, #myTable3").dataTable({
        aaSorting: [[0, 'asc']],
        bPaginate: true,
        bFilter: true,
        bInfo: false,
        bSortable: true,
        bRetrieve: true,
        aoColumnDefs: [         
          { "aTargets": [ 4 ], "bSortable": false }
        ]
    }); 
  });

</script>




