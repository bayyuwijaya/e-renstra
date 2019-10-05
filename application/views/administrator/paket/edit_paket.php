<div class="row" id="portlet-content">
    <div class="col-md-12">
        <div class="portlet light" style="position:relative">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit"></i><?=$judul?>
                </div>
            </div>
            <div class="portlet-body form" id="page-content" style="display:block">
                <form action="<?=site_url('administrator/'.$controller_dir.$controller.'/proses_edit_paket'.'/'.$paket->id_paket)?>" method="post" id="<?=$controller?>" enctype="multipart/form-data" class="horizontal-form">
                    <div class="form-body">
                        <input value="<?=$paket->id_paket?>" type="hidden" name="id_paket">
                        <div class="alert alert-danger display-hide" style="display: none;" id="error">
                            <button class="close" data-close="alert"></button>
                            <span id="error-text"></span>
                        </div>
                        <div class="tabbable-custom ">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#paket" data-toggle="tab" aria-expanded="true">
                                    Paket </a>
                                </li>                              
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="biodata">
                                    <h3 class="form-section">Data Paket</h3>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group" id="form_nm_paket">
                                                <label for="nm_paket" class="control-label"> Paket Pekerjaan <span class="required">* </span></label>
                                                <input required type="text" id="nm_paket" name="nm_paket" class="form-control" placeholder="Paket Pekerjaan" value="<?=$paket->nm_paket?>">
                                                <span id="error_nm_paket" class="help-block"></span>
                                            </div>
                                        </div>                                       
                                    </div>
                                    <div class="row">
                                        <!-- <div class="col-md-4">
                                            <div class="form-group" id="form_kode">
                                                <label for="kode" class="control-label">Kode Paket<span class="required">* </span></label>
                                                <input required type="text" id="kode" name="kode" class="form-control" placeholder="Kode Paket" value="<?=$paket->kode?>">
                                                <span id="error_kode" class="help-block"></span>
                                            </div>
                                        </div> -->
                                        <div class="col-md-6">
                                            <div class="form-group" id="form_id_tahun">
                                                <label for="id_tahun" class="control-label">Tahun Anggaran<span class="required">* </span></label>
                                                <select id="id_tahun" name="id_tahun" class="form-control" style="width:100%" required>
                                                  <option value=""></option>
                                                </select>  
                                                <span id="error_id_tahun" class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="form_cost_kegiatan">
                                                <label for="cost_kegiatan" class="control-label">Anggaran Kegiatan <span class="required">* </span></label>
                                                <input required type="text" name="cost_kegiatan" id="cost_kegiatan" class="form-control" placeholder="Anggaran Kegiatan" value="<?= currency_format($paket->anggaran_kegiatan); ?>" />
                                                <br>
                                                <input type="hidden" id="anggaran_kegiatan" name="anggaran_kegiatan" value="<?=$paket->anggaran_kegiatan?>" >
                                                <span id="error_cost_kegiatan" class="help-block"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="id_kegiatan" name="id_kegiatan" value="<?=$id_kegiatan; ?>">
                                </div>                               
                            </div>
                        </div>
                    </div>
                    <div class="form-actions right">
                        <a type="button" class="btn default" href="<?=site_url('administrator/'.$controller_dir.$controller.'/index\/'.$id_kegiatan)?>">Kembali</a>
                        <button type="submit" class="btn blue"><i class="fa fa-check"></i> Simpan</button>
                    </div>
                </form>
            </div>
            <?php $this->load->view('administrator/include/loading');?>
        </div>
    </div>
</div>
<script>
    $(document).ready( function () {
      $("#id_tahun").select2({
        placeholder: "Pilih Tahun Anggaran",
        language: "id",
        data: <?=$tahun?>
      });
      $("#id_tahun").val("<?=$paket->id_tahun?>").trigger('change');

      $( "#loading-content,#loading" ).fadeOut( "fast", function() {
        $( "#page-content" ).fadeIn("fast");
      });

      /* Dengan Rupiah */
      var dengan_rupiah = document.getElementById('cost_kegiatan');
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
        var x = document.getElementById("anggaran_kegiatan");
        x.getAttributeNode("value").value = num;
      }
    });
</script>
<?php $this->load->view('administrator/script/form_data_paket');?>
