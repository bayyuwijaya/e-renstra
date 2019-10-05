<?php if ($this->session->flashdata('sukses')) { ?>
  <div class="alert alert-success">
    <strong>Sukses !!</strong>
    <p>Data berhasil di update.</p>
  </div>
<?php } ?>
<?php if ($this->session->flashdata('pass_tidak_sama')) { ?>
  <div class="alert alert-danger">
    <strong>Terjadi Kesalahan !!</strong>
    <p>Pastikan Password dan Confirm Password sama.</p>
  </div>
<?php } ?>
<?php if ($this->session->flashdata('pass_tidak_boleh_kosong')) { ?>
  <div class="alert alert-danger">
    <strong>Terjadi Kesalahan !!</strong>
    <p>Password tidak boleh kosong.</p>
  </div>
<?php } ?>
<?php if ($this->session->flashdata('username_sudah_ada')) { ?>
  <div class="alert alert-danger">
    <strong>Terjadi Kesalahan !!</strong>
    <p>Username sudah ada, silahkan gunakan username lain.</p>
  </div>
<?php } ?>
<?php if ($this->session->flashdata('error')) { ?>
  <div class="alert alert-danger">
    <strong>Terjadi Kesalahan !!</strong>
    <p>Terjadi intrupsi silahkan ulangi kembali.</p>
  </div>
<?php } ?>


<div class="row" id="portlet-content">
  <div class="col-md-12">
    <div class="portlet light" style="position:relative">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-user"></i>Identitas User
        </div>
      </div>

      <div class="portlet-body" id="page-content">
        <?= form_open('account/edit_administrator_proses', array('class' => "form-horizontal")) ?>

        <input type="hidden" name="id_sdm" value="<?= $id_sdm ?>">
        <input type="hidden" name="nm_sdm" value="<?= $nm_sdm ?>">

        <div class="form-group">
          <label class="col-sm-3 col-md-2 control-label">Nama</label>
          <div class="col-sm-9 col-md-7">
            <input name="nm_sdm" value="<?= $nm_sdm ?>" type="text" class="form-control" disabled>
          </div>
        </div>
        <hr>
        <div class="form-group">
          <label class="col-sm-3 col-md-2 control-label">Username</label>
          <div class="col-sm-9 col-md-7">
            <input name="username" type="text" value="<?= $username ?>" class="form-control" autocomplete="off">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-md-2 control-label">Password</label>
          <div class="col-sm-9 col-md-7">
            <input name="password" type="password" value="" class="form-control" autocomplete="off" placeholder="*******">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-md-2 control-label">Confirm Password</label>
          <div class="col-sm-9 col-md-7">
            <input name="confirm_password" type="password" value="" class="form-control" autocomplete="off" placeholder="*******">
          </div>
        </div>
        <hr><br><br>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9 col-md-offset-2 col-md-10">
            <button type="submit" class="btn btn-success">Simpan</button>
            <?= anchor('administrator/setting/atur_hakakses', 'Batal', array('class' => 'btn btn-default')) ?>
          </div>
        </div>
        <br><br>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>
</div>

<script type="text/javascript" language="JavaScript">
  function konfirmasi() {
    tanya = confirm("Anda Yakin Akan Menghapus Data ?");
    if (tanya == true) return true;
    else return false;
  }
  $(document).ready(function() {
    $("#myTable").dataTable({
      aaSorting: [[0, 'asc']],
      bPaginate: true,
      bFilter: true,
      bInfo: false,
      bSortable: true,
      bRetrieve: true,
      aoColumnDefs: [{"aTargets": [4], "bSortable": false}]
    });
  });
</script>