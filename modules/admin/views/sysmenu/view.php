										<?php
											use classes\Url;
										?>

										<div class="col-xs-12 col-sm-12 widget-container-span">
											<div class="widget-box">
												<div class="widget-header header-color-blue">
													<h5 class="bigger lighter">
														<i class="icon-table"></i>
														<?=$this->params['data']['menu_name']?>
													</h5>
												</div>

												<div class="widget-body">
													<div class="widget-main no-padding">
														<table class="table table-striped table-bordered table-hover">
															<thead class="thin-border-bottom">
																<tr>
																	<th>
																		<i class="icon-user"></i>
																		名称
																	</th>

																	<th>
																		<?=$this->params['data']['menu_name']?>
																	</th>
																	<!-- <th class="hidden-480">Status</th> -->
																</tr>
															</thead>

															<tbody>
																<tr>
																	<td class="">父级</td>

																	<td>
																		<?=isset($this->params['data']['parent_name']) ? $this->params['data']['menu_name'] : '根分类';?>
																	</td>
																</tr>

																<tr>
																	<td class="">路由</td>

																	<td>
																		<a href="<?=$this->params['data']['menu_route'] ? Url::makeUrl($this->params['data']['menu_route']) : '#'?>"><?=$this->params['data']['menu_route'] ? $this->params['data']['menu_route'] : '未设置';?></a>
																	</td>
																</tr>

																<tr>
																	<td class="">排序</td>

																	<td>
																		<?=$this->params['data']['order_num']?>
																	</td>

																</tr>

																<tr>
																	<td class="">数据</td>

																	<td>
																		<?=$this->params['data']['json_data']?>
																	</td>

																</tr>

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