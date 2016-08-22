var http = require('http')
var fs = require('fs')

http
	.createServer(function(req,res){
		// 1
		// 
		// fs.readFile('./buffer/logo.png',function(err,data){
		// 	if(err){
		// 		res.end('file not exists!')
		// 	}else{
		// 		res.writeHeader(200,{'Context-Type':'text/html'})
		// 		res.end(data)
		// 	}
		// })
		// 
		// 2
		// 
		// fs.createReadStream('../buffer/logo.png').pipe(res)
		// 
		// 3
		// 
		request('url.......png').pipe(res)//自动监听data和end事件，并且还能控制服务器压力，所以在客户端连接缓慢的时候，可以将尽可能少的缓存放在内存里面
	})
	.listen(8090)