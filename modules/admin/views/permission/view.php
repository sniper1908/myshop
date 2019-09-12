										<?php
											use classes\Url;
										?>
										<div class="col-xs-12 col-sm-12 widget-container-span">
											<div class="widget-box">
												<div class="widget-header header-color-blue">
													<h5 class="bigger lighter">
														<i class="icon-table"></i>
														<?=$this->params['data']['permission_name']?>
													</h5>
												</div>

												<div class="widget-body">
													<div class="widget-main no-padding">
														<table class="table table-striped table-bordered table-hover">
															<thead class="thin-border-bottom">
																<tr>
																	<th>
																		<i class="icon-user"></i>
																		角色
																	</th>

																	<th>
																		<?=$this->params['data']['role_name']?>
																	</th>
																	<!-- <th class="hidden-480">Status</th> -->
																</tr>
															</thead>

															<tbody>
																<tr>
																	<td class="">排序</td>

																	<td>
																		<?=$this->params['data']['order_num'] ;?>
																	</td>
																</tr>

																<?php if(!empty($this->params['data']['menu_data'])):?>
																<tr>
																	<td>权限</td>

																	<td>
																		<?php
																			$menu_data = $this->params['data']['menu_data'];
																			foreach($menu_data as $row):
																				echo '|--'.$row['menu_name'].'<br/>';
																				if(isset($row['children'])):
																					foreach ($row['children'] as $children) :
																					echo '|----'.$children['menu_name'].'<br/>';
																						if(isset($children['children'])):
																							foreach ($children['children'] as $grand) :
																							echo '|------'.$grand['menu_name'].'&nbsp;&nbsp;';
																							endforeach;
																							echo '<br/>';
																						endif;
																					endforeach;
																				endif;
																			endforeach;
																		?>
																	</td>
																</tr>
																<?php endif;?>

																<tr>
																	<td class="">管理</td>
																	<td>
																		<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
																			<a class="green" href="<?=Url::makeUrlParams(["edit",'id'=>$this->params['data']['id']])?>">
																				<i class="icon-pencil bigger-130"></i>
																			</a>

																			<a class="red" data-href="<?=Url::makeUrlParams(["delete",'id'=>$this->params['data']['id']])?>" onclick="delData(this)" data-trash='trash'>
																				<i class="icon-trash bigger-130"></i>
																			</a>
																		</div>
																	</td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div><!-- /span -->
										<script src="<?=STATICS_MODULE_JS?>public/default.js"></script>