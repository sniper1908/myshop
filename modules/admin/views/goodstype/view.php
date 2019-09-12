										<?php
											use classes\Url;
											use classes\widgets\DetailView\DetailView;
											extract($this->params);
										?>

										<div class="col-xs-12 col-sm-12 widget-container-span">
											<div class="widget-box">
												<div class="widget-header header-color-blue">
													<h5 class="bigger lighter">
														<i class="icon-table"></i>详情页
													</h5>
												</div>

												<div class="widget-body">
													<div class="widget-main no-padding">
														<?//=DetailView::widget(['model'=>$model,'attributes'=>""])?>
														<?=DetailView::widget([
															'model'=>$model,
															'attributes'=>"",
															'cols_attr' => [
																'radio' => ['enabled'],
																'radio_label' => ['enabled'=>[0=>'关闭',1=>'开启']]
															]
														])?>
													</div>
												</div>
											</div>
										</div><!-- /span -->
										<script src="<?=STATICS_MODULE_JS?>public/default.js"></script>