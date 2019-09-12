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
														<?=DetailView::widget([
															'model'=>$model,
															'attributes'=>"",
															'relation' => [
																'cate_id'=>'getCateName'
															],
															'cols_attr' => [
																'radio' => ['attr_index','is_linked','attr_type','attr_input_type'],
																'radio_label' => [
																	'attr_index'=>[0=>'不需要检索',1=>'关键字检索','范围检索'],
																	'attr_type' =>[0=>'唯一属性',1=>'单选属性',2=>'复选属性'],
																	'attr_input_type' =>[0=>'手工录入',1=>'列表选择',2=>'多行文本输入']
																]
															]
														])?>
													</div>
												</div>
											</div>
										</div><!-- /span -->
										<script src="<?=STATICS_MODULE_JS?>public/default.js"></script>