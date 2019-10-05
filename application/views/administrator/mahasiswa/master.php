<div class="row" id="portlet-content">
    <div class="col-md-12">
        <div class="portlet light" style="position:relative">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-database"></i>Data <?=$judul?>
                </div>
                <div class="actions" id="tombol-action" style="display:nonee">                    
                    <a class="btn blue btn-sm" href="<?=site_url('administrator/'.$controller_dir.$controller.'/tambah_data')?>">
                        <i class="fa fa-plus"></i> Tambah Data
                    </a>
                </div>
            </div>
            <div class="portlet-body" id="page-content" style="display:nonee">
                <div class="table-responsive">
                    <table id="<?=$controller?>_table" class="table table-bordered table-striped table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">KODE</th>
                                <th class="text-center"><center><div style="width: 500px" >SATKER/ PROGRAM/ KEGIATAN/ OUTPUT/ KOMPONEN/ SUB KOMPONEN</div></center></th>

                                <th class="text-center">PROVINSI</th>
                                <th class="text-center"><div style="width: 200px">KABUPATEN / KOTA</div></th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-center">5030</td>
                                <td><center>DUKUNGAN MANAJEMEN BBWS/BWS | UNIT ORGANISASI: BWS BALI - PENIDA      </center></td>

                                <td class="text-center">Bali</td>
                                <td ><center>Kota Denpasar</center></td>
                                <td class="text-center">
                                    <a data-toggle="tooltip" data-placement="top" title="Ubah" href="<?=site_url()?>/administrator/mhs_dir/pegawai/edit_data_renstra/01fcfddd-9bd2-11e9-bfba-02000070106c"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> 
                                    <br>
                                    <a data-toggle="tooltip" data-placement="top" title="Hapus" href="<?=site_url()?>/administrator/mhs_dir/pegawai/del_data" onclick="return confirm('Are you sure?')" style="cursor:pointer"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                    <br>
                                    <a data-toggle="tooltip" data-placement="top" title="Print" href="<?=site_url()?>/administrator/mhs_dir/pegawai/excel_data_pejabat"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></a> 
                                </td>
                            </tr>

                            <tr>
                                <td class="text-center">2</td>
                                <td class="text-center">5036</td>
                                <td><center>PEMBANGUNAN DAN REHABILITASI JARINGAN IRIGASI PERMUKAAN, RAWA DAN TAMBAK | UNIT ORGANISASI: BWS BALI - PENIDA      </center></td>

                                <td class="text-center">Bali</td>
                                <td ><center>Kota Denpasar</center></td>
                                <td class="text-center">
                                    <a data-toggle="tooltip" data-placement="top" title="Ubah" href="<?=site_url()?>/administrator/mhs_dir/pegawai/edit_data_renstra/01fcfddd-9bd2-11e9-bfba-02000070106c"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> 
                                    <br>
                                    <a data-toggle="tooltip" data-placement="top" title="Hapus" href="<?=site_url()?>/administrator/mhs_dir/pegawai/del_data" onclick="return confirm('Are you sure?')" style="cursor:pointer"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                    <br>
                                    <a data-toggle="tooltip" data-placement="top" title="Print" href="<?=site_url()?>/administrator/mhs_dir/pegawai/excel_data_pejabat"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></a> 
                                </td>
                            </tr>

                            <tr>
                                <td class="text-center">3</td>
                                <td class="text-center">5037</td>
                                <td><center>PENGENDALIAN BANJIR, LAHAR GUNUNG BERAPI, DAN PENGAMANAN PANTAI | UNIT ORGANISASI: BWS BALI - PENIDA          </center></td>

                                <td class="text-center">Bali</td>
                                <td ><center>Kota Denpasar</center></td>
                                <td class="text-center">
                                    <a data-toggle="tooltip" data-placement="top" title="Ubah" href="<?=site_url()?>/administrator/mhs_dir/pegawai/edit_data_renstra/01fcfddd-9bd2-11e9-bfba-02000070106c"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> 
                                    <br>
                                    <a data-toggle="tooltip" data-placement="top" title="Hapus" href="<?=site_url()?>/administrator/mhs_dir/pegawai/del_data" onclick="return confirm('Are you sure?')" style="cursor:pointer"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                    <br>
                                    <a data-toggle="tooltip" data-placement="top" title="Print" href="<?=site_url()?>/administrator/mhs_dir/pegawai/excel_data_pejabat"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></a> 
                                </td>
                            </tr>
                            
                        </tbody>
                        <tfoot>
                            <tr>
                               <th class="text-center">No</th>
                               <th class="text-center">KODE</th>
                                <th style="width: 100%" class="text-center">SATKER/ PROGRAM/ KEGIATAN/ OUTPUT/ KOMPONEN/ SUB KOMPONEN</th>

                                <th class="text-center">PROVINSI</th>
                                <th style="width: 100%" class="text-center">KABUPATEN / KOTA</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            
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
