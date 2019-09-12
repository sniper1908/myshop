<?php 
	use classes\Url;
	extract($this->params);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>后台管理系统</title>
	<link rel="stylesheet" href="<?= STATICS_PUBLIC_CSS_DIR?>bootstrap.min.css" />
	<link rel="stylesheet" href="<?= STATICS_PUBLIC_CSS_DIR?>font-awesome4.7.0.min.css" />
	<link rel="stylesheet" href="<?= STATICS_PUBLIC_CSS_DIR?>font-awesome.min.css" />
	<link rel="stylesheet" href="<?= STATICS_PUBLIC_CSS_DIR?>ace.min.css" />
	<link rel="stylesheet" href="<?= STATICS_PUBLIC_CSS_DIR?>ace-rtl.min.css" />
	<link rel="stylesheet" href="<?= STATICS_PUBLIC_CSS_DIR?>ace-skins.min.css" />
	<link rel="stylesheet" href="<?= STATICS_MODULE_STYLE?>site.css" /><!-- basic scripts -->
	<script src="<?= STATICS_PUBLIC_JS_DIR?>jquery-2.0.3.min.js"></script>

	<script type="text/javascript">
		window.jQuery || document.write("<script src='<?= STATICS_PUBLIC_JS_DIR?>jquery-2.0.3.min.js'>"+"<"+"script>");
	</script>

	<!--[if IE]>
	<script type="text/javascript">
	 window.jQuery || document.write("<script src='<?= STATICS_PUBLIC_JS_DIR?>jquery-1.10.2.min.js'>"+"<"+"script>");
	</script>
	<![endif]-->
</head>
<body class="login-layout">
	<div class="main-container">
		<div class="main-content">
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<div class="login-container">
						<div class="center">
							<h1>
								<i class="icon-leaf green"></i>
								<span class="red">Ace</span>
								<span class="white">Application</span>
							</h1>
							<h4 class="blue">&copy; Company Name</h4>
						</div>

						<div class="space-6"></div>