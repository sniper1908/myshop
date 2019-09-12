											jQuery(function($) {
												// 更改排序数字
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
												// 验证表单
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
												// 提交表单
												// $('#btnSubmit').click(function(){
												// 	$('#formMenu').submit();
												// });
											});

											jQuery(function($) {
												// 上传图片
												var $form = $('#formMenu');
												//you can have multiple files, or a file input with "multiple" attribute
												var file_input = $form.find('input[type=file]');
												var upload_in_progress = false;
												var no_file_str = $('#no_file_str').val();

												file_input.ace_file_input({
													// style : 'well',
													no_file:no_file_str,
													// no_file:'没有图片',
													btn_choose:'选择',
													btn_change:'更改',
													// btn_choose : '选择或拖拽图片到此处',
													// btn_change: null,
													droppable: true,
													thumbnail: 'large',
													
													maxSize: 110000,//bytes
													allowExt: ["jpeg", "jpg", "png", "gif"],
													allowMime: ["image/jpg", "image/jpeg", "image/png", "image/gif"],

													before_remove: function() {
														if(upload_in_progress)
															return false;//if we are in the middle of uploading a file, don't allow resetting file input
														return true;
													},

													preview_error: function(filename , code) {
														//code = 1 means file load error
														//code = 2 image load error (possibly file is not an image)
														//code = 3 preview failed
													}
												}).on('change', function(){
													// var file_change = $(this).data('ace_input_files');
													// console.log('change-file');
													// console.log(file_change);
												});

												file_input.on('file.error.ace', function(ev, info) {
													if(info.error_count['ext'] || info.error_count['mime']) alert('Invalid file type! Please select an image!');
													if(info.error_count['size']) alert('Invalid file size! Maximum 100KB');
													
													//you can reset previous selection on error
													//ev.preventDefault();
													//file_input.ace_file_input('reset_input');
												});
												
												
												var ie_timeout = null;//a time for old browsers uploading via iframe
											
												$form.on('submit',function(e){
													// var file_change = $(this).data('ace_input_files');
													// console.log(file_change);
													var files = file_input.data('ace_input_files');
													// console.log('submit-file' + files)
													if( !files || files.length == 0 ) return false;//no files selected
																		
													var deferred ;
													if( "FormData" in window ) {
														//for modern browsers that support FormData and uploading files via ajax
														//we can do >>> var formData_object = new FormData($form[0]);
														//but IE10 has a problem with that and throws an exception
														//and also browser adds and uploads all selected files, not the filtered ones.
														//and drag&dropped files won't be uploaded as well
														
														//so we change it to the following to upload only our filtered files
														//and to bypass IE10's error
														//and to include drag&dropped files as well
														formData_object = new FormData();//create empty FormData object
														
														//serialize our form (which excludes file inputs)
														$.each($form.serializeArray(), function(i, item) {
															//add them one by one to our FormData 
															formData_object.append(item.name, item.value);							
														});
														//and then add files
														$form.find('input[type=file]').each(function(){
															var field_name = $(this).attr('name');
															//for fields with "multiple" file support, field name should be something like `myfile[]`

															var files = $(this).data('ace_input_files');
															// console.log(files);
															// console.log($form.attr('action'))
															if(files && files.length > 0) {
																for(var f = 0; f < files.length; f++) {
																	formData_object.append(field_name, files[f]);
																}
															}
														});
									

														upload_in_progress = true;
														// file_input.ace_file_input('loading', true);
														
														// deferred = $.ajax({
														// 	        // url: $form.attr('action'),
														// 	        url: $('#action_ajax').val(),
														// 	       type: $form.attr('method'),
														// 	processData: false,//important
														// 	contentType: false,//important
														// 	   dataType: 'json',
														// 	       data: formData_object
														// })

													}
													else {
														// alert('iframe');
														//for older browsers that don't support FormData and uploading files via ajax
														//we use an iframe to upload the form(file) without leaving the page

														deferred = new $.Deferred //create a custom deferred object
														
														var temporary_iframe_id = 'temporary-iframe-'+(new Date()).getTime()+'-'+(parseInt(Math.random()*1000));
														var temp_iframe = 
																$('<iframe id="'+temporary_iframe_id+'" name="'+temporary_iframe_id+'" \
																frameborder="0" width="0" height="0" src="about:blank"\
																style="position:absolute; z-index:-1; visibility: hidden;"></iframe>')
																.insertAfter($form)

														$form.append('<input type="hidden" name="temporary-iframe-id" value="'+temporary_iframe_id+'" />');
														
														temp_iframe.data('deferrer' , deferred);
														//we save the deferred object to the iframe and in our server side response
														//we use "temporary-iframe-id" to access iframe and its deferred object
														
														$form.attr({
																	  method: 'POST',
																	 enctype: 'multipart/form-data',
																	  target: temporary_iframe_id //important
																	});

														upload_in_progress = true;
														file_input.ace_file_input('loading', true);//display an overlay with loading icon
														$form.get(0).submit();
														
														
														//if we don't receive a response after 30 seconds, let's declare it as failed!
														ie_timeout = setTimeout(function(){
															ie_timeout = null;
															temp_iframe.attr('src', 'about:blank').remove();
															deferred.reject({'status':'fail', 'message':'Timeout!'});
														} , 30000);
													}


													////////////////////////////
													//deferred callbacks, triggered by both ajax and iframe solution
													/*
													deferred
													.done(function(result) {//success
														// console.log(result)
														//format of `result` is optional and sent by server
														//in this example, it's an array of multiple results for multiple uploaded files
														var message = '';
														for(var i = 0; i < result.length; i++) {
															if(result[i].status == 'OK') {
																message += "File successfully saved. Thumbnail is: " + result[i].url
															}
															else {
																message += "File not saved. " + result.message;
															}
															message += "\n";
														}
														// alert(message);
														$('#logo_file').val(result[0]['url']);
														// $form.get(0).submit();
													})
													.fail(function(result) {//failure
														// alert("There was an error");
														// console.log(result);
														return false;
														// console.log();
													})
													.always(function() {//called on both success and failure
														if(ie_timeout) clearTimeout(ie_timeout)
														ie_timeout = null;
														upload_in_progress = false;
														// file_input.ace_file_input('loading', false);
													});

													deferred.promise();
													*/
													// console.log($(this).data('ace_input_method'));
												})

												//when "reset" button of form is hit, file field will be reset, but the custom UI won't
												//so you should reset the ui on your own
												$form.on('reset', function() {
													$(this).find('input[type=file]').ace_file_input('reset_input_ui');
												});


												if(location.protocol == 'file:') alert("For uploading to server, you should access this page using 'http' protocal, i.e. via a webserver.");

											});