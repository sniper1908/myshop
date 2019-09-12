
jQuery(function($){
	// 排序
	var order_num_value = $('#order_num').attr('data-value');
	order_num_value = parseInt(order_num_value);
	formSpinner(order_num_value,'order_num');
	
	// 属性值录入方式
	$("input[name='Attribute[attr_input_type]']").on('click',function () {
		var that = $(this);
		var id = that.val();
		var textareaObj = $("textarea[name='Attribute[attr_values]']");
		if (id==1) {
			textareaObj.removeAttr('readonly');
		}else{
			textareaObj.attr('readonly','readonly')
		}
	})
});

