										<?php
											use classes\Url;
											use classes\View;
											extract($this->params);
										?>

										<div class="col-xs-12 col-sm-12 widget-container-span">
											<div class="widget-box">
												<div class="widget-header header-color-blue">
													<h5 class="bigger lighter">
														<i class="icon-table"></i>
														<?=$data['model_class']?>
													</h5>
												</div>

												<div class="widget-body">
													<div class="widget-main no-padding">
														<table class="table table-striped table-bordered table-hover">
															<thead class="thin-border-bottom">
																<tr>
																	<th>
																		控制器名
																	</th>

																	<th>
																		<?=$this->params['data']['controller_name']?>
																	</th>
																	<!-- <th class="hidden-480">Status</th> -->
																</tr>
															</thead>

															<tbody>
																<tr>
																	<td>
																		控制器类名
																	</td>

																	<td>
																		<?=$this->params['data']['controller_class']?>
																	</td>
																	<!-- <th class="hidden-480">Status</th> -->
																</tr>
																<tr>
																	<td>
																		模块
																	</td>

																	<td>
																		<?=$this->params['data']['module_name']?>
																	</td>
																	<!-- <th class="hidden-480">Status</th> -->
																</tr>
																<tr>
																	<td>
																		命名空间
																	</td>

																	<td>
																		<?=$this->params['data']['namespace']?>
																	</td>
																	<!-- <th class="hidden-480">Status</th> -->
																</tr>
																<tr>
																	<td class="">基类</td>

																	<td>
																		<?=$this->params['data']['base_class'] ;?>
																	</td>
																</tr>
																<tr>
																	<td class="">模型名</td>

																	<td>
																		<?=$data['model_class'];?>
																	</td>
																</tr>
																<tr>
																	<td class="">页面标题</td>

																	<td>
																		<?=$data['page_title'];?>
																	</td>
																</tr>
																<tr>
																	<td class="">时间</td>

																	<td>
																		<?=date('Y-m-d H:i:s',$data['created_time']);?>
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