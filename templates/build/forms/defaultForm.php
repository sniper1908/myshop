										<!-- 时间：$created_time$ -->
										<?php
											use classes\Web;
											use classes\Url;
											use classes\View;
											extract($this->params);
											$editUrlStr = isset($model) && $model->id ? '&id='.$model->id : '';
										?>
										<form class="form-horizontal" id="formMenu" role="form" method="post" action="<?=Url::makeUrl($this->params['module'].'/'.$this->params['controller'].'/'.$this->params['action'].$editUrlStr)?>">
											$inputStr$

											<div class="clearfix form-actions">
												<div class="col-md-offset-3 col-md-9">
													<button class="btn btn-info" type="submit" id="btnSubmit">
														<i class="icon-ok bigger-110"></i>
														提交
													</button>

													&nbsp; &nbsp; &nbsp;
													<button class="btn" type="reset">
														<i class="icon-undo bigger-110"></i>
														重置
													</button>
												</div>
											</div>

										</form>