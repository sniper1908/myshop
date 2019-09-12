<?php 
use classes\Url;
include_once 'header.php';
?>
<div class="position-relative">
	<div id="login-box" class="login-box visible widget-box no-border">
		<div class="widget-body">
			<div class="widget-main">
				<h4 class="header blue lighter bigger">
					<i class="icon-coffee green"></i>
					退出
				</h4>

				<div class="space-6"></div>

				<div class="alert alert-block alert-success text-center">

					<ul class="list-unstyled">
						<li>
							<i class="icon-ok green"></i>
							<strong class="green">
								<?=$this->params['msg']?>
							</strong>
						</li>
						<li>
							<i class="icon-list green"></i>
							<a href="<?=Url::makeUrl('index')?>" class="green">返回登陆页</a>
						</li>
						<li>
							系统将在<?=$this->params['time'];?>秒钟后自动跳转到列表页
						</li>
					</ul>

				</div>
			</div><!-- /widget-main -->

			<div class="toolbar clearfix">
				<div></div>
				<div></div>

				<!-- <div>
					<a href="#" onclick="show_box('signup-box'); return false;" class="user-signup-link">
						I want to register
						<i class="icon-arrow-right"></i>
					</a>
				</div> -->
			</div>
		</div><!-- /widget-body -->
	</div><!-- /login-box -->
</div><!-- /position-relative -->

<script>
if(<?=$this->params['time']?>!=-1){
	setTimeout("fTurn()",<?=$this->params['time']*1000?>);	
}

function fTurn(){
	var url = "<?=Url::makeUrl('index')?>";
	// alert(url);
	location.href = url;
}
</script>
<?php include_once 'footer.php';?>