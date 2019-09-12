				<?php
					use classes\Web;
					use classes\Helper;
					use classes\Url;
					extract($this->params);
					$btnAction = '';
					$btnAction = (isset($this->params['action']) && $this->params['action']=='index') ? 'add' : 'index';
				?>
				<div class="main-content">
				
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<!-- 面包屑导航 -->
						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?=Url::makeUrl($this->params['module'].'/index/index')?>">首页</a>
							</li>
							<?php if(isset($this->params['page_title'])):?>
							<li class="active"><?=$this->params['page_title']?></li>
							<?php endif;?>
						</ul><!-- .breadcrumb -->

						<!-- 搜索框 -->
						<div class="nav-search" id="nav-search">
							<form class="form-search" action="<?=Url::makeUrl($this->params['module'].'/'.$this->params['controller'].'/search')?>">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="icon-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- #nav-search -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								控制台
								<small>
									<i class="icon-double-angle-right"></i>
									 查看
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<!-- 警告框 -->
								<div class="alert alert-block alert-success">
									<button type="button" class="close" data-dismiss="alert">
										<i class="icon-remove"></i>
									</button>

									<i class="icon-ok green"></i>

									欢迎使用
									<strong class="green">
										Ace后台管理系统
										<small>(v1.2)</small>
									</strong>
									,轻量级好用的后台管理系统模版.	
								</div>

								<!-- 主体内容开始 -->
								<div class="row">
									<div class="col-sm-12">
										<?php if($btnAction!='index'):?>										
										<link rel="stylesheet" href="<?=STATICS_PUBLIC_CSS_DIR?>select2.css" />
										<?php endif;?>
										<?php if($bBtnTitle):?>	
										<p>
											<a href="<?=Url::makeUrl($this->params['module'].'/'.$this->params['controller'].'/'.$btnAction)?>" class="btn btn-success"><?=$this->params['action']=='index' ? '新增数据' : '返回列表'?></a>
										</p>
										<?php endif;?>
										<div class="widget-box transparent">
											<div class="widget-header widget-header-flat">
												<h4 class="lighter">
													<i class="icon-star orange"></i>
													<?=isset($this->params['page_title']) ? $this->params['page_title'] : '详情'?>
												</h4>
											</div>
										</div><!-- widget-box -->
										<?php if(isset($this->params['action']) && $this->params['action'] != 'index'):?>
										<div class="space-24"></div>
										<?php endif;?>
										<?php
											if(Web::app()->Session->hasFlash('error')):
												Web::app()->Session->getFlash('error');
											endif;
										?>
									