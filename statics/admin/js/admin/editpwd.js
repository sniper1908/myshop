											jQuery(function($) {
												// var validation = false;
												
												$('#formMenu').validate({
													// debug模式，验证成功不提交
													debug:false,
													errorElement: 'div',
													errorClass: 'help-block',
													focusInvalid: false,
													rules: {
														"admin[admin_pass]": {
															required: true,
															rangelength: [7,14]
														},
														"chkpassword": {
															required: true,
															rangelength: [7,14],
															equalTo:"#pwd"
														}
													},
											
													messages: {
														"admin[admin_pass]": {
															required:"请输入密码",
															rangelength:"长度为7-14个字符"
														},
														"chkpassword": {
															required:"请再次输入密码",
															rangelength:"长度为7-14个字符",
															equalTo:"两次密码输入不一致"
														}
													},
											
													invalidHandler: function (event, validator) { //display error alert on form submit   
														//$('.alert-danger', $('.login-form')).show();
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
											
													// submitHandler: function (form) {
													// 		//$(form).submit();
													// 		console.log(form);
													// },
													invalidHandler: function (form) {
													}
												});
												
												// if(!$('#formMenu').valid()) return false;

												$('#btnSubmit').click(function(){
													$('#formMenu').submit();
												});
											});