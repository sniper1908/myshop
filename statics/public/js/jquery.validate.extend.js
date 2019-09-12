// jquery validate extend
// 验证扩展
jQuery(function($){
	// 判断输入的路由是否是admin/index/index或index/index形式
	jQuery.validator.addMethod("isRoute",function(value,element){
		var reg = /^([a-zA-Z]{3,15}(\/)*){0,3}$/;
		var re = new RegExp(reg);
		return re.test(value) ? true : false;
	},"请正确输入路由地址");

	jQuery.validator.addMethod("isIntEqZero", function(value, element) { 
         value=parseInt(value);      
         return this.optional(element) || value==0;       
    }, "整数必须为0"); 
});