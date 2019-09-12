<?php if(!empty($msg)):?>
<div class="alert alert-block alert-warning">
	<button type="button" class="close" data-dismiss="alert">
	<i class="icon-remove"></i>
	</button>
<?php
$str = '';
foreach ($msg as $value) {
	$str .= '<i class="icon-remove"></i>';
	$str .= '<strong class="">';
	$str .= $value;
	$str .= '</strong>';
	$str .= '<br/>';
}
echo $str;
?>
</div>
<?php endif;?>