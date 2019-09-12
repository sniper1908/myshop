										<!-- 时间：2018/01/04 09:30:22 -->
										<?php
											use classes\Web;
											use classes\Url;
											extract($this->params);
											$editUrlStr = isset($model) && $model->id ? '&id='.$model->id : '';
											$recommendArr = [];
											$recommendArr = isset($model) && $model->recommend ? explode(',', $model->recommend) : [];
										?>
										<form class="form-horizontal" id="formMenu" role="form" method="post" action="<?=Url::makeUrl($this->params['module'].'/'.$this->params['controller'].'/'.$this->params['action'].$editUrlStr)?>">
											
											<div class='form-group'>
												<label class='col-sm-3 control-label no-padding-right' for='cate_name'>分类名</label>
												<div class='col-sm-9'>
													<div class='clearfix'>
														<input type='text' name="Category[cate_name]" id='cate_name' placeholder='请输入分类名' value="<?=isset($model) ? $model->cate_name : ""?>" class='col-xs-10 col-sm-5' />
 													</div>
												</div>
											</div>
											<div class='space-4'></div>
											<div class='form-group'>
												<label class='col-sm-3 control-label no-padding-right' for='parent_id'>上级分类</label>
												<div class='col-sm-9'>
													<div class='clearfix'>
														<!-- <input type='text' name="Category[parent_id]" id='parent_id' placeholder='请输入上级分类' value="<?//=isset($model) ? $model->parent_id : ""?>" class='col-xs-10 col-sm-5' /> -->
														<select name="Category[parent_id]" id="parent_id" class="col-xs-10 col-sm-5">
															<option value="0">顶级分类</option>
															<?php
																if(!empty($tree)):
																	foreach($tree as $row):
																		echo '<option value="'.$row['id'].'">|-'.str_repeat('--', $row['level']).$row['cate_name'].'</option>';
																	endforeach;
																endif;
															?>
														</select>
 													</div>
												</div>
											</div>
											<div class='space-4'></div>
											<div class='form-group'>
												<label class='col-sm-3 control-label no-padding-right' for='spinner3'>排序数字</label>
												<div class='col-sm-9'>
													<div class='clearfix'>
														<input type='text' name="Category[order_num]" class="input-mini" id="spinner3" placeholder='请输入排序数字' data-value="<?=isset($model) ? $model->order_num : ""?>" class='col-xs-10 col-sm-5' />
 													</div>
												</div>
											</div>
											<div class='space-4'></div>
											<div class='form-group'>
												<label class='col-sm-3 control-label no-padding-right' for='keywords'>关键字</label>
												<div class='col-sm-9'>
													<div class='clearfix'>
														<input type='text' name="Category[keywords]" id='keywords' placeholder='请输入关键字' value="<?=isset($model) ? $model->keywords : ""?>" class='col-xs-10 col-sm-5' />
 													</div>
												</div>
											</div>
											<div class='space-4'></div>
											<div class='form-group'>
												<label class='col-sm-3 control-label no-padding-right' for='des'>描述</label>
												<div class='col-sm-9'>
													<div class='clearfix'>
														<textarea name="Category[des]" id="des" class="col-xs-10 col-sm-5 fixTextareaRow" rows="10"><?=isset($model) ? $model->des : ""?></textarea>
 													</div>
												</div>
											</div>
											<div class='space-4'></div>
											<div class='form-group'>
												<label class='col-sm-3 control-label no-padding-right' for='measure_unit'>数量单位</label>
												<div class='col-sm-9'>
													<div class='clearfix'>
														<input type='text' name="Category[measure_unit]" id='measure_unit' placeholder='请输入数量单位' value="<?=isset($model) ? $model->measure_unit : ""?>" class='col-xs-10 col-sm-5' />
 													</div>
												</div>
											</div>
											<div class='space-4'></div>
											<div class='form-group'>
												<label class='col-sm-3 control-label no-padding-right' for='recommend'>设置为首页推荐</label>
												<div class='col-sm-9'>
													<div class='clearfix'>
														<label>
															<input name="recommend[]" type="checkbox" class="ace" value="1"<?=!empty($recommendArr) && in_array(1,$recommendArr) ? ' checked="checked"' : ''?> />
															<span class="lbl"> 精品</span>
														</label>
														<label>
															<input name="recommend[]" type="checkbox" class="ace" value="2"<?=!empty($recommendArr) && in_array(2,$recommendArr) ? ' checked="checked"' : ''?> />
															<span class="lbl"> 新品</span>
														</label>
														<label>
															<input name="recommend[]" type="checkbox" class="ace" value="3"<?=!empty($recommendArr) && in_array(3,$recommendArr) ? ' checked="checked"' : ''?> />
															<span class="lbl"> 热销</span>
														</label>
 													</div>
												</div>
											</div>
											<div class='space-4'></div>
											<div class='form-group'>
												<label class='col-sm-3 control-label no-padding-right' for='show_in_nav'>导航栏显示</label>
												<div class='col-sm-9'>
													<div class='clearfix'>
 														<label>
															<input name="Category[show_in_nav]" id='show_in_nav' class="ace ace-switch ace-switch-7" type="checkbox" <?=isset($model) && $model->show_in_nav ? "checked='checked'" : ''?> />
															<span class="lbl"></span>
														</label>
 													</div>
												</div>
											</div>
											<div class='space-4'></div>
											<div class='form-group'>
												<label class='col-sm-3 control-label no-padding-right' for='is_show'>前台显示</label>
												<div class='col-sm-9'>
													<div class='clearfix'>
														<label>
															<input name="Category[is_show]" id='is_show' class="ace ace-switch ace-switch-7" type="checkbox" <?=isset($model) && $model->is_show ? "checked='checked'" : ''?> />
															<span class="lbl"></span>
														</label>
 													</div>
												</div>
											</div>
											<div class='space-4'></div>
											<div class='form-group'>
												<label class='col-sm-3 control-label no-padding-right' for='price_range'>价格区间个数</label>
												<div class='col-sm-9'>
													<div class='clearfix'>
														<input type='text' name="Category[price_range]" class="input-mini" id="price_range" placeholder='请输入排序数字' data-value="<?=isset($model) ? $model->price_range : ""?>" class='col-xs-10 col-sm-5' />											
													</div>
												</div>
											</div>
											<div class='space-4'></div>
											<div class='form-group'>
												<label class='col-sm-3 control-label no-padding-right' for='style_url'>样式路径</label>
												<div class='col-sm-9'>
													<div class='clearfix'>
														<input type='text' name="Category[style_url]" id='style_url' placeholder='请输入样式路径' value="<?=isset($model) ? $model->style_url : ""?>" class='col-xs-10 col-sm-5' />
													</div>
												</div>
											</div>
											<div class='space-4'></div>
											<div class='form-group'>
												<label class='col-sm-3 control-label no-padding-right' for='filter_attr'>筛选属性</label>
												<div class='col-sm-9'>
													<div class='clearfix'>
														<input type='text' name="Category[filter_attr]" id='filter_attr' placeholder='请输入筛选属性' value="<?=isset($model) ? $model->filter_attr : ""?>" class='col-xs-10 col-sm-5' />													
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