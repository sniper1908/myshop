										<?php
											use classes\Url;
											extract($this->params);
										?>

										<div class="col-xs-12 col-sm-12 widget-container-span">
											<div class="widget-box">
												<div class="widget-header header-color-blue">
													<h5 class="bigger lighter">
														<i class="icon-table"></i>
														<?=$adminModel->username?>
													</h5>
												</div>

												<div class="widget-body">
													<div class="widget-main no-padding">
														<table class="table table-striped table-bordered table-hover">
															<thead class="thin-border-bottom">
																<tr>
																	<th>
																		<i class="icon-user"></i>
																		用户
																	</th>

																	<th>
																		<?=$adminModel->username?>
																	</th>
																</tr>
															</thead>

															<tbody>
																<tr>
																	<td class="">角色</td>

																	<td>
																		<?=$roleModel->role_name ;?>
																	</td>
																</tr>

																<tr>
																	<td class="">管理</td>
																	<td>
																		<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
																			<a class="green" href="<?=Url::makeUrlParams(["edit",'id'=>$adminModel->id])?>">
																				<i class="icon-pencil bigger-130"></i>
																			</a>

																			<a class="red" data-href="<?=Url::makeUrlParams(["delete",'id'=>$adminModel->id])?>" onclick="delData(this)" data-trash='trash'>
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