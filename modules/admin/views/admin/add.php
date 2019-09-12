										<?php
											use classes\Web;
											use classes\Helper;
											use classes\Url;
										?>
										<form class="form-horizontal" id="formMenu" role="form" method="post" action="<?=Url::makeUrl($this->params['module'].'/'.$this->params['controller'].'/'.$this->params['action'])?>">
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="username">用户名</label>

												<div class="col-sm-9">
													<div class="clearfix">
														<input type="text" name="admin[username]" id="username" placeholder="请输入用户名" class="col-xs-10 col-sm-5" />
													</div>
												</div>
											</div>

											<div class="space-4"></div>
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="pwd">密码</label>

												<div class="col-sm-9">
													<div class="clearfix">
														<input type="password" name="admin[admin_pass]" id="pwd" placeholder="请输入密码" class="col-xs-10 col-sm-5" />
													</div>
												</div>
											</div>

											<div class="space-4"></div>
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="chkpwd">确认密码</label>

												<div class="col-sm-9">
													<div class="clearfix">
														<input type="password" name="chkpassword" id="chkpwd" placeholder="请再次输入密码" class="col-xs-10 col-sm-5" />
													</div>
												</div>
											</div>

											<div class="space-4"></div>
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="email">邮箱</label>

												<div class="col-sm-9">
													<div class="clearfix">
														<input type="text" name="admin[email]" id="email" placeholder="请输入邮箱地址" class="col-xs-10 col-sm-5" />
													</div>
												</div>
											</div>

											<div class="space-4"></div>

											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="status">状态</label>

												<div class="col-sm-9">
													<div class="clearfix">
														<label class="radio inline">
															<input type="radio" name="admin[status]" id="status0" value="0" checked> 未激活
														</label>
														<label class="radio inline">
														  <input type="radio" name="admin[status]" id="status1" value="1"> 激活
														</label>
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
										<!-- 表单验证 -->
										<script src="<?=STATICS_PUBLIC_JS_DIR?>jquery.validate.min.js"></script>
										<script src="<?=STATICS_PUBLIC_JS_DIR?>additional-methods.min.js"></script>
										<script src="<?=STATICS_PUBLIC_JS_DIR?>jquery.validate.extend.js"></script>
										<!-- 表单验证js插件结束 -->
										<script src="<?=STATICS_PUBLIC_JS_DIR?>bootbox.min.js"></script>
										<script src="<?=STATICS_PUBLIC_JS_DIR?>jquery.maskedinput.min.js"></script>
										<!-- <script src="<?//=STATICS_PUBLIC_JS_DIR?>select2.min.js"></script> -->
									