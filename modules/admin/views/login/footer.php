		
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div>
		</div><!-- /.main-container -->
		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='<?= STATICS_PUBLIC_JS_DIR?>jquery.mobile.custom.min.js'>"+"<"+"script>");
		</script>
		<script type="text/javascript">
			function show_box(id) {
			 jQuery('.widget-box.visible').removeClass('visible');
			 jQuery('#'+id).addClass('visible');
			}
		</script>
		<!-- <?php// if ($this->params['have_script']) :?>
				<script src="<?//=STATICS_MODULE_JS.strtolower($this->params['controller']).'/'.strtolower($this->params['action']).'.js'?>"></script>
		<?php// endif;?> -->
		<!-- inline scripts related to this page -->
	</body>
</html>