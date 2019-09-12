// jQuery(function($){
	// $("a[data-trash=trash]").each(function(){
	// 	var that = $(this);
	// 	that.click(function(){
	// 		delData(that);
	// 	})
	// });
	// $("a[data-trash=trash]").click(function(){
	// 	delData($(this));
	// });	


	$('#sample-table-2 tbody tr td').delegate('a[data-trash=trash]','click',function(){
		delData($(this));
	});

	function delData(obj){
		if(confirm("确定删除该条记录？")){
			var url = $(obj).attr('data-href');
			alert(url);return false;
			location.href = url;
		}
	}


	function formSpinner(spinnerValue,spinnerId){
		if (spinnerValue) {
			$('#'+spinnerId).ace_spinner({
				value:spinnerValue,
				min:0,
				max:1000,
				step:1, 
				on_sides: true, 
				icon_up:'icon-plus smaller-75', 
				icon_down:'icon-minus smaller-75', 
				btn_up_class:'btn-success', 
				btn_down_class:'btn-danger'
			});
		}else{
			$('#'+spinnerId).ace_spinner({
				value:0,
				min:0,
				max:1000,
				step:1, 
				on_sides: true, 
				icon_up:'icon-plus smaller-75', 
				icon_down:'icon-minus smaller-75', 
				btn_up_class:'btn-success' , 
				btn_down_class:'btn-danger'
			});
		}
	}
// });

