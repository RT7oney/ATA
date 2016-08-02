//登陆页面控制高度
$(function(){
	var win_height=$(window).height()
	$(".zy-base-main").css("min-height",win_height)
	$(".zy-login-block").css("min-height",win_height)
	$(".zy-login-us").css("position","absolute")
})
//表单填写控制
var z_phone=/^1[34578][0-9]{9}$///手机号
var z_sfz=/(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;//身份证号
var z_patrn=/^[^\s]{6,20}$/;//密码不能小于六位或大于20位
function length_phone(a){
	a_phone=0  //返回1为正确，0为错误
	if(a==11){
		a_phone=1
	}
	return a_phone
}
function length_paw(b){
	a_paw=0  //返回1为正确，0为错误
	if(b>=6){
		a_paw=1
		return a_paw
	}
}
function length_sms(c){
	a_sms=0  //返回1为正确，0为错误
	if(c>=4){
		a_sms=1
		return a_sms
	}
}
//登陆页面按钮控制
$(function(){
	$(".zy-login-val").on('input', function(){
		var phone=$(".zy-phone").val()
		var paw=$(".zy-paw").val()
		if(length_phone(phone.length)==1&&length_paw(paw.length)==1&&z_phone.test(phone)){
			$(".zy-btn").attr("disabled",false);
		}
		else{
			$(".zy-btn").attr("disabled",true);
		}
	})
})
//忘记密码验证码
var sms_time=60;
function getsms(obj){
	var phone=$(".zy-phone").val()
	if(sms_time==60){
		console.log(sms_time)
		if(!z_phone.test(phone)){
	    		$.alert("请输入正确的手机号码", "");
	    		return;
	  	}
		else{
			obj.setAttribute("disabled", true);
			obj.value=sms_time + "s后重新发送";
			sms_time--;
		}
	}
	else if (sms_time == 0) {
		obj.removeAttribute("disabled");
		obj.value="获取验证码";
		sms_time = 60;
		return;
	}
	else {
		obj.setAttribute("disabled", true);
		obj.value=sms_time + "s后重新发送";
		sms_time--;
	}
	setTimeout(function() {
		getsms(obj) }
	,1000)
}
//忘记密码页面按钮控制
$(function(){
	$(".zy-sms-val").on('input', function(){
		var phone=$(".zy-phone").val()
		var sms=$(".zy-sms").val()
		if(length_phone(phone.length)==1 && length_sms(sms.length)==1 && z_phone.test(phone)){
			$(".zy-btn").attr("disabled",false);
		}
		else{
			$(".zy-btn").attr("disabled",true);
		}
	})
})
//显示密码
$(function(){
	$('.zy-paw-hide').click(function(){
		$('.zy-paw-hide').hide()
		$('.zy-paw-show').show()
		$(this).parent().find('.zy-paw').attr("type","text");
	})
	$('.zy-paw-show').click(function(){
		$('.zy-paw-show').hide()
		$('.zy-paw-hide').show()
		$(this).parent().find('.zy-paw').attr("type","password");
	})
})
//注册验证码
var reg_time=60;
function regsms(){
	var obj=document.getElementById("reg_sms")
	if (reg_time == 0) {
		obj.removeAttribute("disabled");
		obj.value="获取验证码";
		reg_time = 60;
		return;
	}
	else {
		obj.setAttribute("disabled", true);
		obj.value=reg_time + "s后重新发送";
		reg_time--;
	}
	setTimeout(function() {
		regsms() }
	,1000)
}
/*************************
**短信登陆页面JS(message_login.html)
***************************/
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
$(function(){
	$(".zy-phone").on("input",function(){
		var phone=$(".zy-phone").val();
		// var z_phone=/^1[34578][0-9]{9}$///手机号
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
/*************************
**邀请奖励页面JS（receiver_packs.html）
***************************/
$(function(){
	$(".ver-login-phone").on("input",function(){
		var phone=$(".zy-phone").val();
		// var z_phone=/^1[34578][0-9]{9}$///手机号
		if(phone.length==11&&z_phone.test(phone)){
			$(".ver-login-now").attr("disabled",false);
		}else{
			$(".ver-login-now").attr("disabled",true);
		}
	})
	$(".ver-login-now").click(function(event) {
		$(".wh-receiver-hiden").show();
		$(".wh-receiver-now").hide();
	});
})
$(".ver-login-psw").on("input",function(){
	var textlenght=$(".zy-sms-val").val();

	if(textlenght>0){
		$(".ver-login-true").attr("disabled",false);
	}else{
		$(".ver-login-true").attr("disabled",true);
	}
})
$(function(){
	$(".zy-sms-btn").click(function(event) {
		$(".ver-login-psw").attr("disabled",false);
		$(".ver-login-psw").focus();
	});
})
