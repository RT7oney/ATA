$(function(){
	$(".ver-login-phone").on("input",function(){
		var phone=$(".zy-phone").val();
		var z_phone=/^1[34578][0-9]{9}$///手机号
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
var sms_time=60;
function getsms(obj){
if (sms_time == 0) {
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
