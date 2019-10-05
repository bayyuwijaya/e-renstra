<?php
$user = count($this->Content_m->get_row_custom('global_user', 'id_global_user', $id_global_user));

if ($user == 0) {
  $nm = 'Yang tersedia pada user';
} else {
  $id_user = $this->Content_m->get_row_custom('global_user', 'id_global_user', $id_global_user)->id_user;
  $get1 = $this->Content_m->get_row_custom('global_employee', 'id_sdm', $id_user);

  if (count($get1) > 0) {
    $nm = $this->Content_m->get_value('global_employee', 'id_sdm', $id_user, 'nm_sdm');
  }
}

$arr_kategori      = array();
$arr_kegiatan      = array();
$arr_kategori_staf = array();
$arr_kegiatan_staf = array();

$id_global_hakakses = array();
$id_kategori        = array();
$id_kegiatan        = array();
$id_kategori_staf   = array();
$id_kegiatan_staf   = array();

foreach ($this->Content_m->select_db('global_user_hakakses', 'id_global_user', $id_global_user)->result() as $key) {
  array_push($id_global_hakakses, $key->id_global_hakakses);
  array_push($id_kategori, $key->id_sp);
  array_push($id_kegiatan, $key->id_sms);
  array_push($id_kategori_staf, $key->id_sp);
  array_push($id_kegiatan_staf, $key->id_sms);
}

$cek_kategori_double = "";
$kegiatan = 0;
$cek_kategori_double_staf = "";
$kegiatan_staf = 0;
$kategori_staf = 0;
$super_admin = 0;
$cek_staf = 0;

foreach ($id_global_hakakses as $id_hak_akses) {

  if ($id_global_hakakses[$kegiatan] == 1) {
    $super_admin = 1;
  }
  if ($id_global_hakakses[$kegiatan] == 2) {
    if ($cek_kategori_double != $id_kategori[$kegiatan])
      array_push($arr_kategori, $id_kategori[$kegiatan]);

    array_push($arr_kegiatan, $id_kegiatan[$kegiatan]);
    $cek_kategori_double = $id_kategori[$kegiatan];
  }
  if ($id_global_hakakses[$kegiatan] == 7) {
    if ($cek_kategori_double_staf != $id_kategori_staf[$kegiatan_staf])
      array_push($arr_kategori_staf, $id_kategori_staf[$kegiatan_staf]);

    array_push($arr_kegiatan_staf, $id_kegiatan_staf[$kegiatan_staf]);
    $cek_kategori_double_staf = $id_kategori_staf[$kegiatan_staf];
    $cek_staf = 1;
  }

  $kegiatan++;
  $kegiatan_staf++;
}

?>

<div class="row" id="portlet-content">
  <div class="col-md-12">
    <div class="portlet light" style="position:relative">
      <div class="portlet-title">
        <div class="caption">

          <i class="fa fa-unlock"></i>Hakakses <?= ucwords(strtolower($nm)) ?>
        </div>

      </div>
      <hr>
      <div class="portlet-bodys" id="page-content">

        <?= form_open('administrator/setting/atur_hakakses/edit_prefillage', array('class' => "form-horizontal")) ?>
        <input type="hidden" value="<?= $id_global_user ?>" name="id_global_user">
        <input type="hidden" value="<?= $id_sdm ?>" name="id_sdm">
        <div class="form-group">
          <div class="col-sm-12 col-md-12">


            <?php 
              $count = 0;
              foreach ($this->Content_m->select_db('global_hakakses')->result() as $key) { 
            ?>
              <?php if ($key->id_global_hakakses == 1) { ?>
                <input type="checkbox" class="administrator" name="administrator" value="all_rule" <?= $super_admin == 1 ? 'checked' : '' ?>> <span style="font-weight:bold"><?= $key->jenis_hakakses ?></span><br>
                <input type="hidden" class="aka" name="get_role[]" value="1_0">
              <?php } ?>
              <?php if ($key->id_global_hakakses == 2) { ?>
                <input type="checkbox" class="admin" name="admin" value="all_kategori" <?= $kegiatan > 1 ? 'checked' : '' ?>> <span style="font-weight:bold"><?= $key->jenis_hakakses ?></span><br>
              <?php } ?>
              <?php if ($key->id_global_hakakses == 7) { ?>
                <input type="checkbox" class="staf" name="staf" value="all_kategori_staf" <?= $cek_staf == 1 ? 'checked' : '' ?>> <span style="font-weight:bold"><?= $key->jenis_hakakses ?></span><br>
              <?php } ?>

              <!-- jika admin -->
              <?php if ($key->id_global_hakakses == 2) { ?>
                <?php 
                  $i = 0;
                  foreach ($this->Content_m->select_db('erenstra_tr_kategori')->result() as $keyb) { ?>
                  <?php 
                    $ii = 0;
                    foreach ($arr_kategori as $kategori_check) { ?>
                      <?php if ($kategori_check == $keyb->id_kategori) { ?>
                        <input type="checkbox" class="id_kategori<?= $i ?>" style="position:relative; margin-left:30px !important" checked> <?= $keyb->nm_kategori ?><br>
                      <?php $ii++;
                      } ?>
                  <?php } ?>
                  <?php if ($ii == 0) { ?>
                    <input type="checkbox" class="id_kategori<?= $i ?>" style="position:relative; margin-left:30px !important"> <?= $keyb->nm_kategori ?><br>
                  <?php } ?>
                  <?php $j = 0;
                    foreach ($this->Content_m->select_db('erenstra_tr_kegiatan', 'id_kategori', $keyb->id_kategori)->result() as $keyc) { 
                      $obj_nm_kegiatan = $this->db->get_where('erenstra_re_nmkegiatan', array('id_nmkegiatan' => $keyc->id_nmkegiatan));
                      if($obj_nm_kegiatan->num_rows() > 0) {
                        $val_nmkegiatan = $obj_nm_kegiatan->row()->nm_kegiatan;
                      } else {
                        $val_nmkegiatan = 'Nama Kegiatan Belum Dipilih';
                      }
                  ?>
                    <?php 
                      $ii = 0;
                      foreach ($arr_kegiatan as $kegiatan_check) { ?>
                      <?php if ($kegiatan_check == $keyc->id_kegiatan) { ?>
                        <input type="checkbox" class="id_kegiatan<?= $i ?><?= $j ?>" name="get_role[]" value="2_<?= $keyc->id_kegiatan ?>" style="margin-left:60px !important" checked> <?= $val_nmkegiatan ?><br>
                      <?php $ii++; } ?>
                    <?php } ?>
                    <?php if ($ii == 0) { ?>
                      <input type="checkbox" class="id_kegiatan<?= $i ?><?= $j ?>" name="get_role[]" value="2_<?= $keyc->id_kegiatan ?>" style="margin-left:60px !important"> <?= $val_nmkegiatan ?><br>
                    <?php } ?>
                  <?php 
                    $j++;
                    $count++;
                    } 
                  ?>
                <?php 
                  $i++;
                  } 
                ?>
              <?php } ?>

              <!-- Jika Staf -->
              <?php if ($key->id_global_hakakses == 7) { ?>
                <?php $k = 0;
                  foreach ($this->Content_m->select_db('erenstra_tr_kategori')->result() as $keyb) { ?>
                  <?php $ii = 0;
                    foreach ($arr_kategori_staf as $kategori_check_staf) { ?>
                      <?php if ($kategori_check_staf == $keyb->id_kategori) { ?>
                        <input type="checkbox" class="id_kategori_staf<?= $k ?>" style="position:relative; margin-left:30px !important" checked> <?= $keyb->nm_kategori ?><br>
                      <?php $ii++; } ?>
                  <?php } ?>
                  <?php if ($ii == 0) { ?>
                    <input type="checkbox" class="id_kategori_staf<?= $k ?>" style="position:relative; margin-left:30px !important"> <?= $keyb->nm_kategori ?><br>
                  <?php } ?>

                  <?php $l = 0;
                    foreach ($this->Content_m->select_db('erenstra_tr_kegiatan', 'id_kegiatan', $keyb->id_kategori)->result() as $keyc) { 
                      $obj_nm_kegiatan = $this->db->get_where('erenstra_re_nmkegiatan', array('id_nmkegiatan' => $keyc->id_nmkegiatan));
                      if($obj_nm_kegiatan->num_rows() > 0) {
                        $val_nmkegiatan = $obj_nm_kegiatan->row()->nm_kegiatan;
                      } else {
                        $val_nmkegiatan = 'Nama Kegiatan Belum Dipilih';
                      }
                  ?>
                    <?php $ii = 0;
                      foreach ($arr_kegiatan_staf as $kegiatan_check_staf) { ?>
                        <?php if ($kegiatan_check_staf == $keyc->id_kegiatan) { ?>
                          <input type="checkbox" class="id_kegiatan_staf<?= $k ?><?= $l ?>" name="get_role[]" value="7_<?= $keyc->id_kegiatan ?>" style="margin-left:60px !important" checked> <?= $val_nmkegiatan ?><br>
                        <?php $ii++;
                          } 
                        ?>
                    <?php } ?>
                    <?php if ($ii == 0) { ?>
                      <input type="checkbox" class="id_kegiatan_staf<?= $k ?><?= $l ?>" name="get_role[]" value="7_<?= $keyc->id_kegiatan ?>" style="margin-left:60px !important"> <?= $val_nmkegiatan ?><br>
                    <?php } ?>
                  <?php 
                      $l++;
                      $count++;
                    } 
                  ?>
                <?php 
                    $k++;
                  } 
                ?>
              <?php } ?>
            <?php } ?>
            <br>
          </div>
        </div>

        <hr>

        <div class="form-group">
          <div class="col-sm-12 col-md-12">
            <button type="submit" class="btn btn-success">Simpan</button>
            <br><br><br>
          </div>
        </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $(document).ready(function() {
    if ($('.administrator').is(':checked') == true) {
      $('.aka').prop('disabled', false);
    } else {
      $('.aka').prop('disabled', true);
    }
  });

  $('.administrator').change(function() {
    if ($('.administrator').is(':checked') == true) {
      $('.aka').prop('disabled', false);
      $('.admin').prop('checked', true);

      <?php $i = 0;
      foreach ($this->Content_m->select_db('erenstra_tr_kategori')->result() as $key) { ?>
        $('.id_kategori<?= $i ?>').prop('checked', true);
        <?php $j = 0;
          foreach ($this->Content_m->select_db('erenstra_tr_kegiatan', 'id_kategori', $key->id_kategori)->result() as $keyb) { ?>
          $('.id_kegiatan<?= $i ?><?= $j ?>').prop('checked', true);
        <?php $j++;
          } ?>
      <?php $i++;
      } ?>

    } else {
      $('.aka').prop('disabled', true);
      $('.admin').prop('checked', false);

      <?php $i = 0;
      foreach ($this->Content_m->select_db('erenstra_tr_kategori')->result() as $key) { ?>
        $('.id_kategori<?= $i ?>').prop('checked', false);
        <?php $j = 0;
          foreach ($this->Content_m->select_db('erenstra_tr_kegiatan', 'id_kategori', $key->id_kategori)->result() as $keyb) { ?>
          $('.id_kegiatan<?= $i ?><?= $j ?>').prop('checked', false);
        <?php $j++;
          } ?>
      <?php $i++;
      } ?>
    }
  });

  $('.admin').change(function() {
    if ($('.admin').is(':checked') == true) {
      <?php $i = 0;
      foreach ($this->Content_m->select_db('erenstra_tr_kategori')->result() as $key) { ?>
        $('.id_kategori<?= $i ?>').prop('checked', true);
        <?php $j = 0;
          foreach ($this->Content_m->select_db('erenstra_tr_kegiatan', 'id_kategori', $key->id_kategori)->result() as $keyb) { ?>
          $('.id_kegiatan<?= $i ?><?= $j ?>').prop('checked', true);
        <?php $j++;
          } ?>
      <?php $i++;
      } ?>
    } else {
      <?php $i = 0;
      foreach ($this->Content_m->select_db('erenstra_tr_kategori')->result() as $key) { ?>
        $('.id_kategori<?= $i ?>').prop('checked', false);
        <?php $j = 0;
          foreach ($this->Content_m->select_db('erenstra_tr_kegiatan', 'id_kategori', $key->id_kategori)->result() as $keyb) { ?>
          $('.id_kegiatan<?= $i ?><?= $j ?>').prop('checked', false);
        <?php $j++;
          } ?>
      <?php $i++;
      } ?>
    }
  });

  <?php $i = 0;
  foreach ($this->Content_m->select_db('erenstra_tr_kategori')->result() as $key) { ?>
    $(".id_kategori<?= $i ?>").change(function() {
      if ($('.id_kategori<?= $i ?>').is(':checked') == true) {
        <?php $j = 0;
          foreach ($this->Content_m->select_db('erenstra_tr_kegiatan', 'id_kategori', $key->id_kategori)->result() as $keyb) { ?>
          $('.id_kegiatan<?= $i ?><?= $j ?>').prop('checked', true);
        <?php $j++;
          } ?>
      } else {
        <?php $j = 0;
          foreach ($this->Content_m->select_db('erenstra_tr_kegiatan', 'id_kategori', $key->id_kategori)->result() as $keyb) { ?>
          $('.id_kegiatan<?= $i ?><?= $j ?>').prop('checked', false);
        <?php $j++;
          } ?>
      }
    });
  <?php 
    $i++; 
    } 
  ?>

  $('.staf').change(function() {
    if ($('.staf').is(':checked') == true) {
      <?php $i = 0;
      foreach ($this->Content_m->select_db('erenstra_tr_kategori')->result() as $key) { ?>
        $('.id_kategori_staf<?= $i ?>').prop('checked', true);
        <?php $j = 0;
          foreach ($this->Content_m->select_db('erenstra_tr_kegiatan', 'id_kategori', $key->id_kategori)->result() as $keyb) { ?>
          $('.id_kegiatan_staf<?= $i ?><?= $j ?>').prop('checked', true);
        <?php $j++;
          } ?>
      <?php $i++;
      } ?>
    } else {
      <?php $i = 0;
      foreach ($this->Content_m->select_db('erenstra_tr_kategori')->result() as $key) { ?>
        $('.id_kategori_staf<?= $i ?>').prop('checked', false);
        <?php $j = 0;
          foreach ($this->Content_m->select_db('erenstra_tr_kegiatan', 'id_kategori', $key->id_kategori)->result() as $keyb) { ?>
          $('.id_kegiatan_staf<?= $i ?><?= $j ?>').prop('checked', false);
        <?php $j++;
          } ?>
      <?php $i++;
      } ?>
    }
  });

  <?php $i = 0;
  foreach ($this->Content_m->select_db('erenstra_tr_kategori')->result() as $key) { ?>
    $(".id_kategori_staf<?= $i ?>").change(function() {
      if ($('.id_kategori_staf<?= $i ?>').is(':checked') == true) {
        <?php $j = 0;
          foreach ($this->Content_m->select_db('erenstra_tr_kegiatan', 'id_kategori', $key->id_kategori)->result() as $keyb) { ?>
          $('.id_kegiatan_staf<?= $i ?><?= $j ?>').prop('checked', true);
        <?php $j++; } ?>
      } else {
        <?php $j = 0;
          foreach ($this->Content_m->select_db('erenstra_tr_kegiatan', 'id_kategori', $key->id_kategori)->result() as $keyb) { ?>
          $('.id_kegiatan_staf<?= $i ?><?= $j ?>').prop('checked', false);
        <?php $j++; } ?>
      }
    });
  <?php $i++;
  } ?>
  
  
</script>