<div class="row" id="icon_data" style="display:none">
  <div class="col-md-12">
    <div class="row">

      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-light blue-soft" href="<?=site_url('administrator/laporan/export_kategori')?>">
        <div class="visual">
          <i class="fa fa-file-text"></i>
        </div>
        <div class="details">
          <div class="number">
            <?php $this->db->where('deleted','0'); ?>
            <?php echo $this->db->get('erenstra_tr_kategori')->num_rows(); ?>
          </div>
          <div class="desc">
            Kategori
          </div>
        </div>
        </a>
      </div>

      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-light red-soft" href="<?=site_url('administrator/laporan/export_kegiatan')?>">
        <div class="visual">
          <i class="fa fa-file-text"></i>
        </div>
        <div class="details">
          <div class="number">
            <?php $this->db->where('deleted','0'); ?>
            <?php echo $this->db->get('erenstra_tr_kegiatan')->num_rows(); ?>
          </div>
          <div class="desc">
            Kegiatan
          </div>
        </div>
        </a>
      </div>

      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-light green-soft" href="<?=site_url('administrator/laporan/export_paket')?>">
        <div class="visual">
          <i class="fa fa-file-text"></i>
        </div>
        <div class="details">
          <div class="number">
              <?php $this->db->where('deleted','0'); ?>
              <?php echo $this->db->get('erenstra_tr_paket')->num_rows(); ?>
          </div>
          <div class="desc">
              Paket
          </div>
        </div>
        </a>
      </div>
      
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-light purple-soft" href="<?=site_url('administrator/laporan/export_subpaket')?>">
        <div class="visual">
          <i class="fa fa-file-text"></i>
        </div>
        <div class="details">
          <div class="number">
              <?php                
                $this->db->select('*');
                $this->db->from('erenstra_tr_lokasi');
                $this->db->where('deleted', 0);
                $count_lokasi = $this->db->get()->num_rows();
                
                $this->db->select('*');
                $this->db->from('erenstra_tr_indikator');
                $this->db->where('deleted', 0);
                $count_indikator = $this->db->get()->num_rows();

                $this->db->select('*');
                $this->db->from('erenstra_tr_rencana_pelaksanaan');
                $this->db->where('deleted', 0);
                $count_rencana = $this->db->get()->num_rows();

                $this->db->select('*');
                $this->db->from('erenstra_tr_file_support');
                $this->db->where('deleted', 0);
                $count_file = $this->db->get()->num_rows();

                $count_all = $count_lokasi+$count_indikator+$count_rencana+$count_file;
                echo $count_all;
              ?>
          </div>
          <div class="desc">
              Sub Paket
          </div>
        </div>
        </a>
      </div>
    
    </div>
  </div>
</div>

<!-- 
    Tabel Daftar Data Export
-->

<div class="row" id="portlet-content">
    <div class="col-md-12">
        <div class="portlet light" style="position:relative">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-user"></i>Data <?=$judul?>
                </div>
                <div class="actions" id="tombol-action" style="display:block">
                    <a class="btn blue btn-sm" onclick="goToURL_export(); return false;" href="javascript:;">
                        <i class="fa fa-print"></i> Print Excel
                    </a>                 
                </div>           
            </div>
            <div class="portlet-body" id="page-content" style="display:block">
                <div class="table-scrollable" style="border:0px;">
                    <table id="<?=$controller?>_table" class="table table-bordered table-hover datatable">
                        <thead>
                            <tr>
                                <th class="text-center" style="min-width:50px;">No</th>
                                <th class="text-center" style="min-width:150px;">Kategori</th>
                                <th class="text-center" style="min-width:150px;">Kode Kegiatan</th>
                                <th class="text-center" style="min-width:450px;">Kegiatan</th>
                                <th class="text-center" style="min-width:450px;">Paket Pekerjaan</th>
                                <th class="text-center" style="min-width:150px;">Tahun</th>
                                <th class="text-center" style="min-width:150px;">Anggaran Kegiatan</th>
                                <th class="text-center" style="min-width:150px;">Skala Prioritas</th>
                                <th class="text-center" style="min-width:150px;">Target Output</th>
                                <th class="text-center" style="min-width:150px;">Satuan Output</th>
                                <th class="text-center" style="min-width:150px;">Target Outcome</th>
                                <th class="text-center" style="min-width:150px;">Satuan Outcome</th>
                                <th class="text-center" style="min-width:150px;">X (Latitude)</th>
                                <th class="text-center" style="min-width:150px;">Y (Longitude)</th>
                                <th class="text-center" style="min-width:150px;">Kabupaten / Kota</th>
                                <th class="text-center" style="min-width:150px;">Kecamatan</th>
                                <th class="text-center" style="min-width:150px;">Desa</th>
                                <th class="text-center" style="min-width:150px;">Indikator 1</th>                             
                                <th class="text-center" style="min-width:150px;">Indikator 2</th>
                                <th class="text-center" style="min-width:150px;">Indikator 3</th>
                                <th class="text-center" style="min-width:150px;">Indikator 4</th>
                                <th class="text-center" style="min-width:150px;">Indikator 5</th>
                                <th class="text-center" style="min-width:150px;">Indikator 6</th>
                                <th class="text-center" style="min-width:150px;">Indikator 7</th>
                                <th class="text-center" style="min-width:150px;">Indikator 8</th>
                                <th class="text-center" style="min-width:150px;">Indikator 9</th>
                                <th class="text-center" style="min-width:150px;">Indikator 10</th>
                                <th class="text-center" style="min-width:150px;">Indikator 11</th>
                                <th class="text-center" style="min-width:150px;">Dokumen Desain</th>
                                <th class="text-center" style="min-width:150px;">Dokumen Lingkungan</th>
                                <th class="text-center" style="min-width:150px;">Surat Usulan</th>
                                <th class="text-center" style="min-width:150px;">Dokumentasi Lokasi </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                          $i = 1;                       
                          
                          $this->db->select('*');
                          $this->db->from('erenstra_tr_kategori kat');
                          $this->db->join('erenstra_re_nmkegiatan re_keg', 're_keg.id_kategori = kat.id_kategori ', 'left');
                          $this->db->join('erenstra_tr_kegiatan tr_keg', 'tr_keg.id_nmkegiatan = re_keg.id_nmkegiatan ', 'left');
                          $this->db->join('erenstra_tr_paket pkt', 'pkt.id_kegiatan = tr_keg.id_kegiatan', 'left');
                          $this->db->join('erenstra_tr_tahun thn', 'thn.id_tahun = pkt.id_tahun and thn.deleted="0"', 'left');
                          $this->db->join('erenstra_tr_rencana_pelaksanaan ren', 'ren.id_paket = pkt.id_paket and ren.deleted="0"', 'left');
                          $this->db->join('erenstra_tr_lokasi lok', 'lok.id_paket = pkt.id_paket and lok.deleted="0"', 'left');           
                          
                          $this->db->where('kat.deleted', 0);
                          $this->db->where('re_keg.deleted', 0);  
                          $this->db->where('tr_keg.deleted', 0);
                          $this->db->where('pkt.deleted', 0);

                          $this->db->order_by('kat.id_kategori', 'asc');                                                                                         
                          $active_record = $this->db->get(); 
                          
                          foreach ($active_record->result() as $key) { 
                        ?>
                          <tr>
                              <td class="text-center">
                                <?=$i;?>
                              </td>
                              <td class="text-center">
                                <?=$key->nm_kategori?>
                              </td>
                              <td class="text-center">
                                <?php
                                  echo substr($key->nm_kegiatan, 0, 4);
                                ?>
                              </td>
                              <td class="text-center">
                                <?php
                                  echo substr($key->nm_kegiatan, 7, 255);
                                ?>
                              </td>
                              <td class="text-center">
                                <?php echo $key->nm_paket?>                             
                              </td>
                              <td class="text-center">
                                <?php echo $key->nm_tahun?>   
                              </td>
                              <td class="text-center">
                                <?php echo $this->Content_m->currency($key->anggaran_kegiatan);?>
                              </td>
                              <td class="text-center">
                                <?php 
                                  $nilai = 0;
                                  $this->db->where('id_paket', $key->id_paket);
                                  $this->db->where('id_kegiatan', $key->id_kegiatan);
                                  $this->db->where('deleted', '0');
                                  foreach ($this->db->get('erenstra_tr_indikator')->result() as $val) {
                                    $subnilai = $this->Content_m->get_value('erenstra_re_indikator', 'id_indikator', $val->id_indikator, 'bobot');
                                    $nilai = $nilai + $subnilai;                                     
                                  }
                                  $persen = substr($nilai * 100, 0, 4);
                                  echo $persen." %";                                                                  
                                ?>
                              </td>
                              <td class="text-center">
                                <?php                                  
                                  if($key->output_target != "") {
                                    $obj_output_target = $key->output_target; 
                                    if(preg_match('/^\d+\.\d+$/', $obj_output_target)) {
                                        echo $obj_output_target;
                                    } else {
                                        echo $obj_output_target.'.00';
                                    }
                                  } else {
                                    echo "<span class='glyphicon glyphicon-minus' aria-hidden='true'></span>";
                                  }
                                ?>
                              </td>
                              <td class="text-center">
                                <?php
                                  if(!empty($key->output_satuan)) {
                                    $this->db->where('id_satuan', $key->output_satuan);
                                    foreach ($this->Content_m->select_db('erenstra_re_satuan')->result() as $keyb) {
                                        echo $keyb->nm_satuan;
                                    }
                                  } else {
                                    echo "<span class='glyphicon glyphicon-minus' aria-hidden='true'></span>";
                                  }                                 
                                ?>
                              </td>
                              <td class="text-center">
                                <?php
                                  if($key->outcome_target != "") {
                                    $obj_outcome_target = $key->outcome_target; 
                                    if(preg_match('/^\d+\.\d+$/', $obj_outcome_target)) {
                                        echo $obj_outcome_target;
                                    } else {
                                        echo $obj_outcome_target.'.00';
                                    }
                                  } else {
                                    echo "<span class='glyphicon glyphicon-minus' aria-hidden='true'></span>";
                                  }
                                ?>
                              </td>
                              <td class="text-center">
                                <?php
                                  if(!empty($key->outcome_satuan)) {
                                    $this->db->where('id_satuan', $key->outcome_satuan);
                                    foreach ($this->Content_m->select_db('erenstra_re_satuan')->result() as $keyc) {
                                        echo $keyc->nm_satuan;
                                    }
                                  } else {
                                    echo "<span class='glyphicon glyphicon-minus' aria-hidden='true'></span>";
                                  }  
                                ?>
                              </td>
                              <td class="text-center">
                                <?php
                                 echo $key->latitude
                                ?>
                              </td>
                              <td class="text-center">
                                <?php echo $key->longitude?>
                              </td>                
                              <td class="text-center">
                                <?php echo $key->kab_kota?>
                              </td>              
                              <td class="text-center">
                                <?php echo $key->kecamatan?>
                              </td>
                              <td class="text-center">
                                <?php echo $key->desa?>
                              </td>
                              <?php 
                                $this->db->where('id_paket', $key->id_paket);
                                $this->db->where('id_kegiatan', $key->id_kegiatan);
                                $this->db->where('deleted', '0');
                                foreach ($this->db->get('erenstra_tr_indikator')->result() as $val) {  
                                  $selected[] = $val->id_indikator;    
                                  $arrlength = count($selected);                              
                                  for($x = 0; $x < $arrlength; $x++) {
                                    $result = $selected[$x];
                                  }                                                               
                                }   
                              ?>
                              <td class="text-center">
                                <?php
                                  if(in_array("idt-1", $result)) {
                                    echo "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>";
                                  } else {
                                    echo "<span class='glyphicon glyphicon-minus' aria-hidden='true'></span>";
                                  }
                                ?>
                              </td>
                              <td class="text-center">
                                <?php
                                  if(in_array("idt-2", $result)) {
                                    echo "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>";
                                  } else {
                                    echo "<span class='glyphicon glyphicon-minus' aria-hidden='true'></span>";
                                  }
                                ?>
                              </td>
                              <td class="text-center">
                                <?php
                                  if(in_array("idt-3", $result)) {
                                    echo "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>";
                                  } else {
                                    echo "<span class='glyphicon glyphicon-minus' aria-hidden='true'></span>";
                                  }
                                ?>
                              </td>
                              <td class="text-center">
                                <?php
                                  if(in_array("idt-4", $result)) {
                                    echo "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>";
                                  } else {
                                    echo "<span class='glyphicon glyphicon-minus' aria-hidden='true'></span>";
                                  }
                                ?>
                              </td>
                              <td class="text-center">
                                <?php
                                  if(in_array("idt-5", $result)) {
                                    echo "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>";
                                  } else {
                                    echo "<span class='glyphicon glyphicon-minus' aria-hidden='true'></span>";
                                  }
                                ?>
                              </td>

                              <td class="text-center">
                                <?php 
                                  if(in_array("idt-6", $result)) {
                                    echo "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>";
                                  } else {
                                    echo "<span class='glyphicon glyphicon-minus' aria-hidden='true'></span>";
                                  }
                                ?>
                              </td>
                              <td class="text-center">
                                <?php
                                  if(in_array("idt-7", $result)) {
                                    echo "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>";
                                  } else {
                                    echo "<span class='glyphicon glyphicon-minus' aria-hidden='true'></span>";
                                  }
                                ?>
                              </td>
                              <td class="text-center">
                                <?php
                                  if(in_array("idt-8", $result)) {
                                    echo "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>";
                                  } else {
                                    echo "<span class='glyphicon glyphicon-minus' aria-hidden='true'></span>";
                                  }
                                ?>
                              </td>
                              <td class="text-center">
                                <?php
                                  if(in_array("idt-9", $result)) {
                                    echo "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>";
                                  } else {
                                    echo "<span class='glyphicon glyphicon-minus' aria-hidden='true'></span>";
                                  }
                                ?>
                              </td>
                              <td class="text-center">
                                <?php
                                  if(in_array("idt-10", $result)) {
                                    echo "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>";
                                  } else {
                                    echo "<span class='glyphicon glyphicon-minus' aria-hidden='true'></span>";
                                  }
                                ?>
                              </td>
                              <td class="text-center">
                                <?php
                                  if(in_array("idt-11", $result)) {
                                    echo "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>";
                                  } else {
                                    echo "<span class='glyphicon glyphicon-minus' aria-hidden='true'></span>";
                                  }
                                ?>
                              </td>
                              <td class="text-center">
                                <?php
                                  // if($key->id_kategorifile === "ktf-1") {
                                  //   echo "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>";
                                  // } else {
                                  //   echo "<span class='glyphicon glyphicon-minus' aria-hidden='true'></span>";
                                  // }
                                ?>
                              </td>
                              <td class="text-center">
                                <?php
                                  // if($key->id_kategorifile === "ktf-2") {
                                  //   echo "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>";
                                  // } else {
                                  //   echo "<span class='glyphicon glyphicon-minus' aria-hidden='true'></span>";
                                  // }
                                ?>
                              </td>
                              <td class="text-center">
                                <?php
                                  // if($key->id_kategorifile === "ktf-3") {
                                  //   echo "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>";
                                  // } else {
                                  //   echo "<span class='glyphicon glyphicon-minus' aria-hidden='true'></span>";
                                  // }
                                ?>
                              </td>
                              <td class="text-center">
                                <?php
                                  // if($key->id_kategorifile === "ktf-4") {
                                  //   echo "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>";
                                  // } else {
                                  //   echo "<span class='glyphicon glyphicon-minus' aria-hidden='true'></span>";
                                  // }
                                ?>
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

<link href="<?=base_url('media/js/remodal-1.0.6/src/remodal.css');?>" rel="stylesheet" type="text/css" />
<link href="<?=base_url('media/js/remodal-1.0.6/src/remodal-default-theme.css');?>" rel="stylesheet" type="text/css" />
<style type="text/css">
  .progressbar {
    height: 20px;
    background-color: #6CAA4F;
  }

  .progress { display: block; position:relative; width:100%; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }
  .bar { background-color: #B4F5B4; width:0%; height:20px; border-radius: 3px; }
  .percent { position:absolute; display:inline-block; top:3px; left:48%; }
</style>

<script type="text/javascript" src="<?=base_url('media/js/jquery.form.js');?>"></script>
<script type="text/javascript" src="<?=base_url('media/js/remodal-1.0.6/src/remodal.js');?>"></script>
<script type="text/javascript">
  function goToURL_ekstra() {
    $('[data-remodal-id = excel_dialog_ekstra]').remodal().open();
  }

  $(function() {     
    var bar = $('.bar');
    var percent = $('.percent');
    
    $('#form_upload_excel').ajaxForm({
      beforeSend: function() {
          var percentVal = '0%';
          bar.width(percentVal)
          percent.html(percentVal);
      },
      uploadProgress: function(event, position, total, percentComplete) {
          var percentVal = percentComplete + '%';
          bar.width(percentVal)
          percent.html(percentVal);
      },
      success: function() {
          var percentVal = '100%';
          bar.width(percentVal)
          percent.html(percentVal);
      },
      complete: function(xhr) {
          alert(xhr.responseText);
      }
    }); 
  });       
</script>

<div class="remodal" data-remodal-id="excel_dialog_ekstra">
  <button data-remodal-action="close" class="remodal-close"></button>
  <?=form_open_multipart(site_url('administrator/export/print_excel_field'), array("id" => "form_upload_excela","method"=>"post"));?>
    <span style="font-size:12px">
        *Pilih Nama Kolom yang akan di eksport ke Excel <br>
    </span>
    <br>
    <center>
      <!-- <input style="width:190px; border:1px solid silver; padding:10px; border-radius:5px" type="file" name="excel_file" accept=".xls,.xlsx" /> -->
      <div style="width:20%; float:left; margin:10px 10px 10px 10px;">
        <input type="checkbox" name="fieldExport[]" value="nama" style=" border:1px solid silver; padding:10px; border-radius:5px;"/> Nama
      </div>
      <div style="width:20%; float:left; margin:10px 10px 10px 10px;">
        <input type="checkbox" name="fieldExport[]" value="nrp" style=" border:1px solid silver; padding:10px; border-radius:5px;"/> NRP 
      </div>
      <div style="width:20%; float:left; margin:10px 10px 10px 10px;">
        <input type="checkbox" name="fieldExport[]" value="ttl" style=" border:1px solid silver; padding:10px; border-radius:5px;"/> TTL <br />
      </div>
      <div style="width:20%; float:left; margin:10px 10px 10px 10px;">
        <input type="checkbox" name="fieldExport[]" value="tmt_krj" style=" border:1px solid silver; padding:10px; border-radius:5px;"/> Tamat Kerja 
      </div>
      <div style="width:20%; float:left; margin:10px 10px 10px 10px;">
        <input type="checkbox" name="fieldExport[]" value="no_sk" style=" border:1px solid silver; padding:10px; border-radius:5px;"/> No SK 
      </div>
      <div style="width:20%; float:left; margin:10px 10px 10px 10px;">
        <input type="checkbox" name="fieldExport[]" value="alamat" style=" border:1px solid silver; padding:10px; border-radius:5px;"/> Alamat <br />
      </div>
      <div style="width:20%; float:left; margin:10px 10px 10px 10px;">
        <input type="checkbox" name="fieldExport[]" value="agama" style=" border:1px solid silver; padding:10px; border-radius:5px;"/> Agama 
      </div>
      <div style="width:20%; float:left; margin:10px 10px 10px 10px;">
        <input type="checkbox" name="fieldExport[]" value="diklat" style=" border:1px solid silver; padding:10px; border-radius:5px;"/> Diklat 
      </div>
      <div style="width:20%; float:left; margin:10px 10px 10px 10px;">
        <input type="checkbox" name="fieldExport[]" value="education" style=" border:1px solid silver; padding:10px; border-radius:5px;"/> Pendidikan Terakhir
      </div>
    <center>
    
    <br>
    <div style="width:100%; float:left; margin:10px 0px 10px 0px;">
      <span style="font-size:8px">
        *Pilih satu atau lebih Checkbox, lalu tekan "Export ke Excel" untuk proses membuat file Excel yang bisa di Download.<br>
      </span>
      <br>
      <button type="submit" style="padding:10px; border-radius: 5px"> Export <span style="font-weight:900"> ke excel </span></button>
    </div>
  <?=form_close();?>
    <!--
    <div class="progress">
      <div class="bar"></div>
      <div class="percent">0%</div>
  </div>
    -->
</div>

<script>
  $(document).ready(function() {

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
        $("#loading-content").fadeOut("fast", function() {
          $( "#page-content" ).fadeIn("fast");
          $( "#info-content" ).fadeIn("fast");
          $( "#tombol-action" ).fadeIn("fast");
        });
      }
    });

    $('#icon_data').show('slow');
  
  });
</script>