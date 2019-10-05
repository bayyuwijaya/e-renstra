<div class="row" id="portlet-content">
    <div class="col-md-12">
        <div class="portlet light" style="position:relative">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-user"></i>Data <?=$judul?>
                </div>
                <div class="actions" id="tombol-action" style="display:nonee">
                    <a class="btn blue btn-sm" onclick="goToURL_ekstra(); return false;" href="javascript:;">
                        <i class="fa fa-print"></i> Print Excel
                    </a>                 
                </div>           
            </div>
            <div class="portlet-body" id="page-content" style="display:nonee">
                <div class="table-responsive">
                    <table id="<?=$controller?>_table" class="table table-bordered table-striped table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">NRP</th>
                                <th class="text-center">TTL</th>
                                <th class="text-center">TMT Kerja</th>
                                <th class="text-center">No SK</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Agama</th>
                                <th class="text-center">Diklat</th>
                                <th class="text-center">Pendidikan Terakhir</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i=1;
    
                            /*
                            $this->db->select('*');
                            $this->db->from('sispeg_tr_pegawai p');
                            $this->db->join('sispeg_tr_pegawai_jabatan pj','pj.id_sdm=p.id_sdm','left');
                            $this->db->join('sispeg_tr_pegawai_diklat pd','pd.id_sdm=p.id_sdm','left');
                            $this->db->join('sispeg_tr_pegawai_pt pt','p.id_sdm=pt.id_sdm','left');
                            $this->db->order_by('pj.added_by','desc');
                            $this->db->order_by('pj.added_by','desc');
                            $this->db->order_by('pt.show','desc');
                            $this->db->where('p.deleted','0');
                            $this->db->group_by('p.id_sdm');
                            */
                            
                            $this->db->select('*');
                            $this->db->from('sispeg_tr_pegawai p');
                            $this->db->where('deleted','0');
                            
                            $q = $this->db->get();
                       
                            foreach ($q->result() as $key) { ?>
                                <tr>

                                    <td class="text-center"><?=$i;$i++;?></td>
                                    <td class="text-center"><?=$key->nm_sdm?></td>
                                    <td class="text-center"><?=$key->nrp?></td>
                                    <td class="text-center"><?=$key->tmpt_lahir?> <?=$key->tgl_lahir?></td>
                                    <td class="text-center">
                                    
                                    <?php 
                                    $this->db->order_by('added_by','desc');
                                    $this->db->limit(1);
                                    $this->db->where('id_sdm',$key->id_sdm);
                                    foreach ($this->Content_m->select_db('sispeg_tr_pegawai_jabatan')->result() as $keyb ) {
                                        echo $keyb->tmt_kerja;
                                    }?>
                                    </td>
                                    <td class="text-center">
                                    <?php 
                                    $this->db->order_by('added_by','desc');
                                    $this->db->limit(1);
                                    $this->db->where('id_sdm',$key->id_sdm);
                                    foreach ($this->Content_m->select_db('sispeg_tr_pegawai_jabatan')->result() as $keyb ) {
                                        echo $keyb->no_sk;
                                    }?>
                                    </td>
                                    <td class="text-center"><?=$key->jln?></td>
                                    <td class="text-center"><?=$this->Content_m->get_value('pddikti_re_agama','id_agama',$key->id_agama,'nm_agama')?></td>
                                    <td class="text-center">
                                    <?php 
                                    $this->db->order_by('added_by','desc');
                                    $this->db->limit(1);
                                    $this->db->where('id_sdm',$key->id_sdm);
                                    foreach ($this->Content_m->select_db('sispeg_tr_pegawai_diklat')->result() as $keyb ) {
                                        echo $keyb->jenis_diklat;
                                    }?>
                                    </td>
                                    <td class="text-center">
                                    <?php 
                                    $this->db->order_by('show','desc');
                                    $this->db->where('id_sdm',$key->id_sdm);
                                    $this->db->limit(1);
                                    foreach ($this->Content_m->select_db('sispeg_tr_pegawai_pt')->result() as $keyb ) {
                                        echo $keyb->jenjang;
                                    }?>
                                    </td>
                                   
                                </tr>

                            <?php }?>
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
  });
</script>
