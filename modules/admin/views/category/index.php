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
														'attributes'=>"cate_name,parent_id,order_num,is_show",
														'relation' => [
															'parent_id'=>'getParentName'
														]
													])?>
												</div>
											</div>
										</div>

										
										<script src="<?=STATICS_MODULE_JS?>public/default.js"></script>