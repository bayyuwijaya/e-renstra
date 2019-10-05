<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Elektronik - Renstra (E-Renstra)</title>
    <link rel="stylesheet" href="<?php echo base_url()?>media/css/login/css/style.css">
    <link rel="shortcut icon" href="<?=base_url('media/images/Logo_PU_(RGB).jpg')?>">
  </head>
  <body>
    <style type="text/css">
      .lupa a{color:#fff;}
    </style>
    <div class="wrapper">
      <div class="container">
        <h1 style="margin-top:-10px; font-size:30px"> E-Renstra <br />
          <p style="font-size:15px"> Elektronik - Renstra </p>
        </h1>
        
        <form action="<?=site_url('account/authentication')?>" method="POST" class="form" id="form">
          <?php if($this->session->flashdata('login_error')) { ?>
            <div style="margin-top:-20px; margin-bottom:5px; font-size: 14px; font-weight: 900"><i>*username atau password salah</i></div>
          <?php } ?>
          <?php if($this->session->flashdata('no_prefillage')) { ?>
            <div style="margin-top:-20px; margin-bottom:5px; font-size: 14px; font-weight: 900"><i>*tidak memiliki akses masuk, silahkan hubungi admin</i></div>
          <?php } ?>
          <?php if($this->session->flashdata('silahkan_Login')) { ?>
            <div style="margin-top:-20px; margin-bottom:5px; font-size: 14px; font-weight: 900"><i>*silahkan login kembali ke sistem</i></div>
          <?php } ?>          
          <input type="text" placeholder="Username"  name="username"  style="font-family: Segoe UI;" autocomplete="off">
          <input type="password" placeholder="Password"  name="password"  style="font-family: Segoe UI;">
          <button type="submit" id="login-button" style="font-family: Segoe UI;">Login</button>        
        </form>

        <a href="<?php echo site_url()?>/account/log_update" target="_Blank"  style="color:#fff; position:relative; z-index:999999; text-decoration:none"> 
          <span style="font-size:14px"><u>v<?=$this->Content_m->get_value('erenstra_re_data','id','8','value')?></u></span>
        </a>
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