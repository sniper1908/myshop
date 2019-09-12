										<?php
											use classes\Web;
											use classes\Helper;
											use classes\Url;
											extract($this->params);
										?>
										<form class="form-horizontal" id="formMenu" role="form" method="post" action="<?=Url::makeUrl($this->params['module'].'/'.$this->params['controller'].'/'.$this->params['action'])?>">
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="permission-name">角色</label>

												<div class="col-sm-9">
													<div class="clearfix">
														<select name="permission[role_id]" id="permission-name" class="col-xs-10 col-sm-5">
															<?php foreach($roles as $role):?>
															<option value="<?=$role['id']?>"><?=$role['role_name']?></option>
															<?php endforeach;?>
														</select>
													</div>
												</div>
											</div>

											<div class="space-4"></div>

											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="order-num">排序</label>

												<div class="col-sm-9">
													<div class="clearfix">
														<input type="text" name="permission[order_num]" class="input-mini" id="spinner3" data-value=0 />
													</div>
												</div>
											</div>

											<div class="space-4"></div>
<!-- 
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="permission-type">类型</label>

												<div class="col-sm-9">
													<div class="clearfix">
														<input type="text" name="permission[permission_type]" id="permission-type" placeholder="请输入类型" class="col-xs-10 col-sm-5" />
													</div>
												</div>
											</div>

											<div class="space-4"></div> -->

											<?php if(!empty($tree)):?>
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="route">权限</label>

												<div class="col-sm-9">
													<div class="clearfix">
														<?php 
															$i=0;
															foreach($tree as $row):
																$i++;
														?>
														<div class="checkbox1">
															<?=$i?>、
															<input type="checkbox" name="parent[]" value="<?=$row['id']?>" id="parent-<?=$row['id']?>" /> 
															<label for="parent-<?=$row['id']?>"><?=$row['menu_name']?></label>
															<br/>
															<?php
																if(!empty($row['children'])):
																	echo '<br/>';
																	foreach ($row['children'] as $children) :
															?>
																<?=str_repeat('&nbsp;',8);?>
																<input type="checkbox" name="children[<?=$row['id']?>][]" value="<?=$children['id']?>" id="children-<?=$children['id']?>" /> 
																<label for="children-<?=$children['id']?>"><?=$children['menu_name']?></label>
																<br/>
																	<?php
																		if(!empty($children['children'])):
																			echo '<br/>';
																			foreach ($children['children'] as $grand) :
																	?>
																		<?=str_repeat('&nbsp;',10);?>
																		<input type="checkbox" name="grand[<?=$row['id']?>][<?=$children['id']?>][]" value="<?=$grand['id']?>" id="grand-<?=$grand['id']?>" /> 
																		<label for="grand-<?=$grand['id']?>"><?=$grand['menu_name']?></label>
																		<?=str_repeat('&nbsp;',2);?>
																	<?php
																			endforeach;
																			echo '<br/><br/>';
																		endif;
																	?><!-- grand end -->
															<?php
																	endforeach;
																endif;
															?><!-- children end -->
														</div>
														<?php 
															endforeach;
														?><!-- tree end -->
													</div>
												</div>
											</div>

											<div class="space-4"></div>
											<?php endif;?><!-- tree end -->
											<!--
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="json-data">数据</label>

												<div class="col-sm-9">
													<div class="clearfix">
														<textarea class="col-xs-10 col-sm-5" name="permission[json_data]" id="json-data"></textarea>
													</div>
												</div>
											</div>

											<div class="space-4"></div> -->

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
										<script src="<?=STATICS_PUBLIC_JS_DIR?>fuelux/fuelux.spinner.min.js"></script>
										<script src="<?=STATICS_PUBLIC_JS_DIR?>fuelux/fuelux.wizard.min.js"></script>
										<!-- 表单验证 -->
										<script src="<?=STATICS_PUBLIC_JS_DIR?>jquery.validate.min.js"></script>
										<script src="<?=STATICS_PUBLIC_JS_DIR?>additional-methods.min.js"></script>
										<script src="<?=STATICS_PUBLIC_JS_DIR?>jquery.validate.extend.js"></script>
										<!-- 表单验证js插件结束 -->
										<script src="<?=STATICS_PUBLIC_JS_DIR?>bootbox.min.js"></script>
										<script src="<?=STATICS_PUBLIC_JS_DIR?>jquery.maskedinput.min.js"></script>
										<!-- <script src="<?//=STATICS_PUBLIC_JS_DIR?>select2.min.js"></script> -->
										<script src="<?=STATICS_MODULE_JS.$this->params['controller']?>/default.js"></script>
									