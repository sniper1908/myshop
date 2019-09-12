										<?php
											use classes\Url;
										?>
										<p>
											<a href="<?=Url::makeUrl($this->params['module'].'/'.$this->params['controller'].'/add')?>" class="btn btn-success">新增菜单</a>
										</p>
										<div class="widget-box transparent">
											<div class="widget-header widget-header-flat">
												<h4 class="lighter">
													<i class="icon-star orange"></i>
													<?=$this->params['page_title']?>
												</h4>

												<!-- <div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="icon-chevron-up"></i>
													</a>
												</div> -->
											</div>
										</div><!-- widget-box -->
										<div class="row">
											<div class="col-xs-12">
												<!-- <h4 class="header smaller lighter blue">
													<i class="icon-star orange"></i>
													<?=$this->params['page_title']?>
												</h4> -->
												<div class="table-header">
													<?=$this->params['page_title']?>列表
												</div>

												<div class="table-responsive">
													<table id="sample-table-2" class="table table-striped table-bordered table-hover">
														<thead>
															<tr>
																<th class="center">
																	<label>
																		<input type="checkbox" class="ace" />
																		<span class="lbl"></span>
																	</label>
																</th>
																<th>名称</th>
																<th>父级</th>
																<th class="hidden-480">路由</th>

																<th>
																	<i class="icon-time bigger-110 hidden-480"></i>
																	排序
																</th>

																<th></th>
															</tr>
														</thead>

														<tbody>
															<tr>
																<td class="center">
																	<label>
																		<input type="checkbox" class="ace" />
																		<span class="lbl"></span>
																	</label>
																</td>

																<td>
																	<a href="#">系统</a>
																</td>
																<td>未设置</td>
																<td class="hidden-480">未设置</td>
																<td>1</td>

																<td>
																	<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
																		<a class="blue" href="#">
																			<i class="icon-zoom-in bigger-130"></i>
																		</a>

																		<a class="green" href="#">
																			<i class="icon-pencil bigger-130"></i>
																		</a>

																		<a class="red" href="#">
																			<i class="icon-trash bigger-130"></i>
																		</a>
																	</div>

																	<div class="visible-xs visible-sm hidden-md hidden-lg">
																		<div class="inline position-relative">
																			<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
																				<i class="icon-caret-down icon-only bigger-120"></i>
																			</button>

																			<ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
																				<li>
																					<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																						<span class="blue">
																							<i class="icon-zoom-in bigger-120"></i>
																						</span>
																					</a>
																				</li>

																				<li>
																					<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																						<span class="green">
																							<i class="icon-edit bigger-120"></i>
																						</span>
																					</a>
																				</li>

																				<li>
																					<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																						<span class="red">
																							<i class="icon-trash bigger-120"></i>
																						</span>
																					</a>
																				</li>
																			</ul>
																		</div>
																	</div>
																</td>
															</tr>

															<tr>
																<td class="center">
																	<label>
																		<input type="checkbox" class="ace" />
																		<span class="lbl"></span>
																	</label>
																</td>

																<td>
																	<a href="#">系统管理</a>
																</td>
																<td>系统</td>
																<td class="hidden-480">未设置</td>
																<td>2</td>

																<td>
																	<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
																		<a class="blue" href="#">
																			<i class="icon-zoom-in bigger-130"></i>
																		</a>

																		<a class="green" href="#">
																			<i class="icon-pencil bigger-130"></i>
																		</a>

																		<a class="red" href="#">
																			<i class="icon-trash bigger-130"></i>
																		</a>
																	</div>

																	<div class="visible-xs visible-sm hidden-md hidden-lg">
																		<div class="inline position-relative">
																			<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
																				<i class="icon-caret-down icon-only bigger-120"></i>
																			</button>

																			<ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
																				<li>
																					<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																						<span class="blue">
																							<i class="icon-zoom-in bigger-120"></i>
																						</span>
																					</a>
																				</li>

																				<li>
																					<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																						<span class="green">
																							<i class="icon-edit bigger-120"></i>
																						</span>
																					</a>
																				</li>

																				<li>
																					<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																						<span class="red">
																							<i class="icon-trash bigger-120"></i>
																						</span>
																					</a>
																				</li>
																			</ul>
																		</div>
																	</div>
																</td>
															</tr>

															<tr>
																<td class="center">
																	<label>
																		<input type="checkbox" class="ace" />
																		<span class="lbl"></span>
																	</label>
																</td>

																<td>
																	<a href="#">菜单</a>
																</td>
																<td>系统管理</td>
																<td class="hidden-480">admin/sysMenu/index</td>
																<td>3</td>

																<td>
																	<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
																		<a class="blue" href="#">
																			<i class="icon-zoom-in bigger-130"></i>
																		</a>

																		<a class="green" href="#">
																			<i class="icon-pencil bigger-130"></i>
																		</a>

																		<a class="red" href="#">
																			<i class="icon-trash bigger-130"></i>
																		</a>
																	</div>

																	<div class="visible-xs visible-sm hidden-md hidden-lg">
																		<div class="inline position-relative">
																			<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
																				<i class="icon-caret-down icon-only bigger-120"></i>
																			</button>

																			<ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
																				<li>
																					<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																						<span class="blue">
																							<i class="icon-zoom-in bigger-120"></i>
																						</span>
																					</a>
																				</li>

																				<li>
																					<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																						<span class="green">
																							<i class="icon-edit bigger-120"></i>
																						</span>
																					</a>
																				</li>

																				<li>
																					<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																						<span class="red">
																							<i class="icon-trash bigger-120"></i>
																						</span>
																					</a>
																				</li>
																			</ul>
																		</div>
																	</div>
																</td>
															</tr>

															<tr>
																<td class="center">
																	<label>
																		<input type="checkbox" class="ace" />
																		<span class="lbl"></span>
																	</label>
																</td>

																<td>
																	<a href="#">路由</a>
																</td>
																<td>系统管理</td>
																<td class="hidden-480">admin/sysRoute/index</td>
																<td>4</td>

																<td>
																	<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
																		<a class="blue" href="#">
																			<i class="icon-zoom-in bigger-130"></i>
																		</a>

																		<a class="green" href="#">
																			<i class="icon-pencil bigger-130"></i>
																		</a>

																		<a class="red" href="#">
																			<i class="icon-trash bigger-130"></i>
																		</a>
																	</div>

																	<div class="visible-xs visible-sm hidden-md hidden-lg">
																		<div class="inline position-relative">
																			<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
																				<i class="icon-caret-down icon-only bigger-120"></i>
																			</button>

																			<ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
																				<li>
																					<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																						<span class="blue">
																							<i class="icon-zoom-in bigger-120"></i>
																						</span>
																					</a>
																				</li>

																				<li>
																					<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																						<span class="green">
																							<i class="icon-edit bigger-120"></i>
																						</span>
																					</a>
																				</li>

																				<li>
																					<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																						<span class="red">
																							<i class="icon-trash bigger-120"></i>
																						</span>
																					</a>
																				</li>
																			</ul>
																		</div>
																	</div>
																</td>
															</tr>

															<tr>
																<td class="center">
																	<label>
																		<input type="checkbox" class="ace" />
																		<span class="lbl"></span>
																	</label>
																</td>

																<td>
																	<a href="#">权限管理</a>
																</td>
																<td>系统</td>
																<td class="hidden-480">未设置</td>
																<td>5</td>

																<td>
																	<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
																		<a class="blue" href="#">
																			<i class="icon-zoom-in bigger-130"></i>
																		</a>

																		<a class="green" href="#">
																			<i class="icon-pencil bigger-130"></i>
																		</a>

																		<a class="red" href="#">
																			<i class="icon-trash bigger-130"></i>
																		</a>
																	</div>

																	<div class="visible-xs visible-sm hidden-md hidden-lg">
																		<div class="inline position-relative">
																			<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
																				<i class="icon-caret-down icon-only bigger-120"></i>
																			</button>

																			<ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
																				<li>
																					<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																						<span class="blue">
																							<i class="icon-zoom-in bigger-120"></i>
																						</span>
																					</a>
																				</li>

																				<li>
																					<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																						<span class="green">
																							<i class="icon-edit bigger-120"></i>
																						</span>
																					</a>
																				</li>

																				<li>
																					<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																						<span class="red">
																							<i class="icon-trash bigger-120"></i>
																						</span>
																					</a>
																				</li>
																			</ul>
																		</div>
																	</div>
																</td>
															</tr>

															<tr>
																<td class="center">
																	<label>
																		<input type="checkbox" class="ace" />
																		<span class="lbl"></span>
																	</label>
																</td>

																<td>
																	<a href="#">权限</a>
																</td>
																<td>权限管理</td>
																<td class="hidden-480">admin/sysRoute/index</td>
																<td>6</td>

																<td>
																	<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
																		<a class="blue" href="#">
																			<i class="icon-zoom-in bigger-130"></i>
																		</a>

																		<a class="green" href="#">
																			<i class="icon-pencil bigger-130"></i>
																		</a>

																		<a class="red" href="#">
																			<i class="icon-trash bigger-130"></i>
																		</a>
																	</div>

																	<div class="visible-xs visible-sm hidden-md hidden-lg">
																		<div class="inline position-relative">
																			<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
																				<i class="icon-caret-down icon-only bigger-120"></i>
																			</button>

																			<ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
																				<li>
																					<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																						<span class="blue">
																							<i class="icon-zoom-in bigger-120"></i>
																						</span>
																					</a>
																				</li>

																				<li>
																					<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																						<span class="green">
																							<i class="icon-edit bigger-120"></i>
																						</span>
																					</a>
																				</li>

																				<li>
																					<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																						<span class="red">
																							<i class="icon-trash bigger-120"></i>
																						</span>
																					</a>
																				</li>
																			</ul>
																		</div>
																	</div>
																</td>
															</tr>

															<tr>
																<td class="center">
																	<label>
																		<input type="checkbox" class="ace" />
																		<span class="lbl"></span>
																	</label>
																</td>

																<td>
																	<a href="#">角色</a>
																</td>
																<td>权限管理</td>
																<td class="hidden-480">admin/sysRoute/index</td>
																<td>7</td>

																<td>
																	<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
																		<a class="blue" href="#">
																			<i class="icon-zoom-in bigger-130"></i>
																		</a>

																		<a class="green" href="#">
																			<i class="icon-pencil bigger-130"></i>
																		</a>

																		<a class="red" href="#">
																			<i class="icon-trash bigger-130"></i>
																		</a>
																	</div>

																	<div class="visible-xs visible-sm hidden-md hidden-lg">
																		<div class="inline position-relative">
																			<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
																				<i class="icon-caret-down icon-only bigger-120"></i>
																			</button>

																			<ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
																				<li>
																					<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																						<span class="blue">
																							<i class="icon-zoom-in bigger-120"></i>
																						</span>
																					</a>
																				</li>

																				<li>
																					<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																						<span class="green">
																							<i class="icon-edit bigger-120"></i>
																						</span>
																					</a>
																				</li>

																				<li>
																					<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																						<span class="red">
																							<i class="icon-trash bigger-120"></i>
																						</span>
																					</a>
																				</li>
																			</ul>
																		</div>
																	</div>
																</td>
															</tr>

															<tr>
																<td class="center">
																	<label>
																		<input type="checkbox" class="ace" />
																		<span class="lbl"></span>
																	</label>
																</td>

																<td>
																	<a href="#">授权</a>
																</td>
																<td>权限管理</td>
																<td class="hidden-480">admin/sysRoute/index</td>
																<td>8</td>

																<td>
																	<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
																		<a class="blue" href="#">
																			<i class="icon-zoom-in bigger-130"></i>
																		</a>

																		<a class="green" href="#">
																			<i class="icon-pencil bigger-130"></i>
																		</a>

																		<a class="red" href="#">
																			<i class="icon-trash bigger-130"></i>
																		</a>
																	</div>

																	<div class="visible-xs visible-sm hidden-md hidden-lg">
																		<div class="inline position-relative">
																			<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
																				<i class="icon-caret-down icon-only bigger-120"></i>
																			</button>

																			<ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
																				<li>
																					<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																						<span class="blue">
																							<i class="icon-zoom-in bigger-120"></i>
																						</span>
																					</a>
																				</li>

																				<li>
																					<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																						<span class="green">
																							<i class="icon-edit bigger-120"></i>
																						</span>
																					</a>
																				</li>

																				<li>
																					<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																						<span class="red">
																							<i class="icon-trash bigger-120"></i>
																						</span>
																					</a>
																				</li>
																			</ul>
																		</div>
																	</div>
																</td>
															</tr>

															<tr>
																<td class="center">
																	<label>
																		<input type="checkbox" class="ace" />
																		<span class="lbl"></span>
																	</label>
																</td>

																<td>
																	<a href="#">账户管理</a>
																</td>
																<td>系统</td>
																<td class="hidden-480">未设置</td>
																<td>9</td>

																<td>
																	<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
																		<a class="blue" href="#">
																			<i class="icon-zoom-in bigger-130"></i>
																		</a>

																		<a class="green" href="#">
																			<i class="icon-pencil bigger-130"></i>
																		</a>

																		<a class="red" href="#">
																			<i class="icon-trash bigger-130"></i>
																		</a>
																	</div>

																	<div class="visible-xs visible-sm hidden-md hidden-lg">
																		<div class="inline position-relative">
																			<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
																				<i class="icon-caret-down icon-only bigger-120"></i>
																			</button>

																			<ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
																				<li>
																					<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																						<span class="blue">
																							<i class="icon-zoom-in bigger-120"></i>
																						</span>
																					</a>
																				</li>

																				<li>
																					<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																						<span class="green">
																							<i class="icon-edit bigger-120"></i>
																						</span>
																					</a>
																				</li>

																				<li>
																					<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																						<span class="red">
																							<i class="icon-trash bigger-120"></i>
																						</span>
																					</a>
																				</li>
																			</ul>
																		</div>
																	</div>
																</td>
															</tr>

															<tr>
																<td class="center">
																	<label>
																		<input type="checkbox" class="ace" />
																		<span class="lbl"></span>
																	</label>
																</td>

																<td>
																	<a href="#">管理员</a>
																</td>
																<td>账户管理</td>
																<td class="hidden-480">admin/sysAdmin/index</td>
																<td>10</td>

																<td>
																	<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
																		<a class="blue" href="#">
																			<i class="icon-zoom-in bigger-130"></i>
																		</a>

																		<a class="green" href="#">
																			<i class="icon-pencil bigger-130"></i>
																		</a>

																		<a class="red" href="#">
																			<i class="icon-trash bigger-130"></i>
																		</a>
																	</div>

																	<div class="visible-xs visible-sm hidden-md hidden-lg">
																		<div class="inline position-relative">
																			<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
																				<i class="icon-caret-down icon-only bigger-120"></i>
																			</button>

																			<ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
																				<li>
																					<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																						<span class="blue">
																							<i class="icon-zoom-in bigger-120"></i>
																						</span>
																					</a>
																				</li>

																				<li>
																					<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																						<span class="green">
																							<i class="icon-edit bigger-120"></i>
																						</span>
																					</a>
																				</li>

																				<li>
																					<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																						<span class="red">
																							<i class="icon-trash bigger-120"></i>
																						</span>
																					</a>
																				</li>
																			</ul>
																		</div>
																	</div>
																</td>
															</tr>

															<tr>
																<td class="center">
																	<label>
																		<input type="checkbox" class="ace" />
																		<span class="lbl"></span>
																	</label>
																</td>

																<td>
																	<a href="#">站点</a>
																</td>
																<td>未设置</td>
																<td class="hidden-480">未设置</td>
																<td>11</td>

																<td>
																	<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
																		<a class="blue" href="#">
																			<i class="icon-zoom-in bigger-130"></i>
																		</a>

																		<a class="green" href="#">
																			<i class="icon-pencil bigger-130"></i>
																		</a>

																		<a class="red" href="#">
																			<i class="icon-trash bigger-130"></i>
																		</a>
																	</div>

																	<div class="visible-xs visible-sm hidden-md hidden-lg">
																		<div class="inline position-relative">
																			<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
																				<i class="icon-caret-down icon-only bigger-120"></i>
																			</button>

																			<ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
																				<li>
																					<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																						<span class="blue">
																							<i class="icon-zoom-in bigger-120"></i>
																						</span>
																					</a>
																				</li>

																				<li>
																					<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																						<span class="green">
																							<i class="icon-edit bigger-120"></i>
																						</span>
																					</a>
																				</li>

																				<li>
																					<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																						<span class="red">
																							<i class="icon-trash bigger-120"></i>
																						</span>
																					</a>
																				</li>
																			</ul>
																		</div>
																	</div>
																</td>
															</tr>

															<tr>
																<td class="center">
																	<label>
																		<input type="checkbox" class="ace" />
																		<span class="lbl"></span>
																	</label>
																</td>

																<td>
																	<a href="#">模板管理</a>
																</td>
																<td>站点</td>
																<td class="hidden-480">admin/sysRoute/index</td>
																<td>12</td>

																<td>
																	<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
																		<a class="blue" href="#">
																			<i class="icon-zoom-in bigger-130"></i>
																		</a>

																		<a class="green" href="#">
																			<i class="icon-pencil bigger-130"></i>
																		</a>

																		<a class="red" href="#">
																			<i class="icon-trash bigger-130"></i>
																		</a>
																	</div>

																	<div class="visible-xs visible-sm hidden-md hidden-lg">
																		<div class="inline position-relative">
																			<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
																				<i class="icon-caret-down icon-only bigger-120"></i>
																			</button>

																			<ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
																				<li>
																					<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																						<span class="blue">
																							<i class="icon-zoom-in bigger-120"></i>
																						</span>
																					</a>
																				</li>

																				<li>
																					<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																						<span class="green">
																							<i class="icon-edit bigger-120"></i>
																						</span>
																					</a>
																				</li>

																				<li>
																					<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																						<span class="red">
																							<i class="icon-trash bigger-120"></i>
																						</span>
																					</a>
																				</li>
																			</ul>
																		</div>
																	</div>
																</td>
															</tr>

															<tr>
																<td class="center">
																	<label>
																		<input type="checkbox" class="ace" />
																		<span class="lbl"></span>
																	</label>
																</td>

																<td>
																	<a href="#">模板</a>
																</td>
																<td>模板管理</td>
																<td class="hidden-480">admin/sysRoute/index</td>
																<td>13</td>

																<td>
																	<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
																		<a class="blue" href="#">
																			<i class="icon-zoom-in bigger-130"></i>
																		</a>

																		<a class="green" href="#">
																			<i class="icon-pencil bigger-130"></i>
																		</a>

																		<a class="red" href="#">
																			<i class="icon-trash bigger-130"></i>
																		</a>
																	</div>

																	<div class="visible-xs visible-sm hidden-md hidden-lg">
																		<div class="inline position-relative">
																			<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
																				<i class="icon-caret-down icon-only bigger-120"></i>
																			</button>

																			<ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
																				<li>
																					<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																						<span class="blue">
																							<i class="icon-zoom-in bigger-120"></i>
																						</span>
																					</a>
																				</li>

																				<li>
																					<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																						<span class="green">
																							<i class="icon-edit bigger-120"></i>
																						</span>
																					</a>
																				</li>

																				<li>
																					<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																						<span class="red">
																							<i class="icon-trash bigger-120"></i>
																						</span>
																					</a>
																				</li>
																			</ul>
																		</div>
																	</div>
																</td>
															</tr>

														</tbody>
													</table>
												</div>
											</div>
										</div>

										<script src="<?=STATICS_PUBLIC_JS_DIR?>jquery.dataTables.min.js"></script>
										<script src="<?=STATICS_PUBLIC_JS_DIR?>jquery.dataTables.bootstrap.js"></script>
										<script type="text/javascript">
											jQuery(function($) {
												var oTable1 = $('#sample-table-2').dataTable( {
													"aoColumns": [
												      { "bSortable": false },
												      null, null,null, null, 
													  { "bSortable": false }
													] 
												} );
												
												
												$('table th input:checkbox').on('click' , function(){
													var that = this;
													$(this).closest('table').find('tr > td:first-child input:checkbox')
													.each(function(){
														this.checked = that.checked;
														$(this).closest('tr').toggleClass('selected');
													});
														
												});
											
											
												$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
												function tooltip_placement(context, source) {
													var $source = $(source);
													var $parent = $source.closest('table')
													var off1 = $parent.offset();
													var w1 = $parent.width();
											
													var off2 = $source.offset();
													var w2 = $source.width();
											
													if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
													return 'left';
												}
											})
										</script>