											jQuery(function($) {
												var order_num = $('#spinner3').attr('data-value');
												order_num = parseInt(order_num);

												// alert($('#spinner3').attr('data-value'));

												if (order_num) {
													$('#spinner3').ace_spinner({
														value:order_num,
														min:0,
														max:1000,
														step:1, 
														on_sides: true, 
														icon_up:'icon-plus smaller-75', 
														icon_down:'icon-minus smaller-75', 
														btn_up_class:'btn-success' , 
														btn_down_class:'btn-danger'
													});
												}else{
													$('#spinner3').ace_spinner({
														value:0,
														min:0,
														max:1000,
														step:1, 
														on_sides: true, 
														icon_up:'icon-plus smaller-75', 
														icon_down:'icon-minus smaller-75', 
														btn_up_class:'btn-success' , 
														btn_down_class:'btn-danger'
													});
												}
												// var validation = false;
												
												$('#formMenu').validate({
													// debug模式，验证成功不提交
													debug:false,
													errorElement: 'div',
													errorClass: 'help-block',
													focusInvalid: false,
													rules: {
														"role[role_name]": {
															required:true,
															rangelength:[2,7]
														}
													},
											
													messages: {
														"role[role_name]":{
															required:'请输入名称',
															rangelength:'长度为2-7个字'
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