										<?php
											use classes\Url;
											extract($this->params);
										?>

										<div class="col-xs-12 col-sm-12 widget-container-span">
											<div class="widget-box">
												<div class="widget-header header-color-blue">
													<h5 class="bigger lighter">
														<i class="icon-table"></i>
														<?=$this->params['data']['username']?>
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
																		<?=$this->params['data']['username']?>
																	</th>
																	<!-- <th class="hidden-480">Status</th> -->
																</tr>
															</thead>

															<tbody>
																<tr>
																	<td class="">邮箱</td>

																	<td>
																		<a href="mailto:<?=$this->params['data']['email']?>"><?=$this->params['data']['email'] ;?></a>
																	</td>
																</tr>

																<tr>
																	<td class="">状态</td>

																	<td>
																		<?=$this->params['data']['status']==1 ? '激活' : '未激活'?>
																	</td>

																</tr>

																<tr>
																	<td class="">时间</td>

																	<td>
																		<?=date('Y-m-d H:i:s',$this->params['data']['created_time'])?>
																	</td>

																</tr>

																<?php if( ($_SESSION['admin']['username']=='admin') || ($_SESSION['admin']['username']!='admin' && $_SESSION['admin']['admin_id']==$data['id']) ):?>
																<tr>
																	<td class="">管理</td>
																	<td>
																		<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
																			<a class="green" href="<?=Url::makeUrlParams(["edit",'id'=>$this->params['data']['id']])?>">
																				<i class="icon-pencil bigger-130"></i>
																			</a>
																			<?php if($_SESSION['admin']['admin_id']!=$data['id']):?>
																			<a class="red" data-href="<?=Url::makeUrlParams(["delete",'id'=>$this->params['data']['id']])?>" onclick="delData(this)" data-trash='trash'>
																				<i class="icon-trash bigger-130"></i>
																			</a>
																			<?php endif;?>
																		</div>
																	</td>
																</tr>
																<?php endif;?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div><!-- /span -->
										<script src="<?=STATICS_MODULE_JS?>public/default.js"></script>