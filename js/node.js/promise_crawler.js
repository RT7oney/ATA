// var https = require('https');
// var fs = require('fs');

// var options = {
//     key: fs.readFileSync('ssh_key.pem'),
//     cert: fs.readFileSync('ssh_cert.pem'),
// }

// https.createServer(options, function(req,res) {
//     res.writeHead(200)
//     res.end('Hello Imooc')
// }).listen(8090);
// 
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
var Promise = require('Promise')
var cheerio = require('cheerio')
var baseUrl = 'http://www.imooc.com/learn/'
var url = 'http://www.imooc.com/learn/348'
var html = ''
var videoIds = [348, 259, 197, 134, 75]
    //cheerio 和 jQuery一样可以操作装载后的html

function filterChapters(html) {
    var $ = cheerio.load(html)
    var chapters = $('.chapter')
    console.log('==========chapters==========')
    console.log(chapters)
    console.log('==========chapters==========')
    var title = $('#page_header .path span').text()
    var number = parseInt($($('.info_num i')[0]).text().trim(), 10)
        // courseData = {
        //     title: title,
        //     number: number,
        //     videos: [{
        //         chapterTitle: '',
        //         video: [
        //             title: '',
        //             id: '',
        //         ]
        //     }]
        // }
    var courseData = {
        title: title,
        number: number,
        videos: []
    }
    chapters.each(function(item) {
        var chapter = $(this) //?
        console.log('===========chapter===========')
        console.log(chapter)
        console.log('===========chapter===========')
        var chapterTitle = chapter.find('strong').text()
        var videos = chapter.find('.video').children('li')
        var chapterData = { //这一章的内容
            chapterTitle: chapterTitle,
            videos: []
        }
        videos.each(function(item) {
            var video = $(this).find('.studyvideo')
            var videoTitle = video.text()
            var id = video.attr('href').split('video/')[1]
            chapterData.videos.push({
                title: videoTitle,
                id: id
            })
        })
        courseData.push(chapterData)
    })
    return courseData
}

function printCourseInfo(coursesData) {
    coursesData.forEach(function(courseData) {
        console.log(courseData.number + ' 人学过' + courseData.title + '\n')
    })

    coursesData.forEach(function(courseData) {
        console.log('###' + courseData.title + '\n')
        courseData.videos.forEach(function(item) {
            // console.log('###' + courseData.title + '\n')
            var chapterTitle = item.chapterTitle
            console.log(chapterTitle + '\n')
            item.videos.forEach(function(video) {
                console.log('【' + video.id + '】' + video.title + '\n')
            })
        })
    })

}

function getPageAsync(url) {
    return new Promise(function(resolve, reject) {
        console.log('正在爬取' + url)
    })
    http.get(url, function(res) {
        res.on('data', function(data) {
            html += data
        })

        res.on('end', function() {
            resolve(html)
                // console.log(html)
                // var courseData = filterChapters(html)
                // printCourseInfo(courseData)
        })
    }).on('error', function(e) {
        reject(e)
        console.log('获取课程信息出错')
    })
}

var fetchCourseArray = []

videoIds.forEach(function(id) {
    fetchCourseArray.push(getPageAsync(baseUrl + id))
})

Promise
    .all(fetchCourseArray)
    .then(function(pages) {
        var coursesData = []
        pages.forEach(function(html) {
            var courses = filterChapters(html)
            coursesData.push(courses)
        })
        courseData.sort(function(a, b) {
            return a.number < b.number
        })
        printCourseInfo(courseData)
    })
