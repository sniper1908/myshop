											
											//var module = "<?=$module;?>";
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
														"menu[menu_name]": {
															required:true,
															rangelength:[2,6]//,
															//进行ajax传值
															// remote: {
															//     url: "check-email.php",     //后台处理程序
															//     type: "post",               //数据发送方式
															//     dataType: "json",           //接受数据格式   
															//     data: {                     //要传递的数据
															//         username: function() {
															//             return $("#username").val();
															//         }
															//     }
															// }
														},
														"menu[menu_route]": {
															required: false,
															isRoute: true
														}
													},
											
													messages: {
														"menu[menu_name]":{
															required:'请输入菜单名称',
															rangelength:'长度为2-6个字'
														},
														"menu[menu_route]": {
															"isRoute":"请正确输入路由地址!"
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

												// 切换select
												$('#routeController').change(function(){
													var that = $(this);
													var routeController = that.val();
													var module = $('#module').val();
													if (0==routeController) {
														var str = '<option value="0">请选择</option>';
														$('#routeControllerAction').html(str);
													} else {
														$.post(
															'index.php?r='+module+'/sysRoute/getActionsForController',
															{
																routeController:routeController
															},
															function(res){
																var str = '';
																for(var i in res){
																	str += '<option value="'+res[i]['id']+'">'+res[i]['route_url']+'</option>';
																}
																$('#routeControllerAction').html(str);
															},
															'json'
														);
													}
												});
											});