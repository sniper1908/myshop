										<?php
											use classes\Web;
											use classes\Url;
											use classes\View;
											extract($this->params);
										?>
										<form class="form-horizontal" id="formMenu" role="form" method="post" action="<?=Url::makeUrl($this->params['module'].'/'.$this->params['controller'].'/'.$this->params['action'].'&id='.$this->params['model']->id)?>">
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="controllername">控制器名称</label>

												<div class="col-sm-9">
													<div class="clearfix">
														<input type="text" name="FormBuild[controller_name]" id="controllername" value="<?=$model->controller_name?>" class="col-xs-10 col-sm-5" />
													</div>
												</div>
											</div>

											<div class="space-4"></div>
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="controllerclass">控制器类名</label>

												<div class="col-sm-9">
													<div class="clearfix">
														<input type="text" name="FormBuild[controller_class]" id="controllerclass" value="<?=$model->controller_class?>" class="col-xs-10 col-sm-5" />
													</div>
												</div>
											</div>

											<div class="space-4"></div>
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="modulename">模块名</label>

												<div class="col-sm-9">
													<div class="clearfix">
														<input type="text" name="FormBuild[module_name]" id="modulename" value="<?=$model->module_name?>" class="col-xs-10 col-sm-5" />
													</div>
												</div>
											</div>

											<div class="space-4"></div>
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="modelclass">模型名</label>

												<div class="col-sm-9">
													<div class="clearfix">
														<input type="text" name="FormBuild[model_class]" id="modelclass" value="<?=$model->model_class?>" class="col-xs-10 col-sm-5" />
													</div>
												</div>
											</div>

											<div class="space-4"></div>

											<div class="clearfix form-actions">
												<div class="col-md-offset-3 col-md-9">
													<button class="btn btn-info" type="submit" id="btnSubmit">
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
										<!-- 表单验证 -->
										<script src="<?=STATICS_PUBLIC_JS_DIR?>jquery.validate.min.js"></script>
										<script src="<?=STATICS_PUBLIC_JS_DIR?>additional-methods.min.js"></script>
										<script src="<?=STATICS_PUBLIC_JS_DIR?>jquery.validate.extend.js"></script>
										<!-- 表单验证js插件结束 -->
										<script src="<?=STATICS_PUBLIC_JS_DIR?>bootbox.min.js"></script>
										<script src="<?=STATICS_PUBLIC_JS_DIR?>jquery.maskedinput.min.js"></script>
										<!-- <script src="<?//=STATICS_PUBLIC_JS_DIR?>select2.min.js"></script> -->
									