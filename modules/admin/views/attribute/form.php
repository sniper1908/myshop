										<!-- 时间：2018/02/04 11:03:53 -->
										<?php
											use classes\Web;
											use classes\Url;
											use classes\View;
											extract($this->params);
											$editUrlStr = isset($model) && $model->id ? '&id='.$model->id : '';
											$editUrlStr .= isset($goods_type_id) ? '&goods_type_id='.$goods_type_id : '';
										?>
										<form class="form-horizontal" id="formMenu" role="form" method="post" action="<?=Url::makeUrl($this->params['module'].'/'.$this->params['controller'].'/'.$this->params['action'].$editUrlStr)?>">
											
											<div class='form-group'>
												<label class='col-sm-3 control-label no-padding-right' for='attr_name'>属性名称</label>
												<div class='col-sm-9'>
													<div class='clearfix'>
														<input type='text' name="Attribute[attr_name]" id='attr_name' placeholder='请输入属性名称' value="<?=isset($model) ? $model->attr_name : ""?>" class='col-xs-10 col-sm-5' />
													</div>
												</div>
											</div>
											<div class='space-4'></div>
											<div class='form-group'>
												<label class='col-sm-3 control-label no-padding-right' for='cate_id'>所属商品类型</label>
												<div class='col-sm-9'>
													<div class='clearfix'>
														<select name="Attribute[cate_id]" id="cate_id" class="col-xs-10 col-sm-5">
															<option value="0">请选择</option>
															<?php
																if(!empty($typeList)):
																	foreach($typeList as $id=>$cate_name):
																		echo 'id='.$id;
																		$typeSelectStr = (isset($model) && $model->id && $model->id==$id) || (isset($goods_type_id) && $goods_type_id==$id) ? ' selected="selected"' : '';
																		echo $typeSelectStr;
																		echo '<option value='.$id.$typeSelectStr.'>'.$cate_name.'</option>';
																	endforeach;
																endif;
															?>
														</select>
													</div>
												</div>
											</div>
											<div class='space-4'></div>
											<div class='form-group'>
												<label class='col-sm-3 control-label no-padding-right' for='attr_index'>能否进行检索</label>
												<div class='col-sm-9'>
													<div class='clearfix'>
														<!-- <input type='text' name="Attribute[attr_index]" id='attr_index' placeholder='请输入能否进行检索' value="<?//=isset($model) ? $model->attr_index : ""?>" class='col-xs-10 col-sm-5' /> -->
														<label>
															<input name="Attribute[attr_index]" type="radio" class="ace" value="0" checked="checked" />
															<span class="lbl"> 不需要检索 </span>
														</label>
														<label>
															<input name="Attribute[attr_index]" type="radio" class="ace" value="1"<?=isset($model) && $model->attr_index==1 ? " checked='checked'" : ""?> />
															<span class="lbl"> 关键字检索 </span>
														</label>
														<label>
															<input name="Attribute[attr_index]" type="radio" class="ace" value="2"<?=isset($model) && $model->attr_index==2 ? " checked='checked'" : ""?> />
															<span class="lbl"> 范围检索 </span>
														</label>
													</div>
													<div>不需要该属性成为检索商品条件的情况请选择不需要检索，需要该属性进行关键字检索商品时选择关键字检索，如果该属性检索时希望是指定某个范围时，选择范围检索。</div>
												</div>
											</div>
											<div class='space-4'></div>
											<div class='form-group'>
												<label class='col-sm-3 control-label no-padding-right' for='is_linked'>相同属性值的商品是否关联</label>
												<div class='col-sm-9'>
													<div class='clearfix'>
														<!-- <input type='text' name="Attribute[is_linked]" id='is_linked' placeholder='请输入相同属性值的商品是否关联' value="<?//=isset($model) ? $model->is_linked : ""?>" class='col-xs-10 col-sm-5' /> -->
														<label>
															<input name="Attribute[is_linked]" type="radio" class="ace" value="0" checked="checked" />
															<span class="lbl"> 否 </span>
														</label>
														<label>
															<input name="Attribute[is_linked]" type="radio" class="ace" value="1"<?=isset($model) && $model->is_linked==1 ? " checked='checked'" : ""?> />
															<span class="lbl"> 是 </span>
														</label>
													</div>
												</div>
											</div>
											<div class='space-4'></div>
											<div class='form-group'>
												<label class='col-sm-3 control-label no-padding-right' for='attr_type'>属性是否可选</label>
												<div class='col-sm-9'>
													<div class='clearfix'>
														<!-- <input type='text' name="Attribute[attr_type]" id='attr_type' placeholder='请输入属性是否多选' value="<?//=isset($model) ? $model->attr_type : ""?>" class='col-xs-10 col-sm-5' /> -->
														<label>
															<input name="Attribute[attr_type]" type="radio" class="ace" value="0" checked="checked" />
															<span class="lbl"> 唯一属性 </span>
														</label>
														<label>
															<input name="Attribute[attr_type]" type="radio" class="ace" value="1"<?=isset($model) && $model->attr_type==1 ? " checked='checked'" : ""?> />
															<span class="lbl"> 单选属性 </span>
														</label>
														<label>
															<input name="Attribute[attr_type]" type="radio" class="ace" value="2"<?=isset($model) && $model->attr_type==2 ? " checked='checked'" : ""?> />
															<span class="lbl"> 复选属性 </span>
														</label>
													</div>
													<div>选择"单选/复选属性"时，可以对商品该属性设置多个值，同时还能对不同属性值指定不同的价格加价，用户购买商品时需要选定具体的属性值。<br>选择"唯一属性"时，商品的该属性值只能设置一个值，用户只能查看该值。</div>
												</div>
											</div>
											<div class='space-4'></div>
											<div class='form-group'>
												<label class='col-sm-3 control-label no-padding-right' for='attr_input_type'>该属性的录入方式</label>
												<div class='col-sm-9'>
													<div class='clearfix'>
														<!-- <input type='text' name="Attribute[attr_input_type]" id='attr_input_type' placeholder='请输入该属性的录入方式' value="<?//=isset($model) ? $model->attr_input_type : ""?>" class='col-xs-10 col-sm-5' /> -->
														<label>
															<input name="Attribute[attr_input_type]" type="radio" class="ace" value="0" checked="checked" />
															<span class="lbl"> 手工录入 </span>
														</label>
														<label>
															<input name="Attribute[attr_input_type]" type="radio" class="ace" value="1"<?=isset($model) && $model->attr_input_type==1 ? " checked='checked'" : ""?> />
															<span class="lbl"> 从下面的列表中选择（用竖线|分隔开可选值） </span>
														</label>
														<label>
															<input name="Attribute[attr_input_type]" type="radio" class="ace" value="2"<?=isset($model) && $model->attr_input_type==2 ? " checked='checked'" : ""?> />
															<span class="lbl"> 多行文本框 </span>
														</label>
													</div>
												</div>
											</div>
											<div class='space-4'></div>
											<div class='form-group'>
												<label class='col-sm-3 control-label no-padding-right' for='attr_values'>可选值列表</label>
												<div class='col-sm-9'>
													<div class='clearfix'>
														<!-- <input type='text' name="Attribute[attr_values]" id='attr_values' placeholder='请输入可选值列表' value="<?//=isset($model) ? $model->attr_values : ""?>" class='col-xs-10 col-sm-5' /> -->
														<textarea name="Attribute[attr_values]" id="attr_values" class="col-xs-10 col-sm-5 fixTextareaRow" rows="10" readonly="readonly"><?=isset($model) ? $model->attr_values : ""?></textarea>
													</div>
												</div>
											</div>
											<div class='space-4'></div>
											<div class='form-group'>
												<label class='col-sm-3 control-label no-padding-right' for='order_num'>排序数字</label>
												<div class='col-sm-9'>
													<div class='clearfix'>
														<input type='text' name="Attribute[order_num]" class="input-mini" id='order_num' placeholder='请输入排序数字' data-value="<?=isset($model) ? $model->order_num : ""?>" class='col-xs-10 col-sm-5' />
													</div>
												</div>
											</div>
											<div class='space-4'></div>
											<div class='form-group'>
												<label class='col-sm-3 control-label no-padding-right' for='attr_group'>属性分组</label>
												<div class='col-sm-9'>
													<div class='clearfix'>
														<input type='text' name="Attribute[attr_group]" id='attr_group' placeholder='请输入属性分组' value="<?=isset($model) ? $model->attr_group : ""?>" class='col-xs-10 col-sm-5' />
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
										<script src="<?=STATICS_MODULE_JS?>public/default.js"></script>
