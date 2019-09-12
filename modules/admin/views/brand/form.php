										<!-- 时间：2018/01/08 10:00:42 -->
										<?php
											use classes\Web;
											use classes\Url;
											use classes\View;
											extract($this->params);
											$editUrlStr = isset($model) && $model->id ? '&id='.$model->id : '';
										?>
										<link rel="stylesheet" href="<?=STATICS_PUBLIC_CSS_DIR?>dropzone.css">
										<div id="">
											<form class="form-horizontal" id="formMenu" role="form" enctype="multipart/form-data" method="post" action="<?=Url::makeUrl($this->params['module'].'/'.$this->params['controller'].'/'.$this->params['action'].$editUrlStr)?>">
												
												<div class='form-group'>
													<label class='col-sm-3 control-label no-padding-right' for='brand_name'>品牌名</label>
													<div class='col-sm-9'>
														<div class='clearfix'>
															<input type='text' name="Brand[brand_name]" id='brand_name' placeholder='请输入品牌名' value="<?=isset($model) ? $model->brand_name : ""?>" class='col-xs-10 col-sm-5'
	 />													</div>
													</div>
												</div>
												<div class='space-4'></div>
												<div class='form-group'>
													<label class='col-sm-3 control-label no-padding-right' for='site_url'>品牌网址</label>
													<div class='col-sm-9'>
														<div class='clearfix'>
															<input type='text' name="Brand[site_url]" id='site_url' placeholder='请输入品牌网址' value="<?=isset($model) ? $model->site_url : ""?>" class='col-xs-10 col-sm-5'
	 />													</div>
													</div>
												</div>
												<div class='space-4'></div>
												<div class='form-group'>
													<label class='col-sm-3 control-label no-padding-right' for='logo'>品牌logo</label>
													<div class='col-sm-9'>
														<div class='clearfix'>
															<div class="col-xs-10 col-sm-5" style="padding: 0;">
																<input type="file" id="id-input-file-2" name="logo" />
																<!-- <input type="file" id="id-input-file-2" name="logo[]" multiple /> -->
																<input type="hidden" id="logo_file" name="Brand[logo]" value="<?=isset($model) && $model->logo ? $model->logo : '';?>">
																<input type="hidden" id="no_file_str" value="<?=isset($model) && $model->logo ? '图片已上传' : '没有图片'?>">
															</div>
	 													</div>
													</div>
												</div>
												<div class='space-4'></div>
												<div class='form-group'>
													<label class='col-sm-3 control-label no-padding-right' for='brand_des'>品牌描述</label>
													<div class='col-sm-9'>
														<div class='clearfix'>
	 														<textarea name="Brand[brand_des]" id="brand_des" class="col-xs-10 col-sm-5" rows="8"><?=isset($model) ? $model->brand_des : ''?></textarea>
	 													</div>
													</div>
												</div>
												<div class='space-4'></div>
												<div class='form-group'>
													<label class='col-sm-3 control-label no-padding-right' for='spinner3'>排序数字</label>
													<div class='col-sm-9'>
														<div class='clearfix'>
															<input type='text' name="Brand[order_num]" id='spinner3' placeholder='请输入排序数字' data-value="<?=isset($model) ? $model->order_num : ""?>" class='input-mini'
	 />													</div>
													</div>
												</div>
												<div class='space-4'></div>
												<div class='form-group'>
													<label class='col-sm-3 control-label no-padding-right' for='is_show'>是否显示</label>
													<div class='col-sm-9'>
														<div class='clearfix'>
	 														<label class="radio inline">
																<input type="radio" name="Brand[is_show]" id="is_show0" value="0" checked> 否
															</label>
															<label class="radio inline">
															  <input type="radio" name="Brand[is_show]" id="is_show1" value="1"<?=isset($model) && $model->is_show==1 ? ' checked' : ''?>> 是
															</label>
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

												<input type="hidden" id="action_ajax" value="<?=Url::makeUrl($this->params['module'].'/'.$this->params['controller'].'/ajaxUpload')?>">
											</form>
										</div>
										<!-- <script src="<?//= STATICS_PUBLIC_JS_DIR?>dropzone.min.js"></script> -->