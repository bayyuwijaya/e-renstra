<div class="row" id="info-content" style="display:none">
    <div class="col-md-12">
        <div class="portlet box blue" style="position:relative">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-user"></i> Informasi Pegawai
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal form-bordered form-row-stripped" role="form">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="form-control-static col-md-2">Nama</label>
                            <p class="form-control-static col-md-10">
                                : <?=$mahasiswa->nm_sdm?>
                            </p>
                        </div>
                        <div class="form-group">
                            <label class="form-control-static col-md-2">Tempat Lahir</label>                            
                            <p class="form-control-static col-md-10">
                                : <?=$mahasiswa->tmpt_lahir?>
                            </p>                            
                        </div>
                        <div class="form-group">
                            <label class="form-control-static col-md-2">Tanggal Lahir</label>                            
                            <p class="form-control-static col-md-10">
                                : <?php setlocale(LC_ALL, 'IND');echo strftime("%d %B %Y", strtotime($mahasiswa->tgl_lahir));?>
                            </p>                            
                        </div>
                        <div class="form-group">
                            <label class="form-control-static col-md-2">Jenis Kelamin</label>                            
                            <p class="form-control-static col-md-10">
                                : <?=$mahasiswa->jk=='L'?'Laki-laki':'Perempuan'?>
                            </p>                            
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row" id="portlet-content">
    <div class="col-md-12">
        <div class="portlet light" style="position:relative">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-graduation-cap"></i><?=$judul?>
                </div>
                <div class="actions" id="tombol-action" style="display:block; margin-left:5px;">
                    <a class="btn blue btn-sm" href="<?=site_url('administrator/mhs_dir/data_evaluasi/print_excel/'.$mahasiswa->id_sdm)?>">
                        <i class="fa fa-print"></i> Print Excel
                    </a>                 
                </div>
                <div class="actions" id="tombol-action" style="display:block; margin-left:5px;">
                    <a class="btn blue btn-sm" href="<?=site_url('administrator/'.$controller_dir.$controller.'/tambah_data')?>/<?=$mahasiswa->id_sdm?>">
                        <i class="fa fa-plus"></i> Tambah Data
                    </a>
                </div>
            </div>
            <div class="portlet-body form" id="page-content" style="display:none">
                <div class="table-responsive">
                    <table id="<?=$controller?>_table" class="table table-bordered table-striped table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Periode Penilaian</th>
                                <th>Rata" Aspek Teknis Pekerjaan</th>
                                <th>Rata" Aspek Non Teknis Pekerjaan</th>
                                <th>Rata" Aspek Kepribadian</th>
                                <th>Total</th>
                                <th>Klasifikasi Nilai</th>

                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php 

                            $this->db->where('id_sdm',$mahasiswa->id_sdm);
                            foreach ($this->Content_m->select_db('sispeg_tr_evaluasi')->result() as $key ) { ?>
                            <tr>
                              <td><?=$key->periode_penilaian?></td>
                              <td><?=$key->rata_rata_aspek_teknis_pekerjaan?></td>
                              <td><?=$key->rata_rata_aspek_non_teknis_pekerjaan?></td>
                              <td><?=$key->rata_rata_aspek_kepribadian?></td>
                              <td><?=$key->total_kinerja_keseluruhan?></td>
                              <td>
                                    
                                    <?php if($key->total_kinerja_keseluruhan >= 13 && $key->total_kinerja_keseluruhan <= 25){ ?>
                                              Buruk

                                    <?php }else if($key->total_kinerja_keseluruhan >= 26 && $key->total_kinerja_keseluruhan == 33 ){ ?>
                                       Cukup
                                    <?php }else if($key->total_kinerja_keseluruhan >= 34 && $key->total_kinerja_keseluruhan == 44 ){ ?>
                                        
                                         Baik
                                    <?php }else if($key->total_kinerja_keseluruhan >= 45 && $key->total_kinerja_keseluruhan == 52 ){ ?>
                                  
                                        Amat Baik
                                    <?php } ?>


                              </td>

                              <td>
                                <a href="<?=site_url()?>/administrator/mhs_dir/data_evaluasi/edit_data/<?=$mahasiswa->id_sdm?>/<?=$key->id_evaluasi?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                <a data-toggle="tooltip" data-placement="top" title="Hapus" href="<?=site_url()?>/administrator/mhs_dir/data_evaluasi/del_data/<?=$key->id_evaluasi?>" onclick="return confirm('Are you sure?')" style="cursor:pointer">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </a>
                              </td>
                            </tr>
                            <?php }?>
                            
                           
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