$(function(){
	//tab
	var tab_height=$(window).height()-80
	$(".zy-tab-top").height(tab_height)
	$(".zy-tab-li").click(function(){
		$(".zy-tab-top").addClass("zy-tab-top2")
		$(".zy-tab-top").height(270)
		$(".zy-tt-i").hide()
		$(this).find(".zy-tt-i").show()
	})
	$(".zy-tab-li1").click(function(){
		$(".zy-tc-bl").hide()
		$(".zy-tc-bl-1").show()
	})
	$(".zy-tab-li2").click(function(){
		$(".zy-tc-bl").hide()
		$(".zy-tc-bl-2").show()
	})
	$(".zy-tt-header").click(function(){
		$(".zy-tab-top").removeClass("zy-tab-top2")
		$(".zy-tab-top").height(tab_height)
		$(".zy-tt-i").hide()
	})

})