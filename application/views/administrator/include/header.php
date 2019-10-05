<div class="page-header md-shadow-z-1-i navbar navbar-fixed-top">
	<div class="page-header-inner">
		<div class="page-logo">
			<a href="<?=site_url()?>" class="text-center" style="margin-top:17px;text-decoration:none">
				<span class="logo-default" style="color:#fff; font-size:23px; text-decoration:none">
					<span style="font-size:18px">DATABASE</span>
					<span style="font-size:8px; color:#fff">v<?=$this->Content_m->get_value('erenstra_re_data','id','8','value')?></span>
				</span>
			</a>
			<div class="menu-toggler sidebar-toggler"></div>
		</div>
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"></a>
		<div class="page-top">
			<img src="<?=base_url()?>media/images/logo_pu_bws.jpg" style="width:300px; margin-top: 10px; margin-left: 15px">
			<div class="top-menu">
				<ul class="nav navbar-nav pull-right">

					<li class="dropdown dropdown-user">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false">
							<img alt="" class="img-circle" src="<?=base_url()?>media/assets/admin/layout2/img/avatar3_small.jpg">
							<span class="username username-hide-on-mobile">
								<?php echo ucwords(strtolower($this->session->userdata('name')))?> 
							</span>
							<i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu dropdown-menu-default">
							<?php if (!in_array(1, $this->session->userdata('id_global_hakakses'))) { ?>
							<!--
							<li>
								<a href="<?php echo site_url()?>/account/edit_profile/<?=$this->session->userdata('userid')?>">
								<i class="icon-user"></i> My Profile </a>
							</li>
							-->
							<?php } ?>
							
							<!--
							<li>
								<a href="<?php echo site_url()?>/account/lock_screen">
								<i class="icon-lock"></i> Lock Screen </a>
							</li>
							
							-->
							<li class="divider">
							</li>
							<li>
								<a href="<?php echo site_url()?>/account/logout">
								<i class="icon-key"></i> Log Out </a>
							</li>
						</ul>
					</li>
					
				</ul>
			</div>
		</div>
	</div>
</div>