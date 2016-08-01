$(function(){
	//tab
	var tab_height=$(window).height()-80
	$(".zy-tab-top").height(tab_height)
	$(".zy-tab-li").click(function(){
		if($(this).hasClass("zy-tab-current")==true){
			$(this).removeClass("zy-tab-current")
			$(".zy-tab-top").removeClass("zy-tab-top2")
			$(".zy-tab-top").height(tab_height)
			$(".zy-tt-i").hide()
			$("#zy-tt-mb").hide()
		}
		else{
			$(".zy-tab-top").addClass("zy-tab-top2")
			$(".zy-tab-top").height(270)
			$("#zy-tt-mb").show()
			$(".zy-tt-i").hide()
			$(this).find(".zy-tt-i").show()
			$(".zy-tab-li").removeClass("zy-tab-current")
			$(this).addClass("zy-tab-current")
		}	
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
		$(".zy-tab-li").removeClass("zy-tab-current")
		$("#zy-tt-mb").hide()
	})
})
$(function(){
	var s=0
	$(".wh-vcard-code").click(function(){
		s++
		if(s%2==0)
		$(".wh-vcard-code").removeClass("zh-vcard-cu")
		else
		$(".wh-vcard-code").addClass("zh-vcard-cu")
	})
})















