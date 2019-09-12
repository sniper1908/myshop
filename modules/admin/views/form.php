										/**
										 * 时间：2017/12/26 09:42:33
										 */
										<?php
											use classes\Web;
											use classes\Url;
											extract($this->params);
											$editUrlStr = isset($model) && $model->id ? '&id='.$model->id : '';
											$inputData = $labels$;
											print_r($inputData);
										?>
										<form class="form-horizontal" id="formMenu" role="form" method="post" action="<?=Url::makeUrl($this->params['module'].'/'.$this->params['controller'].'/'.$this->params['action'].$editUrlStr)?>">
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="role-name">名称</label>

												<div class="col-sm-9">
													<div class="clearfix">
														<input type="text" name="$controller_class$[role_name]" id="role-name" placeholder="请输入名称" class="col-xs-10 col-sm-5" value="<?=isset($model) ? $model->role_name : '';?>" />
													</div>
												</div>
											</div>

											<div class="space-4"></div>

											<div class="clearfix form-actions">
												<div class="col-md-offset-3 col-md-9">
													<button class="btn btn-info" type="button" id="btnSubmit">
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