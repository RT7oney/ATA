var http = require('http')
var querystring = require('querystring')

var postData = querystring.stringfy({
	'content':'一起期待一下',
	'cid':348
})

var options = {
	hostname:'www.imooc.com',
	port:80,
	path:'/course/document',
	method:'POST',
	headers:{

	}
}
var req = http.request(options,function(res){
	console.log('Status: '+res.statusCode)
	console.log('headers: '+JSON.stringfy(res.statusCode))

	res.on('data',function(chunk){
		console.log(Buffer.isBuffer(chunk))
		console.log(typeof chunk)
	})

	res.on('end',function(){
		console.log('评论完毕！')
	})
})

req.on('error',function(e){
	console.log('Error: '+e.message)
})

req.write(postData)
req.end()
