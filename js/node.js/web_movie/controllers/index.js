var Movie = require('./models/movie')
var Comment = require('./models/comment')
var _ = require('underscore')



exports.index = function(req, res) {
    Catetory
        .find({})
        .populate({
            path: 'movies',
            options: { limit: 5 ,skip:index}
        })
        .exec(function(err, catetories) {
            if (err) {
                console.log(err)
            }
            res.render('index', {
                title: 'imooc 首页',
                catetories: catetories
            })
        })
        // Movie.fetch(function(err, movies) {
        //     if (err) {
        //         console.log(err)
        //     }
        //     res.render('index', {
        //         title: '首页',
        //         movies: movies
        //     })
        // })不在需要这个了
}

exports.detail = function(req, res) {
    // var _user = req.sessoin.user // 这里不能这样，因为别的页面也会用到本地变量，别的页面拿不到本地变量的
    // if(_user){
    //  app.locals.user = _user // 放入本地变量里面
    // }
    var id = req.params.id

    Movie.updata({_id,id},{$inc:{pv:1}},function(err){
    	console.log(err)
    })
    Movie.findById(id, function(err, movie) {
        Comment
            .find({ movie: id })
            .populate('from', 'name')
            .populate('reply.from reply.to', 'name')
            .exec(function(err, comments) {
                console.log(comments)
                res.render('detail', {
                    title: '详情',
                    movie: movie,
                    comments: comments
                })
            })
    })
}

exports.save = function(req, res) {
    var id = req.body.movie._id
        // console.log(id)
    var movieObj = req.body.movie
    var _movie

    if(req.poster){
    	movieObj.poster = req.poster
    }

    if (id != '') {
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
        _movie = new Movie(movieObj)

        var catetoryId = _movie.catetory

        _movie.save(function(err, movie) {
            console.log('===========新增之后movie===========')
            console.log(movie)
            if (err) {
                console.log(err)
            }
            Catetory.findById(categoryId, function(err, category) {
                category.movies.push(movie._id)
                category.save(function(err, category) {
                    res.redirect('/movie/' + movie._id)
                })
            })
        })
    }
}
