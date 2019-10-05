<div class="page-content-wrapper">
    <div class="page-content">
        <h3 class="page-title">
            <?=$judul?> <small><?=$desc_judul?></small>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?=site_url('administrator/dashboard')?>">Home</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <?php foreach ($breadcumb as $key => $value) { ?>
                    <?php if($value['link']!='') { ?>
                    <li>
                      <i class="fa fa-<?=$value['icon']?>"></i>
                      <a href="<?=$value['link']?>"><?=$value['judul']?></a>
                      <i class="fa fa-angle-right"></i>
                  </li>
                    <?php } else { ?>
                    <li>
                      <i class="fa fa-<?=$value['icon']?>"></i> <?=$value['judul']?>
                  </li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
        <?php $this->load->view('administrator/'.$page);?>
    </div>
</div>