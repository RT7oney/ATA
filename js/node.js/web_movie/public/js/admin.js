//处理删除等高等逻辑
$(function(){
	$('.del').click(function(e){
		var target = $(e.target)
		var id = target.data('id')
		var tr = $('.item-id-'+id)
		console.log(target)
		console.log(id)
		console.log(tr)
		$.ajax({
			type:'DELETE',
			url:'admin?id='+ id
		}).done(function(res){
			if(res.success === 1){
				if(tr.length > 0){
					tr.remove()
				}
			}
		})
	})

	$('#douban').blur(function(){
		var douban = $(this)
		var id = douban.val()

		if(id){
			$.ajax({
				url:'https://api.douban.com/v2/movie/subject'+id,
				cache:true,
				type:'get',
				dataType:'jsonp',
				crossDomain:true,
				jsonp:'callback',
				success:function(data){

				}
			})
		}
	})
})