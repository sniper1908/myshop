													<?php
														use classes\Url;
														extract($data);
														$attrCount = count($_attributes);
														$nullStr = str_repeat('null,', $attrCount);
														// var_dump($model);
														if (!empty($data['relation'])) {
															$relation_keys = array_keys($relation);
														}
													?>
													<table id="sample-table-2" class="table table-striped table-bordered table-hover">
														<thead>
															<tr>
																<th class="center">
																	<label>
																		<input type="checkbox" class="ace" />
																		<span class="lbl"></span>
																	</label>
																</th>
																<?php  
																	if(!empty($_attributes)):
																		foreach($_attributes as $key=>$value):
																			echo '<th>'.$value.'</th>';
																		endforeach;
																	endif;
																?>
																<th></th>
															</tr>
														</thead>
														<tbody>
															<?php
																if(!empty($aList)):
																	foreach($aList as $key=>$value):
															?>
															<tr>
																<td class="center">
																	<label>
																		<input type="checkbox" class="ace" />
																		<span class="lbl"></span>
																	</label>
																</td>
																<?php 
																	foreach($_attributes as $k=>$v):
																		echo '<td>';
																		// 如果该字段有关联属性
																		if(!empty($relation_keys) && in_array($k,$relation_keys)):
																			echo $model->{$relation[$k]}($value[$k]);
																		// 该字段为图片
																		elseif(isset($cols_attr['img']) && in_array($k, $cols_attr['img'])):
																			echo '<img src="'.$value[$k].'" class="img100" />';
																		// 该字段为单选按钮
																		elseif(isset($cols_attr['radio']) && in_array($k, $cols_attr['radio'])):
																			if(isset($cols_attr['radio_label']) && !empty($cols_attr['radio_label']) && isset($cols_attr['radio_label'][$k])):
																				// echo $cols_attr['radio_label'][$value[$k]];
																				$value_key = $value[$k];
																				echo $cols_attr['radio_label'][$k][$value_key];
																			else:
																				echo $value[$k] ? '是' : '否';
																			endif;
																		// 该字段需要截取字数
																		elseif(isset($cols_attr['cut']) && in_array($k,$cols_attr['cut']['attr'])):
																			echo mb_substr($value[$k], 0,$cols_attr['cut']['length']);
																		// 直接输出字段值
																		else :
																			echo $value[$k];
																		endif;
																		echo '</td>';
																	endforeach;
																?>
																<td>
																	<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
																		<?php
																			if(!empty($menu)):
																				foreach($menu as $row):
																		?>
																		<a class="<?=$row['class_a']?>" href="<?=Url::makeUrlParams2([$row['url'],$row['params']],$value['id'])?>" alt="<?=$row['label']?>">
																			<i class="<?=$row['class_i']?> bigger-130"></i>
																		</a>
																		<?php
																				endforeach;
																			endif;
																		?>
																		<a class="blue" href="<?=Url::makeUrlParams(["view",'id'=>$value['id']])?>" alt="详情">
																			<i class="icon-zoom-in bigger-130"></i>
																		</a>
																		<a class="green" href="<?=Url::makeUrlParams(["edit",'id'=>$value['id']])?>" alt="编辑">
																			<i class="icon-pencil bigger-130"></i>
																		</a>
																		<a class="red" data-href="<?=Url::makeUrlParams(["delete",'id'=>$value['id']])?>" data-trash='trash' alt="删除">
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
													<script src="<?=STATICS_PUBLIC_JS_DIR?>jquery.dataTables.min.js"></script>
													<script src="<?=STATICS_PUBLIC_JS_DIR?>jquery.dataTables.bootstrap.js"></script>
													<script type="text/javascript">
														jQuery(function($) {
															var oTable1 = $('#sample-table-2').dataTable( {
																"aoColumns": [
															      { "bSortable": false },
															      // null, null,null,null,
															      <?=$nullStr?>
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