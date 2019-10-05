<div class="row" id="icon_data" style="display:none">
  <div class="col-md-12">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <a class="dashboard-stat dashboard-stat-light blue"  href="<?=site_url('administrator/import/get_format_import')?>">
          <div class="visual">
              <i class="fa fa-download"></i>
          </div>
          <div class="details">
              <div class="number">
                  Download
              </div>
              <div class="desc">
                  Format Import
              </div>
          </div>
          </a>
        </div>  

        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <a class="dashboard-stat dashboard-stat-light red" href="javascript:;" onclick="goToURL_ekstra(); return false;">
          <div class="visual">
              <i class="fa fa-upload"></i>
          </div>
          <div class="details">
              <div class="number">
                  Import
              </div>
              <div class="desc">
                  Import using excel file
              </div>
          </div>
          </a>
        </div>  
        
    </div>
  </div>
</div>

<script>
  $(document).ready( function () {
    $('#icon_data').show('slow');
  });
</script>


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
  <?=form_open_multipart('administrator/import/import_excel',array("id" => "form_upload_excela","method"=>"post") );?>
        <span style="font-size:8px">
        *Ambil file data import_pegawai.xlsx (.xlsx) yang berasal dari hasil download <br>
        *Pastikan data sesuai dengan format yang sudah di tetapkan pada sistem (hubungi TIM IT untuk informasi lebih lanjut)<br>
        </span>

        <br>
        <center>
        <input style="width:190px; border:1px solid silver; padding:10px; border-radius:5px" type="file" name="excel_file" accept=".xls,.xlsx" />
        </center>
        <br>
        <span style="font-size:8px">
         *Klik Choose File, lalu pilih data excel import_pegawai.xlsx dan tekan Submit untuk proses memasukkan data ke SISTEM.<br>
        </span>
         <br><br>

        <button type="submit" style="padding:10px; border-radius: 5px"> Import <span style="font-weight:900">Data Pegawai </span></button>
  <?=form_close();?>
    <!--
    <div class="progress">
      <div class="bar"></div>
      <div class="percent">0%</div>
  </div>
    -->
</div>
