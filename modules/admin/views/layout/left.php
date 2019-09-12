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
							</ul>
						</li>

						<?php
							if(!empty($menuLeft)):
								foreach($menuLeft as $k=>$row):
						?>
						<li class="tab-pane<?=$mrpid==$row['id'] ? ' active' : '';?>" id="leftMenu<?=$row['id']?>">
							<a href="<?=$row['menu_route'] ? $row['menu_route'] : 'javascript:;'?>">
								<i class="<?=$row['json_data']['icon']?>"></i>
								<span class="menu-text"><?=$row['menu_name']?></span>
								<b class="arrow icon-angle-down"></b>
							</a>
							<?php if($row['children']):?>
							<ul class="submenu" style="display: block;">
								<?php foreach($row['children'] as $child):?>
								<li class="menu-children">
									<a href="<?=$child['menu_route'] ? $child['menu_route'] : 'javascript:;'?>">
										<i class="<?=$child['json_data']['icon']?>"></i>
										<span class="menu-text"><?=$child['menu_name']?></span>
										<b class="arrow icon-angle-down"></b>
									</a>
									<?php if(!empty($child['children'])):?>
									<ul class="submenu menu-grand" style="display: <?=$mpid==$child['id'] ? 'block' : 'none'?>;">
										<?php foreach($child['children'] as $grand):?>
										<li class="<?=$mid==$grand['id'] ? 'active' : ''?>">
											<a href="<?=Url::makeUrl($grand['menu_route'])?>" class="dropdown-toggle">
												<i class=""></i>
												<span class="menu-text"><?=$grand['menu_name']?></span>
											</a>
										</li>
										<?php endforeach;?>
									</ul>
									<?php endif;?>
								</li>
								<?php endforeach;?>
							</ul>
							<?php endif;?>
						</li>
						<?php
								endforeach;
							endif;
						?>
					</ul><!-- /.nav-list -->

					<div class="sidebar-collapse" id="sidebar-collapse">
						<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
					</div>

					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
						$('.menu-children').each(function(){
							var that = $(this);
							that.click(function(){
								var grandMenu = that.find('.menu-grand').eq(0);
								if (grandMenu.css('display')=='none') {
									grandMenu.css('display','block');
								} else {
									grandMenu.css('display','none');
								}
							})
						});
						jQuery(function($){
						});
					</script>
				</div>