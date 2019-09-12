<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>File Upload Example</title>

		<link rel="stylesheet" href="<?=STATICS_PUBLIC_CSS_DIR?>bootstrap.css" />
		<link rel="stylesheet" href="<?= STATICS_PUBLIC_CSS_DIR?>font-awesome4.7.0.min.css" />
		<link rel="stylesheet" href="<?= STATICS_PUBLIC_CSS_DIR?>font-awesome.min.css" />
		<link rel="stylesheet" href="<?= STATICS_PUBLIC_CSS_DIR?>ace.css" />
		<link rel="stylesheet" href="<?= STATICS_PUBLIC_CSS_DIR?>ace-rtl.css" />
		<link rel="stylesheet" href="<?= STATICS_PUBLIC_CSS_DIR?>ace-skins.css" />
		<link rel="stylesheet" href="<?= STATICS_MODULE_STYLE?>site.css" /><!-- basic scripts23333 -->
		<script src="<?= STATICS_PUBLIC_JS_DIR?>jquery-2.0.3.min.js"></script>
	</head>

	<body>
		<form id="myform" method="post" action="http://localhost:8080/myshop/index.php?r=admin/Brand/test2">
			<input  type="file" name="avatar" />
			
			<div class="hr hr-12 dotted"></div>
			
			<button type="submit" class="btn btn-sm btn-primary">Submit</button>
			<button type="reset" class="btn btn-sm">Reset</button>
		</form>
		<script src="<?=STATICS_PUBLIC_JS_DIR?>bootstrap.js"></script>
		<script src="<?=STATICS_PUBLIC_JS_DIR?>ace-elements.js"></script>
		<script src="<?=STATICS_PUBLIC_JS_DIR?>ace.js"></script>
		<script src="<?=STATICS_PUBLIC_JS_DIR?>src/elements.spinner.js"></script>
				
		<script type="text/javascript">
			jQuery(function($) {
				var $form = $('#myform');
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
				
				$form.on('submit', function(e) {
					e.preventDefault();
				
					var files = file_input.data('ace_input_files');
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
							if(files && files.length > 0) {
								for(var f = 0; f < files.length; f++) {
									formData_object.append(field_name, files[f]);
								}
							}
						});
	

						upload_in_progress = true;
						file_input.ace_file_input('loading', true);
						
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
						console.log($form.attr('action'))
						console.log(result)
					})
					.always(function() {//called on both success and failure
						if(ie_timeout) clearTimeout(ie_timeout)
						ie_timeout = null;
						upload_in_progress = false;
						file_input.ace_file_input('loading', false);
					});

					deferred.promise();
				});

			});
		</script>
	</body>
</html>