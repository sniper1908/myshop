										<?php
											use classes\Web;
											use classes\Helper;
											use classes\Url;
										?>
										<form class="form-horizontal" id="formMenu" role="form" method="post" action="<?=Url::makeUrl($this->params['module'].'/'.$this->params['controller'].'/'.$this->params['action'].'&id='.$this->params['model']->id)?>">
											
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="menu-name">名称</label>

												<div class="col-sm-9">
													<div class="clearfix">
														<input type="text" name="menu[menu_name]" id="menu-name" placeholder="请输入菜单名称" class="col-xs-10 col-sm-5" value="<?=$this->params['model']->menu_name?>" />
													</div>
												</div>
											</div>

											<div class="space-4"></div>

											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="parent-id">父级</label>

												<div class="col-sm-9">
													<div class="clearfix">
														<select name="menu[parent_id]" class="col-xs-10 col-sm-5" id="parent-id">
															<option value="0">请选择父级</option>
															<!-- <option value="1">系统</option> -->
															<?php
																if(!empty($this->params['tree'])):
																	foreach($this->params['tree'] as $row):
																		$selStr = $this->params['model']->parent_id==$row['id'] ? ' selected' : '';
																		echo '<option value="'.$row['id'].'"'.$selStr.'>|-'.str_repeat('--', $row['level']).$row['menu_name'].'</option>';
																	endforeach;
																endif;
															?>
														</select>
													</div>
												</div>
											</div>

											<div class="space-4"></div>

											<?php if(!empty($allController)):?>
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="menu-route">控制器</label>

												<div class="col-sm-9">
													<div class="clearfix">
														<input type="hidden" id="module" value="<?=$module?>" />
														<select id="routeController" class="col-xs-10 col-sm-5" name="menu[route_controller]">
															<option value="0">请选择</option>
															<?php
																$selStr = '';
																foreach($allController as $row):
																	$selStr = $model->route_controller==$row['route_controller'] ? ' selected="selected"' : '';
																	// $selStr = $sys_route_controller==$row['route_controller'] ? ' selected="selected"' : '';
																	echo '<option value="'.$row['route_controller'].'"'.$selStr.'>'.$row['route_controller'].'</option>';
																endforeach;
															?>
														</select>
													</div>
												</div>
											</div>

											<div class="space-4"></div>
											<?php endif;?>

											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="menu-route">路由</label>

												<div class="col-sm-9">
													<div class="clearfix">
														<!-- <input type="text" name="menu[menu_route]" id="menu-route" placeholder="请输入路由地址" class="col-xs-10 col-sm-5" value="<?//=$this->params['model']->menu_route?>" /> -->
														<select id="routeControllerAction" class="col-xs-10 col-sm-5" name="menu[sys_route_id]">
															<option value="0">请选择</option>
															<?php
																$selStr = '';
																foreach($allControllerAction as $row):
																	$selStr = $model->sys_route_id==$row['id'] ? ' selected="selected"' : '';
																	// print_r($row);
																	echo '<option value="'.$row['id'].'"'.$selStr.'>'.$row['route_url'].'</option>';
																endforeach;
															?>
														</select>
													</div>
												</div>
											</div>

											<div class="space-4"></div>

											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="order-num">排序</label>

												<div class="col-sm-9">
													<div class="clearfix">
														<input type="text" name="menu[order_num]" class="input-mini" id="spinner3" data-value="<?=$this->params['model']->order_num?>" />
													</div>
												</div>
											</div>

											<div class="space-4"></div>

											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="menu-route">数据</label>

												<div class="col-sm-9">
													<div class="clearfix">
														<textarea class="col-xs-10 col-sm-5" name="menu[json_data]"><?=$this->params['model']->json_data?></textarea>
													</div>
												</div>
											</div>

											<div class="space-4"></div>

											<div class="clearfix form-actions">
												<div class="col-md-offset-3 col-md-9">
													<button class="btn btn-info" type="button" id="btnSubmit">
														<i class="icon-ok bigger-110"></i>
														提交
													</button>

													&nbsp; &nbsp; &nbsp;
													<button class="btn" type="reset">
														<i class="icon-undo bigger-110"></i>
														重置
													</button>
												</div>
											</div>

										</form>
										<script src="<?=STATICS_PUBLIC_JS_DIR?>fuelux/fuelux.spinner.min.js"></script>
										<script src="<?=STATICS_PUBLIC_JS_DIR?>fuelux/fuelux.wizard.min.js"></script>
										<!-- 表单验证 -->
										<script src="<?=STATICS_PUBLIC_JS_DIR?>jquery.validate.min.js"></script>
										<script src="<?=STATICS_PUBLIC_JS_DIR?>additional-methods.min.js"></script>
										<script src="<?=STATICS_PUBLIC_JS_DIR?>jquery.validate.extend.js"></script>
										<!-- 表单验证js插件结束 -->
										<script src="<?=STATICS_PUBLIC_JS_DIR?>bootbox.min.js"></script>
										<script src="<?=STATICS_PUBLIC_JS_DIR?>jquery.maskedinput.min.js"></script>
										<!-- <script src="<?//=STATICS_PUBLIC_JS_DIR?>select2.min.js"></script> -->
										<script src="<?=STATICS_MODULE_JS.strtolower($this->params['controller'])?>/add.js"></script>
									