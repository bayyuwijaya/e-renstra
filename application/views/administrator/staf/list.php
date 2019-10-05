<div class="row" id="portlet-content">
    <div class="col-md-12">
        <div class="portlet light" style="position:relative">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-user-secret"></i>Data <?= $judul ?>
                </div>
                <div class="actions" id="tombol-action" style="display:none">
                    <a class="btn blue btn-sm" href="<?= site_url('administrator/' . $controller_dir . $controller . '/tambah_data') ?>">
                        <i class="fa fa-plus"></i> Tambah Data
                    </a>
                </div>
            </div>
            <div class="portlet-body" id="page-content" style="display:none">
                <div class="table-responsive">
                    <table id="<?= $controller ?>_table" class="table table-bordered table-striped table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">NIP</th>
                                <th class="text-center">Nama Staf</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $x=1; foreach ($query->result() as $key) { ?>
                            <?php
                              $del = '<a class="tooltips btn-xs btn-danger" data-toggle="m-tooltip" data-placement="top" title="Hapus" onclick="viewHapusData(\'' . $key->id_sdm . '\',\'' . $key->nm_sdm . '\')" style="cursor:pointer"><i class=\'fa fa-times\'></i></a>';
                              $edit = anchor('administrator/setting/staf/edit_staf/' . $key->id_sdm, "<span class='glyphicon glyphicon-edit' aria-hidden='true'></span>",  array('class' => "tooltips btn-xs btn-warning", 'data-toggle' => "m-tooltip", 'title' => 'Edit'));
                            ?>
                              <tr align="center">
                                <td class="col-md-1"><?= $x; ?></td>
                                <td class="col-md-4"><?= $key->nidn; ?></td>
                                <td class="col-md-5"><?= $key->nm_sdm; ?></td>
                                <td class="col-md-2">
                                    <?= $edit; ?>
                                    <?= $del; ?>
                                </td>
                              </tr>
                            <?php $x++; } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">NIP</th>
                                <th class="text-center">Nama Staf</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <?php $this->load->view('administrator/include/loading'); ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var table = $('#<?= $controller ?>_table').DataTable({
            "order": [
                [0, 'asc']
            ],
            "processing": false,
            "serverSide": false,
            "searching": true,
            "language": {
                "url": "<?= base_url('media/assets/global/plugins/datatables/media/js') ?>/indonesian.json"
            },
            "columnDefs": [
                {
                    "targets": [0],
                    "bSortable": false
                }
            ],

            "fnInitComplete": function(oSettings, json) {
                $('.dataTables_processing').css('display', 'none');
                $("#loading-content").fadeOut("fast", function() {
                    $("#tombol-action").fadeIn("fast");
                    $("#page-content").fadeIn("fast");
                });
            }
        });

    });

    $('.hapusdata').click(function() {
        if (confirm("Apakah kamu yakin menghapus entry ini?")) {
            return true;
        } else {
            return false;
        }
    });
</script>

<?php $this->load->view('administrator/script/hapus_data'); ?>