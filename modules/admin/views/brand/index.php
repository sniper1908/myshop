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
														'aList'=>$aList,'attributes'=>"",
														'cols_attr' => [
															'img'=>['logo'],
															'radio'=>['is_show'],
															'cut' => ['attr'=>['brand_des'],'length'=>50]
														]
													])?>
												</div>
											</div>
										</div>
										<script src="<?=STATICS_MODULE_JS?>public/default.js"></script>