										<?php
											use classes\Helper;
										?>
										<link rel="stylesheet" href="<?=STATICS_PUBLIC_CSS_DIR?>select2.css" />
										<p>
											<a href="<?=Helper::U($this->params['module'].'/'.$this->params['controller'].'/index')?>" class="btn btn-success">返回列表</a>
										</p>
										<div class="widget-box transparent page-header">
											<div class="widget-header widget-header-flat">
												<h4 class="lighter">
													<i class="icon-star orange"></i>
													<?=$this->params['page_title']?>
												</h4>
											</div>
										</div><!-- /widget-box -->
										<div class="space-24"></div>
										<form class="form-horizontal" id="formMenu" role="form" method="post" action="<?=Helper::U($this->params['module'].'/'.$this->params['controller'].'/insert')?>">
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="menu-name">名称</label>

												<div class="col-sm-9">
													<div class="clearfix">
														<input type="text" name="menu[menu_name]" id="menu-name" placeholder="请输入菜单名称" class="col-xs-10 col-sm-5" />
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
															<option value="1">系统</option>
														</select>
													</div>
												</div>
											</div>

											<div class="space-4"></div>

											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="menu-route">路由</label>

												<div class="col-sm-9">
													<div class="clearfix">
														<input type="text" name="menu[menu_route]" id="menu-route" placeholder="请输入路由地址" class="col-xs-10 col-sm-5" />
													</div>
												</div>
											</div>

											<div class="space-4"></div>

											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="order-num">排序</label>

												<div class="col-sm-9">
													<div class="clearfix">
														<input type="text" name="menu[order_num]" class="input-mini" id="spinner3" />
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
										<script src="<?=STATICS_PUBLIC_JS_DIR?>jquery.validate.min.js"></script>
										<script src="<?=STATICS_PUBLIC_JS_DIR?>jquery.validate.extend.js"></script>
										<script src="<?=STATICS_PUBLIC_JS_DIR?>additional-methods.min.js"></script>
										<script src="<?=STATICS_PUBLIC_JS_DIR?>bootbox.min.js"></script>
										<script src="<?=STATICS_PUBLIC_JS_DIR?>jquery.maskedinput.min.js"></script>
										<script src="<?=STATICS_PUBLIC_JS_DIR?>select2.min.js"></script>
										<!-- <script type="text/javascript">
											jQuery(function($) {
												$('#spinner3').ace_spinner({value:0,min:0,max:1000,step:1, on_sides: true, icon_up:'icon-plus smaller-75', icon_down:'icon-minus smaller-75', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});

												$('#validation-form').validate({
													errorElement: 'div',
													errorClass: 'help-block',
													focusInvalid: false,
													rules: {
														menu[menu_name]: {
															required: true,
															rangelength:[2,6]
														},
														password: {
															required: true,
															minlength: 5
														},
														password2: {
															required: true,
															minlength: 5,
															equalTo: "#password"
														},
														name: {
															required: true
														},
														phone: {
															required: true,
															phone: 'required'
														},
														url: {
															required: true,
															url: true
														},
														comment: {
															required: true
														},
														state: {
															required: true
														},
														platform: {
															required: true
														},
														subscription: {
															required: true
														},
														gender: 'required',
														agree: 'required'
													},
											
													messages: {
														menu[menu_name]:{
															required:"请输入名字，测试"
														},
														email: {
															required: "请输入菜单名称.",
															minlength:"至少2个字",
															maxlength:"最多6个字"
														},
														password: {
															required: "Please specify a password.",
															minlength: "Please specify a secure password."
														},
														subscription: "Please choose at least one option",
														gender: "Please choose gender",
														agree: "Please accept our policy"
													},
											
													invalidHandler: function (event, validator) { //display error alert on form submit   
														$('.alert-danger', $('.login-form')).show();
													},
											
													highlight: function (e) {
														$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
													},
											
													success: function (e) {
														$(e).closest('.form-group').removeClass('has-error').addClass('has-info');
														$(e).remove();
													},
											
													errorPlacement: function (error, element) {
														if(element.is(':checkbox') || element.is(':radio')) {
															var controls = element.closest('div[class*="col-"]');
															if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
															else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
														}
														else if(element.is('.select2')) {
															error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
														}
														else if(element.is('.chosen-select')) {
															error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
														}
														else error.insertAfter(element.parent());
													},
											
													submitHandler: function (form) {
													},
													invalidHandler: function (form) {
													}
												});

												var validation = false;
												if(!$('#validation-form').valid()) return false;
											});
										</script> -->
										<script type="text/javascript">
											jQuery(function($) {
												$('#spinner3').ace_spinner({value:0,min:0,max:1000,step:1, on_sides: true, icon_up:'icon-plus smaller-75', icon_down:'icon-minus smaller-75', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});

												var validation = false;
												$('#validation-form').validate({
													// debug模式，验证成功不提交
													debug:true,
													errorElement: 'div',
													errorClass: 'help-block',
													focusInvalid: false,
													rules: {
														"menu[menu_name]": {
															required:true,
															rangelength:[2,6]
														},
														email: {
															required: true,
															email:true
														},
														"menu[menu_route]": {
															required: false,
															isRoute: true
														}
													},
											
													messages: {
														"menu[menu_name]":{
															required:'请输入菜单名称'
														},
														"menu[menu_route]": {
															"isRoute":"请正确输入路由地址!"
														}
													},
											
													invalidHandler: function (event, validator) { //display error alert on form submit   
														$('.alert-danger', $('.login-form')).show();
													},
											
													highlight: function (e) {
														$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
													},
											
													success: function (e) {
														$(e).closest('.form-group').removeClass('has-error').addClass('has-info');
														$(e).remove();
													},
											
													errorPlacement: function (error, element) {
														if(element.is(':checkbox') || element.is(':radio')) {
															var controls = element.closest('div[class*="col-"]');
															if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
															else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
														}
														else if(element.is('.select2')) {
															error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
														}
														else if(element.is('.chosen-select')) {
															error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
														}
														else error.insertAfter(element.parent());
													},
											
													submitHandler: function (form) {
													},
													invalidHandler: function (form) {
													}
												});

												//if(!$('#validation-form').valid()) return false;

												$('#btnSubmit').click(function(){
													alert('submit');
													$('#formMenu').submit();
												});
											})
										</script>
									