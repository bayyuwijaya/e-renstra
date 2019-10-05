<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>SISPEG - Sistem Informasi Pencatatan Data Kepagawaian</title>
    
    

        <link rel="stylesheet" href="<?php echo base_url()?>media/css/login/css/style.css">

    
    
    </head>

  <body>

    <style type="text/css">
    .lupa a{color:#fff;}
    body{background: #fff}
    </style>
      
    <div class="wrapper">

  <div class="container" style="margin-top:-20px">
<div style="text-align:center">
    LIST Update v<?=$this->Content_m->get_value('siak_re_data','id','8','value')?>
</div>
<br>
  <ul style="text-align:center; list-style: none;">
    <li>Pencatatan data pegawai sudah bisa insert update delete</li>
    <li>Optimasi load data</li>
    <li>Fitur login administrator</li>
   
    
  </ul>


  <br>  <br>  <br> 
<div style="text-align:center">
  Best Regards,<br>
  Deni Supriawan, <span style="font-size:10px">Senior Programmer </span>
</div>
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
$('#login-button').click(function(){
    setTimeout(explode, 1200);

});

function explode(){
  document.getElementById("form").submit();
  
}


</script>