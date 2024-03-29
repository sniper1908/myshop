				<?php
					use classes\Helper;
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

					<ul class="nav nav-list">
						<li class="<?= $this->params['controller'] == 'index' ? 'active' : ''?>" data-id="index">
							<a class="dropdown-toggle" href="<?=Helper::U('admin/index/index')?>">
								<i class="fa fa-dashboard"></i>
								<span class="menu-text"> 控制台 </span>
								<b class="arrow icon-angle-down"></b>
							</a>
							<ul class="submenu" style="display: block;">
								<li class="<?= $this->params['controller'] == 'index' ? 'active' : ''?>" data-id="index-index">
									<a href="<?=Helper::U('admin/index/index')?>" class="dropdown-toggle">
										<i class="fa fa-bookmark-o"></i>
										<span class="menu-text">欢迎页</span>
									</a>
								</li>
							</ul>
						</li>

						<li class="" data-parent-li="sys">
							<!-- <a href="<?//=Helper::U('admin/sys/index')?>" class="dropdown-toggle"> -->
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
											<a href="<?=Helper::U('admin/sysMenu/index')?>" class="dropdown-toggle">
												<i class=""></i>
												<span class="menu-text">菜单</span>
											</a>
										</li>
										<li data-click-li="menuClickLi" data-parent="sysAdmin" data-controller="sysRoute">
											<a href="<?=Helper::U('admin/sysRoute/index')?>" class="dropdown-toggle">
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
						</li>

						<li>
							<a href="typography.html">
								<i class="icon-text-width"></i>
								<span class="menu-text"> 文字排版 </span>
							</a>
						</li>

						<li>
							<a href="#" class="dropdown-toggle">
								<i class="icon-desktop"></i>
								<span class="menu-text"> UI 组件 </span>

								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu">
								<li>
									<a href="elements.html">
										<i class="icon-double-angle-right"></i>
										组件
									</a>
								</li>

								<li>
									<a href="buttons.html">
										<i class="icon-double-angle-right"></i>
										按钮 &amp; 图表
									</a>
								</li>

								<li>
									<a href="treeview.html">
										<i class="icon-double-angle-right"></i>
										树菜单
									</a>
								</li>

								<li>
									<a href="jquery-ui.html">
										<i class="icon-double-angle-right"></i>
										jQuery UI
									</a>
								</li>

								<li>
									<a href="nestable-list.html">
										<i class="icon-double-angle-right"></i>
										可拖拽列表
									</a>
								</li>

								<li>
									<a href="#" class="dropdown-toggle">
										<i class="icon-double-angle-right"></i>

										三级菜单
										<b class="arrow icon-angle-down"></b>
									</a>

									<ul class="submenu">
										<li>
											<a href="#">
												<i class="icon-leaf"></i>
												第一级
											</a>
										</li>

										<li>
											<a href="#" class="dropdown-toggle">
												<i class="icon-pencil"></i>

												第四级
												<b class="arrow icon-angle-down"></b>
											</a>

											<ul class="submenu">
												<li>
													<a href="#">
														<i class="icon-plus"></i>
														添加产品
													</a>
												</li>

												<li>
													<a href="#">
														<i class="icon-eye-open"></i>
														查看商品
													</a>
												</li>
											</ul>
										</li>
									</ul>
								</li>
							</ul>
						</li>

						<li>
							<a href="#" class="dropdown-toggle">
								<i class="icon-list"></i>
								<span class="menu-text"> 表格 </span>

								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu">
								<li>
									<a href="tables.html">
										<i class="icon-double-angle-right"></i>
										简单 &amp; 动态
									</a>
								</li>

								<li>
									<a href="jqgrid.html">
										<i class="icon-double-angle-right"></i>
										jqGrid plugin
									</a>
								</li>
							</ul>
						</li>

						<li>
							<a href="#" class="dropdown-toggle">
								<i class="icon-edit"></i>
								<span class="menu-text"> 表单 </span>

								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu">
								<li>
									<a href="form-elements.html">
										<i class="icon-double-angle-right"></i>
										表单组件
									</a>
								</li>

								<li>
									<a href="form-wizard.html">
										<i class="icon-double-angle-right"></i>
										向导提示 &amp; 验证
									</a>
								</li>

								<li>
									<a href="wysiwyg.html">
										<i class="icon-double-angle-right"></i>
										编辑器
									</a>
								</li>

								<li>
									<a href="dropzone.html">
										<i class="icon-double-angle-right"></i>
										文件上传
									</a>
								</li>
							</ul>
						</li>

						<li>
							<a href="widgets.html">
								<i class="icon-list-alt"></i>
								<span class="menu-text"> 插件 </span>
							</a>
						</li>

						<li>
							<a href="calendar.html">
								<i class="icon-calendar"></i>

								<span class="menu-text">
									日历
									<span class="badge badge-transparent tooltip-error" title="2&nbsp;Important&nbsp;Events">
										<i class="icon-warning-sign red bigger-130"></i>
									</span>
								</span>
							</a>
						</li>

						<li>
							<a href="gallery.html">
								<i class="icon-picture"></i>
								<span class="menu-text"> 相册 </span>
							</a>
						</li>

						<li>
							<a href="#" class="dropdown-toggle">
								<i class="icon-tag"></i>
								<span class="menu-text"> 更多页面 </span>

								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu">
								<li>
									<a href="profile.html">
										<i class="icon-double-angle-right"></i>
										用户信息
									</a>
								</li>

								<li>
									<a href="inbox.html">
										<i class="icon-double-angle-right"></i>
										收件箱
									</a>
								</li>

								<li>
									<a href="pricing.html">
										<i class="icon-double-angle-right"></i>
										售价单
									</a>
								</li>

								<li>
									<a href="invoice.html">
										<i class="icon-double-angle-right"></i>
										购物车
									</a>
								</li>

								<li>
									<a href="timeline.html">
										<i class="icon-double-angle-right"></i>
										时间轴
									</a>
								</li>

								<li>
									<a href="login.html">
										<i class="icon-double-angle-right"></i>
										登录 &amp; 注册
									</a>
								</li>
							</ul>
						</li>

						<li>
							<a href="#" class="dropdown-toggle">
								<i class="icon-file-alt"></i>

								<span class="menu-text">
									其他页面
									<span class="badge badge-primary ">5</span>
								</span>

								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu">
								<li>
									<a href="faq.html">
										<i class="icon-double-angle-right"></i>
										帮助
									</a>
								</li>

								<li>
									<a href="error-404.html">
										<i class="icon-double-angle-right"></i>
										404错误页面
									</a>
								</li>

								<li>
									<a href="error-500.html">
										<i class="icon-double-angle-right"></i>
										500错误页面
									</a>
								</li>

								<li>
									<a href="grid.html">
										<i class="icon-double-angle-right"></i>
										网格
									</a>
								</li>

								<li>
									<a href="blank.html">
										<i class="icon-double-angle-right"></i>
										空白页面
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

							// 菜单项点击更改active
							$("li[data-click-li=menuClickLi]").each(function(idx,ele){
								var that = $(this);
								var controller = "<?=$this->params['controller']?>";
								//alert(controller);
								var thatParentName = that.attr('data-parent');
								var parent = $("li[data-parent-li="+thatParentName+"]");
								var grandParentName = parent.attr('data-parent');
								var grandParent = $("li[data-parent-li="+grandParentName+"]");
								if (that.attr('data-controller') == controller) {
									that.attr('class','active');
									parent.attr('class','active');
									grandParent.attr('class','active');
								} else {
									that.attr('class','');
									// parent.attr('class','active');
									// grandParent.attr('class','active');
								}
							});

						});
					</script>
				</div>