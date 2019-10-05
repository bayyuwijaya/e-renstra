<?=doctype();?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" class="no-js">
    <head>
        <title><?=$judul;?> - Database</title>
        <link rel="shortcut icon" href="<?=base_url('media/images/Logo_PU_(RGB).jpg')?>">
        <base href="<?=base_url()?>">
        <?php
            echo meta('Content-Type', 'text/html; charset=utf-8', 'equiv');
            echo meta('Resource-Type', 'document', 'equiv');
            echo meta('Cache-control', 'no-cache', 'equiv');
            echo meta('X-UA-Compatible', 'IE=edge', 'equiv');
            echo meta('Content-Style-Type', 'text/css', 'equiv');
            if($this->agent->is_mobile())
                echo meta('viewport','width=device-width, initial-scale=1');

            echo link_tag('media/images/Logo_PU_(RGB).jpg');
            echo link_tag('media/assets/global/plugins/font-awesome/css/font-awesome.min.css');
            echo link_tag('media/assets/global/plugins/simple-line-icons/simple-line-icons.min.css');
            echo link_tag('media/assets/global/plugins/bootstrap/css/bootstrap.min.css');
            echo link_tag('media/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.min.css');
            echo link_tag('media/assets/global/plugins/datatables/plugins/bootstrap/responsive.bootstrap.min.css');
            echo link_tag('media/assets/global/plugins/datatables/plugins/bootstrap/select.bootstrap.min.css');
            echo link_tag('media/assets/global/plugins/material-preloader/css/materialPreloader.min.css');
            echo link_tag('media/assets/global/plugins/material-preloader/css/loader.css');
            echo link_tag('media/assets/global/plugins/sweetalert/sweetalert.css');
            echo link_tag('media/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css');
            echo link_tag('media/assets/global/plugins/select2/select2.min.css');
            echo link_tag('media/assets/global/plugins/uniform/css/uniform.default.min.css');
            echo link_tag('media/assets/global/css/components-md.css');
            echo link_tag('media/assets/global/css/plugins-md.css');
            echo link_tag('media/assets/admin/layout2/css/layout.css');
            echo link_tag('media/assets/admin/layout2/css/themes/grey.css');
            echo link_tag('media/assets/admin/layout2/css/custom.css');
            echo link_tag('media/css/more.css');

            echo script_tag(['media/assets/global/plugins/jquery.min.js',
                             'media/assets/global/plugins/jquery-migrate.min.js'
                        ]);
        ?>
    </head>
    <style type="text/css">
        .page-footer{background: linear-gradient(to left, #17B9DC,#fff, #fff)}
        .scroll-to-top > i{margin-bottom: 40px}
    </style>
    <body class="page-md page-sidebar-closed-hide-logo page-container-bg-solid page-sidebar-closed-hide-logo page-header-fixed">
        <?php 
            if($jenis_page == 'select_prefillage') {
                $this->load->view('select_prefillage'); 
            } else {
                $this->load->view($jenis_page.'load'); 
            }
        
        echo script_tag(['media/assets/global/plugins/bootstrap/js/bootstrap.min.js',
                        'media/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js',
                        'media/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.min.js',
                        'media/assets/global/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js',
                        'media/assets/global/plugins/datatables/plugins/bootstrap/responsive.bootstrap.min.js',
                        'media/assets/global/plugins/datatables/plugins/bootstrap/dataTables.select.min.js',
                        'media/assets/global/plugins/material-preloader/js/materialPreloader.min.js',
                        'media/assets/global/plugins/sweetalert/sweetalert.min.js',
                        'media/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
                        'media/assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.id.min.js',
                        'media/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js',
                        'media/assets/global/plugins/select2/select2.full.min.js',
                        //'media/assets/global/plugins/uniform/jquery.uniform.min.js',
                        'media/assets/global/plugins/select2/i18n/id.js',
                        'media/assets/global/scripts/metronic.js',
                        'media/assets/admin/layout2/scripts/layout.js'
                        ]);
        ?>
        <script>
            $(document).ready(function() {    
               Metronic.init();
               Layout.init();
            });
        </script>
    </body>
</html>

