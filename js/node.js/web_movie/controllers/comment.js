var Comment = require('../models/comment')

exports.save = function(req, res) {
    var _comment = req.body.comment
    var movieId = _comment.movie
    if (_comment.cid) { //正常情况下没有，点击用户头像的时候，动态插入一条cid
        Comment.findById(_comment.cid, function(err.comment) {
            var reply = {
                from: _comment.from,
                to: _comment.tid,
                content: _comment.content
            }

            comment.reply.push(reply) // 对当前的评论的reply数组push一条数据
            comment.save(function(err, comment) {
                if (err) {
                    console.log(err)
                }
                res.redirect('/movie/' + movieId)
            })
        })
    } else {
        var comment = new Comment(_comment)
        comment.save(function(err, movie) {
            if (err) {
                console.log(err)
            }
            res.redirect('/moive/' + movieId)
        })
    }

}
