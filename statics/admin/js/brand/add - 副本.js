			jQuery(function($) {
				var $form = $('#formMenu');
				//you can have multiple files, or a file input with "multiple" attribute
				var file_input = $form.find('input[type=file]');
				var upload_in_progress = false;

				file_input.ace_file_input({
					style : 'well',
					btn_choose : 'Select or drop files here',
					btn_change: null,
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
				})
				file_input.on('file.error.ace', function(ev, info) {
					if(info.error_count['ext'] || info.error_count['mime']) alert('Invalid file type! Please select an image!');
					if(info.error_count['size']) alert('Invalid file size! Maximum 100KB');
					
					//you can reset previous selection on error
					//ev.preventDefault();
					//file_input.ace_file_input('reset_input');
				});
				
				
				var ie_timeout = null;//a time for old browsers uploading via iframe
				
				var i = 0;
				$form.on('submit', function(e) {
					console.error('fffff')
					console.log('test'+i);
					e.preventDefault();
					i++;
				
					var files = file_input.data('ace_input_files');
					if( !files || files.length == 0 ) return false;//no files selected
										
					var deferred ;
					if( "FormData" in window ) {
						// alert('ajax');
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
						console.log(formData_object);//return false;
	

						upload_in_progress = true;
						// file_input.ace_file_input('loading', true);
						
						deferred = $.ajax({
							        url: $form.attr('action'),
							       type: $form.attr('method'),
							processData: false,//important
							contentType: false,//important
							   dataType: 'json',
							       data: formData_object
							/**
							,
							xhr: function() {
								var req = $.ajaxSettings.xhr();
								if (req && req.upload) {
									req.upload.addEventListener('progress', function(e) {
										if(e.lengthComputable) {	
											var done = e.loaded || e.position, total = e.total || e.totalSize;
											var percent = parseInt((done/total)*100) + '%';
											//percentage of uploaded file
										}
									}, false);
								}
								return req;
							},
							beforeSend : function() {
							},
							success : function() {
							}*/
						})

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
					deferred
					.done(function(result) {//success
						console.log(result)
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
						alert(message);
					})
					.fail(function(result) {//failure
						alert("There was an error");
						console.log(result);
						// console.log();
					})
					.always(function() {//called on both success and failure
						if(ie_timeout) clearTimeout(ie_timeout)
						ie_timeout = null;
						upload_in_progress = false;
						// file_input.ace_file_input('loading', false);
					});

					deferred.promise();
				});


				//when "reset" button of form is hit, file field will be reset, but the custom UI won't
				//so you should reset the ui on your own
				$form.on('reset', function() {
					$(this).find('input[type=file]').ace_file_input('reset_input_ui');
				});


				if(location.protocol == 'file:') alert("For uploading to server, you should access this page using 'http' protocal, i.e. via a webserver.");

			});
			// jQuery(function($){
			
			// 	$('#id-input-file-1 , #id-input-file-2').ace_file_input({
			// 		no_file:'没有选择文件 ...',
			// 		btn_choose:'选择',
			// 		btn_change:'更改',
			// 		droppable:false,
			// 		onchange:null,
			// 		// thumbnail:false ,//| true | large
			// 		thumbnail:true ,//| true | large
			// 		allowExt: ["jpeg", "jpg", "png", "gif" , "bmp"],
   //          		allowMime: ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"],
   //    //       		before_change:function(files, dropped) {
   //    //       			console.log(files);
   //    //       			console.log(dropped);
			// 			// // 返回值分为四种：
			// 		 // //    1.可返回修改后的文件列表
			// 		 // //    2.true:所有文件被保留
			// 		 // //    3.false：所有文件不被保留
			// 		 // //    4:-1:所有文件不被保留，并且输入框清空
   //    //                  if(files == null || files.length != 2) {
   //    //                     alert("请同时选择open_id与user_id映射的txt文件以及用户详细信息的csv文件进行上传。");
   //    //                     return -1;
   //    //                  }

   //    //                  for(var i = 0; i < files.length; i++) {
   //    //                     var file = files[i];

   //    //                     if(typeof file === 'string') {

   //    //                     }
   //    //                     else if ('File' in window && file instanceof window.File) {

   //    //                     }

   //    //                  }

   //    //                  return true;
   //    //               },
			// 		//whitelist:'gif|png|jpg|jpeg'
			// 		//blacklist:'exe|php'
			// 		//onchange:''
			// 		//
			// 	}).on('change', function(){
			// 		console.log($(this).data('ace_input_files'));
			// 		console.log($(this).data('ace_input_method'));
			// 	});
			
			// });