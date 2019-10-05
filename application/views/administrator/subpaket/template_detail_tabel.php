<style type="text/css">
  @media print {
    .hidden-print {
        display: none !important;
    }
    @page { margin: 0; } 
  }
</style>

<div class="row " id="tab-content">
    <div class="col-md-12">
        <div class="tabbable tabbable-custom ">
            <ul class="nav nav-tabs ">
              <li class="<?=$controller=='lokasi'?'active':''?>">
                  <a <?=$controller!='lokasi'?'href="'.site_url('administrator/'.$controller_dir.'lokasi/index/'.$paket->id_paket.'/'.$kegiatan->id_kegiatan).'"':''?> aria-expanded="true" >
                  <i class="fa fa-edit"></i> Lokasi </a>
              </li>
              <li class="<?=$controller=='indikator'?'active':''?>">
                  <a <?=$controller!='indikator'?'href="'.site_url('administrator/'.$controller_dir.'indikator/index/'.$paket->id_paket.'/'.$kegiatan->id_kegiatan).'"':''?> aria-expanded="false">
                  <i class="fa fa-book"></i> Indikator </a>
              </li>
              <li class="<?=$controller=='rencana'?'active':''?>">
                  <a <?=$controller!='rencana'?'href="'.site_url('administrator/'.$controller_dir.'rencana/index/'.$paket->id_paket.'/'.$kegiatan->id_kegiatan).'"':''?> aria-expanded="false">
                  <i class="fa fa-bar-chart"></i> Rencana Pelaksanaan </a>
              </li>
              <li class="<?=$controller=='file_support'?'active':''?>">
                  <a <?=$controller!='file_support'?'href="'.site_url('administrator/'.$controller_dir.'file_support/index/'.$paket->id_paket.'/'.$kegiatan->id_kegiatan).'"':''?> aria-expanded="false">
                  <i class="fa fa-folder"></i> File Pendukung </a>
              </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">
                    <div class="row" id="info-content" style="display:none">
                        <div class="col-md-12">
                            <div class="portlet box blue" style="position:relative">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-list"></i> Informasi Pekerjaan
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <form class="form-horizontal form-bordered form-row-stripped" role="form">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="form-control-static col-md-2">Nama Kategori</label>
                                                <p class="form-control-static col-md-10">
                                                    : <?=$re_nmkategori->nm_kategori; ?>
                                                </p>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-static col-md-2">Nama Kegiatan</label>
                                                <p class="form-control-static col-md-10">
                                                    : <?=$re_nmkegiatan->nm_kegiatan; ?>
                                                </p>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="form-control-static col-md-2">Nama Paket</label>                            
                                                <p class="form-control-static col-md-10">
                                                    : <?=$paket->nm_paket; ?>
                                                </p>                            
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-static col-md-2">Tahun</label>                            
                                                <p class="form-control-static col-md-10">
                                                    : <?php
                                                        $obj_thn = $this->db->get_where('erenstra_tr_tahun',array('id_tahun'=>$paket->id_tahun, 'deleted'=>0))->row();
                                                        if(isset($obj_thn->nm_tahun)) {
                                                            echo $obj_thn->nm_tahun;
                                                        } else {
                                                            echo "Belum Dipilih";
                                                        }
                                                    ?>                                            
                                                </p>                            
                                            </div>
                                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $this->load->view('administrator/'.$page_tab);?>
                </div>
            </div>
        </div>
    </div>
</div>