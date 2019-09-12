										<?php
											use classes\Web;
											use classes\Helper;
											use classes\Url;
											include_once 'form.php';
										?>
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
										<script src="<?=STATICS_MODULE_JS.$this->params['controller']?>/default.js"></script>