var fs = require('fs') // 读文件写文件异步的
var path = require('path')
// 中间件
exports.signinCheck = function(req, res, next) {
    var user = req.session.user
    if (!user) {
        return res.redirect('/signin')
    }
    next()
}

exports.adminCheck = function(req, res, next) {
    var user = req.session.user
    if (user.role <= 10){
        return res.redirect('/')
    }
    next()
}

exports.savePoster = function(req,res,next){
    var posterData = req.files.posterData
    var filePath = posterData.path
    var originalFilename = posterData.originalFilename

    if (originalFilename){
        fs.readFile(filePath,function(err,data){
            var timestamp = Date.now() //用来命名新的文件名字
            var type = posterData.type.split('/')[1]
            var poster = timestamp+'.'+type
            var newPath = path.join(__dirname,'../../','/public/upload'+poster)
            fs.writeFile(newPath,data,function(err){
                req.poster = poster
                next()
            })
        })
    }else{
        next()
    }
}