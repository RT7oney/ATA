var express = require('express')
var path = require('path')
var mongoose = require('mongoose')
var mongoStore = require('connect-mongo')(express)
var bodyParser = require('body-parser')
var _ = require('underscore')
var Movie = require('./models/movie')
var User = require('./models/user')
var app = express()

mongoose.connect('mongodb://localhost/web_movie')

app.set('views', './views/pages')
app.set('view engine', 'jade')
app.locals.moment = require('moment')
    // app.use(express.bodyParser()) // 表单格式化
app.use(bodyParser.urlencoded({ extended: true })) // 如果 不继承，那么表单中的name=movie[_id],movie不会被识别为对象
app.use(express.static(path.join(__dirname, 'public')))
app.use(express.cookieParser())
app.use(express.multipart())
app.use(express.session({
        secret: 'ryan'
        store: new mongoStore({
            url: 'mongodb://localhost/web_movie',
            collection: 'sessions'
        })
    }))
    // app.set('port', 3000)
app.listen(3000)

if('development' == app.get('env')){
	app.set('showStackError',true)
	app.user(express.logger(':method :url :status'))
	app.locals.pretty = true
	mongoose.set('debug',true)
}

require('./route.js')(app)

// 预处理(和中间件性质不太一样)
app.use(function(req, res, next) {
    var _user = req.session.user
    if (_user) {
        app.locals.user = _user
    }
    return next()
})




