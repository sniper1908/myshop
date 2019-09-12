										<?php
											use classes\Web;
											use classes\Helper;
											use classes\Url;
											extract($this->params);
										?>
										<form class="form-horizontal" id="formMenu" role="form" method="post" action="<?=Url::makeUrl($this->params['module'].'/'.$this->params['controller'].'/'.$this->params['action'].'&id='.$this->params['adminModel']->id)?>">
											
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right">用户</label>

												<div class="col-sm-9">
													<div class="clearfix">
														<label class="col-sm-9" style="padding-top: 4px;padding-left: 18px;"><?=$adminModel->username?></label>
														<input type="hidden" name="assignment[admin_id]" value="<?=$adminModel->id?>" />
													</div>
												</div>
											</div>

											<div class="space-4"></div>

											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="order-num">角色</label>

												<div class="col-sm-9">
													<div class="clearfix">
														<?php foreach($roles as $role):?>
														<div class="radio">
															<label>
																<input type="radio" name="assignment[role_id]" value=<?=$role['id']?><?=$model->role_id==$role['id'] ? ' checked="checked"' : ''?> class="ace" />
																<span class="lbl"> <?=$role['role_name']?></span>
															</label>
														</div>
														<?php endforeach;?>
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
										<!-- <script src="<?=STATICS_MODULE_JS.$this->params['controller']?>/default.js"></script> -->
									