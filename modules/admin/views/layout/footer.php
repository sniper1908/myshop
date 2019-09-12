						
									</div><!-- col-sm-12 end -->
								</div>
								<!-- 主体内容结束 -->

							</div>
						</div>

					</div><!-- page-content end -->
					<div class="ace-settings-container" id="ace-settings-container">
						<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
							<i class="icon-cog bigger-150"></i>
						</div>

						<div class="ace-settings-box" id="ace-settings-box">
							<div>
								<div class="pull-left">
									<select id="skin-colorpicker" class="hide">
										<option data-skin="default" value="#438EB9">#438EB9</option>
										<option data-skin="skin-1" value="#222A2D">#222A2D</option>
										<option data-skin="skin-2" value="#C6487E">#C6487E</option>
										<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
									</select>
								</div>
								<span>&nbsp; 选择皮肤</span>
							</div>

							<div>
								<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
								<label class="lbl" for="ace-settings-navbar"> 固定导航条</label>
							</div>

							<div>
								<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
								<label class="lbl" for="ace-settings-sidebar"> 固定滑动条</label>
							</div>

							<div>
								<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
								<label class="lbl" for="ace-settings-breadcrumbs">固定面包屑</label>
							</div>

							<div>
								<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
								<label class="lbl" for="ace-settings-rtl">切换到左边</label>
							</div>

							<div>
								<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
								<label class="lbl" for="ace-settings-add-container">
									切换窄屏
									<b></b>
								</label>
							</div>
						</div>
					</div><!-- /#ace-settings-container -->
				</div><!-- /.main-container-inner -->

				<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
					<i class="icon-double-angle-up icon-only bigger-110"></i>
				</a>

			</div>
			<!-- /.main-container -->
			
			

			<script type="text/javascript">
				if("ontouchend" in document) document.write("<script src='<?= STATICS_PUBLIC_JS_DIR?>jquery.mobile.custom.min.js'>"+"<"+"script>");
			</script>
			<script src="<?= STATICS_PUBLIC_JS_DIR?>bootstrap.min.js"></script>
			<script src="<?= STATICS_PUBLIC_JS_DIR?>typeahead-bs2.min.js"></script>

			<!-- page specific plugin scripts -->

			<!--[if lte IE 8]>
			  <script src="<?= STATICS_PUBLIC_JS_DIR?>excanvas.min.js"></script>
			<![endif]-->

			<script src="<?= STATICS_PUBLIC_JS_DIR?>jquery-ui-1.10.3.custom.min.js"></script>
			<script src="<?= STATICS_PUBLIC_JS_DIR?>jquery.ui.touch-punch.min.js"></script>
			<script src="<?= STATICS_PUBLIC_JS_DIR?>jquery.slimscroll.min.js"></script>
			<script src="<?= STATICS_PUBLIC_JS_DIR?>jquery.easy-pie-chart.min.js"></script>
			<script src="<?= STATICS_PUBLIC_JS_DIR?>jquery.sparkline.min.js"></script>
			<script src="<?= STATICS_PUBLIC_JS_DIR?>flot/jquery.flot.min.js"></script>
			<script src="<?= STATICS_PUBLIC_JS_DIR?>flot/jquery.flot.pie.min.js"></script>
			<script src="<?= STATICS_PUBLIC_JS_DIR?>flot/jquery.flot.resize.min.js"></script>

			<!-- ace scripts -->
			
			<script type="text/javascript" src="<?=STATICS_PUBLIC_JS_DIR?>ace-extra.min.js"></script>
			<script src="<?= STATICS_PUBLIC_JS_DIR?>ace-elements-format.js"></script>
			<script src="<?= STATICS_PUBLIC_JS_DIR?>ace.min.js"></script>
			<?php if ($this->params['have_script']) :?>
					<!-- <script src="<?//='./statics/'.strtolower($this->params['module']).'/js/'.strtolower($this->params['controller']).'/'.strtolower($this->params['action']).'.js'?>"></script> -->
					<script src="<?=STATICS_MODULE_JS.strtolower($this->params['controller']).'/'.strtolower($this->params['action']).'.js'?>"></script>
			<?php endif;?>
			<!-- inline scripts related to this page -->
	</body>
	</html>