<div class="row" id="icon_data" style="display:none">
  <div class="col-md-12">
    <div class="row">

    <?php foreach($kategori as $value) { ?>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-light blue" href="<?=site_url('administrator/data_renstra/kegiatan/index/'.$value->id_kategori)?>">
          <div class="visual">
            <i class="fa fa-tasks"></i>
          </div>
          <div class="details">
            <div class="number">
              <?php // $this->db->where('deleted','0')?>
              <?php // echo $this->db->get_where('erenstra_tr_kegiatan',array('id_kategori' => $value->id_kategori))->num_rows() ?>
            </div>
            <div class="desc" style="position:relative; bottom:-25px;">
              <b><?=$value->nm_kategori; ?></b>
            </div>
          </div>
        </a>
      </div>
    <?php } ?>
    
    </div>
  </div>
</div>
<script>
  $(document).ready( function () {
    $('#icon_data').show('slow');
  });
</script>