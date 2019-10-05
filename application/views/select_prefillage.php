<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Single Signin System </title>
    <link rel="stylesheet" href="<?php echo base_url()?>media/css/login/css/style.css">
  </head>
  <body>
    <style type="text/css">
      .lupa a{color:#fff;}
      body{background: #fff}
    </style>
      
    <div class="wrapper">
      <div class="container">
        <h1 style="margin-top:-30px; font-size:30px; font-family: Segoe UI;">
          Pilih Hakakses <br>
          <p style="font-size:11px; font-family: Segoe UI;"> Kami mendeteksi ada lebih dari 1 hak akses, <br> pilih salah satu untuk masuk ke sistem </p>
        </h1>
        <br />
        <?php if (in_array(1, $this->session->userdata('id_global_hakakses')) || in_array(2, $this->session->userdata('id_global_hakakses'))) { ?>
          <form action="<?=site_url('administrator/dashboard')?>" method="POST" class="form" id="form" style="margin-bottom:10px; ">
              <button type="submit" id="login-button" style="font-family: Segoe UI; ">
                  <span style="font-size:13px">Login sebagai</span><br><b>Admininstrator Elektronik-Renstra</b>
              </button>
          </form>
        <?php } ?>
      </div>

      <ul class="bg-bubbles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
      </ul>

    </div>
  
    <script src='<?php echo base_url()?>media/css/login/js/jquery.min.js'></script>
    <script src="<?php echo base_url()?>media/css/login/js/index.js"></script>

  </body>
</html>

<script type="text/javascript">
  $('#login-button').click(function() {
      setTimeout(explode, 1200);
  });

  function explode() {
    document.getElementById("form").submit();
  }
</script>