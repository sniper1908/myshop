										<?php
											use classes\Url;
											use classes\widgets\ListView\ListView;
											extract($this->params);
										?>
										<div class="row">
											<div class="col-xs-12">
												<div class="table-header">
													<?=$this->params['page_title']?>列表
												</div>

												<div class="table-responsive">
													<?=ListView::widget([
														'model'=>$model,
														'aList'=>$aList,
														'attributes'=>"attr_name,cate_id,attr_input_type,attr_values,order_num",
														'relation' => [
															'cate_id'=>'getCateName'
														],
														'cols_attr' => [
															'radio' => ['attr_input_type'],
															'radio_label' => [
																'attr_input_type' =>[0=>'手工录入',1=>'列表选择',2=>'多行文本输入']
															]
														]
													])?>
												</div>
											</div>
										</div>
										<script src="<?=STATICS_MODULE_JS?>public/default.js"></script>