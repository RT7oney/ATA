var stream = require('stream')
var util = require('util')

function RedStream(){
	stream.Readable.call(this)
}

util.inherits(RedStream,stream.Readable)

RedStream.prototype._read = function() {
	// body...
	this.push('t')
	this.push('tasd')
	this.push('t3')
	this.push('3')
}

function WritStream(){
	stream.Writable.call(this)
	this._cached = new Buffer('')
}

util.inherits(WritStream,stream.Writable)

WritStream.prototype._write = function(chunk,encode,cb){
	console.log(chunk.toString())
	cb()
}

function TransformStream(){
	stream.Transform.call(this)
}

util.inherits(TransformStream,stream.Transform)

TransformStream.prototype._transform = function(chunk,encode,cb){
	this.push(chunk)
	cb()
}

TransformStream.prototype._flush = function(cb){
	this.push("oh yeah!")
	cb()
}

var rs = new RedStream() // 可读流
var ws = new WritStream() // 可写流
var ts = new TransformStream() // 转换流

rs.pipe(ts).pipe(ws)


