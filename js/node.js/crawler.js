// console.log('heoelo');
/***************http服务器******************/ 
// var http = require('http');

// http.createServer(function (request, response) {

// 	// 发送 HTTP 头部 
// 	// HTTP 状态值: 200 : OK
// 	// 内容类型: text/plain
// 	response.writeHead(200, {'Content-Type': 'text/plain'});

// 	// 发送响应数据 "Hello World"
// 	response.end('Hello World\n');
// }).listen(8888);

// // 终端打印如下信息
// console.log('Server running at http://127.0.0.1:8888/');
/***************http服务器******************/ 
// 
var http = require('http')
var cheerio = require('cheerio')
var url = 'http://www.imooc.com/learn/348'
var html = ''
//cheerio 和 jQuery一样可以操作装载后的html

function filterChapters(html){
	var $ = cheerio.load(html)
	var chapters = $('.chapter')
	console.log('==========chapters==========')
	console.log(chapters)
	console.log('==========chapters==========')
	// [{
	// 	chapterTitle:'',
	// 	video:[
	// 		title:'',
	// 		id:'',
	// 	]
	// }]
	var courseData = []
	chapters.each(function(item){
		var chapter = $(this)//?
		console.log('===========chapter===========')
		console.log(chapter)
		console.log('===========chapter===========')
		var chapterTitle = chapter.find('strong').text()
		var videos = chapter.find('.video').children('li')
		var chapterData = {//这一章的内容
			chapterTitle:chapterTitle,
			videos:[]
		}
		videos.each(function(item){
			var video = $(this).find('.studyvideo')
			var videoTitle = video.text()
			var id = video.attr('href').split('video/')[1]
			chapterData.videos.push({
				title:videoTitle,
				id:id
			})
		})
		courseData.push(chapterData)
	})
	return courseData
}

function printCourseInfo(courseData){
	courseData.forEach(function(item){
		var chapterTitle = item.chapterTitle
		console.log(chapterTitle+'\n')
		item.videos.forEach(function(video){
			console.log('【'+video.id+'】'+video.title+'\n')
		})
	})
}

http.get(url ,function(res){
	res.on('data',function(data){
		html += data
	})

	res.on('end',function(){
		// console.log(html)
		var courseData = filterChapters(html)
		printCourseInfo(courseData)
	})
}).on('error',function(){
	console.log('获取课程信息出错')
})














