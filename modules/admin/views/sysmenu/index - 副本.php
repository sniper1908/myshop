										<?php
											use classes\Helper;
										?>
										<p>
											<a href="<?=Helper::U($this->params['module'].'/'.$this->params['controller'].'/add')?>" class="btn btn-success">新增菜单</a>
										</p>
										<div class="widget-box transparent">
											<div class="widget-header widget-header-flat">
												<h4 class="lighter">
													<i class="icon-star orange"></i>
													<?=$this->params['page_title']?>
												</h4>

												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="icon-chevron-up"></i>
													</a>
												</div>
											</div>

											<div class="widget-body">
												<div class="widget-main no-padding">
													<table class="table table-bordered table-striped">
														<thead class="thin-border-bottom">
															<tr>
																<th>
																	<i class="icon-caret-right blue"></i>
																	ID
																</th>

																<th>
																	<i class="icon-caret-right blue"></i>
																	名称
																</th>

																<th>
																	<i class="icon-caret-right blue"></i>
																	路由
																</th>

																<th>
																	<i class="icon-caret-right blue"></i>
																	父级
																</th>

																<th>
																	<i class="icon-caret-right blue"></i>
																	排序
																</th>

																<th class="hidden-480">
																	<i class="icon-caret-right blue"></i>
																	状态
																</th>
															</tr>
														</thead>

														<tbody>
															<tr>
																<td>1</td>

																<td>
																	<small>
																		<s class="red">$29.99</s>
																	</small>
																	<b class="green">系统</b>
																</td>

																<td>
																	<b class="green">未设置</b>
																</td>

																<td>
																	<b class="green">未设置</b>
																</td>

																<td>
																	<b class="green">1</b>
																</td>

																<td class="hidden-480">
																	<a href="" title="查看" aria-label="查看" data-pjax=0>
																		<span class="fa fa-eye fa-fw"></span>
																	</a>
																	<a href="" title="编辑" aria-label="编辑" data-pjax=0>
																		<span class="fa fa-pencil fa-fw"></span>
																	</a>
																	<a href="" title="删除" aria-label="删除" data-pjax=0>
																		<span class="fa fa-trash-o fa-fw"></span>
																	</a>
																</td>
															</tr>
															<tr>
																<td>2</td>

																<td>系统管理</td>

																<td>系统</td>

																<td>未设置</td>

																<td>2</td>

																<td class="hidden-480">
																	<span class="label label-info arrowed-right arrowed-in">销售中</span>
																</td>
															</tr>
															<tr>
																<td>3</td>

																<td>菜单</td>

																<td>系统管理</td>

																<td>admin/sysMenu/index</td>

																<td>2</td>

																<td class="hidden-480">
																	<span class="label label-info arrowed-right arrowed-in">销售中</span>
																</td>
															</tr>
															<tr>
																<td>4</td>

																<td>路由</td>

																<td>系统管理</td>

																<td>admin/sysRoute/index</td>

																<td>2</td>

																<td class="hidden-480">
																	<span class="label label-info arrowed-right arrowed-in">销售中</span>
																</td>
															</tr>
															<tr>
																<td>5</td>

																<td>权限管理</td>

																<td>系统</td>

																<td>未设置</td>

																<td>1</td>

																<td class="hidden-480">
																	<span class="label label-info arrowed-right arrowed-in">销售中</span>
																</td>
															</tr>
															<tr>
																<td>6</td>

																<td>权限</td>

																<td>权限管理</td>

																<td>admin/sysRoute/index</td>

																<td>2</td>

																<td class="hidden-480">
																	<span class="label label-info arrowed-right arrowed-in">销售中</span>
																</td>
															</tr>
															<tr>
																<td>7</td>

																<td>角色</td>

																<td>权限管理</td>

																<td>admin/sysRoute/index</td>

																<td>2</td>

																<td class="hidden-480">
																	<span class="label label-info arrowed-right arrowed-in">销售中</span>
																</td>
															</tr>
															<tr>
																<td>8</td>

																<td>授权</td>

																<td>权限管理</td>

																<td>admin/sysRoute/index</td>

																<td>2</td>

																<td class="hidden-480">
																	<span class="label label-info arrowed-right arrowed-in">销售中</span>
																</td>
															</tr>
															<tr>
																<td>9</td>

																<td>账户管理</td>

																<td>系统</td>

																<td>未设置</td>

																<td>2</td>

																<td class="hidden-480">
																	<span class="label label-info arrowed-right arrowed-in">销售中</span>
																</td>
															</tr>
															<tr>
																<td>10</td>

																<td>管理员</td>

																<td>账户管理</td>

																<td>admin/sysAdmin/index</td>

																<td>2</td>

																<td class="hidden-480">
																	<span class="label label-info arrowed-right arrowed-in">销售中</span>
																</td>
															</tr>
															<tr>
																<td>11</td>

																<td>站点</td>

																<td>未设置</td>

																<td>未设置</td>

																<td>2</td>

																<td class="hidden-480">
																	<span class="label label-info arrowed-right arrowed-in">销售中</span>
																</td>
															</tr>
															<tr>
																<td>12</td>

																<td>模板管理</td>

																<td>站点</td>

																<td>未设置</td>

																<td>3</td>

																<td class="hidden-480">
																	<span class="label label-info arrowed-right arrowed-in">销售中</span>
																</td>
															</tr>

														</tbody>
													</table>
												</div><!-- /widget-main -->
											</div><!-- /widget-body -->
										</div><!-- /widget-box -->