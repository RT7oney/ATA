var EventEmitter = require('events').EventEmitter
var life = new EventEmitter()

function a1(who){
	console.log('1');

}

life.on('A',a1)
life.on('A',function(who){
	console.log('2');
})
life.on('A',function(who){
	console.log('3');
})
life.on('A',function(who){
	console.log('4');
})
life.on('A',function(who){
	console.log('5');
})
life.on('A',function(who){
	console.log('6');
})
life.on('A',function(who){
	console.log('7');
})
life.on('A',function(who){
	console.log('8');
})
life.on('A',function(who){
	console.log('9');
})
life.on('A',function(who){
	console.log('10');
})

life.removeListener('A',a1);

var haslistended = life.emit('A','事件')



