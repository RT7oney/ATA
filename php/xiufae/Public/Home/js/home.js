$(function(){
	var ThinkPHP = window.Think;
	var hits=$("[id='hits']");
	if($(hits)){
		var model=$(hits).attr("model");
		var hits=$(hits).attr("hits");
	}
	if(ThinkPHP.CONTROLLER_NAME=="Movie" || ThinkPHP.CONTROLLER_NAME=="News"){
		var model=ThinkPHP.CONTROLLER_NAME;
		var hits=1;
		$.get(ThinkPHP.U("Home/"+model+"/hist","id="+ThinkPHP.ID+"&hits="+hits),function(date){
			if(ThinkPHP.PATTEM>1){
				$("[id='digg_up']").text(date.up);
				$("[id='digg_down']").text(date.down);
				$("[id='hits']").text(date.hits);
			}												   
		});
	}
	if(ThinkPHP.CONTROLLER_NAME=="Index"){
		var userID=getQueryString('userID');
		if(userID){
			$.get(ThinkPHP.U("User/Recom/rlink","uid="+userID),function(date){
				var str=date.split("|");
				layer.msg(str[1],{icon: str[0]});
			});
		}
	}
	digg=function(id,type,model){
		$.get(ThinkPHP.U("Home/"+model+"/digg","id="+id+"&digg="+type),function(date){
			$("[id='digg_up']").text(date.up);
			$("[id='digg_down']").text(date.down);
			digg_mag(type);
		});
	}
	digg_mag=function(type){
		if(type=="up"){
			layer.msg("+1",{icon: 6});
		}else{
			layer.msg("+1",{icon: 5});
		}
	}
	function getQueryString(name){ 
		var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i"); 
		var r = window.location.search.substr(1).match(reg); 
		if (r != null) return unescape(r[2]);
		return null; 
	} 
})