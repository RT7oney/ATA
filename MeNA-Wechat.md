# MeNA-Wechat
AshToArt
***
### 2016.08.29：
* 使用koa并且使用中间件的方式接通微信
* 在使用koa-router的时候，需要注意的一点是	

<!-- lang:javascript -->
	
	var KoaRouter = require('koa-router')
	var router = new KoaRouter() // 这里需要使用new关键字实例化
	var app = new Koa()

	//router.get('/test',
	//        wechatCom.getAccessToken({ msg: 'hello wowowowowo' })
	//    )//这样的方法是不行的，会报middleware must be a function
	
	router.get('/test', function*(next) {
    	wechatCom.getAccessToken({ msg: 'hello wowowowowo' })
	})// 需要像这样使用一个发电机函数
	app
      .use(router.routes())
      .use(router.allowedMethods()) //使路由规则生效


### 2016.08.30：
* 微信获取access_token 完成，我并没有使用“原型方法”的方法，我选择exports的形式将每个方法暴露出去，并且在自身调用的时候，把this对象赋值给the_that
* <font color=red>一个瓶颈问题：</font>

<!-- lang:javascript -->

	var _Promise = window.Promise
    var La = function(opts) {
        // var that = this
        this.id = opts.id
        this.p = this.add(opts.id)
    }
    La.prototype.add = function(a){
        var that = this
        addOne(a).then(function(data){
            minerOne(data)
        }).then(function(data){
            return data
        })
    }
    function addOne(a){
        return new _Promise(function(resolve,reject){
            resolve(a+11)
            console.log('here')
        })
    }
    function minerOne(a){
        return new _Promise(function(resolve,reject){
            resolve(a-100)
            console.log('there')
        })
    }
    var lala = new La({id:1})
    console.log(lala)
    
 * 终于理解了Promise，如下：
 
 <!-- lang:javascript -->
 		
 	//a.js
 	var b = require('b')
 	var i = //something
 	
 	var res = yield b.getRes(i)
 	// 如果想要使用这里的yield 关键字，必须要求b.getRes()  return回来一个promise
 	
 <!-- lang:javascript -->
 
 	//b.js
 	var Promise = require('bluebird')
 	
 	exports.getRes = function(i){
 		if(i === 1){
 			return /*这里的return是非常重要的*/ Promise.resolve('第一层返回，直接返回数据')
 		}else{
 			return /*这里的return是非常重要的*/ somePromiseFunc().then(function(data){
 				return /*这里的return是非常重要的*/ Promis.resolve('第二层返回，一层一层的返回，直到最后把promise 函数也返回回去')
 			})
 	}
 
### 2016.08.31：
* 深度理解promise以及mongoose

<!-- lang:javascript -->
	//app.js
	var Koa = require('koa')
	var KoaRouter = require('koa-router')
	var TestModReg = require('./models/DB/testMod') //这里要注册一下模型
	var test = require('./controllers/testCtr')
	var mongoose = require('mongoose')

	mongoose.connect('mongodb://localhost/test-koa-router')

	var app = new Koa()
	var router = new KoaRouter()


	router.get('/test',test.index('hello world'))

	app.use(router.routes()).use(router.allowedMethods())

	app.listen(9999)
	
<!-- lang:javascript -->
	//testCtr.js
	var TestProt = require('../models/testProt')

	exports.index = function(opts) {
    	return function*(next) {
        	console.log('====hi ctr====')
        	this.body = opts

        	// 业务逻辑
        	var Test = new TestProt('1764796')
        	var data = yield Test.getData()
        	console.log('===getData===')
        	console.log(data)
    	}
	}
<!-- lang:javascript -->
	//testProt.js
	'use strict'

	var Promise = require('bluebird')
	var mongoose = require('mongoose')
	var testMod = mongoose.model('Test')
	var request = Promise.promisify(require('request'))

	module.exports = testProt

	function testProt(opts) {
	    this.key = opts
	    // this.data = yield this.getData() // 未测试不知道有没有效果
	}

	testProt.prototype.getData = function() {
	    var that = this
	    return this.getDataFromUrl(this.key).then(function(data) {
	        return that.saveDataToDB(data) // 这里加上一个return拯救了testCtr里面的 var data = yield Test.getData()
	    })

	}

	testProt.prototype.getDataFromUrl = function(key) {
	    var api_url = 'https://api.douban.com/v2/movie/subject/' + key
	    return request({ url: api_url, json: true }).then(function(response) {
	        // console.log(response.body)
	        var data = {
	        	id:response.body.id,
	        	title :response.body.title,
	        	image:response.body.images.medium,
	        	genres:response.body.genres,
	        	summary:response.body.summary,
	        	directors:response.body.directors[0].name,
	        }
	        return Promise.resolve(data)
	    })
	}

	testProt.prototype.saveDataToDB = function(data) {
		console.log('====saveDataToDB====')
		var db_data = {
			data:JSON.stringify(data),
		}
	    var _data = new testMod(db_data)
	    // console.log(_data)
	    return new Promise(function(resolve, reject) {
	        _data.save(function(err, ret) {
	            err ? reject(err) : resolve(data)
	        })
	    })
	}
<!-- lang:javascript -->
	// testMod.js
	var mongoose = require('mongoose')
	var Schema = mongoose.Schema
	var ObjectId = Schema.Types.ObjectId

	var TestSchema = new mongoose.Schema({
	    data:String,
	    meta: {
	        createAt: {
	            type: Date,
	            default: Date.now()
	        },
	        updateAt: {
	            type: Date,
	            default: Date.now()
	        }
	    },
	})

	TestSchema.pre('save', function(next) {
	    if (this.isNew) {
	        this.meta.createAt = this.meta.updateAt = Date.now()
	    } else {
	        this.meta.updateAt = Date.now()
	    }
	    next()
	})

	TestSchema.statics = {
	    // console.log(this)
	    fetch: function(cb) {
	        console.log(this)
	        return this
	            .find({})
	            .sort('meta.updateAt')
	            .exec(cb)
	    },
	    findById: function(id, cb) {
	        return this
	            .findOne({ _id: id })
	            .exec(cb)
	    }
	}

	var TestMod = mongoose.model('Test', TestSchema)
	module.exports = TestMod
* 1菜单：我：1️⃣我的资料2️⃣我的人格（九型人格、心理测试）3️⃣我喜欢的（音乐，电影，书）
* 2菜单：和谁：1️⃣我的社交圈（记录，像我的人，奇缘广场）2️⃣新鲜事广场
* 3菜单：干嘛去1️⃣看电影（新片，热片，好片，院线）2️⃣听音乐（演唱会，榜单，新歌）3️⃣吃喝玩（附近餐馆，最近活动，出行，住房）4️⃣买买买（二手交易，线上买卖）
