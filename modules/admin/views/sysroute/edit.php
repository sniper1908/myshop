										<?php
											use classes\Web;
											use classes\Helper;
											use classes\Url;
											extract($this->params);
										?>
										<form class="form-horizontal" id="formMenu" role="form" method="post" action="<?=Url::makeUrl($this->params['module'].'/'.$this->params['controller'].'/'.$this->params['action'].'&id='.$this->params['model']->id)?>">
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="route-module">模块</label>

												<div class="col-sm-9">
													<div class="clearfix">
														<input type="text" name="route[route_module]" id="route-module" placeholder="请输入模块" class="col-xs-10 col-sm-5" value="<?=$model->route_module?>" />
													</div>
												</div>
											</div>

											<div class="space-4"></div>

											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="route-controller">控制器</label>

												<div class="col-sm-9">
													<div class="clearfix">
														<input type="text" name="route[route_controller]" id="route-controller" placeholder="请输入控制器" class="col-xs-10 col-sm-5" value="<?=$model->route_controller?>" />
													</div>
												</div>
											</div>

											<div class="space-4"></div>

											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="route-action">方法</label>

												<div class="col-sm-9">
													<div class="clearfix">
														<input type="text" name="route[route_action]" id="route-action" placeholder="请输入方法" class="col-xs-10 col-sm-5" value="<?=$model->route_action?>" />
													</div>
												</div>
											</div>

											<div class="space-4"></div>

											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="order-num">排序</label>

												<div class="col-sm-9">
													<div class="clearfix">
														<input type="text" name="route[order_num]" class="input-mini" id="spinner3" data-value=<?=$model->order_num?> />
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
										<script src="<?=STATICS_MODULE_JS.$this->params['controller']?>/default.js"></script>
									