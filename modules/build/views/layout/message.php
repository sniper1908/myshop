<?php 
use classes\Url;
include_once 'header.php';
include_once 'left.php';
include_once 'right.php';
?>
<meta>
<div class="alert alert-block alert-success text-center">

	<ul class="list-unstyled">
		<li>
			<i class="icon-ok green"></i>
			<strong class="green">
				<?=$this->params['msg']?>
			</strong>
		</li>
		<?php if(isset($this->params['controller']) && $this->params['controller']!='login'):?>
		<li>
			<i class="icon-list green"></i>
			<a href="<?=Url::makeUrl('index')?>" class="green">返回列表</a>
		</li>
		<?php endif;?>
		<li>
			<i class="icon-home green"></i>
			<a href="<?=Url::makeUrl('index/index')?>" class="green">返回首页</a>
		</li>
		<li>
			系统将在<?=$this->params['time'];?>秒钟后自动跳转到列表页
		</li>
	</ul>

</div>
<script>
if(<?=$this->params['time']?>!=-1){
	setTimeout("fTurn()",<?=$this->params['time']*1000?>);	
}

function fTurn(){
	var url = "<?=Url::makeUrlParams($this->params['url'])?>";
	// alert(url);
	location.href = url;
}
</script>
<?php include_once 'footer.php';?>