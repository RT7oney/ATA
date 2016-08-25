var _ = require('underscore')
var Movie = require('./models/movie')
var User = require('./models/user')
var IndexController = require('./controllers/index')
var MiddleWare = require('./middleware/middle')

module.exports = function(app/*接收到的app参数*/) { // 对外抛出这个模块

    // app.get('/admin',MiddleWare.signinCheck,MiddleWare.adminCheck,IndexController.index)

    app.post('/user/signup', function(req, res) {
        var _user = req.body.user
            // req.param('user')
            // console.log(_user)
            // 先去数据库查询一下，防止重复注册
        User.find({ name: _user.name }, function(err, user) {
            if (err) {
                console.log(err)
            }
            if (user) {
                return res.redirect('/')
            } else {
                var user = new User(_user)
                user.save(function(err, user) {
                    if (err) {
                        console.log(err)
                    } else {
                        req.session.user = user
                        console.log(user)
                            // res.redirect('/admin/userlist')
                    }
                })
            }
        })

    })

    // app.get('/', function(req, res) {
    //     res.render('index', {
    //         title: '首页',
    //         movies: [{
    //             title: '机械战警',
    //             _id: 1,
    //             poster: 'http://a.hiphotos.baidu.com/baike/c0%3Dbaike80%2C5%2C5%2C80%2C26/sign=408739564e086e067ea5371963611091/8435e5dde71190ef8ed837b8cc1b9d16fdfa60b2.jpg'
    //         }, {
    //             title: '黑客帝国',
    //             _id: 2,
    //             poster: 'http://b.hiphotos.baidu.com/baike/c0%3Dbaike92%2C5%2C5%2C92%2C30/sign=3b580a380a24ab18f41be96554938da8/0b46f21fbe096b639f1ab14e0f338744ebf8aca9.jpg'
    //         }, {
    //             title: '四月物语',
    //             _id: 1,
    //             poster: 'http://h.hiphotos.baidu.com/baike/c0%3Dbaike92%2C5%2C5%2C92%2C30/sign=322cdf62b7fb43160e12722841cd2d46/5d6034a85edf8db1c452c3cd0c23dd54564e741e.jpg'
    //         }, {
    //             title: '机械战警',
    //             _id: 1,
    //             poster: 'http://a.hiphotos.baidu.com/baike/c0%3Dbaike80%2C5%2C5%2C80%2C26/sign=a9bbcaca3adbb6fd3156ed74684dc07d/0b46f21fbe096b630e4520610f338744ebf8aca7.jpg'
    //         }]
    //     })
    // })
    // 
    app.get('/', function(req, res) {
        // var _user = req.sessoin.user // 这里不能这样，因为别的页面也会用到本地变量，别的页面拿不到本地变量的
        // if(_user){
        //  app.locals.user = _user // 放入本地变量里面
        // }
        Movie.fetch(function(err, movies) {
            if (err) {
                console.log(err)
            } else {
                res.render('index', {
                    title: '首页',
                    movies: movies
                })
            }
        })
    })

    app.get('/logout', function(req, res) {
        delete req.session.user
        delete app.locals.user
        res.redirect('/')
    })

    app.get('/movie/:id', function(req, res) {
        var id = req.params.id
        Movie.findById(id, function(err, movie) {
            console.log('===========详情页movie===========')
            console.log(movie)
            res.render('detail', {
                    title: movie.title + '详情',
                    movie: movie,
                })
                // [{
                //     director: '保罗·格林格拉斯',
                //     country: '美国',
                //     title: '谍影重重5',
                //     year: '2016',
                //     poster: 'http://g.hiphotos.baidu.com/baike/c0%3Dbaike180%2C5%2C5%2C180%2C60/sign=97feadf651ee3d6d36cb8f99227f0647/5ab5c9ea15ce36d313fa3d6132f33a87e850b1e1.jpg',
                //     language: '英语',
                //     flash: 'http://static1.mtime.cn/static/flash/outplayer.swf?vid=60836',
                //     summary: '在后斯诺登时代，中情局系统被黑客入侵，多项特工计划可能泄露。与此同时，中情局还发现了杰森·伯恩（马特·达蒙饰）和好搭档尼基·帕森斯（朱丽娅·斯蒂尔斯饰）的踪迹。年轻的网络专家海瑟·李（艾丽西亚·维坎德饰）自告奋勇追踪杰森·伯恩，而杰森·伯恩也在寻找着关于自己身世的惊天黑幕。中情局高官罗伯特·杜威（汤米·李·琼斯饰）是知晓一切幕后秘密的人。罗伯特·杜威、海瑟·李和杰森·伯恩之间的角力悬念，不到最后一刻，就无法了解真正的结局',
                // }]
        })

    })

    app.get('/admin', function(req, res) {
        Movie.fetch(function(err, movies) {
                if (err) {
                    console.log(err)
                } else {
                    res.render('list', {
                        title: '列表',
                        movies: movies
                    })
                }
            })
            // res.render('list', {
            //     title: '列表',
            //     movies: [{
            //         title: '谍影重重5',
            //         _id: '1',
            //         director: '保罗·格林格拉斯',
            //         country: '美国',
            //         year: '2016',
            //         language: '英语',
            //         flash: 'http://static1.mtime.cn/static/flash/outplayer.swf?vid=60836',
            //     }],
            // })
    })

    app.get('/admin/add', function(req, res) {
        res.render('add', {
            title: '管理员',
            movie: {
                title: '',
                director: '',
                country: '',
                year: '',
                poster: '',
                flash: '',
                summary: '',
                language: '',
            }
        })
    })

    app.get('/admin/update/:id', function(req, res) {
        var id = req.params.id
        if (id) {
            Movie.findById(id, function(err, movie) {
                res.render('add', {
                    title: '更新',
                    movie: movie,
                })
            })
        }
    })

    app.post('/admin/addpost', function(req, res) {
        var id = req.body.movie._id
            // console.log(id)
        var movieObj = req.body.movie
        var _movie

        if (id != 'undefined') {
            Movie.findById(id, function(err, movie) {
                if (err) {
                    console.log(err)
                }
                _movie = _.extend(movie, movieObj)
                _movie.save(function(err, movie) {
                    if (err) {
                        console.log(err)
                    }
                    // console.log(movie)
                    res.redirect('/movie/' + movie._id)
                })
            })
        } else {
            // console.log(req.body.movie)
            _movie = new Movie({
                director: movieObj.director,
                title: movieObj.title,
                country: movieObj.country,
                language: movieObj.language,
                year: movieObj.year,
                poster: movieObj.poster,
                flash: movieObj.flash,
                summary: movieObj.summary,
            })

            _movie.save(function(err, movie) {
                console.log('===========新增之后movie===========')
                console.log(movie)
                if (err) {
                    console.log(err)
                }
                res.redirect('/movie/' + movie._id)
            })
        }
    })

    app.delete('/admin', function(req, res) {
        var id = req.query.id

        if (id) {
            Movie.remove({ _id: id }, function(err, movie) {
                if (err) {
                    console.log(err)
                } else {
                    res.json({ success: 1 })
                }
            })
        }
    })
}
