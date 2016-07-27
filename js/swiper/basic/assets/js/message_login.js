//发送验证码倒计时
var sms_t=60;
function sms_sms(){
var obj=$(".zy-sms-btn")
if (sms_t == 0) {
		obj.attr("disabled",false);
		obj.val("获取验证码")
		sms_t = 60;
		return;
	}
	else {
		obj.attr("disabled",true);
		obj.val(sms_t + "s后重新发送")
		sms_t--;
	}
	setTimeout(function() {
		sms_sms() }
	,1000)
}
//登陆页面控制高度
$(function(){
	var win_height=$(window).height()
	$(".zy-base-main").css("min-height",win_height)
	$(".zy-login-block").css("min-height",win_height)
	$(".zy-login-us").css("position","absolute")
})
/*验证手机号输入格式是否正确，若正确则或许验证码按钮可点击*/
$(function(){
	$(".zy-phone").on("input",function(){
		var phone=$(".zy-phone").val();
		var z_phone=/^1[34578][0-9]{9}$///手机号
		if(phone.length==11&&z_phone.test(phone)){
			$(".zy-sms-btn").attr("disabled",false);
		}else{
			$(".zy-sms-btn").attr("disabled",true);
		}
	})
	$(".zy-login-text").on("input",function(){
		var phone=$(".zy-phone").val();
		var sms=$(".zy-sms").val();
		if(phone.length==11&&sms.length==4){
			$(".zy-sms-yz").attr("disabled",false);
		}else{
			$(".zy-sms-yz").attr("disabled",true);
		}
	})
})
$(function(){
	$(".ver-login").click(function() {
		$(".message-login").hide();
		$(".wh-message-login-pop").show();
	});
	$(".wh-message-login-pop-delete").click(function() {
		$(".wh-message-login-pop").hide();
		$(".message-login").show();
	});
})
$(function(){
	$(".wh-btn-true").click(function(event) {
		$(".wh-message-login-pop").hide();
		$(".message-login").show();
		$(".wh-sms-val").attr("disabled",false);
		$(".wh-sms-val").focus();
	});
})


