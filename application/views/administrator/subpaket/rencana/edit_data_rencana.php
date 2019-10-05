<div class="row" id="portlet-content">
    <div class="col-md-12">
        <div class="portlet light" style="position:relative">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit"></i><?=$judul?>
                </div>
            </div>
            <div class="portlet-body form" id="page-content" style="display:block">
               <form action="<?=site_url('administrator/'.$controller_dir.$controller.'/edit_data_proses')?>" method="post" id="<?=$controller?>" enctype="multipart/form-data" class="horizontal-form">
                    <div class="form-body">
                        <div class="alert alert-danger display-hide" style="display: none;" id="error">
                          <button class="close" data-close="alert"></button>
                          <span id="error-text"></span>
                        </div>
                        <div class="tabbable-custom ">
                          <ul class="nav nav-tabs">
                              <li class="active">
                                  <a href="#rencana" data-toggle="tab" aria-expanded="true">
                                  Rencana Pelaksanaan </a>
                              </li>                             
                          </ul>
                          <input type="hidden" name="id_paket" value="<?=$paket->id_paket?>">
                          <input type="hidden" name="id_rencana" value="<?=$rencana->id_rencana?>">
                          <input type="hidden" name="id_kegiatan" value="<?=$kegiatan->id_kegiatan?>">
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="rencana">
                                    <h3 class="form-section">Data Rencana Pelaksanaan</h3>
                                    <div class="row">

                                      <div class="col-md-12">
                                        <div class="form-group" id="form_sub_komponen">
                                            <label for="sub_komponen" class="control-label">Sub Komponen <span class="required">* </span></label>
                                            <input required type="text" id="sub_komponen" name="sub_komponen" class="form-control" placeholder="Ketik Sub Komponen disini" value="<?=$rencana->sub_komponen?>">
                                            <span id="error_sub_komponen" class="help-block"></span>
                                        </div>
                                      </div>
                                      
                                    </div>
                                    <div class="row">

                                      <div class="col-md-6">
                                        <div class="form-group" id="form_output_satuan">
                                            <label for="output_satuan" class="control-label">Output Satuan <span class="required">* </span></label>
                                            <select id="output_satuan" name="output_satuan" class="form-control" style="width:100%" required>
                                              <option value=""></option>
                                            </select>  
                                            <span id="error_output_satuan" class="help-block"></span>
                                        </div>
                                      </div>

                                      <div class="col-md-6">
                                        <div class="form-group" id="form_output_target">
                                          <label for="output_target" class="control-label">Output Target <span class="required">* </span></label>
                                          <input required type="text" id="output_target" name="output_target" class="form-control" placeholder="Ketik Output Target disini" value="<?=$rencana->output_target?>">
                                          <span id="error_output_target" class="help-block"></span>
                                        </div>
                                      </div>

                                    </div>
                                    <div class="row">                                      

                                      <div class="col-md-6">
                                        <div class="form-group" id="form_outcome_satuan">
                                          <label for="outcome_satuan" class="control-label">Outcome Satuan <span class="required">* </span></label>
                                          <select id="outcome_satuan" name="outcome_satuan" class="form-control" style="width:100%" required>
                                            <option value=""></option>
                                          </select>  
                                          <span id="error_outcome_satuan" class="help-block"></span>
                                        </div>
                                      </div>

                                      <div class="col-md-6">
                                        <div class="form-group" id="form_outcome_target">
                                            <label for="outcome_target" class="control-label">Outcome Target<span class="required">* </span></label>
                                            <input required type="text" id="outcome_target" name="outcome_target" class="form-control" placeholder="Ketik Outcome Target disini" value="<?=$rencana->outcome_target?>">
                                            <span id="error_outcome_target" class="help-block"></span>
                                        </div>
                                      </div>

                                    </div>
                                    <div class="row">   

                                      <div class="col-md-12">
                                        <div class="form-group" id="form_anggaran">
                                          <label for="anggaran" class="control-label">Anggaran <span class="required">* </span></label>
                                          <input required type="text" id="anggaran" name="anggaran" class="form-control" placeholder="Ketik Anggaran disini" value="<?= currency_format($rencana->anggaran); ?>" />
                                          <br>
                                          <input type="hidden" id="input_anggaran" name="input_anggaran" value="<?=$rencana->anggaran?>" >
                                          <span id="error_anggaran" class="help-block"></span>
                                        </div>
                                      </div>

                                    </div>                                                                      
                                </div>                              
                            </div>
                        </div>
                    </div>
                    <div class="form-actions right">
                        <a type="button" class="btn default" href="<?=site_url('administrator/'.$controller_dir.$controller)?>/index/<?=$paket->id_paket?>/<?=$kegiatan->id_kegiatan?>">Kembali</a>
                        <button type="submit" class="btn blue"><i class="fa fa-check"></i> Simpan</button>
                    </div>
                </form>
            </div>
            <?php $this->load->view('administrator/include/loading');?>
        </div>
    </div>
</div>
<script>
  $(document).ready(function() {

    $("#output_satuan").select2({
      placeholder: "Pilih Satuan Output",
      language: "id",
      data: <?=$satuanoutput?>
    });
    $("#output_satuan").val("<?=$rencana->output_satuan?>").trigger('change');
    
    $("#outcome_satuan").select2({
      placeholder: "Pilih Satuan Outcome",
      language: "id",
      data: <?=$satuanoutcome?>
    });
    $("#outcome_satuan").val("<?=$rencana->outcome_satuan?>").trigger('change');

    $("#loading-content,#loading").fadeOut("fast",function() {
      $( "#page-content" ).fadeIn("fast");
    });

    /* Dengan Rupiah */
    var dengan_rupiah = document.getElementById('anggaran');
    dengan_rupiah.addEventListener('input', function(e) {
      dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
      convertInt(dengan_rupiah.value);
    });

    /* Fungsi */
    function formatRupiah(angka, prefix) {
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split	= number_string.split(','),
        sisa 	= split[0].length % 3,
        rupiah 	= split[0].substr(0, sisa),
        ribuan 	= split[0].substr(sisa).match(/\d{3}/gi);
        
      if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }
      
      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    function convertInt(data) { 
      var str = data;
      var cutRp = str.slice(4);
      var dot = cutRp.match(/[.]/g);
      var i, len;
      
      for(i=1, len=dot.length; i<=len; i++) {
        cutRp = cutRp.replace(".","");
      }
      var num = parseInt(cutRp);
      var x = document.getElementById("input_anggaran");
      x.getAttributeNode("value").value = num;
    }

  });
</script>
<?php $this->load->view('administrator/script/form_data');?>
