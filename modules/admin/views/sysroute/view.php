										<?php
											use classes\Url;
										?>

										<div class="col-xs-12 col-sm-12 widget-container-span">
											<div class="widget-box">
												<div class="widget-header header-color-blue">
													<h5 class="bigger lighter">
														<i class="icon-table"></i>
														<?=$this->params['data']['route_url']?>
													</h5>
												</div>

												<div class="widget-body">
													<div class="widget-main no-padding">
														<table class="table table-striped table-bordered table-hover">
															<thead class="thin-border-bottom">
																<tr>
																	<th>
																		模块
																	</th>

																	<th>
																		<?=$this->params['data']['route_module']?>
																	</th>
																	<!-- <th class="hidden-480">Status</th> -->
																</tr>
															</thead>

															<tbody>
																<tr>
																	<td>
																		控制器
																	</td>

																	<td>
																		<?=$this->params['data']['route_controller']?>
																	</td>
																	<!-- <th class="hidden-480">Status</th> -->
																</tr>
																<tr>
																	<td>
																		方法
																	</td>

																	<td>
																		<?=$this->params['data']['route_action']?>
																	</td>
																	<!-- <th class="hidden-480">Status</th> -->
																</tr>
																<tr>
																	<td class="">排序</td>

																	<td>
																		<?=$this->params['data']['order_num'] ;?>
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