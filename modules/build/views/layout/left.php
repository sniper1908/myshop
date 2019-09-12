				<?php
					use classes\Helper;
					use classes\Url;
					extract($this->params);
				?>
				<div class="sidebar" id="sidebar">
					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
					</script>

					<div class="sidebar-shortcuts" id="sidebar-shortcuts">
						<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
							<button class="btn btn-success">
								<i class="icon-signal"></i>
							</button>

							<button class="btn btn-info">
								<i class="icon-pencil"></i>
							</button>

							<button class="btn btn-warning">
								<i class="icon-group"></i>
							</button>

							<button class="btn btn-danger">
								<i class="icon-cogs"></i>
							</button>
						</div>

						<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
							<span class="btn btn-success"></span>

							<span class="btn btn-info"></span>

							<span class="btn btn-warning"></span>

							<span class="btn btn-danger"></span>
						</div>
					</div><!-- #sidebar-shortcuts -->

					<ul class="nav nav-list tab-content">
						<li class="<?= $this->params['controller'] == 'index' ? 'active' : ''?>" data-id="index">
							<a class="dropdown-toggle" href="<?=Url::makeUrl('index/index')?>">
								<i class="fa fa-dashboard"></i>
								<span class="menu-text"> 控制台 </span>
								<b class="arrow icon-angle-down"></b>
							</a>
							<ul class="submenu" style="display: block;">
								<li class="<?= $this->params['controller'] == 'index' ? 'active' : ''?>" data-id="index-index">
									<a href="<?=Url::makeUrl('index/index')?>" class="dropdown-toggle">
										<i class="fa fa-bookmark-o"></i>
										<span class="menu-text">欢迎页</span>
									</a>
								</li>
								<li class="<?= $this->params['controller'] == 'model' ? 'active' : ''?>">
									<a href="<?=Url::makeUrl('modelBuild/index')?>" class="dropdown-toggle">
										<i class="fa fa-calculator"></i>
										<span class="menu-text">生成模型</span>
									</a>
								</li>
								<li class="<?= $this->params['controller'] == 'controller' ? 'active' : ''?>">
									<a href="<?=Url::makeUrl('controllerBuild/index')?>" class="dropdown-toggle">
										<i class="fa fa-building-o"></i>
										<span class="menu-text">生成控制器</span>
									</a>
								</li>
								<li class="<?= $this->params['controller'] == 'form' ? 'active' : ''?>">
									<a href="<?=Url::makeUrl('formBuild/index')?>" class="dropdown-toggle">
										<i class="fa fa-check-square-o"></i>
										<span class="menu-text">生成表单</span>
									</a>
								</li>
								<li class="<?= $this->params['controller'] == 'view' ? 'active' : ''?>">
									<a href="<?=Url::makeUrl('viewBuild/index')?>" class="dropdown-toggle">
										<i class="fa fa-camera-retro"></i>
										<span class="menu-text">生成视图</span>
									</a>
								</li>
							</ul>
						</li>
					</ul><!-- /.nav-list -->

					<div class="sidebar-collapse" id="sidebar-collapse">
						<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
					</div>

					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
						
						jQuery(function($){
						});
					</script>
				</div>