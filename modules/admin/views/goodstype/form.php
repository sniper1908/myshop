										<!-- 时间：2018/02/03 12:00:06 -->
										<?php
											use classes\Web;
											use classes\Url;
											use classes\View;
											extract($this->params);
											$editUrlStr = isset($model) && $model->id ? '&id='.$model->id : '';
										?>
										<form class="form-horizontal" id="formMenu" role="form" method="post" action="<?=Url::makeUrl($this->params['module'].'/'.$this->params['controller'].'/'.$this->params['action'].$editUrlStr)?>">
											
											<div class='form-group'>
												<label class='col-sm-3 control-label no-padding-right' for='cate_name'>类型名</label>
												<div class='col-sm-9'>
													<div class='clearfix'>
														<input type='text' name="GoodsType[cate_name]" id='cate_name' placeholder='请输入类型名' value="<?=isset($model) ? $model->cate_name : ""?>" class='col-xs-10 col-sm-5' />
													</div>
												</div>
											</div>
											<div class='space-4'></div>
											<div class='form-group'>
												<label class='col-sm-3 control-label no-padding-right' for='enabled'>类型状态</label>
												<div class='col-sm-9'>
													<div class='clearfix'>
														<label>
															<input name="GoodsType[enabled]" id='enabled' class="ace ace-switch ace-switch-7" type="checkbox" <?=isset($model) && $model->enabled ? "checked='checked'" : ''?> />
															<span class="lbl"></span>
														</label>
													</div>
												</div>
											</div>
											<div class='space-4'></div>
											<div class='form-group'>
												<label class='col-sm-3 control-label no-padding-right' for='attr_group'>属性分组</label>
												<div class='col-sm-9'>
													<div class='clearfix'>
														<textarea name="GoodsType[attr_group]" id="attr_group" rows="10" class="col-xs-10 col-sm-5 fixTextareaRow"><?=isset($model) ? $model->attr_group : ""?></textarea>
														<div class="col-xs-10 col-sm-8"><br />商品属性组用逗号隔开。排序也将按照自然顺序排序。</div>
													</div>
												</div>
											</div>
											<div class='space-4'></div>

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