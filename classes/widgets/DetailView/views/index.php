														<?php
															use classes\Url;
															extract($data);
															if (!empty($data['relation'])) {
																$relation_keys = array_keys($relation);
															}
														?>
														<table class="table table-striped table-bordered table-hover">
															<tbody>
															<?php 
																if(!empty($_attributes)):
																	foreach($_attributes as $key=>$value):
																		echo '<tr>';
																		echo '<td>'.$value.'</td>';
																		echo '<td>';
																		// 如果该字段有关联属性
																		if(!empty($relation_keys) && in_array($key,$relation_keys)):
																			$relation_key_value = $model->$key;
																			echo $model->{$relation[$key]}($relation_key_value);
																		elseif(isset($cols_attr['img']) && in_array($key, $cols_attr['img'])):
																			echo '<img src="'.$model->$key.'" class="img100" />';
																		elseif(isset($cols_attr['radio']) && in_array($key, $cols_attr['radio'])):
																			// echo $model->$key ? '是' : '否';
																			if(isset($cols_attr['radio_label']) && !empty($cols_attr['radio_label']) && isset($cols_attr['radio_label'][$key])):
																				$model_key = $model->$key;
																				echo $cols_attr['radio_label'][$key][$model_key];
																			else :
																				echo $model->$key ? '是' : '否';
																			endif;
																		// elseif(isset($cols_attr['cut']) && in_array($key,$cols_attr['cut']['attr'])):
																		// 	echo mb_substr($model->$key, 0,$cols_attr['cut']['length']);
																		else :
																			echo $model->$key;
																		endif;
																		echo '</td>';
																		echo '<tr>';
															?><!-- 
																<tr>
																	<td><?//=$value?></td>
																	<td><?//=$model->$key?></td>
																</tr> -->
															<?php
																	endforeach;
																endif;
															?>
															</tbody>
														</table>