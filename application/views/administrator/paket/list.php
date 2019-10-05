<div class="row" id="info-content" style="display:none">
    <div class="col-md-12">
        <div class="portlet box blue" style="position:relative">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-tasks"></i> Data Kegiatan
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal form-bordered form-row-stripped" role="form">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="form-control-static col-md-2">Nama Kegiatan</label>
                            <p class="form-control-static col-md-10">
                                : <?=$re_nmkegiatan->nm_kegiatan; ?>      
                            </p>
                        </div>
                        <div class="form-group">
                            <label class="form-control-static col-md-2">Provinsi</label>                            
                            <p class="form-control-static col-md-10">
                                : <?=$kegiatan->provinsi; ?>
                            </p>                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bar Chart -->
<!-- <div class="row">
  <div class="col-md-12">
     BEGIN CHART PORTLET
    <div class="portlet light">
      <div class="portlet-title">
        <div class="caption">
          <i class="icon-bar-chart font-green-haze"></i>
          <span class="caption-subject bold uppercase font-green-haze"> Bar Charts</span>
          <span class="caption-helper">grafik total nilai prioritas pada paket</span>
        </div>
        <div class="tools">
          <a href="javascript:;" class="collapse">
          </a>
          <a href="#portlet-config" data-toggle="modal" class="config">
          </a>
          <a href="javascript:;" class="reload">
          </a>
          <a href="javascript:;" class="fullscreen">
          </a>
          <a href="javascript:;" class="remove">
          </a>
        </div>
      </div>
      <div class="portlet-body">
        <div id="chart_4" class="chart" style="height: 300px;">
        </div>
      </div>
    </div>
     END CHART PORTLET
  </div>
</div> -->

<div class="row" id="portlet-content">
    <div class="col-md-12">
        <div class="portlet light" style="position:relative">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-list-ol"></i><?=$judul?>
                </div>
                <div class="actions" id="tombol-action" style="display:block; margin-left:5px;">
                    <a class="btn blue btn-sm" href="<?=site_url('administrator/mhs_dir/data_pasangan/print_excel/'.$kegiatan->id_kegiatan)?>">
                        <i class="fa fa-print"></i> Print Excel
                    </a>                 
                </div>
                <div class="actions" id="tombol-action" style="display:block; margin-right:5px;">
                    <a class="btn blue btn-sm" href="<?=site_url('administrator/'.$controller_dir.$controller.'/tambah_data'.'/'.$kegiatan->id_kegiatan)?>">
                        <i class="fa fa-plus"></i> Tambah Data
                    </a>
                </div>  
              <div style="padding-right: 15px;" class="actions" id="tombol-action">
                <form action="<?=site_url('administrator/'.$controller_dir.$controller.'/select_tahun'.'/'.$kegiatan->id_kegiatan)?>" method="POST">           
                  <select name="re_tahun" onchange="this.form.submit();">
                    <option value="all">Semua Tahun</option>
                    <?php foreach($this->db->get_where('erenstra_tr_tahun', array('deleted'=>'0'))->result() as $key) { ?>
                      <option value="<?=$key->id_tahun?>" <?=$tahun==$key->id_tahun?'selected':''?>><?=$key->nm_tahun?></option>
                    <?php } ?>
                  </select>
                </form>
              </div>
            </div>
            <div class="portlet-body form" id="page-content" style="display:none">
                <div class="table-responsive">
                    <table id="<?=$controller?>_table" class="table table-bordered table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <!-- <th>Kode</th> -->
                                <th>Paket Pekerjaan</th>
                                <th>Tahun</th>
                                <th>Anggaran Kegiatan</th>
                                <th>Skala Prioritas</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>                               
                          <?php $i=1; foreach ($paket->result() as $val) { ?>
                            <?php
                              $detail = anchor('administrator/data_renstra/lokasi/index/'.$val->id_paket.'/'.$kegiatan->id_kegiatan, "<span class='glyphicon glyphicon-folder-open' aria-hidden='true'></span>",  array('class'=>"tooltips btn-xs btn-primary", 'data-toggle'=>"m-tooltip", 'title'=>'Detail'));                        
                              $delete = '<a class="tooltips btn-xs btn-danger" data-toggle="m-tooltip" data-placement="top" title="Hapus" onclick="viewHapusData(\''.$val->id_paket.'\',\''.$val->nm_paket.'\')" style="cursor:pointer"><i class=\'fa fa-times\'></i></a>';                       
                              $edit   = anchor('administrator/data_renstra/paket/edit_paket/'.$val->id_paket.'/'.$kegiatan->id_kegiatan, "<span class='glyphicon glyphicon-edit' aria-hidden='true'></span>",  array('class'=>"tooltips btn-xs btn-warning", 'data-toggle'=>"m-tooltip", 'title'=>'Edit'));
                              

                              if(isset($val->anggaran_kegiatan)) {
                                $anggaran_kegiatan = $this->Content_m->currency($val->anggaran_kegiatan);
                              } else {
                                $anggaran_kegiatan = 'Belum di Input';
                              }

                              $tahun = $this->db->get_where('erenstra_tr_tahun', array('id_tahun' => $val->id_tahun, 'deleted' => 0))->row();
                              if(isset($tahun->nm_tahun)) {
                                $val_tahun = $tahun->nm_tahun;
                              } else {
                                $val_tahun = 'Belum dipilih';
                              }

                            ?>  
                            <tr align="center">   
                              <td class="col-md-5" style="display:table-cell; text-align:center; vertical-align:middle;"><?=$val->nm_paket?></td>
                              <td class="col-md-1" style="display:table-cell; text-align:center; vertical-align:middle;"><?=$val_tahun?></td>
                              <td class="col-md-3" style="display:table-cell; text-align:center; vertical-align:middle;"><?=$anggaran_kegiatan?></td>
                              <td class="col-md-2" style="display:table-cell; text-align:center; vertical-align:middle;">
                                <div style="height:15px; margin:20px;" style="display:table-cell; text-align:center; vertical-align:middle;" class="progress">
                                  <?php 
                                    $nilai = 0;
                                    $this->db->where('id_paket',$val->id_paket);
                                    $this->db->where('id_kegiatan',$id_kegiatan);
                                    $this->db->where('deleted','0');
                                    foreach ($this->db->get('erenstra_tr_indikator')->result() as $key ) {
                                    //echo $key->id_indikator;
                                      $subnilai = $this->Content_m->get_value('erenstra_re_indikator','id_indikator',$key->id_indikator,'bobot');
                                      $nilai = $nilai + $subnilai;      
                                    //echo $submilai."<br>";                                  
                                    }
                                    $persen = substr($nilai*100, 0, 4);                                                                  
                                  ?>
                                  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?=$persen?>" aria-valuemin="0" aria-valuemax="100" style="width:<?=$persen?>%;" data-toggle="tooltip" data-placement="left" title="<?=$persen?>%">
                                    <p style="color:transparent;"> <?php echo $persen."%<br>";?> </p>
                                  </div>
                                </div>      
                              </td>               
                              <td class="col-md-1" style="display:table-cell; text-align:center; vertical-align:middle;">
                                <?=$detail; ?> 
                                <?=$edit; ?>
                                <?=$delete; ?>
                              </td>
                            </tr>
                          <?php $i++; } ?>          
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
    // $("select").change(function() {
    //   var str = "";
    //   $("select option:selected").each(function() {
    //     str += $(this).text() + " ";
    //   });
    //   $("div").text(str);
    // }).change();

    $('#<?=$controller?>_table').DataTable({
      "order": [[ 0, 'asc' ]],
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
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- <script src="=base_url('media/assets/global/plugins/amcharts/amcharts/amcharts.js')?>" type="text/javascript"></script>
<script src="=base_url('media/assets/global/plugins/amcharts/amcharts/serial.js')?>" type="text/javascript"></script>
<script src="=base_url('media/assets/global/plugins/amcharts/amcharts/pie.js')?>" type="text/javascript"></script>
<script src="=base_url('media/assets/global/plugins/amcharts/amcharts/radar.js')?>" type="text/javascript"></script>
<script src="=base_url('media/assets/global/plugins/amcharts/amcharts/themes/light.js')?>" type="text/javascript"></script>
<script src="=base_url('media/assets/global/plugins/amcharts/amcharts/themes/patterns.js')?>" type="text/javascript"></script>
<script src="=base_url('media/assets/global/plugins/amcharts/amcharts/themes/chalk.js')?>" type="text/javascript"></script>
<script src="=base_url('media/assets/global/plugins/amcharts/amstockcharts/amstock.js')?>" type="text/javascript"></script> -->
<!-- END PAGE LEVEL PLUGINS -->
<!-- <script src="=base_url('media/assets/admin/layout2/scripts/demo.js')?>" type="text/javascript"></script>
<script>
  jQuery(document).ready(function() {       
    // initiate layout and plugins
    Metronic.init(); // init metronic core components
    Layout.init();   // init current layout
    Demo.init();     // init demo features
    ChartsAmcharts.init();
  });
</script> -->

<!-- <script type="text/javascript">
  var ChartsAmcharts = function() {
    var initChartSample4 = function() {
        var chart = AmCharts.makeChart("chart_4", {
            "type": "serial",
            "theme": "light",

            "fontFamily": 'Calibri',
            "color":    '#888888',

            "legend": {
                "useGraphSettings": true,
                "markerSize": 12,
                "verticalGap": 0,
                "valueWidth": 120,

                "equalWidths": false,
                "valueAlign": "left",
            },
            "dataProvider": [
              $i=1; foreach ($paket->result() as $val) { ?>
                {
                  "nmpaket": 'Paket =$val->nm_paket?>',
                  "numpersen":
                                $nilai = 0;
                                $this->db->where('id_paket',$val->id_paket);
                                $this->db->where('id_kegiatan',$id_kegiatan);
                                $this->db->where('deleted','0');
                                foreach ($this->db->get('erenstra_tr_indikator')->result() as $key ) {
                                  $subnilai = $this->Content_m->get_value('erenstra_re_indikator','id_indikator',$key->id_indikator,'bobot');
                                  $nilai = $nilai + $subnilai;                                      
                                }
                                echo $nilai = substr($nilai * 100, 0, 4);                                
                              ?> ,
                },
               $i++; } ?>
            ],
            "valueAxes": [{
                "position": "bottom",
                "axisAlpha": 0,
                "numpersen": "mm",
                "numpersenUnits": {
                    "mm": "%"
                },
            }],
            "startDuration": 1,
            "graphs": [{
                "balloonText": "<span style='font-size:13px;'>[[title]] [[category]]:<b>[[value]] %</b></span>",
                "title": "Persentase",
                "type": "column",
                "fillAlphas": 1,
                "valueField": "numpersen"
            }],
            "rotate": true,
            "categoryField": "nmpaket",
            "categoryAxis": {
                "gridPosition": "right",
                "position": "right",
                "axisAlpha": 0,
                "tickLength": 0
            }
        });

        $('#chart_4').closest('.portlet').find('.fullscreen').click(function() {
            chart.invalidateSize();
        });
    } 

    return {
      init: function() {
          initChartSample4();
      }
    };
  }();
</script> -->

<?php $this->load->view('administrator/script/hapus_data');?>