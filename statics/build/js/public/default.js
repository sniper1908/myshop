jQuery(function($){
	// $("a[data-trash=trash]").each(function(){
	// 	var that = $(this);
	// 	that.click(function(){
	// 		delData(that);
	// 	})
	// });
	// $("a[data-trash=trash]").click(function(){
	// 	delData($(this));
	// });	
});

$('#sample-table-2 tbody tr td').delegate('a[data-trash=trash]','click',function(){
	delData($(this));
});

function delData(obj){
	if(confirm("确定删除该条记录？")){
		var url = $(obj).attr('data-href');
		location.href = url;
	}
}