				<?php
					use classes\Helper;
					use classes\Url;
					// print_r($menuTree);
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
							if(!empty($menuTree)):
								foreach($menuTree as $k=>$row):
						?>
						<li class="tab-pane<?=!$k ? ' active' : '';?>" data-parent-li="sys" id="leftMenu<?=$row['id']?>">
							<a href="<?=$row['menu_route'] ? $row['menu_route'] : 'javascript:;'?>" class="dropdown-toggle1">
								<i class="<?=$row['json_data']['icon']?>"></i>
								<span class="menu-text"><?=$row['menu_name']?></span>
								<b class="arrow icon-angle-down"></b>
							</a>
							<?php if($row['children']):?>
							<ul class="submenu" style="display: block;">
								<?php foreach($row['children'] as $child):?>
								<li class="menu-children" data-parent-li="sysAdmin" data-parent="sys">
									<a href="<?=$row['menu_route'] ? $row['menu_route'] : 'javascript:;'?>" class="dropdown-toggle">
										<i class="<?=$child['json_data']['icon']?>"></i>
										<span class="menu-text"><?=$child['menu_name']?></span>
										<b class="arrow icon-angle-down"></b>
									</a>
									<?php if(!empty($child['children'])):?>
									<ul class="submenu menu-grand active">
										<?php foreach($child['children'] as $grand):?>
										<li data-click-li="menuClickLi" data-parent="sysAdmin" data-controller="sysMenu" class="">
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

						<!-- <li class="tab-pane" data-parent-li="sys" id="menu1">
							<a href="site/index" class="dropdown-toggle">
								<i class="fa fa-cogs"></i>
								<span class="menu-text">系统</span>
								<b class="arrow icon-angle-down"></b>
							</a>
							<ul class="submenu" style="display: block;">
								<li class="" data-parent-li="sysAdmin" data-parent="sys">
									<a href="/site/index" class="dropdown-toggle">
										<i class="fa fa-bars"></i>
										<span class="menu-text">系统管理</span>
										<b class="arrow icon-angle-down"></b>
									</a>
									<ul class="submenu">
										<li data-click-li="menuClickLi" data-parent="sysAdmin" data-controller="sysMenu" class="">
											<a href="<?//=Helper::U('admin/sysMenu/index')?>" class="dropdown-toggle">
												<i class=""></i>
												<span class="menu-text">菜单</span>
											</a>
										</li>
										<li data-click-li="menuClickLi" data-parent="sysAdmin" data-controller="sysRoute">
											<a href="<?//=Helper::U('admin/sysRoute/index')?>" class="dropdown-toggle">
												<i class=""></i>
												<span class="menu-text">路由</span>
											</a>
										</li>
									</ul>
								</li>

								<li data-parent-li="power" data-parent="sys">
									<a href="/site/index" class="dropdown-toggle">
										<i class="fa fa-cog"></i>
										<span class="menu-text">权限管理</span>
										<b class="arrow icon-angle-down"></b>
									</a>
									<ul class="submenu">
										<li data-click-li="menuClickLi" data-parent="power" data-controller="sysPermission">
											<a href="admin/sysPermission/index" class="dropdown-toggle">
												<i class=""></i>
												<span class="menu-text">权限</span>
											</a>
										</li>
										<li data-click-li="menuClickLi" data-parent="power" data-controller="sysRole">
											<a href="admin/sysRole/index" class="dropdown-toggle">
												<i class=""></i>
												<span class="menu-text">角色</span>
											</a>
										</li>
										<li data-click-li="menuClickLi" data-parent="power" data-controller="sysAssignment">
											<a href="/admin/sysAssignment/index" class="dropdown-toggle">
												<i class=""></i>
												<span class="menu-text">授权</span>
											</a>
										</li>
									</ul>
								</li>

								<li data-parent-li="user" data-parent="sys">
									<a href="/site/index" class="dropdown-toggle">
										<i class="fa fa-user"></i>
										<span class="menu-text">账户管理</span>
										<b class="arrow icon-angle-down"></b>
									</a>
									<ul class="submenu">
										<li data-click-li="menuClickLi" data-parent="user" data-controller="sysAdmin">
											<a href="/admin/sysAdmin/index" class="dropdown-toggle">
												<i class=""></i>
												<span class="menu-text">管理员</span>
											</a>
										</li>
									</ul>
								</li>
							</ul>
						</li> -->
					</ul><!-- /.nav-list -->

					<div class="sidebar-collapse" id="sidebar-collapse">
						<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
					</div>

					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
						jQuery(function($){

							$('.menu-children').each(function(){
								var that = $(this);
								that.click(function(){
									var grandMenu = that.find('.menu-grand').eq(0);
									grandMenu.toggle();
								})
							});

							// 菜单项点击更改active
							// $("li[data-click-li=menuClickLi]").each(function(idx,ele){
							// 	var that = $(this);
							// 	var controller = "<?=$this->params['controller']?>";
							// 	//alert(controller);
							// 	var thatParentName = that.attr('data-parent');
							// 	var parent = $("li[data-parent-li="+thatParentName+"]");
							// 	var grandParentName = parent.attr('data-parent');
							// 	var grandParent = $("li[data-parent-li="+grandParentName+"]");
							// 	if (that.attr('data-controller') == controller) {
							// 		that.attr('class','active');
							// 		parent.attr('class','active');
							// 		grandParent.attr('class','active');
							// 	} else {
							// 		that.attr('class','');
							// 		// parent.attr('class','active');
							// 		// grandParent.attr('class','active');
							// 	}
							// });

						});
					</script>
				</div>