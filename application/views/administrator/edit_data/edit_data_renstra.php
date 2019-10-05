<div class="row" id="info-content" style="display:none">
    <div class="col-md-12">
        <div class="portlet box blue" style="position:relative">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-tasks"></i> Data Program
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal form-bordered form-row-stripped" role="form">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="form-control-static col-md-2">Nama Kegiatan</label>
                            <p class="form-control-static col-md-10">
                                : DUKUNGAN MANAJEMEN BBWS/BWS | UNIT ORGANISASI: BWS BALI - PENIDA      
                            </p>
                        </div>
                        <div class="form-group">
                            <label class="form-control-static col-md-2">Provinsi</label>                            
                            <p class="form-control-static col-md-10">
                                : Bali
                            </p>                            
                        </div>
                        <div class="form-group">
                            <label class="form-control-static col-md-2">Kabupaten/Kota</label>                            
                            <p class="form-control-static col-md-10">
                                : Kota Denpasar
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
                    <i class="fa fa-list-ol"></i><?=$judul?>
                </div>






                <div class="actions" id="tombol-action" style="display:block; margin-left:5px;">
                    <a class="btn blue btn-sm" href="<?=site_url('administrator/mhs_dir/data_pasangan/print_excel/'.$mahasiswa->id_sdm)?>">
                        <i class="fa fa-print"></i> Print Excel
                    </a>                 
                </div>

                <div class="actions" id="tombol-action" style="display:block; margin-right:5px;">
                    <a class="btn blue btn-sm" href="<?=site_url('administrator/'.$controller_dir.$controller.'/tambah_data')?>/<?=$mahasiswa->id_sdm?>">
                        <i class="fa fa-plus"></i> Tambah Data
                    </a>
                </div>  

              <div style="padding-right: 15px;  " class="actions" id="tombol-action" >
                    
             
                  <select>
                    <option value="2018">Pilih Tahun</option>
                    <option value="2019">2019</option>
                    <option value="2021">2020</option>
                    <option value="2022">2021</option>
                  </select>

              </div>





            </div>
            <div class="portlet-body form" id="page-content" style="display:none">
                <div class="table-responsive">
                    <table id="<?=$controller?>_table" class="table table-bordered table-striped table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Paket Pekerjaan</th>
                                <th>Tahun</th>
                                <th>Total Nilai Prioritas</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>                            

                            <tr>
                              <td>A</td>
                              <td>Unit Desain BWS Bali-Penida</td>
                              <td>2020</td>
                              <td>100%</td>
                              

                              <td>
                                <a href="<?=site_url()?>/administrator/mhs_dir/data_pasangan/edit_data/<?=$mahasiswa->id_sdm?>/"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                <a data-toggle="tooltip" data-placement="top" title="Hapus" href="<?=site_url()?>/administrator/mhs_dir/data_pasangan/del_data/
                                    " onclick="return confirm('Are you sure?')" style="cursor:pointer">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </a>
                              </td>
                            </tr>

                            <tr>
                              <td>A</td>
                              <td>Kegiatan Penyusunan Program dan Rencana Anggaran</td>
                              <td>2020</td>
                              <td>60%</td>

                              <td>
                                <a href="<?=site_url()?>/administrator/mhs_dir/data_pasangan/edit_data/<?=$mahasiswa->id_sdm?>/"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                <a data-toggle="tooltip" data-placement="top" title="Hapus" href="<?=site_url()?>/administrator/mhs_dir/data_pasangan/del_data/
                                    " onclick="return confirm('Are you sure?')" style="cursor:pointer">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </a>
                              </td>
                            </tr>

                            <tr>
                              <td>A</td>
                              <td>Sistem Manajemen Mutu BWS Bali-Penida</td>
                              <td>2020</td>
                              <td>20%</td>

                              <td>
                                <a href="<?=site_url()?>/administrator/mhs_dir/data_pasangan/edit_data/<?=$mahasiswa->id_sdm?>/"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                <a data-toggle="tooltip" data-placement="top" title="Hapus" href="<?=site_url()?>/administrator/mhs_dir/data_pasangan/del_data/
                                    " onclick="return confirm('Are you sure?')" style="cursor:pointer">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </a>
                              </td>
                            </tr>

                            <tr>
                              <td>A</td>
                              <td>Survey, Pengukuran dan Koordinasi</td>
                              <td>2020</td>
                              <td>10%</td>

                              <td>
                                <a href="<?=site_url()?>/administrator/mhs_dir/data_pasangan/edit_data/<?=$mahasiswa->id_sdm?>/"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                <a data-toggle="tooltip" data-placement="top" title="Hapus" href="<?=site_url()?>/administrator/mhs_dir/data_pasangan/del_data/
                                    " onclick="return confirm('Are you sure?')" style="cursor:pointer">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </a>
                              </td>
                            </tr>
                       
                       
                                                                             
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