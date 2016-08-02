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
            $.ajax({
                type:'post',
                url:'?do=index&cmd=findSMS',
                data:{phone:phone},
                dataType:'json',
                success:function(data){
                    if(data['ret']==200){
                        if(data['data']['status']==1){
                        }else{
                            $.alert(data['data']['error_msg']['msg'], "");
                        }
                    }else{
                        $.alert("请重新刷新页面", "");
                    }
                }
            })
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
        var paw1=$(".zy-new-paw1").val()
        var paw2=$(".zy-new-paw2").val()
		if(length_phone(phone.length)==1 && length_paw(paw1.length)==1 && paw1==paw2 && length_sms(sms.length)==1 && z_phone.test(phone)){
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
		$('.zy-paw').attr("type","text");
		// $(this).parent().find('.zy-paw').attr("type","text");
	})
	$('.zy-paw-show').click(function(){
		$('.zy-paw-show').hide()
		$('.zy-paw-hide').show()
		$('.zy-paw').attr("type","password");
		// $(this).parent().find('.zy-paw').attr("type","password");
	})
})
// $(function(){
// 	$('#hide1').click(function(){
// 		$('#hide1').hide()
// 		$('#show1').show()
// 		$(this).parent().find('.zy-paw').attr("type","text");
// 	})
// 	$('#show1').click(function(){
// 		$('#show1').hide()
// 		$('#hide1').show()
// 		$(this).parent().find('.zy-paw').attr("type","password");
// 	})
// })
// $(function(){
// 	$('#hide2').click(function(){
// 		$('#hide2').hide()
// 		$('#show2').show()
// 		$(this).parent().find('.zy-paw').attr("type","text");
// 	})
// 	$('#show2').click(function(){
// 		$('#show2').hide()
// 		$('#hide2').show()
// 		$(this).parent().find('.zy-paw').attr("type","password");
// 	})
// })
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


function setCookie(c_name,value,expiredays)
{
    var exdate=new Date()
    exdate.setDate(exdate.getDate()+expiredays)
    document.cookie=c_name+ "=" +escape(value)+
        ((expiredays==null) ? "" : ";expires="+exdate.toGMTString())
}

function getCookie(c_name)
{
    if (document.cookie.length>0)
    {
        c_start=document.cookie.indexOf(c_name + "=")
        if (c_start!=-1)
        {
            c_start=c_start + c_name.length+1
            c_end=document.cookie.indexOf(";",c_start)
            if (c_end==-1) c_end=document.cookie.length
            return unescape(document.cookie.substring(c_start,c_end))
        }
    }
    return ""
}

/*************************
**短信登陆页面JS(message_login.html)
*by  王行
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
	$(".wh-phone").on("input",function(){
		var phone=$(".wh-phone").val();
		// var z_phone=/^1[34578][0-9]{9}$///手机号
		if(phone.length==11&&z_phone.test(phone)){
			$(".zy-sms-btn").attr("disabled",false);
		}else{
			$(".zy-sms-btn").attr("disabled",true);
		}
	})
	$(".wh-sms-val").on("input",function(){
		var phone=$(".wh-phone").val();
		var sms=$(".wh-sms-val").val();
		if(phone.length==11&&sms.length==6){
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
	$("#check").click(function() {
		// ajax 验证图形验证码
		var code = $("#authcode").val();
		if(!code){
			return false;
		}
		$.post("?do=index&cmd=authcheck",{code:code},function(msg){
			// console.log(msg);
			if(msg==1){
				sms_sms();
				$(".wh-message-login-pop").hide();
				$(".message-login").show();
				$(".wh-sms-val").attr("disabled",false);
				$(".wh-sms-val").focus();
				//ajax 调用短信接口
				var phone = $("#phone").val();
				$.ajax({
						type: 'post',
						url: '?do=index&cmd=loginSMS',
						data: {
								phone: phone
						},
						dataType: 'json',
						success: function(data) {
								// $.hideLoading();
								console.log(data);
								if (data['ret'] == 200) {
                    if (data['data']['status'] == 1) {
                        $.alert(data['data']['content'],"");
                    } else {
                        $.alert(data['data']['error_msg']['msg'], "");
                    }
                } else {
                    $.alert("请重新刷新页面", "");
                }
						},
						error: function(msg) {
							console.log(msg);
								// $.hideLoading();
								$.alert("网络出错，请重新刷新页面");
						}
				})
			}else{
				$('#changepng').click();
			}
		});

	});
})
/*************************
**邀请奖励页面JS（receiver_packs.html）
*by 王行
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
	// $(".ver-login-now").click(function(event) {
	// 	$(".wh-receiver-hiden").show();
	// 	$(".wh-receiver-now").hide();
	// });
})
$(".ver-login-psw").on("input",function(){
	var textlenght=$(".ver-login-psw").val();

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
