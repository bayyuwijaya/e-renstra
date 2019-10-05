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
            <ul class="nav nav-tabs hidden-print">
                <li class="<?=$controller=='pegawai'?'active':''?>">
                    <a <?=$controller!='pegawai'?'href="'.site_url('administrator/'.$controller_dir.'pegawai/edit_data/'.$mahasiswa->id_sdm).'"':''?> aria-expanded="true">
                    <i class="fa fa-edit"></i> Data Pegawai </a>
                </li>
                <li class="<?=$controller=='data_pasangan'?'active':''?>">
                    <a <?=$controller!='data_pasangan'?'href="'.site_url('administrator/'.$controller_dir.'data_pasangan/view/'.$mahasiswa->id_sdm).'"':''?> aria-expanded="false">
                    <i class="fa fa-user"></i> Istri/Suami </a>
                </li>
                <li class="<?=$controller=='data_anak'?'active':''?>">
                    <a <?=$controller!='data_anak'?'href="'.site_url('administrator/'.$controller_dir.'data_anak/view/'.$mahasiswa->id_sdm).'"':''?> aria-expanded="false">
                    <i class="fa fa-user"></i> Anak </a>
                </li>

                <li class="<?=$controller=='riwayat_pendidikan'?'active':''?>">
                    <a <?=$controller!='riwayat_pendidikan'?'href="'.site_url('administrator/'.$controller_dir.'riwayat_pendidikan/view/'.$mahasiswa->id_sdm).'"':''?> aria-expanded="false">
                    <i class="fa fa-graduation-cap"></i> Pendidikan </a>
                </li>
               
                <li class="<?=$controller=='data_diklat'?'active':''?>">
                    <a <?=$controller!='data_diklat'?'href="'.site_url('administrator/mhs_dir/data_diklat/view/'.$mahasiswa->id_sdm).'"':''?> aria-expanded="false">
                    <i class="fa fa-book"></i> Diklat/Seminar </a>
                </li>
                <li class="<?=$controller=='data_jabatan'?'active':''?>">
                    <a <?=$controller!='data_jabatan'?'href="'.site_url('administrator/'.$controller_dir.'data_jabatan/view/'.$mahasiswa->id_sdm).'"':''?> aria-expanded="false">
                    <i class="fa fa-user-o"></i> Jabatan </a>
                </li>

                <li class="<?=$controller=='data_evaluasi'?'active':''?>">
                    <a <?=$controller!='data_diklat'?'href="'.site_url('administrator/mhs_dir/data_evaluasi/view/'.$mahasiswa->id_sdm).'"':''?> aria-expanded="false">
                    <i class="fa fa-bar-chart"></i> Evaluasi </a>
                </li>

                <li class="<?=$controller=='data_cuti'?'active':''?>">
                    <a <?=$controller!='data_diklat'?'href="'.site_url('administrator/mhs_dir/data_cuti/view/'.$mahasiswa->id_sdm).'"':''?> aria-expanded="false">
                    <i class="fa fa-bookmark"></i> Cuti </a>
                </li>

              
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">
                    <?php $this->load->view('administrator/'.$page_tab);?>
                </div>
            </div>
        </div>
    </div>
</div>