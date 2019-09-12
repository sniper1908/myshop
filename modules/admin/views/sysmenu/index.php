										<?php
											use classes\Url;
										?>
										<div class="row">
											<div class="col-xs-12">
												<div class="table-header">
													<?=$this->params['page_title']?>列表
												</div>

												<div class="table-responsive">
													<table id="sample-table-2" class="table table-striped table-bordered table-hover">
														<thead>
															<tr>
																<th class="center">
																	<label>
																		<input type="checkbox" class="ace" />
																		<span class="lbl"></span>
																	</label>
																</th>
																<th>名称</th>
																<th>父级</th>
																<th class="hidden-480">路由</th>

																<th>
																	<i class="icon-time bigger-110 hidden-480"></i>
																	排序
																</th>

																<th>数据</th>

																<th></th>
															</tr>
														</thead>

														<tbody>
															<?php
																if(!empty($this->params['tree'])):
																	foreach($this->params['tree'] as $row):
															?>
															<tr>
																<td class="center">
																	<label>
																		<input type="checkbox" class="ace" />
																		<span class="lbl"></span>
																	</label>
																</td>

																<td>
																	<a href="#"><?=$row['menu_name']?></a>
																</td>
																<td><?=$row['parent_name'] ? $row['parent_name'] : '<i class="red">未设置</i>'?></td>
																<td class="hidden-480"><?=$row['menu_route'] ? $row['menu_route'] : '<i class="red">未设置</i>'?></td>
																<td><?=$row['order_num']?></td>
																<td><?=$row['json_data']?></td>
																<td>
																	<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
																		<a class="blue" href="<?=Url::makeUrlParams(["view",'id'=>$row['id']])?>">
																			<i class="icon-zoom-in bigger-130"></i>
																		</a>

																		<a class="green" href="<?=Url::makeUrlParams(["edit",'id'=>$row['id']])?>">
																			<i class="icon-pencil bigger-130"></i>
																		</a>

																		<!-- <a class="red" data-href="<?//=Url::makeUrlParams(["delete",'id'=>$row['id']])?>" onclick="delData(this)" data-trash='trash'> -->
																		<a class="red" data-href="<?=Url::makeUrlParams(["delete",'id'=>$row['id']])?>" data-trash='trash'>
																			<i class="icon-trash bigger-130"></i>
																		</a>
																	</div>
																</td>
															</tr>
															<?php
																	endforeach;
																endif;
															?>

														</tbody>
													</table>
												</div>
											</div>
										</div>

										<script src="<?=STATICS_PUBLIC_JS_DIR?>jquery.dataTables.min.js"></script>
										<script src="<?=STATICS_PUBLIC_JS_DIR?>jquery.dataTables.bootstrap.js"></script>
										<script type="text/javascript">
											jQuery(function($) {
												var oTable1 = $('#sample-table-2').dataTable( {
													"aoColumns": [
												      { "bSortable": false },
												      null, null,null, null, null,
													  { "bSortable": false }
													] 
												} );
												
												
												$('table th input:checkbox').on('click' , function(){
													var that = this;
													$(this).closest('table').find('tr > td:first-child input:checkbox')
													.each(function(){
														this.checked = that.checked;
														$(this).closest('tr').toggleClass('selected');
													});
														
												});
											
											
												$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
												function tooltip_placement(context, source) {
													var $source = $(source);
													var $parent = $source.closest('table')
													var off1 = $parent.offset();
													var w1 = $parent.width();
											
													var off2 = $source.offset();
													var w2 = $source.width();
											
													if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
													return 'left';
												}
											});
										</script>
										<script src="<?=STATICS_MODULE_JS?>public/default.js"></script>