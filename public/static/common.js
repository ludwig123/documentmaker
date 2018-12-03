function setPageTitle(title){
	$("title").text(title+" | 酸辣季真");
}

function setNavigateIndicator(id){
	    //设置导航栏下的指示器
	var selector = "#"+id;
    $("#page-main").removeClass("layui-this");
    $(selector).addClass("layui-this");
}