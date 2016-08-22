var fs = require('fs')

var readStream = fs.createReadStream('stream_copy_logo.js')
var n = 0;

readStream
    .on('data', function() {
        n++;
        console.log('data emits')
        console.log(Buffer.isBuffer(chunk))

        readStream.pause()
        console.log('data pause')
        setTimeout(function() {
            console.log('data pause end')
            readStream.resume()
        }, 3000)
    })
    .on('readable', function() {
    	console.log(n)
        console.log('readable')
    })
    .on('end', function() {
        console.log('end')
    })
    .on('close', function() {
        console.log('close')
    })
    .on('error', function() {
        console.log('error')
    })

// 写文件的监听

readStream.on('data',function(chunk){
	if(writeStream.write(chunk) === false){
		console.log('still cached')
		readStream.pause()
	}
})

readStream.on('end',function(){
	writeStream.end()
})

writeStream.on('drain',function(chunk){
	console.log('data drains')
	readStream.resume()
})
